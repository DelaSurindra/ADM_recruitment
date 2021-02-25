@extends('candidate.main-homepage.main')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="div-img-detail">
            <img class="img-detail-news" src="{{asset('image/candidate/news_example.png')}}" alt="">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-news-detail">
                <div class="breadcrumb-candidate">
                    <a class="bread active" href="#">My Application</a>
                    <p class="bread">/Pre Sales Solution Architect</p>
                </div>
                <div class="badge-news mb-3">News</div>
                <h4 class="news-page-title-detail">Astra Daihatsu Motors Recruitment Goes to Japan</h4>
                <p class="p-title-news-detail">12 Februay 2021</p>
            </div>
        </div>
    </div>
</div>
@endsection