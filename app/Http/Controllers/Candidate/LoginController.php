<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\User;
use App\Model\Candidate;
use File;

use Illuminate\View\View;
use DB;
use Request;
use Session;
use Hash;

class LoginController extends Controller
{
    public function index() {
        return view('candidate.main-homepage.main')->with(['topbar'=>'home']);
    }

    public function signUp(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $searchEmail = User::where('email', $data['emailCandidate'])->first();
        if ($searchEmail) {
            return [
                'status'  => 'error',
                'message' => 'Email Sudah Terdaftar'
            ];
        } else {
            $insertUser = User::insertGetId([
                'email' => $data['emailCandidate'],
                'type' => '1',
                'password' => bcrypt($data['passwordCandidate'].env('SALT_PASS_CANDIDATE'))
            ]);

            $insertCandidate = Candidate::insert([
                'first_name' => $data['firstNameCandidate'],
                'last_name' => $data['lastNameCandidate'],
                'user_id' => $insertUser
            ]);

            if ($insertCandidate) {
                $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $insertUser)->first();
                // dd($user->first_name);
                $session = [
                    'user_id' => $user->user_id,
                    'user_email' => $user->email,
                    'user_password' => $user->password,
                    'user_type' => $user->type,
                    'user_status' => $user->status,
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'tanggal_lahir' => $user->tanggal_lahir,
                    'gender' => $user->gender,
                    'telp' => $user->telp,
                    'kota' => $user->kota,
                    'linkedin' => $user->linkedin,
                    'cover_letter' => $user->cover_letter,
                    'resume' => $user->resume,
                    'protofolio' => $user->protofolio,
                    'skill' => $user->skill,
                ];

                Session::put('session_candidate', $session);

                return [
                    'status'   => 'success',
                    'message'  => 'Berhasil Melakukan Registrasi',
                    'url'      => '/complete-account',
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

    public function signIn(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $cekEmail = User::where('email', $data['email'])->where('type', '1')->first();
        
    	if ($cekEmail) {
            if (Hash::check($data['password'].env('SALT_PASS_CANDIDATE'), $cekEmail->password)) {
                $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $cekEmail->id)->first();
                // dd($user->first_name);
                $session = [
                    'user_id' => $user->user_id,
                    'user_email' => $user->email,
                    'user_password' => $user->password,
                    'user_type' => $user->type,
                    'user_status' => $user->status,
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'tanggal_lahir' => $user->tanggal_lahir,
                    'gender' => $user->gender,
                    'telp' => $user->telp,
                    'kota' => $user->kota,
                    'linkedin' => $user->linkedin,
                    'cover_letter' => $user->cover_letter,
                    'resume' => $user->resume,
                    'protofolio' => $user->protofolio,
                    'skill' => $user->skill,
                ];

                Session::put('session_candidate', $session);

                return [
                    'status'   => 'success',
                    'url' => '/',
                    'callback' => 'login'
                ];
            } else {
                return [
                    'status'  => 'error',
                    'message' => 'Email dan Password tidak sesuai'
                ];
            }
        } else {
            return [
                'status'  => 'error',
                'message' => 'Email dan Password tidak sesuai'
            ];
        }
    }

    public function logout(){
        session()->forget('session_candidate');

    	return redirect('/job');
    }
}
