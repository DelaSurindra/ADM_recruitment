<?php

namespace App\Http\Controllers\Admin;
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
    public function loginAdminView(){
    	if (Session()->get('session_id') != null) {
            return redirect()->back();
        }else{
	    	return view('login-admin');
        }
    }

    public function loginAdmin(){
    	$encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $getUser = DB::select('call check_login("'.$data['email'].'", "'.md5($data['password'].'v4Agr3g4t0R').'")');
        // dd($getUser);
    	if ($getUser[0]->code == "00") {

            $checkAdmin = Admin::where('email', $data['email'])->get()->toArray();
            if ($checkAdmin != null) {
                Admin::where('email', $data['email'])->update(['session' => Session::getId()]);
            } else {
                $admin = new Admin();
                $admin->email = $data['email'];
                $admin->session = Session::getId();
                $admin->save();
            }

            if ($getUser[0]->parent_id == null) {
                $parent_id = $getUser[0]->id;
            }else{
                $parent_id = $getUser[0]->parent_id;
            }
            $arrPermission = explode(",", $getUser[0]->permission_id);
            $arrSubPermission = explode(",", $getUser[0]->sub_permission_id);
            $arrHasilSub = [];
            for ($i=0; $i < count($arrSubPermission); $i++) {
                array_push($arrHasilSub, $arrPermission[$i].$arrSubPermission[$i]);
            }

            $dataSession = [
                'id'                    => $getUser[0]->id,
                'parent_id'             => $parent_id,
                'merchant_code'         => $getUser[0]->merchant_code,
                'priviledge_id'         => $getUser[0]->priviledge_id,
                'priviledge'            => $getUser[0]->priviledge,
                'email'                 => $getUser[0]->email,
                'session_id'            => Session::getId(),
                'firstname'             => $getUser[0]->firstname,
                'lastname'              => $getUser[0]->lastname,
                'company_name'          => $getUser[0]->company_name,
                'phone'                 => $getUser[0]->phone,
                'active_status'         => $getUser[0]->active_status,
                'is_fullaccess'         => $getUser[0]->is_fullaccess,
                'bank_id'               => $getUser[0]->bank_id,
                'bank_code'             => $getUser[0]->bank_code,
                'branch_id'             => $getUser[0]->branch_id,
                'branch_code'           => $getUser[0]->branch_code,
                'permission_id'         => $getUser[0]->permission_id,
                'permission_name'       => $getUser[0]->permission_name,
                'array_perm'            => $arrPermission,
                'sub_permission_id'     => $getUser[0]->sub_permission_id,
                'array_sub'             => $arrHasilSub,
                'sub_permission_name'   => $getUser[0]->sub_permission_name,
                'picture'               => $getUser[0]->picture,
            ];

            Session::put('session_id', $dataSession);
            return [
                'status'   => 'success',
                'url'      => '/',
                'callback' => 'login'
            ];
        } elseif ($getUser[0]->code == 'BLOCKED_USER') {
            return [
    			'status'  => 'error',
    			'message' => 'Mohon maaf, akun Anda telah terblokir karena telah melakukan gagal melakukan login lebih dari 3 (tiga) kali. Untuk membuka akun Anda gunakan fitur Forget Password yang terdapat pada halaman ini'
            ];
        } else {
    		return [
    			'status'  => 'error',
    			'message' => 'Maaf username atau password yang Anda masukkan salah, harap coba kembali'
            ];
    	}
    }


    public function logout(){
        if(Session::get('session_id.priviledge_id') == "1") {
            $redirect = 'login-admin-vascomm';
        } else {
            $redirect = 'login';
        }

		session()->forget('session_id');

    	return redirect($redirect);
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
