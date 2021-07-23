<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;

class DownloadJob implements FromView, ShouldAutoSize
{
    public function __construct($exp)
    {
        $this->data = $exp;
    }

    public function view(): View
    {
        return view('admin.job.download-job', ['downloadData' => $this->data]);
    }
}
