<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\User;
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
	    	return view('candidate.first-login-candidate')->with(['topbar'=>'first_login']);
        }
    }

    public function signUp(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);

        $searchEmail = User::where('email', $data['email'])->first();
        if ($searchEmail) {
            return [
                'status'  => 'error',
                'message' => 'Email Sudah Terdaftar'
            ];
        } else {
            $insertUser = User::insertGetId([
                'email' => $data['email'],
                'type'  => '1',
                'password' => bcrypt($data['password'].env('SALT_PASS_HR'))
            ]);

            $insertCandidate = Candidate::insert([
                'name'      => "",
                'user_id'   => $insertUser
            ]);

            if ($insertCandidate) {
                // Insert Session ID
                $user = User::where('id', $insertUser)->first();
                $session = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'type' => $user->type,
                    'data' => $user->customer
                ];
                Session::put('session_id', $session);

                return [
                    'status'   => 'success',
                    'message'  => 'Berhasil Melakukan Registrasi',
                    'url'      => '/first-login',
                    'callback' => 'redirect'
                ];
            }else{
                return[
                    'status'    => 'error',
                    'message'   => 'Gagal Melakukan Registrasi'
                ];
            }
        }
        
    }

}
