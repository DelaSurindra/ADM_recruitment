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
            <div class="fulltime-badge mb-2">Full-time</div>
            <h2 class="candidate-page-title">Pre Sales Solution Architect</h2>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-map.svg') }}" alt="icon">
                        </div>
                        <p>Banten, Indonesia</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
                        </div>
                        <p>Diploma, Bachelor's Degree in Engineering</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
                        </div>
                        <p>DevOps & Cloud Management Software, Enterprise Resource Planning</p>
                    </div>
                    <div class="d-flex align-items-center applican-detail">
                        <div class="icon-wrapper">
                            <img src="{{ asset('image/icon/homepage/icon-clock.svg') }}" alt="icon">
                        </div>
                        <h6>Sunday - Saturday 08:00 - 16:00</h6>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-12">
                    <button class="btn btn-blue btn-block"type="button">Apply Before : <b> 12 February 2021</b></button>
                </div>
                <div class="col-lg-6 col-md-12">
                    <form action="{{ route('post.apply-job') }}" id="formApplyJob" method="POST" ajax="true">
                        <input type="hidden" name="idUser" id="idUser" value="{{ Session::get('session_candidate')['user_id'] }}">
                        <button class="btn btn-red btn-block" type="submit">Apply This Job</button>
                    </form>
                </div>
            </div>

            <hr class="my-4">

            <h4 class="candidate-page-subtitle mb-4">Application History</h4>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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