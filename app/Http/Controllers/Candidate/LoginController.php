<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\User;
use App\Model\Candidate;
use App\Model\Education;
use App\Model\Token;
use App\Jobs\JobSendEmail;
use File;

use Illuminate\View\View;
use DB;
use Request;
use Session;
use Hash;

class LoginController extends Controller
{

    public function signUp(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $searchEmail = User::where('email', $data['emailCandidate'])->first();
        // dd($searchEmail);
        if ($searchEmail) {
            return [
                'status'  => 'warning',
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
                'user_id' => $insertUser,
                'status' => 0
            ]);

            if ($insertCandidate) {
                $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status as user_status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $insertUser)->first()->toArray();
                $education = Education::where('kandidat_id', $user['id'])->get()->toArray();
                // dd($user, $education);
                $session = [
                    'user_id' => $user['user_id'],
                    'user_email' => $user['email'],
                    'user_type' => $user['type'],
                    'user_status' => $user['user_status'],
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'tanggal_lahir' => $user['tanggal_lahir'],
                    'gender' => $user['gender'],
                    'telp' => $user['telp'],
                    'kota' => $user['kota'],
                    'linkedin' => $user['linkedin'],
                    'cover_letter' => $user['cover_letter'],
                    'resume' => $user['resume'],
                    'protofolio' => $user['protofolio'],
                    'skill' => $user['skill'],
                    'foto_profil' => $user['foto_profil'],
                    'status_kandidat' => $user['status'],
                    'pendidikan' => $education
                ];
                Session::put('session_candidate', $session);

                return [
                    'status'   => 'success',
                    'message'  => 'Berhasil Melakukan Registrasi',
                    'url'      => '/complete-account',
                    'callback' => 'modal'
                ];
            }else{
                return[
                    'status'    => 'warning',
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
                $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status as user_status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $cekEmail->id)->first()->toArray();
                $education = Education::where('kandidat_id', $user['id'])->get()->toArray();
                // dd($user, $education);
                $session = [
                    'user_id' => $user['user_id'],
                    'user_email' => $user['email'],
                    'user_type' => $user['type'],
                    'user_status' => $user['user_status'],
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'tanggal_lahir' => $user['tanggal_lahir'],
                    'gender' => $user['gender'],
                    'telp' => $user['telp'],
                    'kota' => $user['kota'],
                    'linkedin' => $user['linkedin'],
                    'cover_letter' => $user['cover_letter'],
                    'resume' => $user['resume'],
                    'protofolio' => $user['protofolio'],
                    'skill' => $user['skill'],
                    'foto_profil' => $user['foto_profil'],
                    'status_kandidat' => $user['status'],
                    'pendidikan' => $education
                ];
                Session::put('session_candidate', $session);

                return [
                    'status'   => 'success',
                    'url' => '/',
                    'callback' => 'login'
                ];
            } else {
                return [
                    'status'  => 'warning',
                    'message' => 'Email dan Password tidak sesuai'
                ];
            }
        } else {
            return [
                'status'  => 'warning',
                'message' => 'Email dan Password tidak sesuai'
            ];
        }
    }
    public function fogetPassword()
    {
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        $searchEmail = User::select('kandidat.first_name', 'kandidat.last_name', 'users.id', 'users.email')->join('kandidat', 'users.id', 'kandidat.user_id')->where('email', $data['email'])->get()->toArray();
        if ($searchEmail) {
            date_default_timezone_set("Asia/Jakarta");
            $tgl = date_create();
            $exp = date_add(date_create(),date_interval_create_from_date_string("1 days"));
            $token = date('YmdHis') . $this->randomString(20);
            $insertCandidate = Token::insert([
                'token' => $token,
                'created_date' => $tgl,
                'expired' => $exp,
                'status' => 0,
                'user_id' => $searchEmail[0]['id']
            ]);
            $username = encrypt($searchEmail[0]['id'] . ',' . date('Y-m-d') . ',' . $token); 
            $dataEmail = [
                'username'      => $username,
                'email'         => $searchEmail[0]['email'],
                'nama'          => $searchEmail[0]['first_name'].' '.$searchEmail[0]['last_name'],
                'subject'       => 'Renew Password',
                'view'          => 'email.email-renew-password-candidate'
            ];

            $response = JobSendEmail::dispatch($dataEmail);
            return [
                'status'   => 'success',
                'message'  => 'Reset password success, please check your email',
                'url'      => '/',
                'callback' => 'modal'
            ];
        } else {
            return [
                'status'  => 'warning',
                'message' => 'Email Tidak Terdaftar'
            ];
        }

    }

    public function viewForgetPassword($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $dataEmail = decrypt($data);
        $explode = explode(',', $dataEmail);
        $date = $explode[1];
        $token = $explode[2];
        $now = date('Y-m-d');

        $checkToken = Token::where('token', $token)->get()->toArray();
        $dataView = [
            'id' => $checkToken[0]['user_id'],
            'status' => $checkToken[0]['status'],
        ];
        if ($checkToken != null) {
            if ($checkToken[0]['status'] == "0") {
                Token::where('token', $token)->update(['status' => "1"]);
                if ($date > $now) {
                    return view('candidate.editpassword')->with(['topbar'=>'education_information','data' => $dataView, 'type' => '2']);
                }else{
                    return view('candidate.editpassword')->with(['topbar'=>'education_information','data' => $dataView, 'type' => '1']);
                }
            }else{
                return view('candidate.editpassword')->with(['topbar'=>'education_information','data' => $dataView, 'type' => '2']);
            }
        }else{
            return view('candidate.editpassword')->with(['topbar'=>'education_information','data' => $dataView, 'type' => '2']);
        }
    }

    public function doResetPass()
    {
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        
        $pass = User::where('id', $data['idCandidate'])->get()->toArray();
        if ($pass) {
            
            $update = User::where('id', $data['idCandidate'])->update([
                'password' => bcrypt($data['password'].env('SALT_PASS_CANDIDATE'))
            ]);
    
            if ($update) {
                return [
                    'status'   => 'success',
                    'message'  => 'Change Password Success, Please Login Again',
                    'url'      => '/',
                    'callback' => 'modal'
                ];
            }else{
                return [
                    'status'   => 'warning',
                    'message'  => 'Change Password Failed',
                ];
            }
        } else {
            return [
                'status'   => 'warning',
                'message'  => 'Change Password Failed, Token Invalid',
            ];
        }
    }


    public function logout(){
        session()->forget('session_candidate');

    	return redirect('/');
    }

    function randomString($length) {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = "";    

        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $str;
    }
}
