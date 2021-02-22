<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Vacancy;
use App\AdminSession;

use Hash;
use Request;
use Session;

class VacancyController extends Controller
{
    public function viewVacancy(){
        return view('admin.vacancy.vacancy-list')->with(['pageTitle' => 'Manajemen vacancy', 'title' => 'Manajemen vacancy', 'sidebar' => 'manajemen_vacancy']);
    }

    public function listvacancy(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $vacancy = new Vacancy;
        if ($dataSend['search']){
            $vacancy = $vacancy->where('title','like','%'.$dataSend['search'].'%');
        }
        $countVacancy = $vacancy->count();

        $listVacancy = $vacancy->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listVacancy = $listVacancy->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listVacancy = $listVacancy->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        // DUMMY
        // $listVacancy = [
        //     [
        //         'job_poster' => 'https://images.unsplash.com/photo-1597404294360-feeeda04612e?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80',
        //         'job_title' => 1,
        //         'id' => 1,
        //     ], [
        //         'job_poster' => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80',
        //         'job_title' => 1,
        //         'id' => 2,
        //     ],
        // ];
        
        if ($listVacancy != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countVacancy,
                "recordsFiltered"   => $countVacancy,
                "data"              => $listVacancy
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

    public function viewVacancyAdd(){
        return view('admin.vacancy.vacancy-add')->with(['pageTitle' => 'Manajemen vacancy', 'title' => 'Manajemen vacancy', 'sidebar' => 'manajemen_vacancy']);
    }

    public function addvacancy(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $addVacancy = Vacancy::insert([
            'job_title' => $data['titleVacancy'],
            'placement' => $data['locationVacancy'],
            'salary' => str_replace(",", "", $data['minSalaryVacancy']),
            'major' => json_encode($data['majorVacancy']),
            'work_time' => $data['workingTimeVacancy'],
            'start_date' => date('Y-m-d', strtotime($data['activatedDate'])),
            'job_description' => $data['descriptionVacancy']
        ]);
        
        if ($addVacancy) {
            $messages = [
                'status' => 'success',
                'message' => 'Berhasil Membuat Vacancy',
                'url' => '/vacancy',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Gagal Membuat Vacancy',
            ];

            return response()->json($messages);
        }   
    }

    public function viewvacancyDetail($id){
        $idVacancy = base64_decode(urldecode($id));

        $dataVacancy = Vacancy::where('id', $idVacancy)->get()->toArray();
        
        if ($dataVacancy) {
            return view('news_event.news_event-edit')->with([
                'pageTitle' => 'Manajemen vacancy', 
                'title' => 'Manajemen vacancy', 
                'sidebar' => 'manajemen_vacancy', 
                'data' => $dataVacancy[0]
            ]);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
    }

    public function editvacancy(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        
        $editVacancy = Vacancy::where('id', $data['idNewsEvent'])->update([
            'job_title' => $data['titleVacancy'],
            'placement' => $data['locationVacancy'],
            'salary' => str_replace(",", "", $data['minSalaryVacancy']),
            'major' => json_encode($data['majorVacancy']),
            'work_time' => $data['workingTimeVacancy'],
            'start_date' => date('Y-m-d', strtotime($data['activatedDate'])),
            'job_description' => $data['descriptionVacancy']
        ]);
        
        if ($editVacancy) {
            $messages = [
                'status' => 'success',
                'message' => 'Berhasil Update Vacancy',
                'url' => '/vacancy',
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Gagal Update Vacancy',
            ];

            return response()->json($messages);
        } 
    }

    public function deleteNewsEvent($id){
        $idVacancy = base64_decode(urldecode($id));

        $deleteVacancy = Vacancy::where('id', $idVacancy)->delete();
        
        if ($deleteVacancy) {
            return [
                'status'   => 'success',
                'message'  => 'Berhasil Hapus Vacancy',
                'url'      => '/vacancy',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => 'Gagal Hapus Vacancy',
            ];
        }
    }
}
