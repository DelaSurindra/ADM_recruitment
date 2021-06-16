<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Exports\DownloadResult;
use App\Model\Test;
use App\Model\TestOtp;
use App\Model\Candidate;
use App\Model\AlternatifTest;
use App\Model\TestParticipant;
use App\Model\Job_Application;
use App\Model\MasterSubtest;
use App\Model\MasterFacet;
use App\Model\CognitiveTestResult;
use App\Model\InventoryTestResult;
use App\Model\SetTest;
use App\Model\Wilayah;
use App\AdminSession;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\JobSendEmail;
use Response;
use Hash;
use Request;
use Session;
use DB;

class TestController extends Controller
{
    public function viewTest(){
        $getTest = Test::get()->toArray();
        if($getTest){
            $now=date("Y-m-d");
            for ($i=0; $i < count($getTest); $i++) { 
                $dateTest=date('Y-m-d', strtotime($getTest[$i]['date_test']));
                if ($now > $dateTest) {
                    Test::where('id', $getTest[$i]['id'])->update(['status_test' => 3]);
                }
            }
        }
        return view('admin.test.test-list')->with(['pageTitle' => 'Manajemen Test', 'title' => 'Manajemen Test', 'sidebar' => 'manajemen_test']);
    }

    public function listTest(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $test = new Test;
        if ($dataSend['search']){
            $test = $test->where('event_id','like','%'.$dataSend['search'].'%');
        }
        $countTest = $test->count();

        $listTest = $test->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listTest = $listTest->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listTest = $listTest->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }

        for ($i=0; $i < count($listTest) ; $i++) { 
            $listTest[$i]['date'] = $listTest[$i]['date_test'];
            $listTest[$i]['date_test'] = date('d/m/Y', strtotime($listTest[$i]['date_test']));
        }
        
        if ($listTest != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countTest,
                "recordsFiltered"   => $countTest,
                "data"              => $listTest
            );
        }else{
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => 0,
                "recordsFiltered"   => 0,
                "data"              => []
            );
        }
        return $response;
    }

    public function viewTestAdd(){
        $breadcrumb = [
            "page"      => "Manage Test",
            "detail"    => "Create Test",
            "route"     => "/HR/test"
        ];
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        return view('admin.test.test-add')->with(['pageTitle' => 'Manajemen Test', 'title' => 'Manajemen Test', 'sidebar' => 'manajemen_test', 'breadcrumb' => $breadcrumb, 'wilayah'=>$wilayah]);
    }

    public function addTest(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if (is_array($data['setTest'])) {
            $setTest = implode(",", $data['setTest']);
        }else{
            $setTest = $data['setTest'];
        }
        $city = strtoupper(substr($data['cityTest'], 0,3));
        $date = date('dmy', strtotime($data['dateTest']));
        $time = strtoupper(substr($data['timeTest'], 0,2));
        $rand = rand(pow(10, 3-1), pow(10, 3)-1);
        $testId = $city.$date.$time.$rand;
        $addTest = Test::insertGetId([
            "city" => $data['cityTest'],
            "time" => $data['timeTest'],
            "location" => $data['locationTest'],
            "date_test" => date("Y-m-d", strtotime($data['dateTest'])),
            "latlong" => $data['longlatTest'],
            "set_test" => $setTest,
            "status_test" => 1,
            "event_id" => $testId
        ]);

        if ($addTest) {
            if (isset($data['alternatifTest'])) {
                if (is_array($data['alternatifTest'])) {
                    for ($i=0; $i < count($data['alternatifTest']); $i++) { 
                        $addAlternatif = AlternatifTest::insert([
                            "date" => $data['alternatifTestDate'][$i],
                            "test_id" => $addTest,
                            "alternative_test_id" => $data['alternatifTest'][$i]
                        ]);
                    }
                }else{
                    $addAlternatif = AlternatifTest::insert([
                        "date" => $data['alternatifTestDate'],
                        "test_id" => $addTest,
                        "alternative_test_id" => $data['alternatifTest']
                    ]);
                }
                if ($addAlternatif) {
                    $id = base64_encode(urlencode($addTest));
                    $messages = [
                        'url' => 'test/detail-test/'.$id
                    ];
        
                    return redirect('/HR/test')->with('addTest', $messages);
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Create Test Failed',
                        'url' => 'close',
                        'id' => '',
                        'value' => ''
                    ];
        
                    return back()->with('notif', $messages);
                }
            }else{
                $id = base64_encode(urlencode($addTest));
                $messages = [
                    'url' => 'test/detail-test/'.$id
                ];
    
                return redirect('/HR/test')->with('addTest', $messages);
            }
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Create Test Failed',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return back()->with('notif', $messages);
        } 
        // dd($city, $date, $time, $rand, $testId);
    }

    public function viewTestEdit($id){
        $idTest = base64_decode(urldecode($id));
        $getTest = Test::where('id', $idTest)->get()->toArray();
        if ($getTest) {
            $getTest[0]['set_test'] = explode(",", $getTest[0]['set_test']);
            $getAlternatif = AlternatifTest::select('alternative_test_event.*', 'test_event.event_id')->join('test_event', 'test_event.id', 'alternative_test_event.alternative_test_id')->where('test_id', $idTest)->get()->toArray();
            $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
            // dd($getTest, $getAlternatif);

            $breadcrumb = [
                "page"      => "Manage Test",
                "detail"    => "Edit Test",
                "route"     => "/HR/test"
            ];
            // $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
            return view('admin.test.test-edit')->with([
                'pageTitle' => 'Manajemen Test', 
                'title' => 'Manajemen Test', 
                'sidebar' => 'manajemen_test', 
                'breadcrumb' => $breadcrumb,
                'data' => $getTest[0],
                'alternative' => $getAlternatif,
                'wilayah' => $wilayah
            ]);
        }else{
            abort(404);
        }
    }

    public function editTest(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if (is_array($data['setTest'])) {
            $setTest = implode(",", $data['setTest']);
        }else{
            $setTest = $data['setTest'];
        }
        
        // dd($data, $setTest);
        $editTest = Test::where('id', $data['idTest'])->update([
            "city" => $data['cityTest'],
            "time" => $data['timeTest'],
            "location" => $data['locationTest'],
            "date_test" => date("Y-m-d", strtotime($data['dateTest'])),
            "latlong" => $data['longlatTest'],
            "set_test" => $setTest,
            "status_test" => 1
        ]);

        if ($editTest) {
            $deleteAlternatif = AlternatifTest::where('test_id', $data['idTest'])->delete();
            if (isset($data['alternatifTest'])) {
                if (is_array($data['alternatifTest'])) {
                    for ($i=0; $i < count($data['alternatifTest']); $i++) { 
                        $addAlternatif = AlternatifTest::insert([
                            "date" => $data['alternatifTestDate'][$i],
                            "test_id" => $data['idTest'],
                            "alternative_test_id" => $data['alternatifTest'][$i]
                        ]);
                    }
                }else{
                    $addAlternatif = AlternatifTest::insert([
                        "date" => $data['alternatifTestDate'],
                        "test_id" => $data['idTest'],
                        "alternative_test_id" => $data['alternatifTest']
                    ]);
                }
                if ($addAlternatif) {
                    $messages = [
                        'status' => 'success',
                        'message' => 'Berhasil Mengubah Data Test',
                        'url' => '/HR/test',
                        'callback' => 'redirect'
                    ];
        
                    return response()->json($messages);
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Mengubah Data Test',
                    ];
        
                    return response()->json($messages);
                }
            }else{
                $messages = [
                    'status' => 'success',
                    'message' => 'Berhasil Mengubah Data Test',
                    'url' => '/HR/test',
                    'callback' => 'redirect'
                ];
    
                return response()->json($messages);
            }
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Gagal Mengubah Data Test',
            ];

            return response()->json($messages);
        }
    }

    public function viewTestDetail($id){
        $idTest = base64_decode(urldecode($id));
        $getTest = Test::where('id', $idTest)->get()->toArray();
        // dd($getTest);
        if ($getTest) {
            $getTest[0]['set_test_array'] = explode(",", $getTest[0]['set_test']);
            $countTestPart = TestParticipant::where('test_id', $idTest)->get()->count();
            $getAlternatif = AlternatifTest::select('alternative_test_event.*', 'test_event.event_id')->join('test_event', 'test_event.id', 'alternative_test_event.alternative_test_id')->where('test_id', $idTest)->get()->toArray();
            // dd($getTest, $getAlternatif);
            $breadcrumb = [
                "page"      => "Manage Test",
                "detail"    => "Manage Test Detail",
                "route"     => "/HR/test"
            ];
            // $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
            return view('admin.test.test-detail')->with([
                'pageTitle' => 'Manajemen Test', 
                'title' => 'Manajemen Test', 
                'sidebar' => 'manajemen_test', 
                'breadcrumb' => $breadcrumb,
                'data' => $getTest[0],
                'alternative' => $getAlternatif,
                'countPart' => $countTestPart
            ]);
        }else{
            abort(404);
        }
    }

    public function listCandidate(){
    	if (Request::input('order')[0]['column'] == '1') {
            $column = 'name';
        }elseif (Request::input('order')[0]['column'] == '2') {
            $column = 'universitas';
        }elseif (Request::input('order')[0]['column'] == '3') {
            $column = 'jurusan';
        }elseif (Request::input('order')[0]['column'] == '4') {
            $column = 'job_position';
        }elseif (Request::input('order')[0]['column'] == '5') {
            $column = 'type';
        }elseif (Request::input('order')[0]['column'] == '6') {
            $column = 'set_test';
        }elseif (Request::input('order')[0]['column'] == '7') {
            $column = 'area';
        }elseif (Request::input('order')[0]['column'] == '8') {
            $column = 'status_participant';
        }elseif (Request::input('order')[0]['column'] == '9') {
            $column = 'location_start_radius';
        }

        $order = $column.'_'.Request::input('order')[0]['dir'];

        if (Request::input('search')['value'] == null) {
        	$search = "NULL";
        }else{
        	$search = '"'.Request::input('search')['value'].'"';
        }

        $id = Request::input('param');
        // dd($id);
        $listCandidate = DB::select('EXEC get_kandidat NULL, NULL, NULL, NULL, NULL, NULL, NULL,'.$id.',NULL, '.$search.', "'.$order.'", "'.Request::input('start').'", "'.Request::input('length').'" ');
        $countCandidate = DB::select('EXEC get_kandidat_count NULL, NULL, NULL, NULL, NULL, NULL, NULL,'.$id.', NULL, '.$search.' ');
        for ($i=0; $i < count($listCandidate); $i++) { 
            $date = date('m/d/Y', strtotime($listCandidate[$i]->tanggal_lahir));
            $birthDate = explode("/", $date);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));

            $listCandidate[$i]->age = $age;

            $listCandidate[$i]->submit_date = date('m/d/Y', strtotime($listCandidate[$i]->submit_date));
            $listCandidate[$i]->gpa = round($listCandidate[$i]->gpa, 2);
        }
        // dd($listCandidate, $countCandidate);

        if ($listCandidate != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countCandidate[0]->total,
                "recordsFiltered"   => $countCandidate[0]->total,
                "data"              => $listCandidate
            );
        }else{
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => 0,
                "recordsFiltered"   => 0,
                "data"              => []
            );
        }
        return $response;
    }

    public function listCandidateTheDay(){
        $id = Request::input('value');
        // dd($id);
        $listCandidate = DB::select("EXEC get_kandidat NULL, NULL, NULL, NULL, NULL, NULL, NULL,'".$id."',NULL, NULL, NULL, '0', '0'");
        // dd($listCandidate);
        // $countCandidate = DB::select('EXEC get_kandidat_count NULL, NULL, NULL, NULL, NULL, NULL, NULL,'.$id.', NULL, '.$search.' ');
        // dd($listCandidate, $countCandidate);
        
        if ($listCandidate != null) {
            for ($i=0; $i < count($listCandidate); $i++) { 
                $date = date('m/d/Y', strtotime($listCandidate[$i]->tanggal_lahir));
                $birthDate = explode("/", $date);
                //get age from date or birthdate
                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));
    
                $listCandidate[$i]->age = $age;
    
                $listCandidate[$i]->submit_date = date('m/d/Y', strtotime($listCandidate[$i]->submit_date));
                $listCandidate[$i]->gpa = round($listCandidate[$i]->gpa, 2);
            }
            
        }
        return response()->json($listCandidate);
    }

    public function listCandidateFinish(){
    	if (Request::input('order')[0]['column'] == '0') {
            $column = 'name';
        }elseif (Request::input('order')[0]['column'] == '1') {
            $column = 'universitas';
        }elseif (Request::input('order')[0]['column'] == '2') {
            $column = 'jurusan';
        }elseif (Request::input('order')[0]['column'] == '3') {
            $column = 'job_position';
        }elseif (Request::input('order')[0]['column'] == '4') {
            $column = 'type';
        }elseif (Request::input('order')[0]['column'] == '5') {
            $column = 'set_test';
        }elseif (Request::input('order')[0]['column'] == '6') {
            $column = 'area';
        }elseif (Request::input('order')[0]['column'] == '7') {
            $column = 'status_participant';
        }elseif (Request::input('order')[0]['column'] == '8') {
            $column = 'location_start_radius';
        }elseif (Request::input('order')[0]['column'] == '9') {
            $column = 'location_end_radius';
        }elseif (Request::input('order')[0]['column'] == '10') {
            $column = 'skor';
        }

        $order = $column.'_'.Request::input('order')[0]['dir'];

        if (Request::input('search')['value'] == null) {
        	$search = "NULL";
        }else{
        	$search = '"'.Request::input('search')['value'].'"';
        }

        $id = Request::input('param');
        // dd($id);
        $listCandidate = DB::select('EXEC get_kandidat NULL, NULL, NULL, NULL, NULL, NULL, NULL,'.$id.',NULL, '.$search.', "'.$order.'", "'.Request::input('start').'", "'.Request::input('length').'" ');
        $countCandidate = DB::select('EXEC get_kandidat_count NULL, NULL, NULL, NULL, NULL, NULL, NULL,'.$id.', NULL, '.$search.' ');
        for ($i=0; $i < count($listCandidate); $i++) { 
            $date = date('m/d/Y', strtotime($listCandidate[$i]->tanggal_lahir));
            $birthDate = explode("/", $date);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));

            $listCandidate[$i]->age = $age;

            $listCandidate[$i]->submit_date = date('m/d/Y', strtotime($listCandidate[$i]->submit_date));
            $listCandidate[$i]->gpa = round($listCandidate[$i]->gpa, 2);
        }
        // dd($listCandidate, $countCandidate);

        if ($listCandidate != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countCandidate[0]->total,
                "recordsFiltered"   => $countCandidate[0]->total,
                "data"              => $listCandidate
            );
        }else{
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => 0,
                "recordsFiltered"   => 0,
                "data"              => []
            );
        }
        return $response;
    }

    public function listCandidatePick(){
    	if (Request::input('order')[0]['column'] == '1') {
            $column = 'date';
        }elseif (Request::input('order')[0]['column'] == '2') {
            $column = 'name';
        }elseif (Request::input('order')[0]['column'] == '3') {
            $column = 'tanggal_lahir';
        }elseif (Request::input('order')[0]['column'] == '4') {
            $column = 'gelar';
        }elseif (Request::input('order')[0]['column'] == '5') {
            $column = 'universitas';
        }elseif (Request::input('order')[0]['column'] == '6') {
            $column = 'fakultas';
        }elseif (Request::input('order')[0]['column'] == '7') {
            $column = 'jurusan';
        }elseif (Request::input('order')[0]['column'] == '8') {
            $column = 'gpa';
        }elseif (Request::input('order')[0]['column'] == '9') {
            $column = 'graduate_year';
        }elseif (Request::input('order')[0]['column'] == '10') {
            $column = 'job_position';
        }elseif (Request::input('order')[0]['column'] == '11') {
            $column = 'area';
        }

        $order = $column.'_'.Request::input('order')[0]['dir'];

        if (Request::input('search')['value'] == null) {
        	$search = "NULL";
        }else{
        	$search = '"'.Request::input('search')['value'].'"';
        }

        $id = Request::input('param');
        // dd($id);
        $listCandidate = DB::select('EXEC get_kandidat NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL,1, '.$search.', "'.$order.'", "'.Request::input('start').'", "'.Request::input('length').'" ');
        $countCandidate = DB::select('EXEC get_kandidat_count NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, 1, '.$search.' ');
        for ($i=0; $i < count($listCandidate); $i++) { 
            $date = date('m/d/Y', strtotime($listCandidate[$i]->tanggal_lahir));
            $birthDate = explode("/", $date);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));

            $listCandidate[$i]->age = $age;

            $listCandidate[$i]->submit_date = date('m/d/Y', strtotime($listCandidate[$i]->submit_date));
            $listCandidate[$i]->gpa = round($listCandidate[$i]->gpa, 2);
        }
        // dd($listCandidate, $countCandidate);

        if ($listCandidate != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countCandidate[0]->total,
                "recordsFiltered"   => $countCandidate[0]->total,
                "data"              => $listCandidate
            );
        }else{
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => 0,
                "recordsFiltered"   => 0,
                "data"              => []
            );
        }
        return $response;
    }

    public function addCandidateTest(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $now = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime($now . "+1 days"));
        // dd($data);
        if ($data['countChoose'] == "1") {
            $rand = rand(pow(10, 6-1), pow(10, 6)-1);
            $exp = explode("_", $data['idCandidate']);
            $addParticipan = TestParticipant::insertGetId([
                "kandidat_id" => $exp[0],
                "test_id"     => $data["idTest"],
                "status"      => 0,
                "reshedule_count" => 0,
                "id_job_application" => $exp[1]
            ]);
            $addOtp = TestOtp::insert([
                "otp"               => $rand,
                "expired"           => $tomorrow,
                "id_kandidat"       => $exp[0],
                "id_participant"    => $addParticipan
            ]);
            
        }else if ($data["countChoose"] > 1) {
            for ($i=0; $i < $data["countChoose"]; $i++) {
                $rand = rand(pow(10, 6-1), pow(10, 6)-1);
                $exp = explode("_", $data['idCandidate'][$i]);
                $addParticipan = TestParticipant::insertGetId([
                    "kandidat_id" => $exp[0],
                    "test_id"     => $data["idTest"],
                    "status"      => 0,
                    "reshedule_count" => 0,
                    "id_job_application" => $exp[1]
                ]);
                $addOtp = TestOtp::insert([
                    "otp"               => $rand,
                    "expired"           => $tomorrow,
                    "id_kandidat"       => $exp[0],
                    "id_participant"    => $addParticipan
                ]);
            }
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Please Choose Partisipant',
            ];

            return response()->json($messages);
        }

        if ($addParticipan) {
            $test = Test::where('id', $data['idTest'])->get()->toArray();
            $date = date('D, d M Y', strtotime($test[0]['date_test']));
            if ($data['countChoose'] == "1") {
                $exp = explode("_", $data['idCandidate']);
                Job_Application::where('id', $exp[1])->update(['status'=>2]);
                $track = $this->statusTrackApply($exp[1], 2);
                $kandidat = Candidate::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('users', 'kandidat.user_id', 'users.id')->where('kandidat.id', $exp[0])->get()->toArray();
                $dataEmail = [
                    'email'         => $kandidat[0]['email'],
                    'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                    'tanggal'       => $date,
                    'waktu'         => $test[0]['time'],
                    'lokasi'        => $test[0]['location'],
                    'subject'       => 'Written Test Invitation',
                    'view'          => 'email.email-written-test-invit'
                ];

                $response = JobSendEmail::dispatch($dataEmail);
            }else if ($data["countChoose"] > 1) {
                for ($i=0; $i < $data["countChoose"]; $i++) { 
                    $exp = explode("_", $data['idCandidate'][$i]);
                    Job_Application::where('id', $exp[1])->update(['status'=>2]);
                    $track = $this->statusTrackApply($exp[1], 2);
                    $kandidat = Candidate::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('users', 'kandidat.user_id', 'users.id')->where('kandidat.id', $exp[0])->get()->toArray();
                    $dataEmail = [
                        'email'         => $kandidat[0]['email'],
                        'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                        'tanggal'       => $date,
                        'waktu'         => $test[0]['time'],
                        'lokasi'        => $test[0]['location'],
                        'subject'       => 'Written Test Invitation',
                        'view'          => 'email.email-written-test-invit'
                    ];

                    $response = JobSendEmail::dispatch($dataEmail);
                }
            }
            $id = base64_encode(urlencode($data["idTest"]));
            $messages = [
                'status' => 'success',
                'message' => 'Add Participant Success',
                'url' => '/HR/test/detail-test/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Add Participant Failed',
            ];

            return response()->json($messages);
        }
    }

    public function setTestParticipant(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
    
        if (is_array($data["idPart"])) {
            for ($i=0; $i < count($data["idPart"]); $i++) { 
                $editSetTest = TestParticipant::where("id", $data["idPart"][$i])->update(["set_test" => $data["valueSet"]]);
            }
        }else{
            $editSetTest = TestParticipant::where("id", $data["idPart"])->update(["set_test" => $data["valueSet"]]);
        }
        if ($editSetTest) {
            $id = base64_encode(urlencode($data["idSetTest"]));
            $messages = [
                'status' => 'success',
                'message' => 'Add Set Test Success',
                'url' => '/HR/test/detail-test/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Add Set Test Failed',
            ];

            return response()->json($messages);
        }
    }

    public function setAbsenParticipant(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        
        if (is_array($data["absenPart"])) {
            for ($i=0; $i < count($data["absenPart"]); $i++) { 
                $editSetTest = TestParticipant::where("id", $data["absenPart"][$i])->update(["status" => $data["absenParticipant"]]);
            }
        }else{
            $editSetTest = TestParticipant::where("id", $data["absenPart"])->update(["status" => $data["absenParticipant"]]);
        }
        if ($editSetTest) {
            if ($data['absenParticipant'] == "3") {
                if (is_array($data["absenPart"])) {
                    for ($i=0; $i < count($data["absenPart"]); $i++) { 
                        $otp = TestOtp::where("id_participant", $data["absenPart"][$i])->get()->toArray();

                        $kandidat = Candidate::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('users', 'kandidat.user_id', 'users.id')->where('kandidat.id', $otp[0]['id_kandidat'])->get()->toArray();
                        $dataEmail = [
                            'email'         => $kandidat[0]['email'],
                            'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                            'otp'           => $otp[0]['otp'],
                            'subject'       => 'Written Test OTP',
                            'view'          => 'email.email-written-test-otp'
                        ];
                        $response = JobSendEmail::dispatch($dataEmail);
                    }
                }else{
                    $otp = TestOtp::where("id_participant", $data["absenPart"])->get()->toArray();
                    $kandidat = Candidate::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('users', 'kandidat.user_id', 'users.id')->where('kandidat.id', $otp[0]['id_kandidat'])->get()->toArray();
                    $dataEmail = [
                        'email'         => $kandidat[0]['email'],
                        'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                        'otp'           => $otp[0]['otp'],
                        'subject'       => 'Written Test OTP',
                        'view'          => 'email.email-written-test-otp'
                    ];

                    $response = JobSendEmail::dispatch($dataEmail);
                }
                
            }
            
            $id = base64_encode(urlencode($data["idSetAbsen"]));
            $messages = [
                'status' => 'success',
                'message' => 'Add Absen Success',
                'url' => '/HR/test/detail-test/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Add Absen Failed',
            ];

            return response()->json($messages);
        }
    }

    public function startEndTest(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        if ($data['statusStart'] == "2") {
            $messageSuccess = 'Start Test Success';
            $messageFailed = 'Start Test Failed';
        }else{
            $messageSuccess = 'End Test Success';
            $messageFailed = 'End Test Failed';
        }
        
        $startTest = Test::where('id', $data['idStart'])->update(['status_test' => $data['statusStart']]);
        if ($startTest) {
            if ($data['statusStart'] == "3") {
                $participant = TestParticipant::select('kandidat_id')
                                ->where('test_id', $data['idStart'])
                                ->where('status', '4')
                                ->orWhere('status', '6')
                                ->get()->toArray();
                // dd($participant);
                for ($i=0; $i < count($participant); $i++) { 
                    $jobApplication = Job_Application::select("id")->where("kandidat_id", $participant[$i])->get()->toArray();
                    // dd($jobApplication);
                    $updateJob = Job_Application::where('id', $jobApplication[0]['id'])->update(['status' => 4]);
                    $track = $this->statusTrackApply($jobApplication[0]['id'], 4);
                }
            }
            $id = base64_encode(urlencode($data["idStart"]));
            $messages = [
                'status' => 'success',
                'message' => $messageSuccess,
                'url' => '/HR/test/detail-test/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => $messageFailed,
            ];

            return response()->json($messages);
        }
    }

    public function detailReschedule(){
        $id = Request::input('idParticipant');
        $getTest = TestParticipant::select('test_event.*', 'test_participant.id as id_participant')
                                    ->join('test_event', 'test_event.id', 'test_participant.reshedule_test_id')
                                    ->where('test_participant.id', $id)
                                    ->get()->toArray();
        $getTest[0]["date"] = date("d M Y", strtotime($getTest[0]['date_test']));
        return response()->json($getTest[0]);
    }

    public function postReschedule(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if ($data['valueBtn'] == "confirm") {
            $confirmReschedule = TestParticipant::where('id', $data['idParticipant'])->update([
                'status' => 0,
                'test_id' => $data['idTestRechedule']
            ]);
            $messageSucc = "Confirm Reschedule Participant Success";
            $messageFail = "Confirm Reschedule Participant Failed";

        } else {
            $confirmReschedule = TestParticipant::where('id', $data['idParticipant'])->update([
                'status' => 7
            ]);
            $messageSucc = "Decline Reschedule Participant Success";
            $messageFail = "Decline Reschedule Participant Failed";
        }
        
        if ($confirmReschedule) {
            if ($data['valueBtn'] == "confirm") {
                $test = Test::where('id',$data['idTestRechedule'])->get()->toArray();
                $date = date('D, d M Y', strtotime($test[0]['date_test']));
                $kandidat = TestParticipant::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('kandidat', 'test_participant.kandidat_id', 'kandidat.id')->join('users', 'kandidat.user_id', 'users.id')->where('test_participant.id', $data['idParticipant'])->get()->toArray();
                $dataEmail = [
                    'email'         => $kandidat[0]['email'],
                    'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                    'tanggal'       => $date,
                    'waktu'         => $test[0]['time'],
                    'lokasi'        => $test[0]['location'],
                    'subject'       => 'Written Test Reschedule Confirmation',
                    'view'          => 'email.email-written-test-reschedule'
                ];
    
                $response = JobSendEmail::dispatch($dataEmail);
    
            }
            $id = base64_encode(urlencode($data["idTestValue"]));
            $messages = [
                'status' => 'success',
                'message' => $messageSucc,
                'url' => '/HR/test/detail-test/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => $messageFail,
            ];

            return response()->json($messages);
        }
        
    }

    public function viewResultTest($id){
        $idTest = base64_decode(urldecode($id));
        $testParticipant = TestParticipant::select('test_participant.*', 'test_event.city', 'test_event.event_id','test_event.location','test_event.date_test','test_event.time','test_event.set_test as set_data_test','test_event.latlong')
                                            ->join('test_event', 'test_participant.test_id', 'test_event.id')
                                            ->where('test_participant.id', $idTest)->get()->toArray();
        if ($testParticipant) {
            $listCandidate = DB::select('EXEC get_kandidat '.$testParticipant[0]['kandidat_id'].', NULL, NULL, NULL, NULL, NULL, NULL,NULL,NULL, NULL, NULL, 0, 1 ');
            $masterSubtest = MasterSubtest::where('id', '!=', '13')->orderBy('sub_type', 'ASC')->get()->toArray();
            $setTest = SetTest::where('set', $testParticipant[0]['set_test'])->get()->toArray();
            $cognitiveResult = CognitiveTestResult::where('id_participant', $testParticipant[0]['id'])->get()->toArray();
            if ($cognitiveResult) {
                $cognitiveResult[0]['skorAbstrak'] = $cognitiveResult[0]['abstrak1']+$cognitiveResult[0]['abstrak2']+$cognitiveResult[0]['abstrak3']+$cognitiveResult[0]['abstrak4'];
                
                if ($cognitiveResult[0]['skorAbstrak'] >= $setTest[0]['abstrak']) {
                    $cognitiveResult[0]['resultAbstrak'] = "PASS";
                }else{
                    $cognitiveResult[0]['resultAbstrak'] = "FAIL";
                }

                $cognitiveResult[0]['skorNumeric'] = $cognitiveResult[0]['numerical1']+$cognitiveResult[0]['numerical2']+$cognitiveResult[0]['numerical3']+$cognitiveResult[0]['numerical4'];

                if ($cognitiveResult[0]['skorNumeric'] >= $setTest[0]['numerical']) {
                    $cognitiveResult[0]['resultNumeric'] = "PASS";
                }else{
                    $cognitiveResult[0]['resultNumeric'] = "FAIL";
                }

                $cognitiveResult[0]['skorVerbal'] = $cognitiveResult[0]['verbal1']+$cognitiveResult[0]['verbal2']+$cognitiveResult[0]['verbal3']+$cognitiveResult[0]['verbal4'];

                if ($cognitiveResult[0]['skorVerbal'] >= $setTest[0]['verbal']) {
                    $cognitiveResult[0]['resultVerbal'] = "PASS";
                }else{
                    $cognitiveResult[0]['resultVerbal'] = "FAIL";
                }

                if ($cognitiveResult[0]['skor'] >= $setTest[0]['total']) {
                    $cognitiveResult[0]['resultSkor'] = "PASS";
                }else{
                    $cognitiveResult[0]['resultSkor'] = "FAIL";
                }

            } else {
                $cognitiveResult[0]['skorAbstrak'] = "Not Set";
                $cognitiveResult[0]['abstrak1'] = "Not Set";
                $cognitiveResult[0]['abstrak2'] = "Not Set";
                $cognitiveResult[0]['abstrak3'] = "Not Set";
                $cognitiveResult[0]['abstrak4'] = "Not Set";
                $cognitiveResult[0]['skorNumeric'] = "Not Set";
                $cognitiveResult[0]['numerical1'] = "Not Set";
                $cognitiveResult[0]['numerical2'] = "Not Set";
                $cognitiveResult[0]['numerical3'] = "Not Set";
                $cognitiveResult[0]['numerical4'] = "Not Set";
                $cognitiveResult[0]['skorVerbal'] = "Not Set";
                $cognitiveResult[0]['verbal1'] = "Not Set";
                $cognitiveResult[0]['verbal2'] = "Not Set";
                $cognitiveResult[0]['verbal3'] = "Not Set";
                $cognitiveResult[0]['verbal4'] = "Not Set";
                $cognitiveResult[0]['skor'] = "Not Set";
                $cognitiveResult[0]['resultAbstrak'] = "";
                $cognitiveResult[0]['resultNumeric'] = "";
                $cognitiveResult[0]['resultVerbal'] = "";
                $cognitiveResult[0]['resultSkor'] = "";
            }

            $breadcrumb = [
                "page"          => "Manage Test",
                "detail"        => "Manage Test Detail",
                "detail_page"   => "Test Result",
                "route"         => "/HR/test",
            ];
            return view('admin.test.test-result')->with([
                'pageTitle'     => 'Manajemen Test', 
                'title'         => 'Manajemen Test', 
                'sidebar'       => 'manajemen_test', 
                'breadcrumb'    => $breadcrumb,
                "candidate"     => $listCandidate[0],
                "test"          => $testParticipant[0],
                "masterSubtest" => $masterSubtest,
                "cognitiveResult" => $cognitiveResult
            ]);
        }else{
            abort(404);
        }

    }

    public function inventoryResult(){
        $idParticipant = Request::input('id');
        $inventory = InventoryTestResult::select('inventory_test_result.*', 'master_facet.category', 'master_facet.facet_name')
                                        ->join('master_facet', 'master_facet.id', 'inventory_test_result.facet_id')
                                        ->where('inventory_test_result.id_participant', $idParticipant)->get()->toArray();
        // dd($inventory);
        $label = [];
        $result = [];
        if ($inventory) {
            for ($i=0; $i < count($inventory) ; $i++) { 
                $dataLabel = $inventory[$i]['category'].' ('.$inventory[$i]['facet_name'].')';
                array_push($label, $dataLabel);
                array_push($result, (int)$inventory[$i]['skor']);
            }
        }

        $value = [
            'label'  => $label,
            'result' => $result
        ];

        return response()->json($value);
    }

    public function downloadResult($id){
        $idDownload = base64_decode(urldecode($id));
        $date = date('YmdHis');
        return Excel::download(new DownloadResult($idDownload), 'Download_'.$date.'.xlsx');
    }

    function str_putcsv($array, $filename, $headers, $delimiter=",")
	{
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        $f = fopen(public_path()."/storage/".$filename, 'w');

        fputcsv($f, $headers, $delimiter);
    
        foreach ($array as $line) {
            fputcsv($f, $line, $delimiter);
		}
		
    }

    public function sendOtpOne(){
        $value = Request::input('value');
        $data = explode('_', $value);
        // dd($data);
        
        $otp = TestOtp::where("id_kandidat", $data[0])->get()->toArray();
        if($otp){
            $kandidat = Candidate::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('users', 'kandidat.user_id', 'users.id')->where('kandidat.id', $data[0])->get()->toArray();
            // dd($otp, $kandidat);
            
            $dataEmail = [
                'email'         => $kandidat[0]['email'],
                'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                'otp'           => $otp[0]['otp'],
                'subject'       => 'Written Test OTP',
                'view'          => 'email.email-written-test-otp'
            ];
    
            $response = JobSendEmail::dispatch($dataEmail);
            $id = base64_encode(urlencode($data[1]));

            $messages = [
                'status' => 'success',
                'message' => 'Send OTP Success',
                'url' => '/HR/test/detail-test/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
    
        }else{
            $messages = [
                'status' => 'error',
                'message' => "Send OTP Failed",
            ];

            return response()->json($messages);
        }
    }

    public function sendOtpBulk(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        if($data['countSend'] == "0"){
            $messages = [
                'status' => 'error',
                'message' => "Please Choose Participant",
            ];

            return response()->json($messages);
            
        }else if ($data['countSend'] == "1") {
            $otp = TestOtp::where("id_kandidat", $data['idSend'])->get()->toArray();
            $kandidat = Candidate::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('users', 'kandidat.user_id', 'users.id')->where('kandidat.id', $data['idSend'])->get()->toArray();
            
            $dataEmail = [
                'email'         => $kandidat[0]['email'],
                'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                'otp'           => $otp[0]['otp'],
                'subject'       => 'Written Test OTP',
                'view'          => 'email.email-written-test-otp'
            ];
    
            $response = JobSendEmail::dispatch($dataEmail);
        } else {
            for ($i=0; $i < $data['countSend']; $i++) { 
                $otp = TestOtp::where("id_kandidat", $data['idSend'][$i])->get()->toArray();
                $kandidat = Candidate::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('users', 'kandidat.user_id', 'users.id')->where('kandidat.id', $data['idSend'][$i])->get()->toArray();
                
                $dataEmail = [
                    'email'         => $kandidat[0]['email'],
                    'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                    'otp'           => $otp[0]['otp'],
                    'subject'       => 'Written Test OTP',
                    'view'          => 'email.email-written-test-otp'
                ];
        
                $response = JobSendEmail::dispatch($dataEmail);
            }
        }
        $id = base64_encode(urlencode($data['idSetAbsen']));
        $messages = [
            'status' => 'success',
            'message' => 'Send OTP Success',
            'url' => '/HR/test/detail-test/'.$id,
            'callback' => 'redirect'
        ];

        return response()->json($messages);
    }

    public function sendEmailResult(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $getTest = Test::select('users.email', 'kandidat.first_name', 'kandidat.last_name', 'cognitive_test_result.skor', 'cognitive_test_result.status as status_result')
                        ->join('test_participant', 'test_event.id', 'test_participant.test_id')
                        ->leftJoin('cognitive_test_result', 'test_participant.id', 'cognitive_test_result.id_participant')
                        ->join('kandidat', 'test_participant.kandidat_id', 'kandidat.id')
                        ->join('users', 'kandidat.user_id', 'users.id')
                        ->where('test_event.id', $data['idSendResult'])->get()->toArray();
        // dd($getTest);
        if ($getTest) {
            for ($i=0; $i < count($getTest); $i++) {
                if ($getTest[$i]['status_result'] == "1") {
                    $dataEmail = [
                        'email'  => $getTest[$i]['email'],
                        'nama'  => $getTest[$i]['first_name'].' '.$getTest[$i]['first_name'],
                        'text'  => 'Written Test',
                        'tipe' => 1,
                        'subject' => 'Written Test Result Announcement',
                        'view' => 'email.email-written-test-result'
                    ];
                    $response = JobSendEmail::dispatch($dataEmail);
                }else {
                    $dataEmail = [
                        'email'  => $getTest[$i]['email'],
                        'nama'  => $getTest[$i]['first_name'].' '.$getTest[$i]['first_name'],
                        'text'  => 'Written Test',
                        'tipe' => 2,
                        'subject' => 'Written Test Result Announcement',
                        'view' => 'email.email-written-test-result'
                    ];
                    $response = JobSendEmail::dispatch($dataEmail);
                }
            }
            $id = base64_encode(urlencode($data['idSendResult']));
            $messages = [
                'status' => 'success',
                'message' => 'Send Email Result Success',
                'url' => '/HR/test/detail-test/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => "Data Not Found",
            ];

            return response()->json($messages);
        }
    }
}
