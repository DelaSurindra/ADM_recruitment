<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Pelamar;
use App\Model\Vacancy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
