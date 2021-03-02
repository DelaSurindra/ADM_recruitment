<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Education;
use App\Model\Vacancy;
use App\Model\Wilayah;
use App\Model\User;

use Request;
use Session;

class JobController extends Controller
{
    public function viewJob() {
        // Get data lokasi
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        // Get data Job
        $job = Vacancy::orderBy('created_at', 'desc')->take(9)->get()->toArray();
        
        for ($i=0; $i < count($job); $i++) { 
            if($job[$i]['degree'] == 1) {
                $degree = "Diploma's Degree";
            } elseif($job[$i]['degree'] == 2) {
                $degree = "Bachelor's Degree";
            } elseif($job[$i]['degree'] == 3) {
                $degree = "Master's Degree";
            }

            $major = explode(',', $job[$i]['major']);
            foreach ($major as $value) {
                $job[$i]['education_req'] = $degree.' in '.$value;
            }
        }
        // dd($job);
        return view('candidate.job_list.job-list')->with(['topbar'=>'job', 'job'=>$job, 'wilayah'=>$wilayah]);
    }

    public function viewJobDetail($id) {
        $id = base64_decode(urldecode($id));
        $job = Vacancy::where('job_id', $id)->first()->toArray();
        // dd($job);
        if($job['degree'] == 1) {
            $degree = "Diploma's Degree";
        } elseif($job['degree'] == 2) {
            $degree = "Bachelor's Degree";
        } elseif($job['degree'] == 3) {
            $degree = "Master's Degree";
        }

        $major = explode(',', $job['major']);
        foreach ($major as $value) {
            $job['education_req'] = $degree.' in '.$value;
        }

        return view('candidate.job_list.job-detail')->with(['topbar'=>'job', 'job'=>$job]);
    }

    public function applyJob() {
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if ($data['idUser']) {
            // get data education
            $education = Education::where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
            // get data job
            $job = Vacancy::where('job_id', $data['idJob'])->first()->toArray();
            // dd($education, $job);
            $state = false;
            if (count($education) > 1) {
                foreach ($education as $pendidikan) {
                    if ($pendidikan['gelar'] == $job['degree'] && trim($pendidikan['jurusan']," ") === $job['major']) {
                        $state = true;
                    }
                }
            } else {
                if ($education[0]['gelar'] == $job['degree'] && $education[0]['jurusan'] == $job['major']) {
                    $state = true;
                }
            }
            // dd($education, $job, $state);
            if ($state) {
                return [
                    'status' => 'success',
                    'message' => 'Berhasil',
                    'callback' => 'applySuccess'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Gagal Apply Job',
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
}
