<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use DB;

class DownloadResult implements FromView, ShouldAutoSize
{

    public function __construct($idDownload)
    {
        $this->id = $idDownload;
    }

    public function view(): View
    {
        $listCandidate = DB::select('EXEC get_kandidat NULL, NULL, NULL, NULL, NULL, NULL, NULL,'.$this->id.',NULL, NULL, NULL, 0, 0 ');
        
        return view('admin.test.test-download', ['downloadData' => $listCandidate]);
    }
}
