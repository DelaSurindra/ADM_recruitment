<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //

    public function getSoal(Request $request){
    	$user = $request->user();

    	dd($user);
    }
}
