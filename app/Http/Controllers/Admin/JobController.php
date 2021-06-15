<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Vacancy;
use App\Model\Wilayah;
use App\Model\Candidate;
use App\Model\User;
use App\Model\Job_Application;
use App\Model\Education;
use App\Model\MasterUniversitas;
use App\Model\MasterMajor;
use App\Model\Status_History_Application;
use App\Model\MasterSubtest;
use App\Model\MasterFacet;
use App\Model\CognitiveTestResult;
use App\Model\InventoryTestResult;
use App\Model\SetTest;
use App\Model\TestParticipant;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\addBulkCandidate;
use Hash;
use Request;
use Session;
use DB;
use Response;

class JobController extends Controller
{
    public function viewJob(){
        $vacancy = Vacancy::select('job_id', 'job_title')->get()->toArray();
        $universitas = MasterUniversitas::get()->toArray();
        $major = MasterMajor::get()->toArray();
        return view('admin.job.job-list')->with(['pageTitle' => 'Manajemen Job', 'title' => 'Manajemen Job', 'sidebar' => 'manajemen_job', 'vacancy'=>$vacancy, 'universitas'=>$universitas, 'major'=>$major]);
    }

    public function listJob(){

        $filter;
        $parameter = parse_str(Request::input('param'),$filter);
        if($filter['ipkMinimum'] != ""){
            $ipkMinimum = '"'.$filter['ipkMinimum'].'"';
        }else{
            $ipkMinimum = "NULL";
        }
        if($filter['job'] != ""){
            $job = '"'.$filter['job'].'"';
        }else{
            $job = "NULL";
        }
        if($filter['major'] != ""){
            $major = '"'."'".$filter['major']."'".'"';
        }else{
            $major = "NULL";
        }
        // dd($major);
        if($filter['university'] != ""){
            $university = '"'."'".$filter['university']."'".'"';
        }else{
            $university = "NULL";
        }
        if($filter['usia'] != ""){
            $usia = '"'.$filter['usia'].'"';
        }else{
            $usia = "NULL";
        }
        if($filter['tahunLulus'] != ""){
            $tahunLulus = '"'.$filter['tahunLulus'].'"';
        }else{
            $tahunLulus = "NULL";
        }
        // dd($filter);
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
        }elseif (Request::input('order')[0]['column'] == '12') {
            $column = 'status';
        }

        $order = $column.'_'.Request::input('order')[0]['dir'];

        if (Request::input('search')['value'] == null) {
        	$search = "NULL";
        }else{
        	$search = '"'.Request::input('search')['value'].'"';
        }
        $listCandidate = DB::select('EXEC get_kandidat NULL, '.$ipkMinimum.', '.$job.', '.$major.', '.$university.', '.$usia.', '.$tahunLulus.', NULL, NULL, '.$search.', "'.$order.'", "'.Request::input('start').'", "'.Request::input('length').'" ');
        $countCandidate = DB::select('EXEC get_kandidat_count NULL,'.$ipkMinimum.', '.$job.', '.$major.', '.$university.', '.$usia.', '.$tahunLulus.', NULL, NULL, '.$search.' ');
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

    public function viewJobEdit($id){

        $idJob = base64_decode(urldecode($id));
        $listCandidate = Job_Application::select('kandidat.*', 'job_application.id as job_id', 'job_application.vacancy_id', 'vacancies.job_title', 'job_application.status as status_job', 'users.email')
                                    ->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')
                                    ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                    ->join('users', 'users.id', 'kandidat.user_id')
                                    ->where('job_application.id', $idJob)->get()->toArray();
        // dd($listCandidate);
        if ($listCandidate) {
            $listCandidate[0]['tanggal_lahir'] = date('d F Y', strtotime($listCandidate[0]['tanggal_lahir']));
            $listCandidate[0]['pendidikan'] = [];
            $kandidat_id = [];
            array_push($kandidat_id, $listCandidate[0]['id']);

            $pendidikan_kandidat_id = [];
            $education = Education::get()->toArray();
            
            for ($i=0; $i < count($education); $i++) { 
                array_push($pendidikan_kandidat_id, $education[$i]['kandidat_id']);
            }

            
            $dummy = [];
            for ($i=0; $i < count($pendidikan_kandidat_id); $i++) { 
                $search = array_search($pendidikan_kandidat_id[$i], $kandidat_id);
                array_push($dummy, $search.','.$i);
            }
            foreach ($dummy as $key => $value) {
                $exp = explode(",", $value);
                if ($exp[0] != "") {
                    array_push($listCandidate[$exp[0]]['pendidikan'], $education[$exp[1]]);
                }
            }

            $history = Status_History_Application::where('job_application_id', $idJob)->get()->toArray();
            // dd($history);
            $apply = [];
            $online_test = [];
            $hr_interview = [];
            $user_interview1 = [];
            $user_interview2 = [];
            $direktur_interview = [];
            $mcu = [];
            $document_sign = [];

            $status_online_test = '';
            $status_hr_interview = '';
            $status_user_interview1 = '';
            $status_user_interview2 = '';
            $status_direktur_interview = '';
            $status_mcu = '';

            if ($history) {
                for ($i=0; $i < count($history) ; $i++) { 
                    $history[$i]['tanggal'] = date("d F Y H:i", strtotime($history[$i]['created_at']));
                    if ($history[$i]['status'] == "0") {
                        array_push($apply, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "1") {
                        array_push($online_test, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "2") {
                        array_push($online_test, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "3") {
                        array_push($online_test, $history[$i]['tanggal']);
                        $status_online_test = 'success';
                    }else if ($history[$i]['status'] == "4") {
                        array_push($online_test, $history[$i]['tanggal']);
                        $status_online_test = 'failed';
                    }else if ($history[$i]['status'] == "5") {
                        array_push($hr_interview, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "6") {
                        array_push($user_interview1, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "7") {
                        array_push($user_interview2, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "8") {
                        array_push($direktur_interview, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "9") {
                        array_push($mcu, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "10") {
                        array_push($document_sign, $history[$i]['tanggal']);
                    }else if ($history[$i]['status'] == "13") {
                        array_push($hr_interview, $history[$i]['tanggal']);
                        $status_hr_interview = 'success';
                    }else if ($history[$i]['status'] == "14") {
                        array_push($hr_interview, $history[$i]['tanggal']);
                        $status_hr_interview = 'failed';
                    }else if ($history[$i]['status'] == "15") {
                        array_push($user_interview1, $history[$i]['tanggal']);
                        $status_user_interview1 = 'success';
                    }else if ($history[$i]['status'] == "16") {
                        array_push($user_interview1, $history[$i]['tanggal']);
                        $status_user_interview1 = 'failed';
                    }else if ($history[$i]['status'] == "17") {
                        array_push($user_interview2, $history[$i]['tanggal']);
                        $status_user_interview2 = 'success';
                    }else if ($history[$i]['status'] == "18") {
                        array_push($user_interview2, $history[$i]['tanggal']);
                        $status_user_interview2 = 'failed';
                    }else if ($history[$i]['status'] == "19") {
                        array_push($direktur_interview, $history[$i]['tanggal']);
                        $status_direktur_interview = 'success';
                    }else if ($history[$i]['status'] == "20") {
                        array_push($direktur_interview, $history[$i]['tanggal']);
                        $status_direktur_interview = 'failed';
                    }else if ($history[$i]['status'] == "21") {
                        array_push($mcu, $history[$i]['tanggal']);
                        $status_mcu = 'success';
                    }else if ($history[$i]['status'] == "22") {
                        array_push($mcu, $history[$i]['tanggal']);
                        $status_mcu = 'failed';
                    }
                }
            }

            $breadcrumb = [
                "page"      => "Manage Job Application",
                "detail"    => "View Job Application",
                "route"     => "/HR/job"
            ];

            if ($listCandidate[0]['status_job'] >= 3) {
                $masterSubtest = MasterSubtest::where('id', '!=', '13')->orderBy('sub_type', 'ASC')->get()->toArray();
                $testPart = TestParticipant::where('test_participant.id_job_application', $idJob)
                                            ->get()->toArray();
                // dd($testPart, $idJob);
                $setTest = SetTest::where('set', $testPart[0]['set_test'])->get()->toArray();
                $cognitiveResult = CognitiveTestResult::where('id_participant', $testPart[0]['id'])->get()->toArray();
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
                // dd($cognitiveResult);
                return view('admin.job.job-edit')->with([
                    'pageTitle' => 'Manajemen Job Application', 
                    'title' => 'Manajemen Job Application', 
                    'sidebar' => 'manajemen_job', 
                    'breadcrumb' => $breadcrumb, 
                    'data'=>$listCandidate[0],
                    'history'=>[
                        'apply'          => $apply,
                        'online_test'    => $online_test,
                        'hr_interview'   => $hr_interview,
                        'user_interview1'=> $user_interview1,
                        'user_interview2'=> $user_interview2,
                        'direktur_interview'=> $direktur_interview,
                        'mcu'            => $mcu,
                        'document_sign'  => $document_sign
                    ],
                    'status' => [
                        'status_online_test'     => $status_online_test,
                        'status_hr_interview'    => $status_hr_interview,
                        'status_user_interview1' => $status_user_interview1,
                        'status_user_interview2' => $status_user_interview2,
                        'status_direktur_interview' => $status_direktur_interview,
                        'status_mcu'             => $status_mcu
                    ],
                    "masterSubtest" => $masterSubtest,
                    "cognitiveResult" => $cognitiveResult,
                    "test" => $testPart[0]
                ]);
            }else{
                return view('admin.job.job-edit')->with([
                    'pageTitle' => 'Manajemen Job Application', 
                    'title' => 'Manajemen Job Application', 
                    'sidebar' => 'manajemen_job', 
                    'breadcrumb' => $breadcrumb, 
                    'data'=>$listCandidate[0],
                    'history'=>[
                        'apply'          => $apply,
                        'online_test'    => $online_test,
                        'hr_interview'   => $hr_interview,
                        'user_interview1'=> $user_interview1,
                        'user_interview2'=> $user_interview2,
                        'direktur_interview'=> $direktur_interview,
                        'mcu'            => $mcu,
                        'document_sign'  => $document_sign
                    ],
                    'status' => [
                        'status_online_test'     => $status_online_test,
                        'status_hr_interview'    => $status_hr_interview,
                        'status_user_interview1' => $status_user_interview1,
                        'status_user_interview2' => $status_user_interview2,
                        'status_direktur_interview' => $status_direktur_interview,
                        'status_mcu'             => $status_mcu
                    ]
                ]);
            }
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

    public function editJob(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $getJob = Job_Application::where('id', $data['idJob'])->get()->toArray();

        if ($data['aplicationStatus'] == "99") {
            $appStatus = "11";
        }else{
            $appStatus = $data['aplicationStatus'];
        }

        if ($getJob[0]['status'] != $appStatus) {
            $track = $this->statusTrackApply($data['idJob'], $appStatus);
        }
        $updateJob = Job_Application::where('id', $data['idJob'])->update(['status' => $appStatus]);
        if ($updateJob) {
            if ($data['aplicationStatus'] == "99") {
                Candidate::where('id', $data['idKandidat'])->update(['status'=>3]);
            }

            return [
                'status'   => 'success',
                'message'  => 'Berhasil Mengubah Data Job Application',
                'url'      => '/HR/job',
                'callback' => 'redirect'
            ];
        }else{
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mengubah Data Job Application',
            ];
        }
    }

    public function downloadFile($file){
        $data = base64_decode(urldecode($file));
        $str = str_replace("%2F", "/", $data);
        $path = public_path('storage').'/'.$str;
        // dd($path);
        return Response::download($path);
    }

    public function bulkUpdate(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if (is_array($data['idJob'])) {
            for ($i=0; $i < count($data['idJob']); $i++) { 
                $exp = explode("_", $data['idJob'][$i]);
                // dd($exp);
                $update = Job_application::where('id', $exp[0])->update(['status'=>$data['aplicationStatus']]);
                $track = $this->statusTrackApply($exp[0], $data['aplicationStatus']);
            }
        }else{
            $exp = explode("_", $data['idJob']);
            $update = Job_application::where('id', $exp[0])->update(['status'=>$data['aplicationStatus']]);
            $track = $this->statusTrackApply($exp[0], $data['aplicationStatus']);
        }

        if ($update) {
            return [
                'status'   => 'success',
                'message'  => 'Berhasil Mengubah Data Bulk Kandidat',
                'url'      => '/HR/job',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mengubah Data Bulk Kandidat',
            ];
        }
        
    }
}
