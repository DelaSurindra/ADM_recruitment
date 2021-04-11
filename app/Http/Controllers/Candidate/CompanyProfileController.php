<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyProfileController extends Controller
{
    public function viewCompanyProfile(){
        return view('candidate.company-profile.company-profile')->with(['topbar'=>'company-profile']);
    }
}
