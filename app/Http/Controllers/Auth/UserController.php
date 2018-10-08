<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getIndex()
    {
        $data = [
            "user" => User::paginate(10),
            "id" => Auth::user()->id
        ];
        return view('admin.user.home', $data);
    }

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function getBlock($id)
    {
        $isi = User::find($id);
        if (!$isi) abort(404);

        $isi->status = false;
        $isi->save();

        return redirect()->back()->with('success', 'Success Blocked User');
    }

    public function getActive($id)
    {
        $isi = User::find($id);
        if (!$isi) abort(404);

        $isi->status = true;
        $isi->save();

        return redirect()->back()->with('success', 'Success Activate User');
    }

    public function postAdd(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        if ($validator->fails()) {
            return redirect()
            			->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $password = str_random(8);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('listUser')->with('success', 'Success Added new admin '.$req->email.' with password '.$password);
    }
}
