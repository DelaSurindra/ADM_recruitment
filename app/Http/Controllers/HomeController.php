<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Pelamar;
use App\Model\Vacancy;
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
        $lamaranTerakhir = Pelamar::max('created_at');

        $jumlahLowongan = Vacancy::count();
        return view('admin.home')->with(['jumlahLamaran'=>$jumlahPelamar, 'last' => $lamaranTerakhir,'jumlahLowongan'=>$jumlahLowongan]);
    }
}
