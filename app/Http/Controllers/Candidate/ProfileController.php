<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;

use Request;
use Session;

class ProfileController extends Controller
{
    public function viewFirstLogin(){
	    return view('candidate.first-login-candidate')->with(['topbar'=>'first_login']);
    }

    public function postFirstLogin(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        dd($data, Request::file('certificate'));
        if (Request::has('imgLogoCMS')) {
            $image = Request::file('imgLogoCMS');
            $ext = $image->getClientOriginalExtension();
            // dd($image->getRealPath());
            $path = $image->storeAs('uploads', 'logo_utama_'.time().'.'.$ext, 'public');
            $sql->image_logo = '/storage/'.$path;
        }
    }

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
