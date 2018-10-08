<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('admin.profile.edit', $data);
    }

    public function postProfile(Request $req)
    {
        $data = Auth::user();
        $user = User::find($data->id);

        $rule = [
            'name' => 'required|string|max:255',
        ];        
        
        if (isset($req->password)) {
            $rule['password'] = 'confirmed|min:6';
            $user->password = Hash::make($req->password);
        }

        if ($req->email != $data->email) {
            $rule['email'] = 'required|string|email|max:255|unique:users';
            $user->email = $req->email;
        }

        $validator = Validator::make($req->all(), $rule);

        if ($validator->fails()) {
            return redirect()
            			->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->name = $req->name;
        $user->save();

        return redirect()->route('home')->with('success', 'Success Edit Profile');
    }
}
