<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Vacancy;
use App\Model\Wilayah;
use App\Model\Candidate;
use App\Model\Job_application;
use App\Model\Education;
use Illuminate\Support\Facades\Storage;
use Hash;
use Request;
use Session;
use DB;
use Response;

class CandidateController extends Controller
{
    public function viewCandidate(){
        $vacancy = Vacancy::select('job_id', 'job_title')->get()->toArray();

        return view('admin.candidate.candidate-list')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate', 'vacancy'=>$vacancy]);
    }

    public function listCandidate(){

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
        $listCandidate = DB::select('EXEC get_kandidat NULL, '.$ipkMinimum.', '.$job.', '.$major.', '.$university.', '.$usia.', '.$tahunLulus.', '.$search.', "'.$order.'", "'.Request::input('start').'", "'.Request::input('length').'" ');
        $countCandidate = DB::select('EXEC get_kandidat_count NULL,'.$ipkMinimum.', '.$job.', '.$major.', '.$university.', '.$usia.', '.$tahunLulus.', '.$search.' ');
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

    public function viewCandidateEdit($id){
        $idJob = base64_decode(urldecode($id));
        $listCandidate = Job_application::where('job_application.id', $idJob)->select('job_application.*', 'kandidat.first_name', 'kandidat.last_name', 'kandidat.tanggal_lahir', 'vacancies.job_title', 'vacancies.lokasi')
                    ->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')
                    ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')->get()->toArray();
        if ($listCandidate) {
            $listCandidate[0]['pendidikan'] = [];
            $listCandidate[0]['submit_date'] = date('m/d/Y', strtotime($listCandidate[0]['created_at']));

            $date = date('m/d/Y', strtotime($listCandidate[0]['tanggal_lahir']));
            $birthDate = explode("/", $date);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));

            $listCandidate[0]['age'] = $age;

            $kandidat_id = [];
            array_push($kandidat_id, $listCandidate[0]['kandidat_id']);

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
                "page"      => "Manage Candidate",
                "detail"    => "Edit Candidate",
                "route"     => "/HR/candidate"
            ];
            return view('admin.candidate.candidate-edit')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate', 'breadcrumb' => $breadcrumb, 'data'=>$listCandidate[0]]);
        }else{
            abort(404);
        }
    }

    public function editCandidate(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        $updateJob = Job_Application::where('id', $data['idJob'])->update(['status' => $data['aplicationStatus']]);
        if ($updateJob) {
            if (is_array($data['idPendidikan']) && count($data['idPendidikan']) > 1) {
                for ($i=0; $i < count($data['idPendidikan']); $i++) { 
                    $updatePendidikan = Education::where('id', $data['idPendidikan'][$i])->update([
                        'universitas' => $data['universitas'][$i],
                        'fakultas' => $data['faculty'][$i],
                        'jurusan' => $data['jurusan'][$i],
                        'start_year' => $data['start_year'][$i],
                        'end_year' => $data['end_year'][$i]
                    ]);
                }
            }else{
                $updatePendidikan = Education::where('id', $data['idPendidikan'])->update([
                    'universitas' => $data['universitas'],
                    'fakultas' => $data['faculty'],
                    'jurusan' => $data['jurusan'],
                    'start_year' => $data['start_year'],
                    'end_year' => $data['end_year']
                ]);
            }

            if ($updatePendidikan) {
                return [
                    'status'   => 'success',
                    'message'  => 'Berhasil Mengubah Data Kandidat',
                    'url'      => '/HR/candidate',
                    'callback' => 'redirect'
                ];
            }else{
                return [
                    'status'   => 'error',
                    'message'  => 'Gagal Mengubah Data Kandidat',
                ];
            }
        }else{
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mengubah Data Kandidat',
            ];
        }
    }

    public function viewCandidateDetail($id){

        $idKandidat = base64_decode(urldecode($id));
        $listCandidate = Candidate::where('id', $idKandidat)->get()->toArray();
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
                "page"      => "Manage Candidate",
                "detail"    => "View Candidate",
                "route"     => "/HR/candidate"
            ];
            return view('admin.candidate.candidate-detail')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate', 'breadcrumb' => $breadcrumb, 'data'=>$listCandidate[0]]);
        }else{
            abort(404);
        }
    }

    public function downloadFile($file){
        $data = base64_decode(urldecode($file));
        $str = str_replace("%2F", "/", $data);
        $path = public_path('storage').'/'.$str;
        // dd($path);
        return Response::download($path);
    }
}
