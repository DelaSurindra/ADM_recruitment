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

class DownloadDefault implements FromView, ShouldAutoSize{
    public function view(): View
    {
        return view('admin.candidate.template-bulk');
    }
}
