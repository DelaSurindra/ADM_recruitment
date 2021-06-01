<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\User;
use App\Model\HumanResource;
use App\Model\Token;
use App\Jobs\JobSendEmail;
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

    public function forgetPassword(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        $searchEmail = User::select('human_resource.first_name', 'human_resource.last_name', 'users.id', 'users.email')->join('human_resource', 'users.id', 'human_resource.user_id')->where('email', $data['email'])->get()->toArray();
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
                'view'          => 'email.email-renew-password'
            ];

            $response = JobSendEmail::dispatch($dataEmail);

            $messages = [
                'status' => 'success',
                'message' => 'Reset password success, please check your email',
                'url' => '/HR/login',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            return [
                'status'  => 'warning',
                'message' => 'Email Not Found'
            ];
        }
    }

    public function viewResetPassword($data){
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
                    return view('admin.reset-password')->with(['data' => $dataView, 'type' => '2']);
                }else{
                    return view('admin.reset-password')->with(['data' => $dataView, 'type' => '1']);
                }
            }else{
                return view('admin.reset-password')->with(['data' => $dataView, 'type' => '2']);
            }
        }else{
            return view('admin.reset-password')->with(['data' => $dataView, 'type' => '2']);
        }
    }

    public function resetPassword(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        
        $pass = User::where('id', $data['idUser'])->get()->toArray();
        if ($pass) {
            
            $update = User::where('id', $data['idUser'])->update([
                'password' => bcrypt($data['newPassword'].env('SALT_PASS_HR'))
            ]);
    
            if ($update) {
                $messages = [
                    'status' => 'success',
                    'message' => 'Create New Password Success',
                    'url' => '/HR/login',
                    'callback' => 'redirect'
                ];
    
                return response()->json($messages);
            }else{
                $messages = [
                    'status' => 'error',
                    'message' => 'Create New Password Failed',
                ];
    
                return response()->json($messages);
            }
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'User Not Found',
            ];

            return response()->json($messages);
        }
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
