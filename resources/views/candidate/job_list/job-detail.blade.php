@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb-candidate">
                <a class="bread active" href="#">Job List</a>
                <p class="bread">/Database Administrator</p>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            @if($jobDetail['type'] == 1)
            <div class="fulltime-badge mb-2">Full-time</div>
            @elseif($jobDetail['type'] == 2)
            <div class="internship-badge mb-2">Internship</div>
            @endif
            <h2 class="candidate-page-title">{{ $jobDetail['job_title'] }}</h2>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-map.svg') }}" alt="icon">
                        </div>
                        <p>{{ $jobDetail['lokasi'] }}, Indonesia</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
                        </div>
                        <p>{{ $jobDetail['education_req'] }}</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
                        </div>
                        <p>{{ $jobDetail['major'] }}</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-clock.svg') }}" alt="icon">
                        </div>
                        <h6>{{ $jobDetail['work_time'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-12">
                    <button class="btn btn-blue btn-block"type="button">Apply Before : <b> {{ date('j F Y', strtotime($jobDetail['active_date'])) }}</b></button>
                </div>
                <div class="col-lg-6 col-md-12">
                    <form action="{{ route('post.apply-job') }}" id="formApplyJob" method="POST" ajax="true">
                        <input type="hidden" name="idUser" id="idUser" value="{{ Session::get('session_candidate')['user_id'] }}">
                        <input type="hidden" name="idJob" id="idJob" value="{{ $jobDetail['job_id'] }}">
                        <input type="hidden" name="degreeJob" id="degreeJob" value="{{ $jobDetail['degree'] }}">
                        <input type="hidden" name="majorJob" id="majorJob" value="{{ $jobDetail['major'] }}">
                        @if(session('session_candidate.status_kandidat') == 1 || session('session_candidate.status_kandidat') == 2)
                        @else
                        <button class="btn btn-home-color btn-block" type="submit">Apply This Job</button>
                        @endif
                    </form>
                </div>
            </div>

            <hr class="my-4">

            <h4 class="candidate-page-subtitle mb-4">Jobs Description</h4>

            <p>{!! $jobDetail['job_requirement'] !!}</p>
        </div>

        <div class="col-lg-4 col-md-12">
            @foreach($job as $data)
            <div class="card card-job-list my-3">
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
            @endforeach
        </div>
    </div>
</div>
@endsection