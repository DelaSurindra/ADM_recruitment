@extends('candidate.main-homepage.main')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="div-img-detail">
            <img class="img-detail-news" src="{{asset('storage/').'/'.$newsEvent['image']}}" alt="">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-news-detail">
                <div class="breadcrumb-news">
                    <a class="bread active" href="{{route('get.news.event.page')}}">{{$newsEvent['type'] == "1" ? 'News':'Event'}}</a>
                    <p class="bread">&nbsp/ Detail</p>
                </div>
                <div class="badge-news mb-3">{{$newsEvent['type'] == "1" ? 'News':'Event'}}</div>
                <h4 class="news-page-title-detail">{{$newsEvent['title']}}</h4>
                <p class="p-title-news-detail">{{date('d F Y', strtotime($newsEvent['created_at']))}}</p>
                @if($newsEvent['type'] != '1')
                <div class="row">
                    <div class="col-md-4 ml-4 mt-3 div-valid">
                        <p class="text-valid">Valid : <strong>{{date('d F Y', strtotime($newsEvent['start_date']))}} - {{date('d F Y', strtotime($newsEvent['end_date']))}}</strong></p>
                    </div>
                </div>
                @endif
                <hr>
                <div class="div-content-detail">
                    {!! $newsEvent['content'] !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection