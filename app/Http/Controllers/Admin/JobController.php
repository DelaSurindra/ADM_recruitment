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
use App\Model\Job_application;
use App\Model\Education;
use App\Model\MasterUniversitas;
use App\Model\MasterMajor;
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
        return view('admin.job.job-list')->with(['pageTitle' => 'Manajemen Job', 'title' => 'Manajemen Job', 'sidebar' => 'manajemen_job', 'vacancy'=>$vacancy]);
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
            $major = '"'.$filter['major'].'"';
        }else{
            $major = "NULL";
        }
        if($filter['university'] != ""){
            $university = '"'.$filter['university'].'"';
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

        $idKandidat = base64_decode(urldecode($id));
        $listCandidate = Candidate::select('kandidat.*', 'job_application.id as job_id', 'job_application.status as status_job', 'users.email')
                                    ->join('job_application', 'job_application.kandidat_id', 'kandidat.id')
                                    ->join('users', 'users.id', 'kandidat.user_id')
                                    ->where('kandidat.id', $idKandidat)->get()->toArray();
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
    
            // dd($listCandidate);
            $breadcrumb = [
                "page"      => "Manage Job Application",
                "detail"    => "View Job Application",
                "route"     => "/HR/job"
            ];
            return view('admin.job.job-edit')->with(['pageTitle' => 'Manajemen Job Application', 'title' => 'Manajemen Job Application', 'sidebar' => 'manajemen_job', 'breadcrumb' => $breadcrumb, 'data'=>$listCandidate[0]]);
        }else{
            abort(404);
        }
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
        for ($i=0; $i < count($data['idJob']); $i++) { 
            $exp = explode("_", $data['idJob'][$i]);
            // dd($exp);
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
