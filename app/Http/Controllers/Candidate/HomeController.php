<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NewsEvent;
use App\Model\Vacancy;
use App\Model\ConfigHomepage;

class HomeController extends Controller
{
    public function viewIndex() {
        $news = NewsEvent::where('type', '1')->where('status', '1')->orderBy('created_at', 'DESC')->offset(0)->limit(4)->get()->toArray();
        $event = NewsEvent::where('type', '2')->where('status', '1')->orderBy('created_at', 'DESC')->offset(0)->limit(4)->get()->toArray();
        $job = Vacancy::where('status', 1)->orderBy('created_at', 'desc')->offset(0)->limit(6)->get()->toArray();

        $banner =  ConfigHomepage::where('config', 2)->get()->toArray();
        for ($i=0; $i < count($job); $i++) { 
            if($job[$i]['degree'] == 1) {
                $degree = "Diploma's Degree";
            } elseif($job[$i]['degree'] == 2) {
                $degree = "Bachelor's Degree";
            } elseif($job[$i]['degree'] == 3) {
                $degree = "Master's Degree";
            } else {
                $degree = "";
            }

            $job[$i]['education_req'] = $degree;
        }
        return view('candidate.welcome')->with(['topbar'=>'home', 'news' => $news, 'event' => $event, 'job' => $job, 'banner'=>$banner]);
    }

    
    public function getColor(){
        $color = ConfigHomepage::select('value')->where('config', 1)->get()->toArray();
        return response()->json($color[0]);
    }
}
