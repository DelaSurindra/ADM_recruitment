<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\InterviewEvent;
use App\Model\InterviewType;
use App\Model\InterviewReschedule;
use App\Model\Job_Application;
use App\Model\Candidate;
use App\Model\Wilayah;
use App\Jobs\JobSendEmail;
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
            $interview = $interview->where('kandidat.first_name','like','%'.$dataSend['search'].'%')->orWhere('kandidat.last_name','like','%'.$dataSend['search'].'%');
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
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
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
            'interviewType' => $interviewType,
            'wilayah'  => $wilayah
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
                    "status"                => 1,
                    "reshedule_count"       => 0
                ]);
            }

            if ($addInterview) {

                if ($data['typeInterview'] == "1") {
                    $statusJob = 5;
                    $mcu = 'N';
                }elseif ($data['typeInterview'] == "2") {
                    $statusJob = 6;
                    $mcu = 'N';
                }elseif ($data['typeInterview'] == "3") {
                    $statusJob = 7;
                    $mcu = 'N';
                }elseif ($data['typeInterview'] == "4") {
                    $statusJob = 8;
                    $mcu = 'N';
                }elseif ($data['typeInterview'] == "5") {
                    $statusJob = 9;
                    $mcu = 'Y';
                }else{
                    $statusJob = 10;
                    $mcu = 'N';
                }

                for ($i=0; $i < $data['countChoose']; $i++) { 

                    $interview = InterviewType::where('id', $data['typeInterview'])->get()->toArray();
                    $kandidat = Job_Application::select('kandidat.first_name', 'kandidat.last_name', 'users.email', 'vacancies.job_title')->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')->join('users', 'kandidat.user_id', 'users.id')->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')->where('job_application.id', is_array($data["idJOb"]) ? $data["idJOb"][$i] : $data["idJOb"])->get()->toArray();
                    $date = date('D, d M Y', strtotime($data['dateInterview']));
                    if ($data['typeInterview'] == "6") {
                        $dataEmail = [
                            'email'         => $kandidat[0]['email'],
                            'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                            'tanggal'       => $date,
                            'waktu'         => $data['timeInterview'],
                            'lokasi'        => $data['locationInterview'],
                            'pic'           => $data['interviewer'],
                            'vacancy'       => $kandidat[0]['job_title'],
                            'subject'       => 'Document Sign Invitation',
                            'view'          => 'email.email-doc-sign'
                        ];
        
                        $response = JobSendEmail::dispatch($dataEmail);
                    }else{
                        $dataEmail = [
                            'email'         => $kandidat[0]['email'],
                            'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                            'tanggal'       => $date,
                            'waktu'         => $data['timeInterview'],
                            'lokasi'        => $data['locationInterview'],
                            'pic'           => $data['interviewer'],
                            'interview'     => $interview[0]['name'],
                            'tipe'          => 1,
                            'mcu'           => $mcu,
                            'subject'       => $interview[0]['name'].' Invitation',
                            'view'          => 'email.email-interview-invit'
                        ];
        
                        $response = JobSendEmail::dispatch($dataEmail);
                    }

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

    	$dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $interview = Job_Application::select('job_application.id as job_application_id', 'job_application.kandidat_id', 'job_application.status', 'kandidat.foto_profil', 'kandidat.first_name', 'kandidat.last_name', 'kandidat.gender', 'kandidat.telp', 'kandidat.kota', 'vacancies.job_title')
                                    ->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')
                                    ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                    ->where('job_application.status', "!=", "0")
                                    ->Where('job_application.status', "!=", "1")
                                    ->Where('job_application.status', "!=", "2")
                                    ->Where('job_application.status', "!=", "4")
                                    ->Where('job_application.status', "!=", "10")
                                    ->Where('job_application.status', "!=", "11")
                                    ->Where('job_application.status', "!=", "12");

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

    public function updateStatus(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $updateStatus = InterviewEvent::where('id', $data['idUpdateStatus'])->update([
            "status" => $data["statusInterview"],
            "note"   => $data["noteInterview"]   
        ]);

        if ($updateStatus) {
            $interview = InterviewEvent::select('interview_type.name')->join('interview_type', 'interview_event.type_id', 'interview_type.id')->where('interview_event.id', $data['idUpdateStatus'])->get()->toArray();

            $kandidat = Job_Application::select('kandidat.first_name', 'kandidat.last_name', 'users.email')->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')->join('users', 'kandidat.user_id', 'users.id')->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')->where('job_application.id', $data['idJobApp'])->get()->toArray();
            if ($data["statusInterview"] == "2") {
                $dataEmail = [
                    'email'         => $kandidat[0]['email'],
                    'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                    'text'          => $interview[0]['name'],
                    'tipe'          => "1",
                    'subject'       => $interview[0]['name'].' Result Announcement',
                    'view'          => 'email.email-interview-result'
                ];

                $response = JobSendEmail::dispatch($dataEmail);
            }else{
                if ($data["statusFail"] == "1") {
                    $dataEmail = [
                        'email'         => $kandidat[0]['email'],
                        'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                        'text'          => $interview[0]['name'],
                        'tipe'          => "2",
                        'subject'       => $interview[0]['name'].' Result Announcement',
                        'view'          => 'email.email-interview-result'
                    ];
    
                    $response = JobSendEmail::dispatch($dataEmail);
                }else{
                    $dataEmail = [
                        'email'         => $kandidat[0]['email'],
                        'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                        'text'          => $interview[0]['name'],
                        'tipe'          => "3",
                        'subject'       => $interview[0]['name'].' Result Announcement',
                        'view'          => 'email.email-interview-result'
                    ];
                }
            }
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

    public function viewInterviewEdit($id){
        $idInterview = base64_decode(urldecode($id));
        $getInterview = InterviewEvent::select('interview_event.*', 'reschedule_interview.id as id_reschedule', 'reschedule_interview.date_start', 'reschedule_interview.date_end', 'reschedule_interview.time_start', 'reschedule_interview.time_end')
                                        ->leftJoin('reschedule_interview', 'interview_event.id', 'reschedule_interview.interview_event_id')
                                        ->where('interview_event.id', $idInterview)
                                        ->get()->toArray();
        if ($getInterview) {
            if($getInterview[0]['status'] == "2" || $getInterview[0]['status'] == "3"){
                $getInterview[0]['disabled'] = 'disabled';
            }else{
                $getInterview[0]['disabled'] = '';
            }
            if ($getInterview[0]['status'] == 1) {
                $getInterview[0]['status_interview'] = "New";
            }else if ($getInterview[0]['status'] == 2) {
                $getInterview[0]['status_interview'] = "Pass";
            }else if ($getInterview[0]['status'] == 3) {
                $getInterview[0]['status_interview'] = "Fail";
            }else if ($getInterview[0]['status'] == 4) {
                $getInterview[0]['status_interview'] = "Rescheduled";
            }else if ($getInterview[0]['status'] == 5) {
                $getInterview[0]['status_interview'] = "Decline  Reschedule";
            }else {
                $getInterview[0]['status_interview'] = "New";
            }
            $interviewType = InterviewType::get()->toArray();
            $getJob = Job_Application::select('job_application.id as job_application_id', 'job_application.kandidat_id', 'job_application.status', 'kandidat.foto_profil', 'kandidat.first_name', 'kandidat.last_name', 'kandidat.gender', 'kandidat.telp', 'kandidat.kota', 'vacancies.job_title')
                                    ->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')
                                    ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                    ->where('job_application.id', $getInterview[0]['id_job_application'])->get()->toArray();
            
            if ($getJob) {
                if ($getJob[0]['status'] == 0) {
                    $getJob[0]['status_user'] = "Application Resume";
                }else if ($getJob[0]['status'] == 1) {
                    $getJob[0]['status_user'] = "Process To Written Test";
                }else if ($getJob[0]['status'] == 2) {
                    $getJob[0]['status_user'] = "Scheduled to Written Test";
                }else if ($getJob[0]['status'] == 3) {
                    $getJob[0]['status_user'] = "Written Test Pass";
                }else if ($getJob[0]['status'] == 4) {
                    $getJob[0]['status_user'] = "Written Test failed";
                }else if ($getJob[0]['status'] == 5) {
                    $getJob[0]['status_user'] = "Process to HR interview";
                }else if ($getJob[0]['status'] == 6) {
                    $getJob[0]['status_user'] = "Process to User Interview 1";
                }else if ($getJob[0]['status'] == 7) {
                    $getJob[0]['status_user'] = "Process to User Interview 2";
                }else if ($getJob[0]['status'] == 8) {
                    $getJob[0]['status_user'] = "Process to Direktur Interview";
                }else if ($getJob[0]['status'] == 9) {
                    $getJob[0]['status_user'] = "Process to MCU";
                }else if ($getJob[0]['status'] == 10) {
                    $getJob[0]['status_user'] = "Process to Doc Sign";
                }else if ($getJob[0]['status'] == 11) {
                    $getJob[0]['status_user'] = "Failed";
                }else if ($getJob[0]['status'] == 13) {
                    $getJob[0]['status_user'] = "HR interview Pass";
                }else if ($getJob[0]['status'] == 14) {
                    $getJob[0]['status_user'] = "HR interview Fail";
                }else if ($getJob[0]['status'] == 15) {
                    $getJob[0]['status_user'] = "User Interview 1 Pass";
                }else if ($getJob[0]['status'] == 16) {
                    $getJob[0]['status_user'] = "User Interview 1 Fail";
                }else if ($getJob[0]['status'] == 17) {
                    $getJob[0]['status_user'] = "User Interview 2 Pass";
                }else if ($getJob[0]['status'] == 18) {
                    $getJob[0]['status_user'] = "User Interview 2 Fail";
                }else if ($getJob[0]['status'] == 19) {
                    $getJob[0]['status_user'] = "Direktur Interview Pass";
                }else if ($getJob[0]['status'] == 20) {
                    $getJob[0]['status_user'] = "Direktur Interview Fail";
                }else if ($getJob[0]['status'] == 21) {
                    $getJob[0]['status_user'] = "MCU Pass";
                }else if ($getJob[0]['status'] == 22) {
                    $getJob[0]['status_user'] = "MCU Fail";
                }else{
                    $getJob[0]['status_user'] = "Hired";
                }

                // dd($getJob, $getInterview);
                $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
                $breadcrumb = [
                    "page"      => "Manage Interview",
                    "detail"    => "Edit Interview",
                    "route"     => "/HR/test"
                ];
                return view('admin.interview.interview-edit')->with([
                    'pageTitle' => 'Manajemen Interview', 
                    'title' => 'Manajemen Interview', 
                    'sidebar' => 'manajemen_interview', 
                    'breadcrumb' => $breadcrumb,
                    'interviewType' => $interviewType,
                    'interview' => $getInterview[0],
                    'kandidat' => $getJob[0],
                    'wilayah'  => $wilayah
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
        
        
    }

    public function editInterview(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $editInterview = InterviewEvent::where('id', $data['idInterview'])->update([
            "interview_date"        => date("Y-m-d", strtotime($data["dateInterview"])),
            "time"                  => $data["timeInterview"],
            "location"              => $data["locationInterview"],
            "city"                  => $data["cityInterview"],
            "interviewer"           => $data["interviewer"],
            "last_interview"        => isset($data["lastInterview"]) ? $data["lastInterview"] : 0
        ]);

        if ($editInterview) {
            $messages = [
                'status' => 'success',
                'message' => 'Edit Interview Success',
                'url' => '/HR/interview',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Edit Interview Failed',
            ];

            return response()->json($messages);
        }
        
    }

    public function declineInterview(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $declineInterview = InterviewEvent::where('id', $data['idDecline'])->update([
            "status" => 5,
        ]);

        if ($declineInterview) {
            InterviewReschedule::where('id', $data['idReschedule'])->delete();
            $messages = [
                'status' => 'success',
                'message' => 'Decline Reschedule Interview Success',
                'url' => '/HR/interview',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Decline Reschedule Interview Failed',
            ];

            return response()->json($messages);
        }
    }

    public function accInterview(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $accInterview = InterviewEvent::where('id', $data['idAcc'])->update([
            "interview_date" => date("Y-m-d", strtotime($data["dateAccInterview"])),
            "time"           => $data["timeAccInterview"],
            "status"         => 1,
        ]);

        if ($accInterview) {
            $kandidat = InterviewEvent::select('kandidat.first_name', 'kandidat.last_name', 'users.email', 'vacancies.job_title')->join('job_application', 'interview_event.id_job_application', 'job_application.id')->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')->join('users', 'kandidat.user_id', 'users.id')->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')->where('interview_event.id', $data['idAcc'])->get()->toArray();
            $date = date('D, d M Y', strtotime($data["dateAccInterview"]));
            
            $dataEmail = [
                'email'         => $kandidat[0]['email'],
                'nama'          => $kandidat[0]['first_name'].' '.$kandidat[0]['last_name'],
                'tanggal'       => $date,
                'waktu'         => $data["timeAccInterview"],
                'subject'       => 'Interview Reschedule Confirmation',
                'view'          => 'email.email-interview-reschedule'
            ];

            $response = JobSendEmail::dispatch($dataEmail);

            InterviewReschedule::where('id', $data['idReschedule'])->delete();
            $messages = [
                'status' => 'success',
                'message' => 'Accept Reschedule Interview Success',
                'url' => '/HR/interview',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Accept Reschedule Interview Failed',
            ];

            return response()->json($messages);
        }
    }
}
