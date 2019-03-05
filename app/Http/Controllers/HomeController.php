<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Pelamar;
use App\Model\Vacancy;
use App\Model\Setting;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlahPelamar = Pelamar::count();
        $jumlahPelamarActiv = Pelamar::where('status','=','APLY')->count();
        $jumlahPelamarIntv = Pelamar::where('status','=','INTV')->count();
        $jumlahPelamarAcpt = Pelamar::where('status','=','ACPT')->count();
        $jumlahPelamarRjct = Pelamar::where('status','=','RJCT')->count();
        $lamaranTerakhir = Pelamar::max('created_at');
        $setting = Setting:: select()->first();
        $jumlahAvail = Vacancy::where('is_available','=','1')->count();
        $jumlahClose = Vacancy::where('is_available','=','0')->count();
        $dump= $setting->value;
        $data= array(
            "PelamarActiv" => $jumlahPelamarActiv,
            "PelamarIntv" => $jumlahPelamarIntv,
            "PelamarAcpt" => $jumlahPelamarAcpt,
            "PelamarRjct" => $jumlahPelamarRjct
        );
        // dd($data);
        return view('admin.home')->with(['jumlahLamaran'=>$jumlahPelamar, 'last' => $lamaranTerakhir,'jumlahAvail'=>$jumlahAvail,'jumlahClose'=>$jumlahClose,'setting'=>$dump, 'data'=>$data ]);
    } 
}
