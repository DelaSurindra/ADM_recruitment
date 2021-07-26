<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\MasterSubtest;
use Response;
use Hash;
use Request;
use Session;
use DB;

class TimeSubTestController extends Controller
{
    public function viewTimeSubTest(){
        return view('admin.time-subtest.time-subtest-list')->with(['pageTitle' => 'Manajemen Time Sub Test', 'title' => 'Manajemen Time Sub Test', 'sidebar' => 'manajemen_time_subtest']);
    }

    public function listTimeSubTest(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $timeSubTest = new MasterSubtest;

        if ($dataSend['search']){
            $timeSubTest = $timeSubTest->where('sub_type','like','%'.$dataSend['search'].'%');
        }
        $countTimeSubTest = $timeSubTest->count();

        $listTimeSubTest = $timeSubTest->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listTimeSubTest = $listTimeSubTest->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listTimeSubTest = $listTimeSubTest->orderBy('sub_type', $dataSend["sort"])->get()->toArray();
        }
        
        for ($i=0; $i < count($listTimeSubTest); $i++) { 
            $listTimeSubTest[$i]['time'] = round($listTimeSubTest[$i]['time'], 1);
        }

        if ($listTimeSubTest != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countTimeSubTest,
                "recordsFiltered"   => $countTimeSubTest,
                "data"              => $listTimeSubTest
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

    public function editTimeSubTest(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $editTime = MasterSubTest::where('id', $data['idTimeSubTest'])->update([
            'time' => round($data['timeSubTest'], 1)
        ]);
        if ($editTime) {
            $messages = [
                'status' => 'success',
                'message' => 'Edit Time Sub Test Success',
                'url' => '/HR/time-sub-test',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Edit Time Sub Test Failed',
            ];

            return response()->json($messages);
        }
    }

}
