<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\Test;
use App\Model\Candidate;
use App\Model\TestOtp;
use DB;

class ApiLoginController extends Controller
{
    //
    public function login(Request $request){
    	$login = $request->validate([
    		"email" => "required|string",
    		"password" => "required|string",
            "otp"=>"required"
    	]);

    	$user = self::findUser($login);

        if(!$user){
            return response(["code"=>"404","message"=>"Invalid credentials"]);
        }

        $candidate = self::validateCandidate($user->id,$login['otp']);

        if(!$candidate){
            return response(["code"=>"404","message"=>"Invalid OTP"]);
        }

        $participant = DB::table("test_participant")->where("kandidat_id",$candidate->id)->get();

        if(sizeof($participant)==0){
           return response(['code'=>'404','message'=>'participant not found']);
        }
        $participant = $participant[0];

        $testEvent = self::getTestEvent($participant->id);

        if(!$testEvent){
            return response(["code"=>"404","message"=>"Invalid Test Event"]);
        }

        Auth::login($user);

    	$accessToken = Auth::user()->createToken('authToken')->accessToken;

    	return response(["user"=>Auth::user(), "access_token"=>$accessToken, "test_event"=>$testEvent]);
    }

    protected function findUser($credentials){
        $user = User::where('email',$credentials['email'])->get();

        if(sizeof($user)==0) return false;
        $user = $user[0];

        if(Hash::check($credentials['password'], $user->password)){
            return $user;
        }

        return false;
    }

    protected function validateCandidate($userId, $otp){
        $candidate = Candidate::where("user_id",$userId)->get();

        if(sizeof($candidate)==0) return false;

        $candidate = $candidate[0];

        $cekOtp = TestOtp::where("id_kandidat",$candidate->id)
                                ->where("otp",$otp)
                                ->where("expired",'>',now())
                                ->get();

        if(!$cekOtp){
            return false;
        }
        
        return $candidate;
    }

    protected function getTestEvent($testId){
    

        $test = Test::find($testId);

        if(!$test){
            return false;
        }

        return $test;
    }
}
