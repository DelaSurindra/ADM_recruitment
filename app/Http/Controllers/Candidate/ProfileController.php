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
}
