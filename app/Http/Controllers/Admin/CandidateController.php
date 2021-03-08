<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Vacancy;
use App\Model\Wilayah;
use App\Model\Candidate;
use App\Model\Job_application;
use App\Model\Education;

use Hash;
use Request;
use Session;

class CandidateController extends Controller
{
    public function viewCandidate(){
        return view('admin.candidate.candidate-list')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate']);
    }

    public function listCandidate(){
        $candidate = Job_application::select('kandidat.*', 'job_application.id as jobapp_id', 'job_application.status as jobapp_status', 'job_application.created_at as jobapp_created_at', 'vacancies.job_title', 'vacancies.lokasi', 'pendididkan.universitas','pendididkan.jurusan')
                    ->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')
                    ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                    ->join('pendididkan', 'kandidat.id', 'pendididkan.kandidat_id')
                    ->groupBy('kandidat.id','kandidat.first_name','kandidat.last_name','kandidat.id','kandidat.tanggal_lahir','kandidat.gender','kandidat.telp','kandidat.kota','kandidat.linkedin','kandidat.cover_letter','kandidat.id','kandidat.resume','kandidat.id','kandidat.protofolio','kandidat.skill','kandidat.user_id','kandidat.created_at','kandidat.updated_at','kandidat.foto_profil','kandidat.status', 'job_application.id', 'job_application.id', 'job_application.status', 'job_application.created_at', 'job_application.updated_at')
                    ->get()->toArray();
        $education = Education::get()->toArray();
        dd($candidate, $education);
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $candidate = new Job_application;
        $candidate = $candidate->select('kandidat.*', 'job_application.id as jobapp_id', 'job_application.status as jobapp_status', 'job_application.created_at as jobapp_created_at', 'vacancies.job_title', 'vacancies.lokasi')
                    ->join('kandidat', 'job_application.kandidat_id', 'kandidat.id')
                    ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id');

        if ($dataSend['search']){
            $candidate = $candidate->where('title','like','%'.$dataSend['search'].'%');
        }
        $countCandidate = $candidate->count();

        $listCandidate = $candidate->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listCandidate = $listCandidate->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listCandidate = $listCandidate->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        $kandidat_id = [];
        $pendidikan_kandidat_id = [];
        $education = Education::get()->toArray();
        
        for ($i=0; $i < count($education); $i++) { 
            array_push($pendidikan_kandidat_id, $education[$i]['kandidat_id']);
        }
        for ($k=0; $k < count($listCandidate); $k++) { 
            $listCandidate[$k]['pendidikan'] = [];
            $listCandidate[$k]['pendidikan_user'] = ["gelar" => ""];
            array_push($kandidat_id, $listCandidate[$k]['id']);
        }
        $dummy = [];
        for ($i=0; $i < count($pendidikan_kandidat_id); $i++) { 
            $search = array_search($pendidikan_kandidat_id[$i], $kandidat_id);
            array_push($dummy, $search.','.$i);
        }
        // dd($dummy, $kandidat_id, $pendidikan_kandidat_id, $listCandidate);
        foreach ($dummy as $key => $value) {
            // dd($education[$key]);
            $exp = explode(",", $value);
            // dd($listCandidate[$exp[0]], $education[$exp[1]]);
            if ($exp[0] != "") {
                array_push($listCandidate[$exp[0]]['pendidikan'], $education[$exp[1]]);
                if ($listCandidate[$exp[0]]['pendidikan'] != []) {
                    $listCandidate[$exp[0]]['pendidikan_user'] = $listCandidate[$exp[0]]['pendidikan'][0];
                }
            }

        }

        dd($listCandidate);
        if ($listCandidate != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countCandidate,
                "recordsFiltered"   => $countCandidate,
                "data"              => $listCandidate
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

    public function viewCandidateEdit($id){
        $breadcrumb = [
            "page"      => "Manage Candidate",
            "detail"    => "Edit Candidate",
            "route"     => "/HR/candidate"
        ];
        return view('admin.candidate.candidate-edit')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate', 'breadcrumb' => $breadcrumb]);
    }

    public function viewCandidateDetail($id){
        $breadcrumb = [
            "page"      => "Manage Candidate",
            "detail"    => "Edit Candidate",
            "route"     => "/HR/candidate"
        ];
        return view('admin.candidate.candidate-detail')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate', 'breadcrumb' => $breadcrumb]);
    }
}
