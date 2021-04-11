<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function viewContactUs(){
        return view('candidate.contact-us.contact-us')->with(['topbar'=>'contact-us']);
    }
}
