<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function viewProfile(){
        return view('candidate.profile-child')->with(['topbar'=>'profile']);
    }

    public function editPersonalInformation(){
        return view('candidate.personal-information')->with(['topbar'=>'personal_information']);
    }

    public function editOtherInformation(){
        return view('candidate.other-information')->with(['topbar'=>'other_information']);
    }

    public function editEducationInformation(){
        return view('candidate.education-information')->with(['topbar'=>'education_information']);
    }

    public function myAppDetail(){
        return view('candidate.my-app-detail')->with(['topbar'=>'myapp_detail']);
    }

    public function testReschedule(){
        return view('candidate.test-reschedule')->with(['topbar'=>'test_reschedule']);
    }

    public function interviewReschedule(){
        return view('candidate.interview-reschedule')->with(['topbar'=>'interview_reschedule']);
    }
}
