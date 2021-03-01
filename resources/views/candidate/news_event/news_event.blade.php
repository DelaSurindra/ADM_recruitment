@extends('candidate.main-homepage.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('image/candidate/news_example.png')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Gambar Slide Yang Pertama</h5>
                        <p>Gambar pemandangan sungai.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('image/candidate/news_example.png')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Gambar Slide Yang Kedua</h5>
                        <p>Gambar pemandangan sawah di desa.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('image/candidate/news_example.png')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Gambar Slide Yang Ketiga</h5>
                        <p>Gambar pemandangan taman belakang rumah.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<div class="container mt-1">
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
                    <div>
                        @foreach($newsEvent as $data)
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
                                                        <div class="badge-news mb-3">{{$data['type'] == "1" ? 'News':'Event'}}</div>
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
                        <center>Load More</center>
                    </div>
                </div>
                <div class="tab-pane fade show" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab">
                    <div class="card-list-news">
                        <div class="card-body-news">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <img src="{{asset('image/candidate/news_example.png')}}" class="img-news">
                                </div>
                                <div class="col-lg-8 col-md-12 mt-5">
                                    <div class="div-right-news">
                                        <div class="d-flex">
                                            <div class="badge-news mb-3">Event</div>
                                            <p class="align-items-center p-title-news">12 Februay 2021</p>
                                        </div>
                                        <h4 class="news-page-title">Astra Daihatsu Motors Recruitment Goes to Japan</h4>
                                        <p class="news-page-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio nunc sed non augue. Magnis augue tortor facilisis id. Mi sed gravida congue pulvinar odio feugiat. Etiam cursus in sce....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-list-news">
                        <div class="card-body-news">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <img src="{{asset('image/candidate/news_example.png')}}" class="img-news">
                                </div>
                                <div class="col-lg-8 col-md-12 mt-5">
                                    <div class="div-right-news">
                                        <div class="d-flex">
                                            <div class="badge-news mb-3">Event</div>
                                            <p class="align-items-center p-title-news">12 Februay 2021</p>
                                        </div>
                                        <h4 class="news-page-title">Astra Daihatsu Motors Recruitment Goes to Japan</h4>
                                        <p class="news-page-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio nunc sed non augue. Magnis augue tortor facilisis id. Mi sed gravida congue pulvinar odio feugiat. Etiam cursus in sce....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab">...</div>
            </div>

        </div>
    </div>
</div>
@endsection