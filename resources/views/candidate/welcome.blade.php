@extends('candidate.main-homepage.main')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <!-- <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li> -->
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="div-image-carousel">
                        <img src="{{asset('image/candidate/slide_home.png')}}" class="d-block w-100 img-carousel">
                    </div>
                </div>
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
<div class="row">
    <div class="col-md-12 div-blue-job">
        <center>
            <p>There are <span>24 job vacancies <a href="{{route('get.job.page')}}">View All<img src="{{asset('image/icon/homepage/icon-view-all.svg')}}"></a></span></p>
        </center>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <ul class="nav nav-pills mb-3 tabs-news" id="pills-tab" role="tablist">
                <li class="nav-item px-2" role="presentation">
                    <a class="nav-link active" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">News</a>
                </li>
                <li class="nav-item px-2" role="presentation">
                    <a class="nav-link" id="pills-event-tab" data-toggle="pill" href="#pills-event" role="tab" aria-controls="pills-event" aria-selected="false">Event</a>
                </li>
            </ul>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <a href="{{route('get.news.event.page')}}" class="view-all-news">View All <img src="{{asset('image/icon/homepage/icon-view-all-red.svg')}}"></a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                    <div class="row">
                        @foreach($news as $dataNews)
                            <div class="col-md-3">
                                <a href="{{route('get.news.event.page.detail', base64_encode(urlencode($dataNews['id'])))}}">
                                    <div class="card-list-home">
                                        <img src="{{asset('storage/').'/'.$dataNews['image'] }}" class="home-news">
                                        <div class="badge-news mt-3 ml-3">News</div>
                                        <p class="ml-3 mt-2 title-home-news">{{$dataNews['title']}}</p>
                                        <p class="ml-3 mt-2 date-home-news">{{date('d F Y', strtotime($dataNews['created_at']))}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade show" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab">
                    <div class="row">
                        @foreach($event as $dataEvent)
                            <div class="col-md-3">
                                <a href="{{route('get.news.event.page.detail', base64_encode(urlencode($dataEvent['id'])))}}">
                                    <div class="card-list-home">
                                        <img src="{{asset('storage/').'/'.$dataEvent['image'] }}" class="home-news">
                                        <div class="badge-news mt-3 ml-3">News</div>
                                        <p class="ml-3 mt-2 title-home-news">{{$dataEvent['title']}}</p>
                                        <p class="ml-3 mt-2 date-home-news">{{date('d F Y', strtotime($dataEvent['created_at']))}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="home-title-job">Best Job Vacancy for You</p>
        </div>
    </div>
    <div class="row">
    @foreach($job as $data)
        <div class="col-lg-4 col-md-6 col-sm-12 my-3">
            <div class="card card-job-list">
                <a href="{{ route('get.job.page.detail', base64_encode(urlencode($data['job_id']))) }}" class="text-decoration-none">
                    <div class="card-body">
                        @if($data['type'] == 1)
                        <div class="fulltime-badge mb-3">Full-time</div>
                        @elseif($data['type'] == 2)
                        <div class="internship-badge mb-3">Internship</div>
                        @endif
                        <label class="label-no-margin mb-1">{{ $data['lokasi'] }}, Indonesia</label>
                        <h4 class="candidate-page-subtitle mb-3">{{ $data['job_title'] }}</h4>

                        <div class="d-flex align-items-center job-list-detail mb-1">
                            <div class="icon-wrapper">
                                <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
                            </div>
                            <p class="text">{{ $data['education_req'] }}</p>
                        </div>
                        <div class="d-flex align-items-center job-list-detail">
                            <div class="icon-wrapper">
                                <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
                            </div>
                            <p class="text">{{ $data['major'] }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <center>
                <a href="{{route('get.job.page')}}" class="view-all-job">View All</a>
            </center>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row bg-grey">
        <div class="col-md-1 bg-warning-home">
            <img src="{{asset('image/icon/homepage/icon-warning-home.svg')}}" alt="">
        </div>
        <div class="col-md-8">
            <p class="text-warning-home">PT. Astra Daihatsu Motor never requests for any payment from the applicants, appoints any agent, representative or individual on behalf of the Company to order or receive payments during the recruitment process. If you find a fraudulent recruitment activity on behalf of PT Astra Daihatsu Motor, please report them with the supporting evidence to <span>rekrutmen.adm@daihatsu.astra.co.id</span></p>
        </div>
        <div class="col-md-3">
            <center>
                <a href="{{route('get.candidate.contact-us')}}"><button class="btn btn-red mt-5 w-75">Contact Us</button></a>

            </center>
        </div>
    </div>
</div>

@endsection