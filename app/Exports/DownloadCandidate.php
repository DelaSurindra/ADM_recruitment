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

class DownloadCandidate implements FromView, ShouldAutoSize
{
    public function __construct($exp)
    {
        $this->data = $exp;
    }

    public function view(): View
    {
        return view('admin.candidate.download-candidate', ['downloadData' => $this->data]);
    }
}
