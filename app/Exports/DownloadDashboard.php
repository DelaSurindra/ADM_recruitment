<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use App\Model\Job_Application;
use App\Model\CognitiveTestResult;
use DB;

class DownloadDashboard implements FromView, ShouldAutoSize
{
    public function __construct($exp)
    {
        $this->data = $exp;
    }

    public function view(): View
    {
        if ($this->data[2] == "1") {
            $cognitiveTest = CognitiveTestResult::select('cognitive_test_result.*', 'kandidat.first_name', 'kandidat.last_name')
                                            ->join('test_participant', 'cognitive_test_result.id_participant', 'test_participant.id')
                                            ->join('kandidat', 'test_participant.kandidat_id', 'kandidat.id')
                                            ->where('cognitive_test_result.status', 2)
                                            ->whereBetween('cognitive_test_result.created_at', [$this->data[0], $this->data[1]])
                                            ->orderBy('kandidat.first_name', 'ASC')
                                            ->get()->toArray();
            return view('admin.download-dashboard-candidate', ['downloadData' => $cognitiveTest]);
        }else if ($this->data[2] == "2" || $this->data[2] == "3") {
            $cognitiveTest = CognitiveTestResult::select('cognitive_test_result.*', 'kandidat.first_name', 'kandidat.last_name')
                                            ->join('test_participant', 'cognitive_test_result.id_participant', 'test_participant.id')
                                            ->join('kandidat', 'test_participant.kandidat_id', 'kandidat.id')
                                            ->whereBetween('cognitive_test_result.created_at', [$this->data[0], $this->data[1]])
                                            ->orderBy('kandidat.first_name', 'ASC')
                                            ->get()->toArray();
            return view('admin.download-dashboard-candidate', ['downloadData' => $cognitiveTest]);
        }else if ($this->data[2] == "4") {
            $univ = Job_Application::select('pendidikan.universitas', DB::raw('COUNT(pendidikan.universitas) as total'))
                                ->join('pendidikan', 'job_application.kandidat_id', 'pendidikan.kandidat_id')
                                ->where('job_application.status', '>=', 3)
                                ->whereBetween('job_application.created_at', [$this->data[0], $this->data[1]])
                                ->groupBy('pendidikan.universitas')
                                ->get()->toArray();
                                
            return view('admin.download-dashboard-pendidikan', ['downloadData' => $univ, 'type'=>"1"]);
            
        }else if ($this->data[2] == "5") {
            $major = Job_Application::select('pendidikan.jurusan', DB::raw('COUNT(pendidikan.jurusan) as total'))
                                ->join('pendidikan', 'job_application.kandidat_id', 'pendidikan.kandidat_id')
                                ->where('job_application.status', '>=', 3)
                                ->whereBetween('job_application.created_at', [$this->data[0], $this->data[1]])
                                ->groupBy('pendidikan.jurusan')
                                ->get()->toArray();

            return view('admin.download-dashboard-pendidikan', ['downloadData' => $major, 'type'=>"2"]);
        }
    }
}
