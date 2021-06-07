<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\User;
use App\Model\Role;
use App\Model\HumanResource;
use Response;
use Hash;
use Request;
use Session;
use DB;

class UserController extends Controller
{
    public function viewUser(){
        return view('admin.user.user-list')->with(['pageTitle' => 'Manajemen User', 'title' => 'Manajemen User', 'sidebar' => 'manajemen_user']);
    }

    public function listUser(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $user = HumanResource::select('human_resource.*', 'users.email', 'users.status', 'role.role_name')
                                    ->join('users', 'human_resource.user_id', 'users.id')
                                    ->join('role', 'human_resource.role', 'role.id');

        if ($dataSend['search']){
            $user = $user->where('human_resource.first_name','like','%'.$dataSend['search'].'%')->orWhere('human_resource.last_name','like','%'.$dataSend['search'].'%')->orWhere('users.email','like','%'.$dataSend['search'].'%');
        }
        $countUser = $user->count();

        $listUser = $user->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            if ($dataSend["order"] == "created_at") {
                $dataSend["order"] = 'human_resource.created_at';
            }
            $listUser = $listUser->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listUser = $listUser->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }

        for ($i=0; $i < count($listUser); $i++) { 
            $listUser[$i]['created_at'] = date('d/m/Y', strtotime($listUser[$i]['created_at']));
        }
        
        if ($listUser != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countUser,
                "recordsFiltered"   => $countUser,
                "data"              => $listUser
            );
        }else{
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => 0,
                "recordsFiltered"   => 0,
                "data"              => []
            );
        }
        return $response;
    }

    public function viewUserAdd(){
        $role = Role::get()->toArray();
        return view('admin.user.user-add')->with(['pageTitle' => 'Manajemen User', 'title' => 'Manajemen User', 'sidebar' => 'manajemen_user', 'role' => $role]);
    }

    public function addUser(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $getUser = User::where('email', $data['emailUser'])->get()->toArray();
        if ($getUser) {
            $messages = [
                'status' => 'error',
                'message' => 'Email Already Exist',
            ];

            return response()->json($messages);
        }else{
            $insertUser = User::insertGetId([
                'email' => $data['emailUser'],
                'type' => '2',
                'password' => bcrypt($data['passUser'].env('SALT_PASS_HR'))
            ]);
            if ($insertUser) {
                $insertHR = HumanResource::insert([
                    'first_name' => $data['firstNameUser'],
                    'last_name'  => $data['lastNameUser'],
                    'gender'     => $data['genderUser'],
                    'telp'       => $data['telpUser'],
                    'role'       => $data['roleUser'],
                    'user_id'    => $insertUser
                ]);
                if ($insertHR) {
                    $messages = [
                        'status' => 'success',
                        'message' => 'Add User Success',
                        'url' => '/HR/user',
                        'callback' => 'redirect'
                    ];
        
                    return response()->json($messages);
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Add User Failed',
                    ];
        
                    return response()->json($messages);
                }
            }else{
                $messages = [
                    'status' => 'error',
                    'message' => 'Add User Failed',
                ];
    
                return response()->json($messages);
            }
        }
    }

    public function viewUserEdit($id){
        $idUser = base64_decode(urldecode($id));
        $user = HumanResource::select('human_resource.*', 'users.email', 'users.status', 'role.role_name')
                                    ->join('users', 'human_resource.user_id', 'users.id')
                                    ->join('role', 'human_resource.role', 'role.id')
                                    ->where('human_resource.id', $idUser)->get()->toArray();
        if ($user) {
            $role = Role::get()->toArray();
            return view('admin.user.user-edit')->with(['pageTitle' => 'Manajemen User', 'title' => 'Manajemen User', 'sidebar' => 'manajemen_user', 'role' => $role, 'user'=>$user[0]]);
        }else{
            abort(404);
        }
    }

    public function editUser(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $editHR = HumanResource::where('id', $data['idUser'])->update([
            'first_name' => $data['firstNameUser'],
            'last_name'  => $data['lastNameUser'],
            'gender'     => $data['genderUser'],
            'telp'       => $data['telpUser'],
            'role'       => $data['roleUser']
        ]);
        if ($editHR) {
            $messages = [
                'status' => 'success',
                'message' => 'Edit User Success',
                'url' => '/HR/user',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Edit User Failed',
            ];

            return response()->json($messages);
        }
    }

    public function deleteUser(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if ($data['typeDeleteUser'] == "0") {
            $message = 'Deactive User Success';
            $messageErr = 'Deactive User failed';
        } else {
            $message = 'Active User Success';
            $messageErr = 'Active User failed';
        }
        
        $deleteUser = User::where('id', $data['idDeleteUser'])->update(['status' => $data['typeDeleteUser']]);

        if ($deleteUser) {
            $messages = [
                'status' => 'success',
                'message' => $message,
                'url' => '/HR/user',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => $messageErr,
            ];

            return response()->json($messages);
        }
    }
}
