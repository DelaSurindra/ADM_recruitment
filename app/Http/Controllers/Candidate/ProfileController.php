<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function viewProfile(){
        return view('candidate.profile-child');
    }

    public function editPersonalInformation(){
        return view('candidate.personal-information');
    }

    public function editOtherInformation(){
        return view('candidate.other-information');
    }

    public function editEducationInformation(){
        return view('candidate.education-information');
    }

    public function myAppDetail(){
        return view('candidate.my-app-detail');
    }

    public function testReschedule(){
        return view('candidate.test-reschedule');
    }

    public function interviewReschedule(){
        return view('candidate.interview-reschedule');
    }
}
