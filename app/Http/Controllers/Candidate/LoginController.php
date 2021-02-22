<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Admin;
use App\Institusi;
use File;

use Illuminate\View\View;
use DB;
use Request;
use Session;

class LoginController extends Controller
{

    public function viewLoginCandidate(){
    	if (Session()->get('session_id') != null) {
            return redirect()->back();
        }else{
	    	return view('candidate.first-login-candidate');
        }
    }

}
