<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\NewsEvent;
use App\AdminSession;

use Hash;
use Request;
use Session;

class NewsEventController extends Controller
{
    public function viewNewsEvent(){
        return view('admin.news_event.news_event-list')->with(['pageTitle' => 'Manajemen News/Event', 'title' => 'Manajemen News/Event', 'sidebar' => 'manajemen_news_event']);
    }

    public function listNewsEvent(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'         =>  (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'          =>  (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $newsEvent = new NewsEvent;
        if ($dataSend['search']){
            $newsEvent = $newsEvent->where('title','like','%'.$dataSend['search'].'%');
        }
        $countNewsEvent = $newsEvent->count();

        $listNewsEvent = $newsEvent->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listNewsEvent = $listNewsEvent->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listNewsEvent = $listNewsEvent->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        if ($listNewsEvent != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countNewsEvent,
                "recordsFiltered"   => $countNewsEvent,
                "data"              => $listNewsEvent
            );
        }else{
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => 0,
                "recordsFiltered"   => 0,
                "data"              => []
            );
        }
        return $response;
    }

    public function viewNewsEventAdd(){
        
        return view('admin.news_event.news_event-add')->with(['pageTitle' => 'Manajemen News/Event', 'title' => 'Manajemen News/Event', 'sidebar' => 'manajemen_news_event']);
    }

    public function addNewsEvent(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        if (Request::has('imageNewsEvent')) {
            $image = Request::file('imageNewsEvent');
            $ext = $image->getClientOriginalExtension();
            if ($data['tipeNewsEvent'] == '1') {
                $tipe = 'news';
            } else {
                $tipe = 'event';
            }
            
            $path = $image->storeAs('event-news', $tipe.'_'.time().'.'.$ext, 'public');
            $dataImage = $path;
        }else{
            $dataImage = '';
        }

        if ($data['tipeNewsEvent'] == "1") {
            $addNewsEvent = NewsEvent::insert([
                'title'         => $data['titleNewsEvent'],
                'content'       => $data['descriptionNewsEvent'],
                'image'         => $dataImage,
                'type'          => $data['tipeNewsEvent']
            ]);
        } else {
            $addNewsEvent = NewsEvent::insert([
                'title'         => $data['titleNewsEvent'],
                'content'       => $data['descriptionNewsEvent'],
                'image'         => $dataImage,
                'start_date'    => date('Y-m-d', strtotime($data['tglMulaiNewsEvent'])),
                'end_date'      => date('Y-m-d', strtotime($data['tglSelesaiNewsEvent'])),
                'type'          => $data['tipeNewsEvent']
            ]);
        }
        
        if ($addNewsEvent) {
            $messages = [
                'status' => 'success',
                'message' => 'Berhasil Membuat Event/News',
                'url' => 'close'
            ];

            return redirect('/HR/news_event')->with('notif', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Gagal Membuat Event/News',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
        
    }

    public function viewNewsEventDetail($id){
        $idNewsEvent = base64_decode(urldecode($id));

        $dataNewsEvent = NewsEvent::where('id', $idNewsEvent)->get()->toArray();
        
        if ($dataNewsEvent) {
            return view('admin.news_event.news_event-edit')->with(['pageTitle' => 'Manajemen News/Event', 'title' => 'Manajemen News/Event', 'sidebar' => 'manajemen_news_event', 'data'=>$dataNewsEvent[0]]);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
    }

    public function editNewsEvent(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        if (Request::has('imageNewsEvent')) {
            $image = Request::file('imageNewsEvent');
            $ext = $image->getClientOriginalExtension();
            if ($data['tipeNewsEvent'] == '1') {
                $tipe = 'news';
            } else {
                $tipe = 'event';
            }
            
            $path = $image->storeAs('event-news', $tipe.'_'.time().'.'.$ext, 'public');
            $dataImage = $path;
        }else{
            $dataImage = $data['oldImage'];
        }

        if ($data['tipeNewsEvent'] == "1") {
            $editNewsEvent = NewsEvent::where('id', $data['idNewsEvent'])->update([
                'title'         => $data['titleNewsEvent'],
                'content'       => $data['descriptionNewsEvent'],
                'image'         => $dataImage,
                'type'          => $data['tipeNewsEvent']
            ]);
        } else {
            $editNewsEvent = NewsEvent::where('id', $data['idNewsEvent'])->update([
                'title'         => $data['titleNewsEvent'],
                'content'       => $data['descriptionNewsEvent'],
                'image'         => $dataImage,
                'start_date'    => date('Y-m-d', strtotime($data['tglMulaiNewsEvent'])),
                'end_date'      => date('Y-m-d', strtotime($data['tglSelesaiNewsEvent'])),
                'type'          => $data['tipeNewsEvent']
            ]);
        }
        

        
        if ($editNewsEvent) {
            $messages = [
                'status' => 'success',
                'message' => 'Berhasil Mengubah Data Event/News',
                'url' => 'close'
            ];

            return redirect('/HR/news_event')->with('notif', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Gagal Mengubah Data Event/News',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
    }

    public function deleteNewsEvent(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        if ($data['tipeDeleteNewsEvent'] == '0') {
            $message = 'Berhasil menonaktifkan News/Event';
        }else{
            $message = 'Berhasil mengaktifkan News/Event';
        }

        $deleteNewsEvent = NewsEvent::where('id', $data['idDeleteNewsEvent'])->update([
            'status' => $data['tipeDeleteNewsEvent']
        ]);
        
        if ($deleteNewsEvent) {
            return [
                'status'   => 'success',
                'message'  => $message,
                'url'      => '/HR/news_event',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mengubah Status News/Event',
            ];
        }
    }
}
