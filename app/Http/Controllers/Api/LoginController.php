<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\Test;
use App\Model\TestParticipant;
use Exception;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
                                        "email" => "required|string",
                                        "password" => "required|string",
                                        "latitude" => "required",
                                        "longitude" => "required",
                                        "otp"=>"required"
                                    ]);

        if($validator->fails()) {
            return response()->json(["code"=>"20","message"=>$validator->errors()]);
        }

        $credentials = $request->all();

        // Get User Data
        $userData = self::getUserData($credentials['email']);
        if(!$userData){
            return response()->json(["code"=>"21","message"=>"User credentials not found"]);
        }
        // dd($userData);
        // Validate OTP
        if($userData->otp != $credentials['otp']){
            return response()->json(["code"=>"22","message"=>"OTP missmatch"]);
        }
        // Set timezone to Jakarta
        date_default_timezone_set('Asia/Jakarta');
        // Validate OTP expiration
        $otpExpDate = date_create($userData->expired);
        $now = date_create(now());
        $dateDiff = date_diff($now,$otpExpDate)->format('%R%a');
        
        if($dateDiff<0){
            return response()->json(["code"=>"23","message"=>"OTP Expired"]);
        }

        // Valdiate participant status
        if($userData->tp_status != 3){
            $message = self::getStatusParticipantMessage($userData->tp_status);
            return response()->json(["code"=>"24","message"=>$message]);
        }

        // Validate Test DateTime
        $testDate = date_create($userData->date_test);
        // Validate Test Time
        $testTime = $userData->time;
        $startTime = substr($testTime, 0,5);
        $endTime = substr($testTime, -5);
        $startDateTime = date_create($testDate->format("Y-m-d ").$startTime);
        $endDateTime = date_create($testDate->format("Y-m-d ").$endTime);


        // dd($now->format('Y-m-d H:i'), $startDateTime->format('Y-m-d H:i'),$endDateTime->format('Y-m-d H:i'));
        // dd($now < $startDateTime, $now > $endDateTime);
        $formatedNow = $now->format("d-m-Y H:i:s");
        $formatedTestDate = $testDate->format('d-m-Y');
        if($now < $startDateTime){
             return response()->json(["code"=>"25","message"=>"Test belum dimulai", "data"=>["test_date"=>$formatedTestDate,"start_time"=>$startTime, "end_time"=>$endTime, "now"=> $formatedNow]]);
        }

        if($now > $endDateTime){
             return response()->json(["code"=>"26","message"=>"Test sudah selesai", "data"=>["test_date"=>$formatedTestDate,"start_time"=>$startTime, "end_time"=>$endTime, "now"=> $formatedNow]]);
        }

        // Save user coordinates & radius
        $userLat = $credentials["latitude"];
        $userLong = $credentials["longitude"];

        $testLatlong = self::explodeLatLong($userData->latlong);

        if(!$testLatlong){
            return response()->json(["code"=>"27","message"=>"Invalid test coordinates format: ".$userData->latLong]);
        }

        $testLat = $testLatlong["lat"];
        $testLong = $testLatlong["long"];

        $radius = self::vincentyGreatCircleDistance($testLat, $testLong, $userLat, $userLong);

        $participantData = [
            "tp_id"=>$userData->tp_id,
            "location_start" => $userLat.",".$userLong,
            "radius_start" => $radius
        ];

        $updateLocation = self::saveUserLocation($participantData);

        if(!$updateLocation["success"]){
            return response()->json(["code"=>28,"message"=>$updateLocation["message"]]);
        }

        // Validate user credential
        if(!Auth::attempt(['email'=>$credentials['email'], 'password'=>$credentials['password'].env('SALT_PASS_CANDIDATE')])){
            return response()->json(["code"=>"29","message"=>"Username or password missmatch"]);
        }
        
        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        $testEvent = [
            "test_id" => $userData->id,
            "event_id" => $userData->event_id,
            "city" => $userData->city,
            "location" => $userData->location,
            "latlong" => $userData->latlong,
            "date_test" => $userData->date_test,
            // "set_test" => $userData->set_test,
            "status_test" => $userData->status_test,
            "id_kandidat" => $userData->id_kandidat,
            "id_participant" => $userData->id_participant,
            "test_participant_id" => $userData->tp_id,
            "location_radius" => $radius,
            "enrollment_time" => $now->format("Y-m-d H:i:s"),
            "remaining_time" => date_diff($now,$endDateTime)->format('%H:%I:%S')
        ];

        return response(["code"=>"00","message"=>"login success","data"=>["user"=>Auth::user(), "test_event"=>$testEvent, "access_token"=>$accessToken]]);
    }

    protected function getUserData($email){
        // RAW Query
        // SELECT te.*, u.*, totp.* FROM test_event te
        // JOIN test_participant tp ON te.id = tp.test_id
        // JOIN test_otp totp ON totp.id_kandidat = tp.kandidat_id
        // JOIN kandidat k ON k.id = tp.kandidat_id
        // JOIN users u ON u.id = k.user_id
        // WHERE u.email = 'ianahmad@gmail.com';

        $userData = Test::join("test_participant", "test_participant.test_id","=","test_event.id")
                        ->join("test_otp","test_otp.id_kandidat","=","test_participant.kandidat_id")
                        ->join("kandidat","kandidat.id","=","test_participant.kandidat_id")
                        ->join("users","users.id","=","kandidat.user_id")
                        ->where("users.email",$email)
                        ->select("users.*","test_event.*","test_otp.*","test_participant.id as tp_id","test_participant.status as tp_status")
                        ->get();
        // dd($userData);
        if(sizeof($userData)==0){
            return false;
        }

        return $userData[0];
    }

    protected function explodeLatLong($testLatlong){

        $latLong = explode(",", $testLatlong);

        if(sizeof($latLong)==1){
            return false;
        }

        return ["lat"=>$latLong[0],"long"=>$latLong[1]];
    }

    protected function saveUserLocation($participatData){
        $tpId = $participatData["tp_id"];
        // $tpId = 99;

        $testParticipant = TestParticipant::find($tpId);

        if(!$testParticipant){
            return ["success"=>false,"message"=>"Test participant not found. TP: ".$tpId];
        }
        
        $testParticipant->update([
            "location_start" => $participatData["location_start"],
            "location_start_radius" => $participatData["radius_start"]
        ]);
        
        return ["success"=>true];
    }


    /**
     * Calculates the great-circle distance between two points, with
     * the Vincenty formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    protected function vincentyGreatCircleDistance(
      $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    protected function getStatusParticipantMessage($status){
        switch ($status) {
            case 6:
                return "Kandidat terblokir karena melakukan screenshoot/capture";
                break;
            case 2:
                return "Jadwal test kandidat diubah";
                break;
            case 4:
                return "Kandidat tidak hadir";
                break;
            case 5:
                return "Kandidat telah menyelesaikan tes";
                break;
            
            default:
                return "Kandidat belum menghadiri tes";
                break;
        }
    }
}
