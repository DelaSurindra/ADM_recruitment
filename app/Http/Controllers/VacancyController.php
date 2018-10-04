<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\Vacancy;
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
            "vacancy" => Vacancy::paginate(20)
        ];
        return view('admin.vacancy.home', $data);
    }

    public function getDetail($id)
    {
        $data = [
            "vacancy" => Vacancy::find($id)
        ];

        return view('admin.vacancy.detail', $data);
    }

    public function getInput()
    {
        return view('admin.vacancy.add');
    }

    public function getEdit($id)
    {
        $isi = Vacancy::find($id);
        if (!$isi) abort(404);

        $data = [
            "vacancy" => $isi
        ];

        return view('admin.vacancy.edit', $data);
    }

    public function getDelete($id)
    {
        $isi = Vacancy::find($id);
        if (!$isi) abort(404);

        Storage::disk('poster')->delete($isi->job_poster);
        $isi->delete();

        return redirect('vacancy')->with('success', 'Success Deleted Job');
    }

    public function postInput(Request $req)
    {
        
        $validator = Validator::make($req->all(), [
    		'job_id' => 'required',
			'job_title' => 'required',
			'available' => 'required',
			'poster' => 'required|max:3000|mimes:png,jpeg'
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
			$destination = 'recruitment/';

			$posterPath = $req->poster->storeAs($destination, $filename, 'poster');
        }

        $vacancy = new Vacancy;
        $vacancy->job_id = $req->job_id;
        $vacancy->job_title = $req->job_title;
        $vacancy->job_description = $req->job_des;
        $vacancy->job_poster = $posterPath;
        $vacancy->is_available = $req->available;
        $vacancy->end_date = $req->end;

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
    		'job_id' => 'required',
			'job_title' => 'required',
			'available' => 'required',
			'poster' => 'max:3000|mimes:png,jpeg'
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
			$destination = 'recruitment/';

			$posterPath = $req->poster->storeAs($destination, $filename, 'poster');
        }

        if (isset($posterPath)) {
            $vacancy->job_poster = $posterPath;
        }

        $vacancy->job_title = $req->job_title;
        $vacancy->job_description = $req->job_des;
        $vacancy->is_available = $req->available;
        $vacancy->end_date = $req->end;

        try {
	        $vacancy->save();

	        return redirect()->route('vacancy')
	        				->with('success','Job Vacancy Success Edited');
        } catch (Exception $e) {
        	return redirect()->back()
	        				->with('error','Gagal Menyimpan Job Vacancy. Err: '.$e->getMessage());
        }
    }
}
