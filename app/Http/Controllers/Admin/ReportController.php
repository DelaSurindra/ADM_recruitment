<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Exports\DownloadReport;
use App\Model\MasterUniversitas;
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
        $dateStart = "'".date('Y-m-d', strtotime(Request::input('dateStartReport')))."'";
        $dateEnd = "'".date('Y-m-d', strtotime(Request::input('dateEndReport')))."'";
        $tipe = Request::input('categoryReport');
        $kota = "'".Request::input('kotaReport')."'";
        $univ = "'".Request::input('universitasReport')."'";

        if ($tipe == "1") {
            
            $dataReport = DB::select('SELECT te.date_test, te.id AS test_id, te.event_id, te.city, AVG((verbal1+verbal2+verbal3+verbal4)/4) AS verbal, AVG((numerical1+numerical2+numerical3+numerical4)/4) AS numerical, AVG((abstrak1+abstrak2+abstrak3+abstrak4)/4) AS abstrak, COUNT(te.id) AS total_peserta, cl.jumlah_lulus FROM test_event te LEFT JOIN test_participant tp ON tp.test_id = te.id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id LEFT JOIN (SELECT te.id, count(cr.id_participant) AS jumlah_lulus FROM test_event te JOIN test_participant tp ON tp.test_id = te.id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr."status" =2 GROUP BY te.id) cl ON cl.id = te.id WHERE te.created_at BETWEEN '.$dateStart.' AND '.$dateEnd.' GROUP BY te.city, te.date_test, te.event_id, cl.jumlah_lulus,te.id');

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
            $dataReport = DB::select('SELECT p.jurusan, AVG((verbal1+verbal2+verbal3+verbal4)/4) AS verbal, AVG((numerical1+numerical2+numerical3+numerical4)/4) AS numerical, AVG((abstrak1+abstrak2+abstrak3+abstrak4)/4) AS abstrak FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE p.created_at BETWEEN '.$dateStart.' AND '.$dateEnd.' GROUP BY p.jurusan');

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
            $dataReport = DB::select('SELECT p.universitas, COUNT(cr.id) as total_peserta, cl.jumlah_lulus, cg.jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id LEFT JOIN (SELECT p.universitas, COUNT(cr.id_participant) AS jumlah_lulus FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 2 GROUP BY p.universitas) cl ON cl.universitas = p.universitas LEFT JOIN (SELECT p.universitas, COUNT(cr.id_participant) AS jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 1 GROUP BY p.universitas) cg ON cg.universitas = p.universitas WHERE p.created_at BETWEEN '.$dateStart.' AND '.$dateEnd.' GROUP BY p.universitas, cl.jumlah_lulus, cg.jumlah_gagal');

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
            $dataReport = DB::select('SELECT p.jurusan, COUNT(cr.id) as total_peserta, cl.jumlah_lulus, cg.jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id LEFT JOIN (SELECT p.jurusan, COUNT(cr.id_participant) AS jumlah_lulus FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 2 GROUP BY p.jurusan) cl ON cl.jurusan = p.jurusan LEFT JOIN (SELECT p.jurusan, COUNT(cr.id_participant) AS jumlah_gagal FROM pendidikan p LEFT JOIN test_participant tp ON p.kandidat_id = tp.kandidat_id LEFT JOIN cognitive_test_result cr ON cr.id_participant = tp.id WHERE cr.status = 1 GROUP BY p.jurusan) cg ON cg.jurusan = p.jurusan WHERE p.created_at BETWEEN '.$dateStart.' AND '.$dateEnd.' GROUP BY p.jurusan, cl.jumlah_lulus, cg.jumlah_gagal');

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
        }elseif ($tipe == "5") {
            $dataReport = DB::select('SELECT MONTH(created_at) AS bulan, YEAR(created_at) as tahun, AVG((verbal1+verbal2+verbal3+verbal4)/4) AS verbal, AVG((numerical1+numerical2+numerical3+numerical4)/4) AS numerical, AVG((abstrak1+abstrak2+abstrak3+abstrak4)/4) AS abstrak FROM cognitive_test_result GROUP BY MONTH(created_at), YEAR(created_at)');

            for ($i=0; $i < count($dataReport); $i++) {
                
                if ($dataReport[$i]->bulan == "1") {
                    $bulan = "Januari";
                }elseif ($dataReport[$i]->bulan == "2") {
                    $bulan = "Februari";
                }elseif ($dataReport[$i]->bulan == "3") {
                    $bulan = "Maret";
                }elseif ($dataReport[$i]->bulan == "4") {
                    $bulan = "April";
                }elseif ($dataReport[$i]->bulan == "5") {
                    $bulan = "Mei";
                }elseif ($dataReport[$i]->bulan == "6") {
                    $bulan = "Juni";
                }elseif ($dataReport[$i]->bulan == "7") {
                    $bulan = "Juli";
                }elseif ($dataReport[$i]->bulan == "8") {
                    $bulan = "Agustus";
                }elseif ($dataReport[$i]->bulan == "9") {
                    $bulan = "September";
                }elseif ($dataReport[$i]->bulan == "10") {
                    $bulan = "Oktober";
                }elseif ($dataReport[$i]->bulan == "11") {
                    $bulan = "November";
                }elseif ($dataReport[$i]->bulan == "12") {
                    $bulan = "Desember";
                }

                $dataReport[$i]->periode = $bulan.' '.$dataReport[$i]->tahun;

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
        }elseif ($tipe == "6") {
            $dataReport = DB::select('SELECT v.job_id, v.job_title, AVG(dt.written_test) AS average_wirrten_test, AVG(dt.hr_review) AS average_hr_review, AVG(dt.final_review) AS average_final_review, AVG(dt.user_review) AS average_user_review, AVG(dt.mcu) AS average_mcu, AVG(dt.hired) AS average_hired FROM vacancies v left JOIN job_application ja ON v.job_id = ja.vacancy_id left JOIN (SELECT ha.job_application_id, DATEDIFF(DAY,max(swt.start_wt),max(ewt.end_wt)) AS written_test, DATEDIFF(DAY,max(shr.created_at),max(ehr.created_at)) AS hr_review, DATEDIFF(DAY,MAX(sfn.created_at), MAX(efn.created_at)) AS final_review, DATEDIFF(DAY,MAX(susr.created_at), MAX(eusr.created_at)) AS user_review, DATEDIFF(DAY, MAX(smcu.created_at), MAX(emcu.created_at)) AS mcu, DATEDIFF(DAY, MAX(shired.created_at), MAX(ehired.created_at)) AS hired FROM status_history_application ha LEFT JOIN (SELECT id, created_at AS start_wt FROM status_history_application WHERE status = 2) swt ON swt.id = ha.id LEFT JOIN (SELECT id, created_at AS end_wt FROM status_history_application WHERE status = 3) ewt ON ewt.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 5) shr ON shr.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 13) ehr ON ehr.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 8) sfn ON sfn.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 19) efn ON efn.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 9) smcu ON smcu.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 21) emcu ON emcu.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 0) shired ON shired.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 21) ehired ON ehired.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 6 OR status = 7) susr ON susr.id = ha.id LEFT JOIN (SELECT id, created_at FROM status_history_application WHERE status = 15 OR status = 17) eusr ON eusr.id = ha.id GROUP BY ha.job_application_id) dt ON dt.job_application_id = ja.id WHERE v.created_at BETWEEN '.$dateStart.' AND '.$dateEnd.' GROUP BY v.job_id, v.job_title');

            for ($i=0; $i < count($dataReport); $i++) { 

                if ($dataReport[$i]->average_wirrten_test != null) {
                    $dataReport[$i]->average_wirrten_test = round($dataReport[$i]->average_wirrten_test, 2);
                }else{
                    $dataReport[$i]->average_wirrten_test = 0;
                }

                if ($dataReport[$i]->average_hr_review != null) {
                    $dataReport[$i]->average_hr_review = round($dataReport[$i]->average_hr_review, 2);
                }else{
                    $dataReport[$i]->average_hr_review = 0;
                }

                if ($dataReport[$i]->average_final_review != null) {
                    $dataReport[$i]->average_final_review = round($dataReport[$i]->average_final_review, 2);
                }else{
                    $dataReport[$i]->average_final_review = 0;
                }

                if ($dataReport[$i]->average_user_review != null) {
                    $dataReport[$i]->average_user_review = round($dataReport[$i]->average_user_review, 2);
                }else{
                    $dataReport[$i]->average_user_review = 0;
                }

                if ($dataReport[$i]->average_mcu != null) {
                    $dataReport[$i]->average_mcu = round($dataReport[$i]->average_mcu, 2);
                }else{
                    $dataReport[$i]->average_mcu = 0;
                }

                if ($dataReport[$i]->average_hired != null) {
                    $dataReport[$i]->average_hired = round($dataReport[$i]->average_hired, 2);
                }else{
                    $dataReport[$i]->average_hired = 0;
                }

                $dataReport[$i]->total_time = (float)$dataReport[$i]->average_wirrten_test+(float)$dataReport[$i]->average_hr_review+(float)$dataReport[$i]->average_final_review+(float)$dataReport[$i]->average_user_review+(float)$dataReport[$i]->average_mcu+$dataReport[$i]->average_hired;
            }

        }elseif ($tipe == "7") {
            $dataReport = DB::select('SELECT MONTH(j.created_at) AS bulan, YEAR(j.created_at) as tahun, di.d3, sa.s1, ma.s2 FROM job_application j JOIN pendidikan p ON j.kandidat_id = p.kandidat_id LEFT JOIN (SELECT  MONTH(j.created_at) AS bulan, COUNT(j.kandidat_id) AS d3 FROM job_application j LEFT JOIN pendidikan p ON j.kandidat_id = p.kandidat_id WHERE p.gelar = 1 GROUP BY p.gelar, MONTH(j.created_at)) di ON di.bulan = MONTH(j.created_at) LEFT JOIN (SELECT  MONTH(j.created_at) AS bulan, COUNT(j.kandidat_id) AS s1 FROM job_application j LEFT JOIN pendidikan p ON j.kandidat_id = p.kandidat_id WHERE p.gelar = 2 GROUP BY p.gelar, MONTH(j.created_at)) sa ON sa.bulan = MONTH(j.created_at) LEFT JOIN (SELECT  MONTH(j.created_at) AS bulan, COUNT(j.kandidat_id) AS s2 FROM job_application j LEFT JOIN pendidikan p ON j.kandidat_id = p.kandidat_id WHERE p.gelar = 3 GROUP BY p.gelar, MONTH(j.created_at)) ma ON ma.bulan = MONTH(j.created_at) GROUP BY MONTH(j.created_at), YEAR(j.created_at), di.d3, sa.s1, ma.s2');
            
            for ($i=0; $i < count($dataReport); $i++) { 
                if ($dataReport[$i]->bulan == "1") {
                    $bulan = "Januari";
                }elseif ($dataReport[$i]->bulan == "2") {
                    $bulan = "Februari";
                }elseif ($dataReport[$i]->bulan == "3") {
                    $bulan = "Maret";
                }elseif ($dataReport[$i]->bulan == "4") {
                    $bulan = "April";
                }elseif ($dataReport[$i]->bulan == "5") {
                    $bulan = "Mei";
                }elseif ($dataReport[$i]->bulan == "6") {
                    $bulan = "Juni";
                }elseif ($dataReport[$i]->bulan == "7") {
                    $bulan = "Juli";
                }elseif ($dataReport[$i]->bulan == "8") {
                    $bulan = "Agustus";
                }elseif ($dataReport[$i]->bulan == "9") {
                    $bulan = "September";
                }elseif ($dataReport[$i]->bulan == "10") {
                    $bulan = "Oktober";
                }elseif ($dataReport[$i]->bulan == "11") {
                    $bulan = "November";
                }elseif ($dataReport[$i]->bulan == "12") {
                    $bulan = "Desember";
                }
                $dataReport[$i]->periode = $bulan.' '.$dataReport[$i]->tahun;

                if ($dataReport[$i]->d3 == null) {
                    $dataReport[$i]->d3 = 0;
                }
                if ($dataReport[$i]->s1 == null) {
                    $dataReport[$i]->s1 = 0;
                }
                if ($dataReport[$i]->s2 == null) {
                    $dataReport[$i]->s2 = 0;
                }
            }
        }elseif ($tipe == "8") {
            $dataReport = DB::select('SELECT k.gender, COUNT(k.id) as total_kandidat, k.kota, p.jurusan, p.universitas FROM kandidat k LEFT JOIN pendidikan p ON k.id = p.kandidat_id WHERE k.kota = '.$kota.' AND p.universitas = '.$univ.' AND k.created_at BETWEEN '.$dateStart.' AND '.$dateEnd.' GROUP BY k.gender, k.kota, p.jurusan, p.universitas');

            for ($i=0; $i < count($dataReport); $i++) { 
                if ($dataReport[$i]->gender == "1") {
                    $dataReport[$i]->gender = "Male";
                }else{
                    $dataReport[$i]->gender = "Female";
                }
            }
        }
        // dd($dataReport);
        return response()->json($dataReport);
    }

    public function downloadReport($date){
        $tanggal = base64_decode(urldecode($date));
        $exp = explode('_', $tanggal);
        $exp[0] = date('Y-m-d', strtotime($exp[0]));
        $exp[1] = date('Y-m-d', strtotime($exp[1]));
        $kota = strtolower(str_replace(" ", "_", $exp[3]));
        $univ = strtolower(str_replace(" ", "_", $exp[4]));
        if ($exp[2] == "1") {
            $nameFile = 'Report_tren_lelulusan_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "2") {
            $nameFile = 'Report_avg_skor_jurusan_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "3") {
            $nameFile = 'Report_tingkat_kelulusan_universitas_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "4") {
            $nameFile = 'Report_tingkat_kelulusan_jurusan_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "5") {
            $nameFile = 'Report_tren_avg_skor_subtest.xlsx';
        }else if ($exp[2] == "6") {
            $nameFile = 'Report_avg_fulfilment_lead_time_per_job_vacancy_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "7") {
            $nameFile = 'Report_tren_analisa_jumlah_peningkatan_penurunan_jumlah_pelamar.xlsx';
        }else if ($exp[2] == "8") {
            $nameFile = 'Report_analisa_profil_kandidat_'.$exp[0].'-'.$exp[1].'_'.$kota.'_'.$univ.'.xlsx';
        }

        return Excel::download(new DownloadReport($exp), $nameFile);
    }
}
