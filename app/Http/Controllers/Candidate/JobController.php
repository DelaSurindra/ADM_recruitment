<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function viewJob() {
        return view('candidate.job_list.job-list')->with(['topbar'=>'job']);
    }

    public function viewJobDetail() {
        return view('candidate.job_list.job-detail')->with(['topbar'=>'job']);
    }
}
