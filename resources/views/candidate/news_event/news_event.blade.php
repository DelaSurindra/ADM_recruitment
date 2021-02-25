@extends('candidate.main-homepage.main')
@section('content')
<div class="container">
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
                    <div class="card-list-news">
                        <div class="card-body-news">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <img src="{{asset('image/candidate/news_example.png')}}" class="img-news">
                                </div>
                                <div class="col-lg-8 col-md-12 mt-5">
                                    <div class="div-right-news">
                                        <div class="d-flex">
                                            <div class="badge-news mb-3">News</div>
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
                                            <div class="badge-news mb-3">News</div>
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