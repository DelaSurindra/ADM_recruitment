<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Vacancy;
use App\Model\Job_Application;
use App\Model\MasterSource;
use App\Model\CognitiveTestResult;
use App\Exports\DownloadDashboard;
use Maatwebsite\Excel\Facades\Excel;

use Request;
use Session;
use DB;

class HomeController extends Controller
{
    public function homeView() {
        $openVacancy = Vacancy::where('status', 1)->count();
        $closeVacancy = Vacancy::where('status', 0)->count();
        $totalJob = Job_Application::count();
        $hiredJob = Job_Application::where('status', 12)->count();

        $formatOpenVacancy = $this->number_format_short($openVacancy);
        $formatCloseVacancy = $this->number_format_short($closeVacancy);
        $formatTotalJob = $this->number_format_short($totalJob);
        $formatHiredJob = $this->number_format_short($hiredJob);

        $dataDashboard = [
            "openVacancy"  => $formatOpenVacancy,
            "closeVacancy" => $formatCloseVacancy,
            "totalJob"     => $formatTotalJob,
            "formatHired"  => $formatHiredJob
        ];

        return view('admin.welcome')->with(['pageTitle' => 'Dashboard', 'title' => 'Dashboard', 'sidebar' => 'dashboard', "dataDashboard" => $dataDashboard]);
    }

    public function chartTotalApplication(){
        $total = Job_Application::count();
        $proses = Job_Application::where('status', '!=', '11')->where('status', '!=', '12')->count();
        $decline = Job_Application::where('status', '11')->count();
        $hired = Job_Application::where('status', '12')->count();

        if ($proses != 0) {
            $persenProses = round(($proses/$total)*100, 2);
        }else{
            $persenProses = 0;
        }

        if ($decline != 0) {
            $persenDecline = round(($decline/$total)*100, 2);
        }else{
            $persenDecline = 0;
        }

        if ($hired) {
            $persenHired = round(($hired/$total)*100, 2);
        } else {
            $persenHired = 0;
        }
        
        $dataChart = [
            "proses"    => $persenProses,
            "decline"   => $persenDecline,
            "hired"     => $persenHired
        ];

        return response()->json($dataChart);
    }

    public function chartApplicationSource(){
        $dataCount = MasterSource::select('application_source.source', 'job_application.referensi', DB::raw('COUNT(job_application.referensi) as total'))
                                ->join('job_application', 'application_source.id', 'job_application.referensi')
                                ->groupBy('application_source.source', 'job_application.referensi')->get()->toArray();
        // dd($dataCount);
        $label = [];
        $result = [];
        if ($dataCount) {
            for ($i=0; $i < count($dataCount) ; $i++) { 
                $dataLabel = $dataCount[$i]['source'];
                array_push($label, $dataLabel);
                array_push($result, (int)$dataCount[$i]['total']);
            }
        }

        $value = [
            'label'  => $label,
            'result' => $result
        ];

        return response()->json($value);
    }

    public function topScore(){
        $dateStart = date('Y-m-d', strtotime(Request::input('dateStart')));
        $dateEnd = date('Y-m-d', strtotime(Request::input('dateEnd')));
        $cognitiveTest = CognitiveTestResult::select('cognitive_test_result.skor', 'test_participant.kandidat_id', 'kandidat.foto_profil', 'kandidat.first_name', 'kandidat.last_name')
                                            ->join('test_participant', 'cognitive_test_result.id_participant', 'test_participant.id')
                                            ->join('kandidat', 'test_participant.kandidat_id', 'kandidat.id')
                                            ->where('cognitive_test_result.status', 2)
                                            ->whereBetween('cognitive_test_result.created_at', [$dateStart, $dateEnd])
                                            ->orderBy('cognitive_test_result.skor', 'DESC')
                                            ->limit(3)
                                            ->get()->toArray();
        
        return response()->json($cognitiveTest);
    }

    public function candidatePass(){
        $dateStart = date('Y-m-d', strtotime(Request::input('dateStart')));
        $dateEnd = date('Y-m-d', strtotime(Request::input('dateEnd')));
        $pass = CognitiveTestResult::where('status', 2)->whereBetween('cognitive_test_result.created_at', [$dateStart, $dateEnd])->count();
        $total = CognitiveTestResult::whereBetween('cognitive_test_result.created_at', [$dateStart, $dateEnd])->count();
        $persentase = 0;
        if ($total != 0) {
            $persentase = round($pass/$total, 2);
        }

        $dataCandidatePass = [
            'total'      => $total,
            'pass'       => $pass,
            'persentase' => $persentase
        ];

        return response()->json($dataCandidatePass);
    }

    public function averageScore(){
        $dateStart = date('Y-m-d', strtotime(Request::input('dateStart')));
        $dateEnd = date('Y-m-d', strtotime(Request::input('dateEnd')));
        $average = CognitiveTestResult::select(
                                        DB::raw('AVG(verbal1) as verbal1'),
                                        DB::raw('AVG(verbal2) as verbal2'),
                                        DB::raw('AVG(verbal3) as verbal3'),
                                        DB::raw('AVG(verbal4) as verbal4'),
                                        DB::raw('AVG(numerical1) as numerical1'),
                                        DB::raw('AVG(numerical2) as numerical2'),
                                        DB::raw('AVG(numerical3) as numerical3'),
                                        DB::raw('AVG(numerical4) as numerical4'),
                                        DB::raw('AVG(abstrak1) as abstrak1'),
                                        DB::raw('AVG(abstrak2) as abstrak2'),
                                        DB::raw('AVG(abstrak3) as abstrak3'),
                                        DB::raw('AVG(abstrak4) as abstrak4'),
                                    )->whereBetween('created_at', [$dateStart, $dateEnd])->get()->toArray();

        $averageVerbal = (float)$average[0]['verbal1']+(float)$average[0]['verbal2']+(float)$average[0]['verbal3']+(float)$average[0]['verbal4'];
        $averageNumeric = (float)$average[0]['numerical1']+(float)$average[0]['numerical2']+(float)$average[0]['numerical3']+(float)$average[0]['numerical4'];
        $averageAbstrak = (float)$average[0]['abstrak1']+(float)$average[0]['abstrak2']+(float)$average[0]['abstrak3']+(float)$average[0]['abstrak4'];
        
        $averageAll = [
            'verbal' => round($averageVerbal, 2),
            'numeric' => round($averageNumeric, 2),
            'abstrak' => round($averageAbstrak, 2),
        ];

        return response()->json($averageAll);
    }

    public function applicationUniversity(){
        $dateStart = date('Y-m-d', strtotime(Request::input('dateStart')));
        $dateEnd = date('Y-m-d', strtotime(Request::input('dateEnd')));
        $univ = Job_Application::select('pendidikan.universitas', DB::raw('COUNT(pendidikan.universitas) as total'))
                                ->join('pendidikan', 'job_application.kandidat_id', 'pendidikan.kandidat_id')
                                ->where('job_application.status', '>=', 3)
                                ->whereBetween('job_application.created_at', [$dateStart, $dateEnd])
                                ->groupBy('pendidikan.universitas')
                                ->get()->toArray();
        
        $label = [];
        $result = [];
        if ($univ) {
            for ($i=0; $i < count($univ) ; $i++) { 
                $dataLabel = $univ[$i]['universitas'];
                array_push($label, $dataLabel);
                array_push($result, (int)$univ[$i]['total']);
            }
        }

        $value = [
            'label'  => $label,
            'result' => $result
        ];

        return response()->json($value);
    }

    public function applicationMajor(){
        $dateStart = date('Y-m-d', strtotime(Request::input('dateStart')));
        $dateEnd = date('Y-m-d', strtotime(Request::input('dateEnd')));
        $major = Job_Application::select('pendidikan.jurusan', DB::raw('COUNT(pendidikan.jurusan) as total'))
                                ->join('pendidikan', 'job_application.kandidat_id', 'pendidikan.kandidat_id')
                                ->where('job_application.status', '>=', 3)
                                ->whereBetween('job_application.created_at', [$dateStart, $dateEnd])
                                ->groupBy('pendidikan.jurusan')
                                ->get()->toArray();
        // dd($major);
        $label = [];
        $result = [];
        if ($major) {
            for ($i=0; $i < count($major) ; $i++) { 
                $dataLabel = $major[$i]['jurusan'];
                array_push($label, $dataLabel);
                array_push($result, (int)$major[$i]['total']);
            }
        }

        $value = [
            'label'  => $label,
            'result' => $result
        ];

        return response()->json($value);
    }

    public function downloadDashboard($date){
        $tanggal = base64_decode(urldecode($date));
        $exp = explode('_', $tanggal);
        $exp[0] = date('Y-m-d', strtotime($exp[0]));
        $exp[1] = date('Y-m-d', strtotime($exp[1]));
        // dd($exp);
        if ($exp[2] == "1") {
            $nameFile = 'Download_topscore_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "2") {
            $nameFile = 'Download_candidatepass_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "3") {
            $nameFile = 'Download_averagescore_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "4") {
            $nameFile = 'Download_universitas_'.$exp[0].'-'.$exp[1].'.xlsx';
        }else if ($exp[2] == "5") {
            $nameFile = 'Download_major_'.$exp[0].'-'.$exp[1].'.xlsx';
        }

        return Excel::download(new DownloadDashboard($exp), $nameFile);
    }

    function number_format_short( $n, $precision = 1 ) {
        if ($n < 1000) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 1000000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 1000000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 1000000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
    
      // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
      // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
    
        return $n_format . $suffix;
    }
}
