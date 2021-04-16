<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\InterviewEvent;
use App\AdminSession;
use Response;
use Hash;
use Request;
use Session;
use DB;

class InterviewController extends Controller
{
    public function viewInterview(){
        return view('admin.interview.interview-list')->with(['pageTitle' => 'Manajemen Interview', 'title' => 'Manajemen Interview', 'sidebar' => 'manajemen_interview']);
    }

    public function listInterview(){
        $interview = InterviewEvent::join('job_application', 'interview_event.id_job_application', 'job_application.id')->get()->toArray();
        dd($interview);
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $interview = new InterviewEvent;
        if ($dataSend['search']){
            $interview = $interview->where('title','like','%'.$dataSend['search'].'%');
        }
        $countInterview = $interview->count();

        $listInterview = $interview->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listInterview = $listInterview->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listInterview = $listInterview->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        
        if ($listInterview != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countInterview,
                "recordsFiltered"   => $countInterview,
                "data"              => $listInterview
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
}
