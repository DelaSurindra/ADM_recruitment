<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;

use App\Model\NewsEvent;
use Request;

class NewsEventController extends Controller
{
    public function viewNewsEvent(){
        $newsEvent = NewsEvent::where('type', '1')->orderBy('created_at', 'DESC')->get()->toArray();
        // dd($newsEvent);
        return view('candidate.news_event.news_event')->with(['topbar'=>'news_event', 'newsEvent' => $newsEvent]);
    }

    public function viewNewsEventDetail($id){
        $idNewsEvent = base64_decode(urldecode($id));
        $newsEvent = NewsEvent::where('id', $idNewsEvent)->get()->toArray();

        // dd($newsEvent);
        if ($newsEvent) {
            return view('candidate.news_event.news_event_detail')->with(['topbar'=>'news_event', 'newsEvent'=>$newsEvent[0]]);
        }else{
            abort(404);
        }
    }
}
