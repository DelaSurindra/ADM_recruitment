<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsEventController extends Controller
{
    public function viewNewsEvent(){
        return view('candidate.news_event.news_event');
    }

    public function viewNewsEventDetail(){
        return view('candidate.news_event.news_event_detail');
    }
}
