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
            @if($job['type'] == 1)
            <div class="fulltime-badge mb-2">Full-time</div>
            @elseif($job['type'] == 2)
            <div class="internship-badge mb-2">Internship</div>
            @endif
            <h2 class="candidate-page-title">{{ $job['job_title'] }}</h2>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-map.svg') }}" alt="icon">
                        </div>
                        <p>{{ $job['lokasi'] }}, Indonesia</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
                        </div>
                        <p>{{ $job['degree'] }}</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
                        </div>
                        <p>{{ $job['education_req'] }}</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-clock.svg') }}" alt="icon">
                        </div>
                        <h6>{{ $job['work_time'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-12">
                    <button class="btn btn-blue btn-block"type="button">Apply Before : <b> {{ date('j F Y', strtotime($job['active_date'])) }}</b></button>
                </div>
                <div class="col-lg-6 col-md-12">
                    <form action="{{ route('post.apply-job') }}" id="formApplyJob" method="POST" ajax="true">
                        <input type="hidden" name="idUser" id="idUser" value="{{ Session::get('session_candidate')['user_id'] }}">
                        <input type="hidden" name="idJob" id="idJob" value="{{ $job['job_id'] }}">
                        <input type="hidden" name="degreeJob" id="degreeJob" value="{{ $job['degree'] }}">
                        <input type="hidden" name="majorJob" id="majorJob" value="{{ $job['major'] }}">
                        <button class="btn btn-red btn-block" type="submit">Apply This Job</button>
                    </form>
                </div>
            </div>

            <hr class="my-4">

            <h4 class="candidate-page-subtitle mb-4">Jobs Description</h4>

            <p>{!! $job['job_requirement'] !!}</p>
        </div>

        <div class="col-lg-4 col-md-12">
            @for($i=0; $i < 3; $i++)
            <div class="card card-job-list my-3">
                <div class="card-body">
                    <div class="internship-badge mb-3">Internship</div>
                    <label class="label-no-margin mb-1">Banten, Indonesia</label>
                    <h4 class="candidate-page-subtitle mb-3">Pre Sales Solution Architect</h4>

                    <div class="d-flex align-items-center job-list-detail mb-1">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
                        </div>
                        <p>Diploma, Bachelor's Degree in Engineering</p>
                    </div>
                    <div class="d-flex align-items-start job-list-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
                        </div>
                        <p>DevOps & Cloud Management Software, Enterprise Resource Planning</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection