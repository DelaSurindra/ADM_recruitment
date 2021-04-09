<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Model\Status_History_Application;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function statusTrackApply($job_apply_id, $status) {
        $sql = Status_History_Application::insert([
            'status' => $status,
            'job_application_id' => $job_apply_id,
        ]);

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function getStatusParticipantMessage($status){
        switch ($status) {
            case 6:
                return "Kandidat terblokir karena melakukan screenshoot atau screen recording";
                break;
            case 2:
                return "Jadwal test kandidat diubah";
                break;
            case 4:
                return "Kandidat tidak hadir";
                break;
            case 5:
                return "Kandidat telah menyelesaikan tes";
                break;
            
            default:
                return "Kandidat belum menghadiri tes";
                break;
        }
    }
}
