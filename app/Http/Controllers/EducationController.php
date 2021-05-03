<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MasterUniversitas;
use App\Model\MasterMajor;

class EducationController extends Controller
{
    public function getAllData()
    {
        $universitas = MasterUniversitas::get()->toArray();
        $major = MasterMajor::get()->toArray();
        $data = [
            'universitas'   => MasterUniversitas::get()->toArray(),
            'major'         => MasterMajor::get()->toArray()
        ];
        
        return response()->json($data);
    }

}
