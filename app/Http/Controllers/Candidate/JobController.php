<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Vacancy;
use App\Model\Wilayah;

use Request;
use Session;

class JobController extends Controller
{
    public function viewJob() {
        // Get data lokasi
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        // Get data Job
        $job = Vacancy::get()->toArray();
        
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
        return view('candidate.job_list.job-detail')->with(['topbar'=>'job', 'job'=>$job]);
    }

    public function applyJob() {
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if ($data['idUser']) {
            # code...
        } else {
            return [
                'status' => 'warning',
                'message' => 'Harap login',
                'callback' => 'mustLogin'
            ];
        }
    }
}
