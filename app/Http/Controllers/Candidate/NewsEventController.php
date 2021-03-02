<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;

use App\Model\NewsEvent;
use Request;

class NewsEventController extends Controller
{
    public function viewNewsEvent(){
        $news = NewsEvent::where('type', '1')->where('status', '1')->orderBy('created_at', 'DESC')->offset(0)->limit(5)->get()->toArray();
        $event = NewsEvent::where('type', '2')->where('status', '1')->orderBy('created_at', 'DESC')->offset(0)->limit(5)->get()->toArray();
        $newsEvent = NewsEvent::where('status', '1')->orderBy('created_at', 'DESC')->limit(3)->get()->toArray();
        return view('candidate.news_event.news_event')->with(['topbar'=>'news_event', 'news' => $news, 'event'=>$event, 'newsEvent'=>$newsEvent]);
    }

    public function viewNewsEventDetail($id){
        $idNewsEvent = base64_decode(urldecode($id));
        $newsEvent = NewsEvent::where('id', $idNewsEvent)->get()->toArray();
        if ($newsEvent) {
            return view('candidate.news_event.news_event_detail')->with(['topbar'=>'news_event', 'newsEvent'=>$newsEvent[0]]);
        }else{
            abort(404);
        }
    }

    public function getMoreNews(){
        $value = Request::input('value');
        $newsEvent = NewsEvent::where('type', '1')->where('status', '1')->orderBy('created_at', 'DESC')->offset($value)->limit(5)->get()->toArray();
        for ($i=0; $i < count($newsEvent); $i++) { 
            $newsEvent[$i]['tanggal'] = date('d F Y', strtotime($newsEvent[$i]['created_at']));
        }
        return response()->json($newsEvent);
    }

    public function getMoreEvent(){
        $value = Request::input('value');
        $newsEvent = NewsEvent::where('type', '2')->where('status', '1')->orderBy('created_at', 'DESC')->offset($value)->limit(5)->get()->toArray();
        for ($i=0; $i < count($newsEvent); $i++) { 
            $newsEvent[$i]['tanggal'] = date('d F Y', strtotime($newsEvent[$i]['created_at']));
        }
        return response()->json($newsEvent);
    }
}
