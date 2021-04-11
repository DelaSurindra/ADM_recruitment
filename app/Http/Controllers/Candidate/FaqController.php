<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function viewFaq(){
        return view('candidate.faq.faq')->with(['topbar'=>'faq']);
    }
}
