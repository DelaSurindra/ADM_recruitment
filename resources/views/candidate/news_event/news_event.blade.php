@extends('candidate.main-homepage.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @if(count($newsEvent) == "1")
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                @endif
                @if(count($newsEvent) == "2")
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                @endif
                @if(count($newsEvent) == "3")
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                @endif
            </ol>
            <div class="carousel-inner">
                @foreach($newsEvent as $dataNews)
                <div class="carousel-item active">
                    <div class="div-image-carousel">
                        <img src="{{asset('storage/').'/'.$dataNews['image'] }}" class="d-block w-100 img-carousel">
                    </div>
                    <div class="carousel-caption d-none d-md-block carousel-news">
                        <div class="badge-carousel mb-2">{{$dataNews['type'] == "1" ? "News" : "Event"}}</div>
                        <h5 class="text-carousel mb-5">{{$dataNews['title']}}</h5>
                        <a href="{{route('get.news.event.page.detail', base64_encode(urlencode($dataNews['id'])))}}" class="a-read-more"><button type="button" class="btn btn-read-more">Read More</button></a>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><img src="{{asset('/image/icon/homepage/news-prev.svg')}}" class="img-prev-next"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><img src="{{asset('/image/icon/homepage/news-next.svg')}}" class="img-prev-next"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <ul class="nav nav-pills mb-3 tabs-news" id="pills-tab" role="tablist">
                <li class="nav-item px-2" role="presentation">
                    <a class="nav-link active" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">News</a>
                </li>
                <li class="nav-item px-2" role="presentation">
                    <a class="nav-link" id="pills-event-tab" data-toggle="pill" href="#pills-event" role="tab" aria-controls="pills-event" aria-selected="false">Event</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                    <div id="divNews">
                        @foreach($news as $data)
                            <a href="{{route('get.news.event.page.detail', base64_encode(urlencode($data['id'])))}}" class="news-ahref">
                                <div class="card-list-news">
                                    <div class="card-body-news">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12">
                                                <img src="{{asset('storage/').'/'.$data['image'] }}" class="img-news">
                                            </div>
                                            <div class="col-lg-8 col-md-12 mt-5">
                                                <div class="div-right-news">
                                                    <div class="d-flex">
                                                        <div class="badge-news mb-3">News</div>
                                                        <p class="align-items-center p-title-news">{{date('d F Y', strtotime($data['created_at']))}}</p>
                                                    </div>
                                                    <h4 class="news-page-title">{{$data['title']}}</h4>
                                                    <!-- <p class="news-page-content">{!! $data['content'] !!}</p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div>
                        @if(count($news) > 5)
                        <center>
                            <button type="button" class="btn btn-load-more" id="loadNews" value=5>Load More</button>
                        </center>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade show" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab">
                    <div id="divEvent">
                        @foreach($event as $data)
                            <a href="{{route('get.news.event.page.detail', base64_encode(urlencode($data['id'])))}}" class="news-ahref">
                                <div class="card-list-news">
                                    <div class="card-body-news">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12">
                                                <img src="{{asset('storage/').'/'.$data['image'] }}" class="img-news">
                                            </div>
                                            <div class="col-lg-8 col-md-12 mt-5">
                                                <div class="div-right-news">
                                                    <div class="d-flex">
                                                        <div class="badge-news mb-3">Event</div>
                                                        <p class="align-items-center p-title-news">{{date('d F Y', strtotime($data['created_at']))}}</p>
                                                    </div>
                                                    <h4 class="news-page-title">{{$data['title']}}</h4>
                                                    <!-- <p class="news-page-content">{!! $data['content'] !!}</p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div>
                        @if(count($event) > 5)
                        <center>
                            <button type="button" class="btn btn-load-more" id="loadEvent" value=5>Load More</button>
                        </center>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection