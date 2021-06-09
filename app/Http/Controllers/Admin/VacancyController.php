<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Vacancy;
use App\Model\Wilayah;
use App\Model\MasterMajor;
use App\AdminSession;

use Hash;
use Request;
use Session;

class VacancyController extends Controller
{
    public function viewVacancy(){
        $getVacancy = Vacancy::get()->toArray();
        if($getVacancy){
            $now=date("Y-m-d");
            for ($i=0; $i < count($getVacancy); $i++) { 
                $dateActive=date('Y-m-d', strtotime($getVacancy[$i]['active_date']));
                if ($now > $dateActive) {
                    Vacancy::where('job_id', $getVacancy[$i]['job_id'])->update(['status' => 0]);
                }
            }
        }
        return view('admin.vacancy.vacancy-list')->with(['pageTitle' => 'Manajemen vacancy', 'title' => 'Manajemen vacancy', 'sidebar' => 'manajemen_vacancy']);
    }

    public function listVacancy(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $vacancy = new Vacancy;
        if ($dataSend['search']){
            $vacancy = $vacancy->where('job_title','like','%'.$dataSend['search'].'%');
        }
        $countVacancy = $vacancy->count();

        $listVacancy = $vacancy->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            // dd($dataSend['order']);
            if ($dataSend['order'] == "major") {
                $major = "CAST(major AS VARCHAR(100)) ".$dataSend['sort'];
                $listVacancy = $listVacancy->orderByRaw($major)->get()->toArray();
            }else{
                $listVacancy = $listVacancy->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
            }
        } else {
            $listVacancy = $listVacancy->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        
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
        $breadcrumb = [
            "page"      => "Manage Vacancy",
            "detail"    => "Create Job Vacancy",
            "route"     => "/HR/vacancy"
        ];
        $major = MasterMajor::select('major')->get()->toArray();
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        return view('admin.vacancy.vacancy-add')->with(['pageTitle' => 'Manajemen vacancy', 'title' => 'Manajemen vacancy', 'sidebar' => 'manajemen_vacancy', 'wilayah'=>$wilayah, 'breadcrumb' => $breadcrumb, 'major' => $major]);
    }

    public function addVacancy(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        if (is_array($data['majorVacancy'])) {
            $major = $data['majorVacancy'][0];
            for ($i=1; $i < count($data['majorVacancy']); $i++) { 
                $major = $major.','.$data['majorVacancy'][$i];
            }
        } else {
            $major = $data['majorVacancy'];
        }
        
        $addVacancy = Vacancy::insert([
            'job_title' => $data['titleVacancy'],
            'lokasi' => $data['locationVacancy'],
            'major' => $major,
            'degree' => $data['degreeVacancy'],
            'work_time' => $data['workingTimeVacancy'],
            'type' => $data['typeVacancy'],
            'active_date' => date('Y-m-d', strtotime($data['activatedDate'])),
            'job_requirement' => $data['descriptionVacancy']
        ]);
        
        if ($addVacancy) {
            $messages = [
                'status' => 'success',
                'message' => 'Berhasil Membuat Vacancy',
                'url' => '/HR/vacancy',
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

    public function viewVacancyDetail($id){
        $breadcrumb = [
            "page"      => "Manage Vacancy",
            "detail"    => "Edit Job Vacancy",
            "route"     => "/HR/vacancy"
        ];
        $idVacancy = base64_decode(urldecode($id));
        $dataVacancy = Vacancy::where('job_id', $idVacancy)->get()->toArray();
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        $major = MasterMajor::select('major')->get()->toArray();
        
        if ($dataVacancy) {
            $dataVacancy[0]['major'] = explode(',', $dataVacancy[0]['major']);
            return view('admin.vacancy.vacancy-edit')->with([
                'pageTitle' => 'Manajemen vacancy', 
                'title' => 'Manajemen vacancy', 
                'sidebar' => 'manajemen_vacancy', 
                'data' => $dataVacancy[0],
                'wilayah' => $wilayah,
                'breadcrumb' => $breadcrumb,
                'major' => $major
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

    public function editVacancy(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        if (is_array($data['majorVacancy'])) {
            $major = $data['majorVacancy'][0];
            for ($i=1; $i < count($data['majorVacancy']); $i++) { 
                $major = $major.','.$data['majorVacancy'][$i];
            }
        } else {
            $major = $data['majorVacancy'];
        }
        
        $editVacancy = Vacancy::where('job_id', $data['idVacancy'])->update([
            'job_title' => $data['titleVacancy'],
            'lokasi' => $data['locationVacancy'],
            'major' => $major,
            'degree' => $data['degreeVacancy'],
            'work_time' => $data['workingTimeVacancy'],
            'type' => $data['typeVacancy'],
            'active_date' => date('Y-m-d', strtotime($data['activatedDate'])),
            'job_requirement' => $data['descriptionVacancy']
        ]);
        
        if ($editVacancy) {
            $messages = [
                'status' => 'success',
                'message' => 'Berhasil Update Vacancy',
                'url' => '/HR/vacancy',
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

    public function deleteVacancy(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        if ($data['tipeDeleteVacancy'] == '0') {
            $message = 'Berhasil menonaktifkan Vacancy';
        }else{
            $message = 'Berhasil mengaktifkan Vacancy';
        }
        
        $deleteVacancy = Vacancy::where('job_id', $data['idDeleteVacancy'])->update([
            'status' => $data['tipeDeleteVacancy']
        ]);
        
        if ($deleteVacancy) {
            return [
                'status'   => 'success',
                'message'  => $message,
                'url'      => '/HR/vacancy',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mengubah Status Vacancy',
            ];
        }
    }

    public function getMajor(){
        $getMajor = MasterMajor::get()->toArray();
        return response()->json($getMajor);
    }
}
