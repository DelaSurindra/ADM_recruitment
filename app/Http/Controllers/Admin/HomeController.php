<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Vacancy;
use App\Model\Job_Application;
use App\Model\MasterSource;

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
