<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Job_Application;
use App\Model\Education;
use App\Model\Vacancy;
use App\Model\Wilayah;
use App\Model\User;
use App\Model\Candidate;
use App\Model\MasterSource;
use App\Jobs\JobSendEmail;

use Request;
use Session;

class JobController extends Controller
{
    public function viewJob() {
        // Get data lokasi
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        // Get data Job
        $job = Vacancy::where('status', 1)->orderBy('created_at', 'desc')->take(9)->get()->toArray();
        // dd($job);
        for ($i=0; $i < count($job); $i++) { 
            if($job[$i]['degree'] == 1) {
                $degree = "Diploma's Degree";
            } elseif($job[$i]['degree'] == 2) {
                $degree = "Bachelor's Degree";
            } elseif($job[$i]['degree'] == 3) {
                $degree = "Master's Degree";
            } else {
                $degree = "";
            }

            $job[$i]['education_req'] = $degree;
        }
        // dd($job);
        return view('candidate.job_list.job-list')->with(['topbar'=>'job', 'job'=>$job, 'wilayah'=>$wilayah]);
    }

    public function getJobList() {
        $data = Request::input('value');
        // dd($data);
        $filter; 
        $parameter = parse_str($data, $filter);
        // dd($filter);
        if (isset($filter['searchJob'])) {
            $sql = new Vacancy;
            // Search
            if (isset($filter['searchJob']) && !empty($filter['searchJob'])) {
                $sql = $sql->where('job_title', 'like','%'.$filter['searchJob'].'%');
            }
            // Filter Job Type
            if (isset($filter['jobTypeFulltime']) || isset($filter['jobTypeInternship'])) {
                if (!empty($filter['jobTypeFulltime']) && !empty($filter['jobTypeInternship'])) {
                    $sql = $sql->whereIn('type', [$filter['jobTypeFulltime'], $filter['jobTypeInternship']]);
                } elseif (!empty($filter['jobTypeFulltime'])) {
                    $sql = $sql->where('type', $filter['jobTypeFulltime']);
                } elseif (!empty($filter['jobTypeInternship'])) {
                    $sql = $sql->where('type', $filter['jobTypeInternship']);
                }
            }
            // Filter Lokasi
            if (isset($filter['locationFilter']) && !empty($filter['locationFilter'])) {
                $sql = $sql->where('lokasi', $filter['locationFilter']);
            }
            // Filter Education
            if (isset($filter['educationFilterD3']) || isset($filter['educationFilterS1']) || isset($filter['educationFilterS2'])) {
                if (!empty($filter['educationFilterD3']) && !empty($filter['educationFilterS1']) && !empty($filter['educationFilterS2'])) {
                    $sql = $sql->whereIn('degree', [$filter['educationFilterD3'], $filter['educationFilterS1'], $filter['educationFilterS2']]);
                } elseif (!empty($filter['educationFilterD3']) && !empty($filter['educationFilterS1'])) {
                    $sql = $sql->whereIn('degree', [$filter['educationFilterD3'], $filter['educationFilterS1']]);
                } elseif (!empty($filter['educationFilterD3']) && !empty($filter['educationFilterS2'])) {
                    $sql = $sql->whereIn('degree', [$filter['educationFilterD3'], $filter['educationFilterS2']]);
                } elseif (!empty($filter['educationFilterS1']) && !empty($filter['educationFilterS2'])) {
                    $sql = $sql->whereIn('degree', [$filter['educationFilterS1'], $filter['educationFilterS2']]);
                } elseif (!empty($filter['educationFilterD3'])) {
                    $sql = $sql->where('degree', $filter['educationFilterD3']);
                } elseif (!empty($filter['educationFilterS1'])) {
                    $sql = $sql->where('degree', $filter['educationFilterS1']);
                } elseif (!empty($filter['educationFilterS2'])) {
                    $sql = $sql->where('degree', $filter['educationFilterS2']);
                }
            }
            // Filter Major
            if (isset($filter['majorFilter']) && !empty($filter['majorFilter'])) {
                $sql = $sql->where('major', 'like','%'.$filter['majorFilter'].'%');
            }

            $job = $sql->orderBy('created_at', 'desc')->get()->toArray();
        } else {
            $job = Vacancy::orderBy('created_at', 'desc')->take($data)->get()->toArray();
        }
        
        for ($i=0; $i < count($job); $i++) { 
            if($job[$i]['degree'] == 1) {
                $degree = "Diploma's Degree";
            } elseif($job[$i]['degree'] == 2) {
                $degree = "Bachelor's Degree";
            } elseif($job[$i]['degree'] == 3) {
                $degree = "Master's Degree";
            }

            $job[$i]['education_req'] = $degree;
        }
        // dd($job);
        return response()->json($job);
    }

    public function viewJobDetail($id) {
        $id = base64_decode(urldecode($id));

        $job = Vacancy::orderBy('created_at', 'desc')->take(3)->get()->toArray();
        // dd($job);
        for ($i=0; $i < count($job); $i++) { 
            if($job[$i]['degree'] == 1) {
                $degree = "Diploma's Degree";
            } elseif($job[$i]['degree'] == 2) {
                $degree = "Bachelor's Degree";
            } elseif($job[$i]['degree'] == 3) {
                $degree = "Master's Degree";
            } else {
                $degree = "";
            }

            $job[$i]['education_req'] = $degree;
        }

        $jobDetail = Vacancy::where('job_id', $id)->first()->toArray();
        // dd($job);
        if($jobDetail['degree'] == 1) {
            $degree = "Diploma's Degree";
        } elseif($jobDetail['degree'] == 2) {
            $degree = "Bachelor's Degree";
        } elseif($jobDetail['degree'] == 3) {
            $degree = "Master's Degree";
        }

        $jobDetail['education_req'] = $degree;

        return view('candidate.job_list.job-detail')->with(['topbar'=>'job', 'job'=>$job, 'jobDetail'=>$jobDetail]);
    }

    public function applyJob() {
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        
        if ($data['idUser']) {
            // get data education
            $education = Education::where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
            // get data job
            $job = Vacancy::where('job_id', $data['idJob'])->first()->toArray();
            
            $state = false;
            if (count($education) > 1) {
                foreach ($education as $pendidikan) {
                    if ($pendidikan['gelar'] >= $job['degree'] && trim($pendidikan['jurusan'], " ") === $job['major']) {
                        $state = true;
                    }
                }
            } else {
                if ($education[0]['gelar'] >= $job['degree'] && trim($education[0]['jurusan'], " ") === $job['major']) {
                    $state = true;
                }
            }
            
            if ($state) {
                $apply = Job_Application::insertGetId([
                    'interview_count' => '',
                    'referensi' => '',
                    'status' => 0,
                    'kandidat_id' => Session::get('session_candidate')['id'],
                    'vacancy_id' => $data['idJob']
                ]);

                if ($apply) {
                    $track = $this->statusTrackApply($apply, 0);
                    $updateStatus = Candidate::where('id', Session::get('session_candidate')['id'])->update(['status'=>1]);
                    $souce = MasterSource::get()->toArray();
                    $dataEmail = [
                        'email'         => session('session_candidate.user_email'),
                        'nama'          => session('session_candidate.first_name').' '.session('session_candidate.last_name'),
                        'subject'       => 'Application Submission',
                        'view'          => 'email.email-application-submission'
                    ];
            
                    $response = JobSendEmail::dispatch($dataEmail);
                    if ($updateStatus) {
                        session()->forget('session_candidate.status_kandidat');
                        session()->put('session_candidate.status_kandidat', 1);
                        return [
                            'status' => 'success',
                            'message' => 'Berhasil',
                            'idApply' => $apply,
                            'callback' => 'applySuccess',
                            'options' => $souce
                        ];
                    }
                } else {
                    return [
                        'status' => 'warning',
                        'message' => 'Job Requirement Not Match',
                    ];
                }
            } else {
                return [
                    'status' => 'warning',
                    'message' => 'Job Requirement Not Match',
                ];
            }
        } else {
            return [
                'status' => 'warning',
                'message' => 'Harap login',
                'callback' => 'mustLogin'
            ];
        }
    }

    public function applyTellMe() {
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $sql = Job_Application::where('id', $data['idApply'])->update([
            'referensi' => $data['tellMe'],
        ]);

        if ($sql) {
            return [
                'status' => 'success',
                'message' => 'Berhasil',
                'callback' => 'applySuccessTellMe'
            ];
        } else {
            return [
                'status' => 'warning',
                'message' => 'Error Save Tell Me',
            ];
        }
    }

}
