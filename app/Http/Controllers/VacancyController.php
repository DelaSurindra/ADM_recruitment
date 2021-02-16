<?php

namespace App\Http\Controllers;

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
    return view('vacancy.vacancy-list')->with(['pageTitle' => 'Manajemen vacancy', 'title' => 'Manajemen vacancy', 'sidebar' => 'manajemen_vacancy']);
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
}
