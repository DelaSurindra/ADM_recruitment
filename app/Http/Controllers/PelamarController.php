<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pelamar;
use App\Model\Vacancy;

class PelamarController extends Controller
{


    public function getIndex(Request $req)
    {
        
        if ($req->q != null || $req->job != null) {
            $pelamar = Pelamar::where('job_id', 'like', '%'.$req->job.'%')
                                ->where(function($query) use($req){
                                    $query->where('firstname', 'like', '%'.$req->q.'%')
                                        ->orWhere('lastname', 'like', '%'.$req->q.'%');
                                })
                                ->paginate(20);
            $option = Vacancy::find($req->job);
        } else {
            $pelamar = Pelamar::paginate(20);
            $option = "";
        }

        $data = [
            "pelamar" => $pelamar,
            "vacancy" => Vacancy::all(),
            "option" => $option
        ];
        return view('admin.pelamar', $data);
    }

    public function getDetailPelamar($id)
    {
        $isi = Pelamar::find($id);
        if (empty($isi)) abort(404);

        $job = Vacancy::find($isi->job_id);

        if (empty($job)) abort(404);
       
        $data = [
            "pelamar" => $isi,
            "job" => $job->job_title
        ];

        return view('admin.detail', $data);
    }

    public function getDownload($id)
    {
        $isi = Pelamar::find($id);
        if (!$isi) abort(404);
        //PDF file is stored under project/public/download/info.pdf
        $file= storage_path('app/'.$isi->file_cv);;

        $headers = array(
                'Content-Type: application/pdf',
                );

        return response()->download($file);
    }

    public function changeStatus(Request $req, $id)
    {
        $isi = Pelamar::find($id);
        if (!$isi) abort(404);

        $isi->status = $req->status;
        $isi->save();

        return redirect()->back()->with('success','Success to Change the Status');
    }
}
