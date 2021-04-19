<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\InterviewEvent;
use App\Model\InterviewType;
use App\Model\Job_Application;
use App\Model\Candidate;
use App\AdminSession;
use Response;
use Hash;
use Request;
use Session;
use DB;

class InterviewController extends Controller
{
    public function viewInterview(){
        return view('admin.interview.interview-list')->with(['pageTitle' => 'Manajemen Interview', 'title' => 'Manajemen Interview', 'sidebar' => 'manajemen_interview']);
    }

    public function listInterview(){
        
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $interview = InterviewEvent::select('interview_event.*', 'interview_type.name as type_name', 'job_application.kandidat_id', 'job_application.vacancy_id', 'job_application.status as status_job', 'kandidat.foto_profil', 'kandidat.first_name', 'kandidat.last_name', 'vacancies.job_title', 'vacancies.lokasi as area_vacancy')
        ->join('interview_type', 'interview_event.type_id', 'interview_type.id')
        ->join('job_application', 'interview_event.id_job_application', 'job_application.id')
        ->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')
        ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id');

        if ($dataSend['search']){
            $interview = $interview->where('title','like','%'.$dataSend['search'].'%');
        }
        $countInterview = $interview->count();

        $listInterview = $interview->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listInterview = $listInterview->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listInterview = $listInterview->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }

        for ($i=0; $i < count($listInterview); $i++) { 
            $listInterview[$i]['interview_date'] = date('d/m/y', strtotime($listInterview[$i]['interview_date']));
        }
        
        if ($listInterview != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countInterview,
                "recordsFiltered"   => $countInterview,
                "data"              => $listInterview
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

    public function viewInterviewAdd(){
        $interviewType = InterviewType::get()->toArray();
        $breadcrumb = [
            "page"      => "Manage Interview",
            "detail"    => "Create Interview",
            "route"     => "/HR/test"
        ];
        return view('admin.interview.interview-add')->with([
            'pageTitle' => 'Manajemen Interview', 
            'title' => 'Manajemen Interview', 
            'sidebar' => 'manajemen_interview', 
            'breadcrumb' => $breadcrumb,
            'interviewType' => $interviewType
        ]);
    }

    public function addInterview(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        if ($data['countChoose'] == "0") {
            $messages = [
                'status' => 'error',
                'message' => 'Please Choose Partisipant',
            ];

            return response()->json($messages);
        }else{
            for ($i=0; $i < $data['countChoose']; $i++) { 
                $addInterview = InterviewEvent::insert([
                    "type_id"               => $data["typeInterview"],
                    "id_job_application"    => is_array($data["idJOb"]) ? $data["idJOb"][$i] : $data["idJOb"],
                    "interview_date"        => date("Y-m-d", strtotime($data["dateInterview"])),
                    "time"                  => $data["timeInterview"],
                    "location"              => $data["locationInterview"],
                    "city"                  => $data["cityInterview"],
                    "interviewer"           => $data["interviewer"],
                    "last_interview"        => isset($data["lastInterview"]) ? $data["lastInterview"] : 0,
                    "status"                => 1
                ]);
            }

            if ($addInterview) {
                if ($data['typeInterview'] == "1") {
                    $statusJob = 5;
                }elseif ($data['typeInterview'] == "2") {
                    $statusJob = 6;
                }elseif ($data['typeInterview'] == "3") {
                    $statusJob = 9;
                }elseif ($data['typeInterview'] == "4") {
                    $statusJob = 10;
                }

                for ($i=0; $i < $data['countChoose']; $i++) { 
                    $updateJob = Job_Application::where('id', is_array($data["idJOb"]) ? $data["idJOb"][$i] : $data["idJOb"])->update(["status"=> $statusJob]);
                    $track = $this->statusTrackApply(is_array($data["idJOb"]) ? $data["idJOb"][$i] : $data["idJOb"], $statusJob);
                }

                $messages = [
                    'status' => 'success',
                    'message' => 'Add Interview Success',
                    'url' => '/HR/interview',
                    'callback' => 'redirect'
                ];
    
                return response()->json($messages);
            }else{
                $messages = [
                    'status' => 'error',
                    'message' => 'Add Interview Failed',
                ];
    
                return response()->json($messages);
            }
        }
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
        $listCandidate = DB::select('EXEC get_kandidat NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL,3, '.$search.', "'.$order.'", "'.Request::input('start').'", "'.Request::input('length').'" ');
        $countCandidate = DB::select('EXEC get_kandidat_count NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, 3, '.$search.' ');
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

    public function updateStatus(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        $updateStatus = InterviewEvent::where('id', $data['idUpdateStatus'])->update([
            "status" => $data["statusInterview"],
            "note"   => $data["noteInterview"]   
        ]);

        if ($updateStatus) {
            if ($data["statusJobApp"] == "5") {
                if ($data["statusInterview"] == "2") {
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 13]);
                    $track = $this->statusTrackApply($data["idJobApp"], 13);
                }else{
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 14]);
                    $track = $this->statusTrackApply($data["idJobApp"], 14);
                    if ($data["statusFail"] == "2") {
                        $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 11]);
                        $track = $this->statusTrackApply($data["idJobApp"], 11);
                        $updateKandidat = Candidate::where('id', $data["idKandidat"])->update(["status"=> 4]);
                    } 
                    
                }
            }elseif ($data["statusJobApp"] == "6") {
                if ($data["statusInterview"] == "2") {
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 15]);
                    $track = $this->statusTrackApply($data["idJobApp"], 15);
                }else{
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 16]);
                    $track = $this->statusTrackApply($data["idJobApp"], 16);
                    if ($data["statusFail"] == "2") {
                        $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 11]);
                        $track = $this->statusTrackApply($data["idJobApp"], 11);
                        $updateKandidat = Candidate::where('id', $data["idKandidat"])->update(["status"=> 4]);
                    } 
                    
                }
            }elseif ($data["statusJobApp"] == "7") {
                if ($data["statusInterview"] == "2") {
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 17]);
                    $track = $this->statusTrackApply($data["idJobApp"], 17);
                }else{
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 18]);
                    $track = $this->statusTrackApply($data["idJobApp"], 18);
                    if ($data["statusFail"] == "2") {
                        $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 11]);
                        $track = $this->statusTrackApply($data["idJobApp"], 11);
                        $updateKandidat = Candidate::where('id', $data["idKandidat"])->update(["status"=> 4]);
                    } 
                    
                }
            }elseif ($data["statusJobApp"] == "8") {
                if ($data["statusInterview"] == "2") {
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 19]);
                    $track = $this->statusTrackApply($data["idJobApp"], 19);
                }else{
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 20]);
                    $track = $this->statusTrackApply($data["idJobApp"], 20);
                    if ($data["statusFail"] == "2") {
                        $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 11]);
                        $track = $this->statusTrackApply($data["idJobApp"], 11);
                        $updateKandidat = Candidate::where('id', $data["idKandidat"])->update(["status"=> 4]);
                    } 
                    
                }
            }elseif ($data["statusJobApp"] == "9") {
                if ($data["statusInterview"] == "2") {
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 21]);
                    $track = $this->statusTrackApply($data["idJobApp"], 21);
                }else{
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 22]);
                    $track = $this->statusTrackApply($data["idJobApp"], 22);
                    if ($data["statusFail"] == "2") {
                        $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 11]);
                        $track = $this->statusTrackApply($data["idJobApp"], 11);
                        $updateKandidat = Candidate::where('id', $data["idKandidat"])->update(["status"=> 4]);
                    } 
                    
                }
            }elseif ($data["statusJobApp"] == "10") {
                if ($data["statusInterview"] == "2") {
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 12]);
                    $track = $this->statusTrackApply($data["idJobApp"], 12);
                    $updateKandidat = Candidate::where('id', $data["idKandidat"])->update(["status"=> 2]);
                }else{
                    $updateJob = Job_Application::where('id', $data["idJobApp"])->update(["status"=> 11]);
                    $track = $this->statusTrackApply($data["idJobApp"], 11);
                    $updateKandidat = Candidate::where('id', $data["idKandidat"])->update(["status"=> 4]);
                }
            }

            $messages = [
                'status' => 'success',
                'message' => 'Update Status Success',
                'url' => '/HR/interview',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Update Status Failed',
            ];

            return response()->json($messages);
        }
        
    }
}
