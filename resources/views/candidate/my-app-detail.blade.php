@extends('candidate.profile')
@section('profile')
    @include('candidate.profile-home')
@endsection

@section('app')
<div class="breadcrumb-candidate">
    <a class="bread active" href="#">My Application</a>
    <p class="bread">/Pre Sales Solution Architect</p>
</div>
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
    <div class="col-lg-7 col-md-12 d-flex align-items-center">
        <p class="last-update-detail">Last Updated : <span>12 February 2021 18:02</span></p>
    </div>
    <div class="col-lg-5 col-md-12">
        <button class="btn btn-red btn-block"type="button" data-toggle="modal" data-target="#modalOnlineTest">Check Online Test</button>
    </div>
</div>

<hr class="my-4">

<div class="accordion accordion-applican-detail" id="accordionExample">
    <div class="card-accordion">
        <div class="card-accordion-head" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h4 class="candidate-page-subtitle mb-0">Application History</h4>
            <i class="fas fa-chevron-up"></i>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-accordion-body">
                <div class="track-applican-line">
                    <div class="green-line"></div>
                    <div class="gray-line long"></div>
                    <div class="gray-line"></div>
                    <div class="gray-line"></div>
                    <div class="gray-line"></div>
                </div>
                <div class="track-applican">
                    <div class="track-item active">
                        <img src="{{ asset('image/icon/homepage/track/track-resume-red.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Resume Application</p>
                            <p class="subtitle">2 February 2021 18:02</p>
                            <div class="track-status red">Success</div>
                        </div>
                    </div>
                    <div class="track-item active">
                        <img src="{{ asset('image/icon/homepage/track/track-online-test-red.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Online Test </p>
                            <p class="subtitle">2 February 2021 18:02</p>
                            <div class="track-status yellow">Need to Check</div>
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{ asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">User Interview</p>
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{ asset('image/icon/homepage/track/track-hr-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">HR Interview</p>
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{ asset('image/icon/homepage/track/track-medical-checkup.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Medical Checkup</p>
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{ asset('image/icon/homepage/track/track-document-sign.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Document Sign and Contract</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-accordion">
        <div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <h4 class="candidate-page-subtitle mb-0">Job Description</h4>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-accordion-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modalOnlineTest" tabindex="-1" aria-labelledby="modalOnlineTestLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm modal-online-test">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="candidate-page-subtitle mb-0">Online Test<br>Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>

                <div class="modal-card mb-3">
                    <h6>Pre Sales Solution Architect</h6>
                    <p>Banten, Indonesia</p>
                </div>

                <div class="modal-fill">
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="">Date</label>
                            <p class="mb-0">17 Februari 2021 10:00</p>
                        </div>
                        <div>
                            <label for="">Duration</label>
                            <p class="mb-0">60 Minutes</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <label for="">Your Login ID</label>
                            <h6 class="mb-0">KKJH99NND9SS</h6>
                        </div>
                        <img class="image-copy" src="{{ asset('image/icon/homepage/icon-copy.svg') }}" alt="icon">
                    </div>
                    <hr>
                    <p class="text-center mb-4">Copy your login ID to take the test later</p>

                    <button class="btn btn-red btn-block">Confirmation</button>
                    <button class="btn btn-white btn-block">Reschedule Test</button>
                </div>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
@endsection