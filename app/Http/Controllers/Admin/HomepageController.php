<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\ConfigHomepage;
use App\AdminSession;
use Response;
use Hash;
use Request;
use Session;
use DB;

class HomepageController extends Controller
{
    public function viewHomepage(){
        $color = ConfigHomepage::select('value')->where('config', 1)->get()->toArray();
        $banner = ConfigHomepage::where('config', 2)->get()->toArray();
        return view('admin.homepage.homepage-list')->with(['pageTitle' => 'Manajemen Homepage', 'title' => 'Manajemen Homepage', 'sidebar' => 'manajemen_homepage', 'color'=>$color[0]['value'], 'banner'=>$banner]);
    }

    public function editColor(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $editColor = ConfigHomepage::where('config', 1)->update(['value'=>$data['color']]);
        if ($editColor) {
            $messages = [
                'status' => 'success',
                'message' => 'Edit Color Scheme Success',
                'url' => '/HR/homepage',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Edit Color Scheme Failed',
            ];

            return response()->json($messages);
        }
        
    }

    public function addBanner(){
        if (Request::has('fileBanner')) {
            $image = Request::file('fileBanner');
            $ext = $image->getClientOriginalExtension();
            $path = $image->storeAs('banner', 'banner'.'_'.time().'.'.$ext, 'public');
            $addBanner = ConfigHomepage::insert([
                'config' => 2,
                'value'  => $path
            ]);
            if ($addBanner) {
                $messages = [
                    'status' => 'success',
                    'message' => 'Add Banner Success',
                    'url' => 'close',
                    'id' => '',
                    'value' => ''
                ];
    
                return redirect('/HR/homepage')->with('notif', $messages);
            } else {
                $messages = [
                    'status' => 'error',
                    'message' => 'Add Banner Failed',
                    'url' => 'close',
                    'id' => '',
                    'value' => ''
                ];
    
                return back()->with('notif', $messages);
            }
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Please Choose Image',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return back()->with('notif', $messages);
        }
    }

    public function editBanner(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        if (Request::has('fileBannerEdit')) {
            $image = Request::file('fileBannerEdit');
            $ext = $image->getClientOriginalExtension();
            $path = $image->storeAs('banner', 'banner'.'_'.time().'.'.$ext, 'public');
        }else{
            $path = $data['oldBanner'];
        }

        $editBanner = ConfigHomepage::where('id', $data['idBanner'])->update([
            'value'  => $path
        ]);

        if ($editBanner) {
            $messages = [
                'status' => 'success',
                'message' => 'Edit Banner Success',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return redirect('/HR/homepage')->with('notif', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Edit Banner Failed',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return back()->with('notif', $messages);
        }
    }

    public function deleteBanner(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $deleteBanner = ConfigHomepage::where('id', $data['idDeleteBanner'])->delete();
        if ($deleteBanner) {
            return [
                'status'   => 'success',
                'message'  => 'Delete Banner Success',
                'url'      => '/HR/homepage',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => 'Delete Banner Failed',
            ];
        }
    }
}
