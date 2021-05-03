<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\User;
use App\Model\HumanResource;
use Hash;
use DB;
use Request;
use Session;

class LoginController extends Controller
{
    public function loginAdminView(){
    	if (Session()->get('session_id') != null) {
            return redirect()->back();
        }else{
	    	return view('admin.login-admin');
        }
    }

    public function loginAdmin(){
    	$encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $user = User::where('email', $data['email'])->where('type', '2')->first();
        // dd($getUser);
    	if ($user) {
            if (Hash::check($data['password'].env('SALT_PASS_HR'), $user->password)) {
                if ($user->status == 1) {
                    $HR = HumanResource::select('human_resource.*', 'role.role_name')->join('role', 'human_resource.role', 'role.id')->where('human_resource.user_id', $user->id)->first();
                    $session = [
                        'id' => $user->id,
                        'email' => $user->email,
                        'type' => $user->type,
                        'hr_id' => $HR->id,
                        'first_name' => $HR->first_name,
                        'last_name' => $HR->last_name,
                        'gender' => $HR->gender,
                        'telp' => $HR->telp,
                        'role' => $HR->role,
                        'role_name' => $HR->role_name,
                    ];
                    Session::put('session_id', $session);
                    return [
                        'status'   => 'success',
                        'url'      => '/HR',
                        'callback' => 'login'
                    ];
                }else{
                    return [
                        'status'  => 'error',
                        'message' => 'User Tidak Aktif'
                    ];
                }

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
        session()->forget('session_id');

    	return redirect('HR/login');
    }

    public function checkSession() {
        session()->forget('session_id');
        $session_id = Session()->get('session_id');
        if ($session_id != null) {
            return '1';
        }
        else {
            return '0';
        }
    }

    // public function forgotPassView()
    // {
    //     if (Session()->get('session_id') != null) {
    //         return redirect()->back();
    //     }else{
    //         return view('forgot-password');
    //     }
    // }

    public function forgotPassword()
    {
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data['email']);
        $getUser = Institusi::where('email', $data['email'])->get();
        // dd($getUser);
        if (isset($getUser[0])) {
            $req = new RequestController;

            $request = [
                'email'      => $getUser[0]->email,
                'type'       => 'reset_password'
            ];

            $endpoint = '/password/generate';
            $response = $req->send($request,$endpoint);
            // dd($response);
            if ($response['code'] == "00") {
                session()->put('session_reset', $request);
                return [
                    'status'   => 'success',
                    'message'  => $response['message'],
                    'url'      => '/reset-password',
                    'callback' => 'redirect'
                ];
            } else {
                return [
                    'status'   => 'error',
                    'message'  => $response['message']
                ];
            }
        } else {
            return [
                'status'   => 'error',
                'message'  => 'User tidak ditemukan'
            ];
        }

    }
    public function resetPassView()
    {
        $sesReset = session('session_reset');
        session()->forget('session_reset');
        if (isset($sesReset)) {
            return view('reset-password')->with(['email' => $sesReset['email']]);
        }else{
            return redirect('login');
        }

    }

    public function newPassword()
    {
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $req = new RequestController;

        $request = [
            'email'      => $data['emailReset'],
            'password'   => md5($data['passwordReset'].'v4Agr3g4t0R'),
            'otp'        => $data['otpReset'],
        ];

        $endpoint = '/password/verify';
        $response = $req->send($request,$endpoint);

        if ($response['code'] == "00") {
            return [
                'status'   => 'success',
                'message'  => $response['message'],
                'url'      => '/otp-password-success',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => $response['message']
            ];
        }
    }

    public function successForget(){
        return view('otp-password-success');
    }

    function randomString($length) {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = "";

        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $str;
    }

    public function otpNewPasswordView(){
        return view('otp-new-password');
    }

    public function viewLoginCandidate(){
    	if (Session()->get('session_id') != null) {
            return redirect()->back();
        }else{
	    	return view('first-login-candidate');
        }
    }

}
