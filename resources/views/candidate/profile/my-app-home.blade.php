<h2 class="candidate-page-title">My Application</h2>
<div class="row mt-4">
    <div class="col-12">
        <ul class="nav nav-pills mb-3 tabs-my-app" id="pills-tab" role="tablist">
            <li class="nav-item pr-2" role="presentation">
                <a class="nav-link active" id="pills-all-myapp-tab" data-toggle="pill" href="#pills-all-myapp" role="tab" aria-controls="pills-all-myapp" aria-selected="true">All</a>
            </li>
            <li class="nav-item px-2" role="presentation">
                <a class="nav-link" id="pills-onprocess-myapp-tab" data-toggle="pill" href="#pills-onprocess-myapp" role="tab" aria-controls="pills-onprocess-myapp" aria-selected="false">Onprocess</a>
            </li>
            <li class="nav-item px-2" role="presentation">
                <a class="nav-link" id="pills-hired-myapp-tab" data-toggle="pill" href="#pills-hired-myapp" role="tab" aria-controls="pills-hired-myapp" aria-selected="false">Hired</a>
            </li>
            <li class="nav-item px-2" role="presentation">
                <a class="nav-link" id="pills-failed-myapp-tab" data-toggle="pill" href="#pills-failed-myapp" role="tab" aria-controls="pills-failed-myapp" aria-selected="false">Failed</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all-myapp" role="tabpanel" aria-labelledby="pills-all-myapp-tab">
                @if(count($job_apply) > 0)
                    @foreach($job_apply as $apply)
                    <div class="card-list-my-app">
                        <div class="card-head-my-app {{$apply['status_css']}} d-flex justify-content-center">
                            @if($apply['status'] >= 0 && $apply['status'] < 11)
                                <p>Onprocess : <span>{{$apply['status_text']}}</span> </p>
                            @else
                                <p>{{$apply['status_text']}}</p>
                            @endif
                        </div>
                        <div class="card-body-my-app p-4">
                            <div class="row m-1">
                                <div class="col-lg-8 col-md-12">
                                    <div class="fulltime-badge mb-3">{{$apply["type"] == "1" ? "Full-time":"Intership"}}</div>
                                    <label class="label-no-margin mb-1">{{$apply['lokasi']}}, Indonesia</label>
                                    <h4 class="candidate-page-subtitle mb-0">{{$apply['job_title']}}</h4>
                                </div>
                                <div class="col-lg-4 col-md-12 border-left1">
                                    <a href="{{route('get.profile.my-app-detail', base64_encode(urlencode($apply['id'])))}}" class="btn btn-white btn-block">View Detail</a>
                                    @if($apply['button'] == "Y")
                                    <button class="btn btn-red btn-block">{{$apply['status_text']}}</button>
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <!-- Ketika data kosong -->
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-5">
                        <img src="{{ asset('image/icon/homepage/icon-koper.svg') }}" alt="icon">
                        <h4 class="candidate-page-subtitle mb-2 mt-5">You haven't applied for a job </h4>
                        <p class="text-empty-job mb-3">Join our team right now</p>
                        <a href="{{ route('get.job.page') }}" class="btn btn-red px-5">See Job Vacancy</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="tab-pane fade" id="pills-onprocess-myapp" role="tabpanel" aria-labelledby="pills-onprocess-myapp-tab">...</div>
            <div class="tab-pane fade" id="pills-hired-myapp" role="tabpanel" aria-labelledby="pills-hired-myapp-tab">...</div>
            <div class="tab-pane fade" id="pills-failed-myapp" role="tabpanel" aria-labelledby="pills-failed-myapp-tab">...</div>
        </div>
    </div>
</div>