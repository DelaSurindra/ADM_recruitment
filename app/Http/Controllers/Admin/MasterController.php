<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\MasterUniversitas;
use App\Model\MasterMajor;

use Response;
use Hash;
use Request;
use Session;
use DB;

class MasterController extends Controller
{
    public function viewMaster(){
        return view('admin.master.master-list')->with(['pageTitle' => 'Manajemen Data Master', 'title' => 'Manajemen Data Master', 'sidebar' => 'manajemen_master']);
    }

    public function listUniversitas(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $universitas = new MasterUniversitas;
        if ($dataSend['search']){
            $universitas = $universitas->where('universitas','like','%'.$dataSend['search'].'%');
        }
        $countUniversitas = $universitas->count();

        $listUniversitas = $universitas->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listUniversitas = $listUniversitas->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listUniversitas = $listUniversitas->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        
        if ($listUniversitas != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countUniversitas,
                "recordsFiltered"   => $countUniversitas,
                "data"              => $listUniversitas
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

    public function listMajor(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $major = new MasterMajor;
        if ($dataSend['search']){
            $major = $major->where('major','like','%'.$dataSend['search'].'%');
        }
        $countMajor = $major->count();

        $listMajor = $major->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listMajor = $listMajor->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listMajor = $listMajor->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        
        if ($listMajor != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countMajor,
                "recordsFiltered"   => $countMajor,
                "data"              => $listMajor
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

    public function addMaster(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if ($data['typeMaster'] == "1") {
            $univ = strtolower($data['nameUniv']);
            $universitas = MasterUniversitas::get()->toArray();
            $dataUniv = [];
            if ($universitas) {
                for ($i=0; $i < count($universitas); $i++) { 
                    array_push($dataUniv, strtolower($universitas[$i]['universitas']));
                }
                if (in_array($univ, $dataUniv)) {
                    $messages = [
                        'status' => 'error',
                        'message' => "Data '".$data['nameUniv']."' Exist",
                    ];
        
                    return response()->json($messages);
                }
            }
            $addMaster = MasterUniversitas::insert([
                "universitas" => $data['nameUniv']
            ]);
        }else{
            $major = strtolower($data['nameMajor']);
            $getMajor = MasterMajor::get()->toArray();
            $dataMajor = [];
            if ($getMajor) {
                for ($i=0; $i < count($getMajor); $i++) { 
                    array_push($dataMajor, strtolower($getMajor[$i]['major']));
                }
                if (in_array($major, $dataMajor)) {
                    $messages = [
                        'status' => 'error',
                        'message' => "Data '".$data['nameMajor']."' Exist",
                    ];
        
                    return response()->json($messages);
                }
            }
            $addMaster = MasterMajor::insert([
                "major" => $data['nameMajor']
            ]);
        }

        if ($addMaster) {
            $messages = [
                'status' => 'success',
                'message' => 'Create Data Success',
                'url' => '/HR/master',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Create Data Failed',
            ];

            return response()->json($messages);
        }
    }

    public function editMaster(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if ($data['typeEdit'] == "1") {
            $univ = strtolower($data['nameEdit']);
            $universitas = MasterUniversitas::get()->toArray();
            $dataUniv = [];
            if ($universitas) {
                for ($i=0; $i < count($universitas); $i++) { 
                    array_push($dataUniv, strtolower($universitas[$i]['universitas']));
                }
                if (in_array($univ, $dataUniv)) {
                    $messages = [
                        'status' => 'error',
                        'message' => "Data '".$data['nameEdit']."' Exist",
                    ];
        
                    return response()->json($messages);
                }
            }
            $editMaster = MasterUniversitas::where('id', $data['idEdit'])->update([
                "universitas" => $data['nameEdit']
            ]);
        }else{
            $major = strtolower($data['nameEdit']);
            $getMajor = MasterMajor::get()->toArray();
            $dataMajor = [];
            if ($getMajor) {
                for ($i=0; $i < count($getMajor); $i++) { 
                    array_push($dataMajor, strtolower($getMajor[$i]['major']));
                }
                if (in_array($major, $dataMajor)) {
                    $messages = [
                        'status' => 'error',
                        'message' => "Data '".$data['nameEdit']."' Exist",
                    ];
        
                    return response()->json($messages);
                }
            }
            $editMaster = MasterMajor::where('id', $data['idEdit'])->update([
                "major" => $data['nameEdit']
            ]);
        }

        if ($editMaster) {
            $messages = [
                'status' => 'success',
                'message' => 'Edit Data Success',
                'url' => '/HR/master',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Edit Data Failed',
            ];

            return response()->json($messages);
        }
    }

    public function deleteMaster(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if ($data['typeDelete'] == "1") {
            $deleteMaster = MasterUniversitas::where('id', $data['idDelete'])->delete();
        }else{
            $deleteMaster = MasterMajor::where('id', $data['idDelete'])->delete();
        }

        if ($deleteMaster) {
            $messages = [
                'status' => 'success',
                'message' => 'Delete Data Success',
                'url' => '/HR/master',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Delete Data Failed',
            ];

            return response()->json($messages);
        }
    }
}
