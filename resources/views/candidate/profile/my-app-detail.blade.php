@extends('candidate.profile.profile')
@section('profile')
    @include('candidate.profile.profile-home')
@endsection

@section('app')
<div class="breadcrumb-candidate">
    <a class="bread active" href="{{ route('get.profile.my-app') }}">My Application</a>
    <p class="bread">&nbsp/ Pre Sales Solution Architect</p>
</div>
<div class="fulltime-badge mb-2">{{$vacancy["type"] == "1" ? "Full-time":"Intership"}}</div>
<h2 class="candidate-page-title">{{$vacancy['job_title']}}</h2>
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex align-items-center applican-detail">
            <div class="icon-wrapper">
                <img src="{{ asset('image/icon/homepage/icon-map.svg') }}" alt="icon">
            </div>
            <p>{{$vacancy['lokasi']}}, Indonesia</p>
        </div>
        <div class="d-flex align-items-center applican-detail">
            <div class="icon-wrapper">
                <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
            </div>
            @if($vacancy['degree'] == '1')
                <p>Diploma's Degree</p>
            @elseif($vacancy['degree'] == '2')
                <p>Bachelor's Degree</p>
            @else
                <p>Master's Degree</p>
            @endif
        </div>
        <div class="d-flex align-items-center applican-detail">
            <div class="icon-wrapper">
                <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
            </div>
            <p>{{$vacancy['major']}}</p>
        </div>
        <div class="d-flex align-items-center applican-detail">
            <div class="icon-wrapper">
                <img src="{{ asset('image/icon/homepage/icon-clock.svg') }}" alt="icon">
            </div>
            <h6>{{$vacancy['work_time']}}</h6>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-7 col-md-12 d-flex align-items-center">
        
        <p class="last-update-detail">Last Updated : <span>{{$history['last_update']}}</span></p>
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
                    @if($history['online_test'] != [])
                        <div class="green-line long"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['user_interview'] != [] || $history['hr_interview'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['user_interview'] != [])
                        <div class="green-line long"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [])
                        <div class="green-line long"></div>
                    @else
                        <div class="gray-line long"></div>
                    @endif
                </div>
                <div class="track-applican">
                    <div class="track-item">
                        <img src="{{$history['apply'] != [] ? asset('image/icon/homepage/track/track-resume-red.svg') : asset('image/icon/homepage/track/track-resume.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Resume Application</p>
                            @if($history['apply'] != [])
                            <p class="subtitle">{{last($history['apply'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{$history['online_test'] != [] ? asset('image/icon/homepage/track/track-online-test-red.svg') : asset('image/icon/homepage/track/track-online-test.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Online Test </p>
                            @if($history['online_test'] != [])
                            <p class="subtitle">{{last($history['online_test'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{$history['hr_interview'] != [] ? asset('image/icon/homepage/track/track-hr-interview-red.svg') : asset('image/icon/homepage/track/track-hr-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">HR Interview</p>
                            @if($history['hr_interview'] != [])
                            <p class="subtitle">{{last($history['hr_interview'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{$history['user_interview'] != [] ? asset('image/icon/homepage/track/track-user-interview-red.svg') : asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">User Interview</p>
                            @if($history['user_interview'] != [])
                            <p class="subtitle">{{last($history['user_interview'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{$history['mcu'] != [] ? asset('image/icon/homepage/track/track-medical-checkup-red.svg') : asset('image/icon/homepage/track/track-medical-checkup.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Medical Checkup</p>
                            @if($history['mcu'] != [])
                            <p class="subtitle">{{last($history['mcu'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                        </div>
                    </div>
                    <div class="track-item">
                        <img src="{{$history['document_sign'] != [] ? asset('image/icon/homepage/track/track-document-sign-red.svg') : asset('image/icon/homepage/track/track-document-sign.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Document Sign and Contract</p>
                            @if($history['document_sign'] != [])
                            <p class="subtitle">{{last($history['document_sign'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
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
                {!! $vacancy['job_requirement'] !!}
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