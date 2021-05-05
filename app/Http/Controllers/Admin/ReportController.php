<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Exports\DownloadResult;
use App\Model\Test;
use App\Model\TestOtp;
use App\Model\AlternatifTest;
use App\Model\TestParticipant;
use App\Model\Job_Application;
use App\Model\MasterSubtest;
use App\Model\MasterFacet;
use App\Model\CognitiveTestResult;
use App\Model\InventoryTestResult;
use App\Model\SetTest;
use App\AdminSession;
use App\Model\MasterUniversitas;
use App\Model\MasterMajor;
use App\Model\Wilayah;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Hash;
use Request;
use Session;
use DB;

class ReportController extends Controller
{
    public function viewReport(){
        $universitas = MasterUniversitas::get()->toArray();
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        return view('admin.report.report-list')->with([
            'pageTitle' => 'Report', 
            'title' => 'Report', 
            'sidebar' => 'manajemen_report',
            'universitas' => $universitas,
            'wilayah' => $wilayah
        ]);
    }

    public function getReport(){
        $dateStart = date('Y-m-d', strtotime(Request::input('dateStartReport')));
        $dateEnd = date('Y-m-d', strtotime(Request::input('dateEndReport')));
        $tipe = Request::input('categoryReport');
        $kota = Request::input('kotaReport');
        $univ = Request::input('universitasReport');

        if ($tipe == "1") {
            
            $dataReport = DB::select('SELECT te.date_test, te.id AS test_id, te.event_id, te.city, AVG(verbal1+verbal2+verbal3+verbal4) AS verbal, AVG(numerical1+numerical2+numerical3+numerical4) AS numerical, AVG(abstrak1+abstrak2+abstrak3+abstrak4) AS abstrak, COUNT(te.id) AS total_peserta, cl.jumlah_lulus FROM test_event te LEFT JOIN test_participant tp ON tp.test_id = te.id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id LEFT JOIN (SELECT te.id, count(cr.id_participant) AS jumlah_lulus FROM test_event te JOIN test_participant tp ON tp.test_id = te.id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr."status" =2 GROUP BY te.id) cl ON cl.id = te.id GROUP BY te.city, te.date_test, te.event_id, cl.jumlah_lulus,te.id');

            for ($i=0; $i < count($dataReport); $i++) { 
                $dataReport[$i]->date_test = date('d/m/Y', strtotime($dataReport[$i]->date_test));
                if ($dataReport[$i]->verbal != null) {
                    $dataReport[$i]->verbal = round($dataReport[$i]->verbal, 2);
                }else{
                    $dataReport[$i]->verbal = 0;
                }
                if ($dataReport[$i]->numerical != null) {
                    $dataReport[$i]->numerical = round($dataReport[$i]->numerical, 2);
                }else{
                    $dataReport[$i]->numerical = 0;
                }
                if ($dataReport[$i]->abstrak != null) {
                    $dataReport[$i]->abstrak = round($dataReport[$i]->abstrak, 2);
                }else{
                    $dataReport[$i]->abstrak = 0;
                }
                if ($dataReport[$i]->total_peserta != null) {
                    $dataReport[$i]->total_peserta = $dataReport[$i]->total_peserta;
                }else{
                    $dataReport[$i]->total_peserta = 0;
                }
                if ($dataReport[$i]->jumlah_lulus != null) {
                    $dataReport[$i]->jumlah_lulus = $dataReport[$i]->jumlah_lulus;
                }else{
                    $dataReport[$i]->jumlah_lulus = 0;
                }
            }

        }elseif ($tipe == "2") {
            $dataReport = DB::select('SELECT p.jurusan, AVG(verbal1+verbal2+verbal3+verbal4) AS verbal, AVG(numerical1+numerical2+numerical3+numerical4) AS numerical, AVG(abstrak1+abstrak2+abstrak3+abstrak4) AS abstrak FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id GROUP BY p.jurusan');

            for ($i=0; $i < count($dataReport); $i++) { 
                if ($dataReport[$i]->verbal != null) {
                    $dataReport[$i]->verbal = round($dataReport[$i]->verbal, 2);
                }else{
                    $dataReport[$i]->verbal = 0;
                }
                if ($dataReport[$i]->numerical != null) {
                    $dataReport[$i]->numerical = round($dataReport[$i]->numerical, 2);
                }else{
                    $dataReport[$i]->numerical = 0;
                }
                if ($dataReport[$i]->abstrak != null) {
                    $dataReport[$i]->abstrak = round($dataReport[$i]->abstrak, 2);
                }else{
                    $dataReport[$i]->abstrak = 0;
                }
            }

        }elseif ($tipe == "3") {
            $dataReport = DB::select('SELECT p.universitas, COUNT(cr.id) as total_peserta, cl.jumlah_lulus, cg.jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id LEFT JOIN (SELECT p.universitas, COUNT(cr.id_participant) AS jumlah_lulus FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 2 GROUP BY p.universitas) cl ON cl.universitas = p.universitas LEFT JOIN (SELECT p.universitas, COUNT(cr.id_participant) AS jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 1 GROUP BY p.universitas) cg ON cg.universitas = p.universitas GROUP BY p.universitas, cl.jumlah_lulus, cg.jumlah_gagal');

            for ($i=0; $i < count($dataReport); $i++) { 

                if ($dataReport[$i]->total_peserta != null) {
                    $dataReport[$i]->total_peserta = (int)$dataReport[$i]->total_peserta;
                }else{
                    $dataReport[$i]->total_peserta = 0;
                }

                if ($dataReport[$i]->jumlah_lulus != null) {
                    $dataReport[$i]->jumlah_lulus = (int)$dataReport[$i]->jumlah_lulus;
                }else{
                    $dataReport[$i]->jumlah_lulus = 0;
                }

                if ($dataReport[$i]->jumlah_gagal != null) {
                    $dataReport[$i]->jumlah_gagal = (int)$dataReport[$i]->jumlah_gagal;
                }else{
                    $dataReport[$i]->jumlah_gagal = 0;
                }

                if ($dataReport[$i]->jumlah_lulus != 0 || $dataReport[$i]->total_peserta) {
                    $dataReport[$i]->persentase_lulus = round(($dataReport[$i]->jumlah_lulus/$dataReport[$i]->total_peserta)*100, 2);
                }else{
                    $dataReport[$i]->persentase_lulus = 0;
                }
            }
        }elseif ($tipe == "4") {
            $dataReport = DB::select('SELECT p.jurusan, COUNT(cr.id) as total_peserta, cl.jumlah_lulus, cg.jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id LEFT JOIN (SELECT p.jurusan, COUNT(cr.id_participant) AS jumlah_lulus FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 2 GROUP BY p.jurusan) cl ON cl.jurusan = p.jurusan LEFT JOIN (SELECT p.jurusan, COUNT(cr.id_participant) AS jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 1 GROUP BY p.jurusan) cg ON cg.jurusan = p.jurusan GROUP BY p.jurusan, cl.jumlah_lulus, cg.jumlah_gagal');

            for ($i=0; $i < count($dataReport); $i++) { 

                if ($dataReport[$i]->total_peserta != null) {
                    $dataReport[$i]->total_peserta = (int)$dataReport[$i]->total_peserta;
                }else{
                    $dataReport[$i]->total_peserta = 0;
                }

                if ($dataReport[$i]->jumlah_lulus != null) {
                    $dataReport[$i]->jumlah_lulus = (int)$dataReport[$i]->jumlah_lulus;
                }else{
                    $dataReport[$i]->jumlah_lulus = 0;
                }

                if ($dataReport[$i]->jumlah_gagal != null) {
                    $dataReport[$i]->jumlah_gagal = (int)$dataReport[$i]->jumlah_gagal;
                }else{
                    $dataReport[$i]->jumlah_gagal = 0;
                }

                if ($dataReport[$i]->jumlah_lulus != 0 || $dataReport[$i]->total_peserta) {
                    $dataReport[$i]->persentase_lulus = round(($dataReport[$i]->jumlah_lulus/$dataReport[$i]->total_peserta)*100, 2);
                }else{
                    $dataReport[$i]->persentase_lulus = 0;
                }
            }
        }
        // dd($dataReport);
        return response()->json($dataReport);
    }
}
