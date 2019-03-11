<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Model\Vacancy;
use App\Model\Pelamar;
use App\Model\Setting;
use Validator;

class VacancyController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getIndex()
  {
    $data = [
      "vacancy" => Vacancy::leftJoin('pelamar', 'pelamar.job_id', '=', 'vacancies.job_id')
      ->select('vacancies.job_id', 'vacancies.job_title', 'vacancies.is_available', 'vacancies.end_date', 'vacancies.job_target', DB::raw('count(pelamar.job_id) as total'))
      ->groupBy('vacancies.job_id', 'vacancies.job_title', 'vacancies.is_available', 'vacancies.end_date', 'vacancies.job_target')
      ->paginate(20)
    ];
    return view('admin.vacancy.home', $data);
  }

  public function getDetail($id)
  {
    $id = str_replace('_','/', $id);
    $data = [
      "vacancy" => Vacancy::find($id)
    ];

    return view('admin.vacancy.detail', $data);
  }

  public function getInput()
  {
    return view('admin.vacancy.add');
  }

  public function updateRole($value)
  {
    if ($value==1) {
          // dd('sama');
      DB::table('setting')
      ->where('id', 1)
      ->update(['value' => 0]);
    }else{
          // dd('beda');
      DB::table('setting')
      ->where('id', 1)
      ->update(['value' => 1]);
    }
    return redirect()->route('home')->with('success', 'Success update role CV');
  }

  public function getEdit($id)
  {
    $id = str_replace('_','/', $id);
    $isi = Vacancy::find($id);
    if (!$isi) abort(404);

    $data = [
      "vacancy" => $isi
    ];
        // dd($data);

    return view('admin.vacancy.edit', $data);
  }

  public function getDelete($id)
  { 
    $id = str_replace('_','/', $id);
    $isi = Vacancy::find($id);
    if (!$isi) abort(404);
    Storage::disk('poster')->delete('/'.$isi->job_poster);
    $isi->delete();
    return redirect('vacancy')->with('success', 'Success Deleted Job');
  }

  public function postInput(Request $req)
  {

    $validator = Validator::make($req->all(), [
      'job_id' => 'required|unique:vacancies,job_id|regex:/^\S*$/u',
      'job_title' => 'required',
      'target' => 'numeric',
      'poster' => 'required|max:3000|mimes:png,jpeg',
    ]);

    if ($validator->fails()) {
      return redirect()
      ->back()
      ->withErrors($validator)
      ->withInput();
    }

   //      if($req->hasFile('posterMobile') && $req->hasFile('posterDesktop')){

   //      	if(!($req->file('posterMobile')->isValid() && $req->file('posterDesktop')->isValid())){
   //      		return redirect()->back()
   //      					->withInput()
   //      					->with('error_msg','Please upload valid file');
			// }

			// $filename = $req->job_id.'.png';
			// $destination = 'recruitment/posisi/';

   //          $posterPath = $req->posterMobile->storeAs('mobile/'.$destination, $filename, 'poster');
   //          $posterPath = $req->posterDesktop->storeAs('desktop/'.$destination, $filename, 'poster');

   //          $posterPath = $destination.$filename;
   //      }
    $filename = $req->job_id.'.png';
    $destination = 'recruitment/posisi';
    $posterPath = $req->poster->storeAs('/'.$destination, $filename, 'poster');

    $vacancy = new Vacancy;
    $vacancy->job_id = $req->job_id;
    $vacancy->job_title = $req->job_title;
    $vacancy->job_description = $req->job_des;
    $vacancy->job_Req = $req->job_req;
    $vacancy->job_poster = $posterPath;
    $vacancy->is_available = $req->available;
    $vacancy->job_target = $req->target;
    $vacancy->end_date = $req->end;
        // dd($vacancy);
    try {
     $vacancy->save();

     return redirect()->route('vacancy')
     ->with('success','Job Vacancy Success Added');
   } catch (Exception $e) {
     return redirect()->back()
     ->with('error','Gagal Menyimpan Job Vacancy. Err: '.$e->getMessage());
   }
 }

 public function postEdit(Request $req, $id)
 {

  $vacancy = Vacancy::find($id);
  if (!$vacancy) abort(404);

  $validator = Validator::make($req->all(), [
    'job_id' => 'required|regex:/^\S*$/u',
    'job_title' => 'required',
    'target' => 'numeric',
    'posterDesktop' => 'max:3000|mimes:png,jpeg',
    'posterMobile' => 'max:3000|mimes:png,jpeg'
  ]);
  if ($validator->fails()) {
    return redirect()
    ->back()
    ->withErrors($validator)
    ->withInput();
  }

  if($req->hasFile('poster')){

   if(!$req->file('poster')->isValid()){
    return redirect()->back()
    ->withInput()
    ->with('error_msg','Please upload valid file');
  }
  $filename = $req->job_id.'.png';
  $destination = 'recruitment/posisi';
  $posterPath = $req->poster->storeAs('/'.$destination, $filename, 'poster');

  if ($id != $req->job_id) {
    Storage::disk('poster')->delete('/'.$vacancy->job_poster);
  }

}

if (isset($posterPath)) {
  $vacancy->job_poster = $posterPath;
}

$this->changeJobId($vacancy->job_id, $req->job_id);

$vacancy->job_id = $req->job_id;
$vacancy->job_title = $req->job_title;
$vacancy->job_description = $req->job_des;
$vacancy->job_Req = $req->job_req;
$vacancy->is_available = $req->available;
$vacancy->job_target = $req->target;
$vacancy->end_date = $req->end;
        // dd($vacancy);
try {
 $vacancy->save();

 return redirect()->route('vacancy')
 ->with('success','Job Vacancy Success Edited');
} catch (Exception $e) {
 return redirect()->back()
 ->with('error','Gagal Menyimpan Job Vacancy. Err: '.$e->getMessage());
}
}

function changeJobId($id, $new_job_id)
{
  $pelamar = Pelamar::where('job_id', $id)->get();

  foreach ($pelamar as $key) {
    $key->job_id = $new_job_id;
    $key->save();
  }
}
}
