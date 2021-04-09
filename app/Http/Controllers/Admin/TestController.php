<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Test;
use App\Model\AlternatifTest;
use App\Model\TestParticipant;
use App\Model\Job_Application;
use App\Model\Wilayah;
use App\AdminSession;

use Hash;
use Request;
use Session;
use DB;

class TestController extends Controller
{
    public function viewTest(){
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
            $test = $test->where('title','like','%'.$dataSend['search'].'%');
        }
        $countTest = $test->count();

        $listTest = $test->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listTest = $listTest->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listTest = $listTest->orderBy('created_at', $dataSend["sort"])->get()->toArray();
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
        // $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        return view('admin.test.test-add')->with(['pageTitle' => 'Manajemen Test', 'title' => 'Manajemen Test', 'sidebar' => 'manajemen_test', 'breadcrumb' => $breadcrumb]);
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
                'alternative' => $getAlternatif
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
        // dd($countTestPart);
        if ($getTest) {
            if($getTest[0]['status_test'] != 3){
                $dateTest=date('Y-m-d', strtotime($getTest[0]['date_test']));
                $now=date("Y-m-d");
                if ($now > $dateTest) {
                    Test::where('id', $idTest)->update(['status_test' => 3]);
                }
            }
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
        if ($data['countChoose'] == "1") {
            $exp = explode("_", $data['idCandidate']);
            $addParticipan = TestParticipant::insert([
                "kandidat_id" => $exp[0],
                "test_id"     => $data["idTest"],
                "status"      => 0,
                "reshedule_count" => 0
            ]);
                
        }else if ($data["countChoose"] > 1) {
            for ($i=0; $i < $data["countChoose"]; $i++) {
                $exp = explode("_", $data['idCandidate'][$i]);
                $addParticipan = TestParticipant::insert([
                    "kandidat_id" => $exp[0],
                    "test_id"     => $data["idTest"],
                    "status"      => 0
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
            if ($data['countChoose'] == "1") {
                $exp = explode("_", $data['idCandidate']);
                Job_Application::where('id', $exp[1])->update(['status'=>2]);
                $track = $this->statusTrackApply($exp[1], 2);
            }else if ($data["countChoose"] > 1) {
                for ($i=0; $i < $data["countChoose"]; $i++) { 
                    $exp = explode("_", $data['idCandidate'][$i]);
                    Job_Application::where('id', $exp[1])->update(['status'=>2]);
                    $track = $this->statusTrackApply($exp[1], 2);
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
        // dd($idTest);
        $breadcrumb = [
            "page"          => "Manage Test",
            "detail"        => "Manage Test Detail",
            "detail_page"   => "Test Result",
            "route"         => "/HR/test"
        ];
        return view('admin.test.test-result')->with(['pageTitle' => 'Manajemen Test', 'title' => 'Manajemen Test', 'sidebar' => 'manajemen_test', 'breadcrumb' => $breadcrumb]);
    }
}
