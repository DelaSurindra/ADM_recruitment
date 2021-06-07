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
    @if($job['status'] == '2')
    <div class="col-lg-5 col-md-12">
        <button class="btn btn-home-color btn-block"type="button" data-toggle="modal" data-target="#modalOnlineTest">Check Online Test</button>
    </div>
    @endif
    @if($job['status'] == '5' || $job['status'] == '6' || $job['status'] == '7' || $job['status'] == '8' || $job['status'] == '9' || $job['status'] == '10')
    <div class="col-lg-5 col-md-12">
        <button class="btn btn-home-color btn-block"type="button" data-toggle="modal" data-target="#modalOnlineInterview">Check Online Interview</button>
    </div>
    @endif
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
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['user_interview3'] != [] || $history['user_interview2'] != [] || $history['user_interview1'] != [] || $history['hr_interview'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['user_interview3'] != [] || $history['user_interview2'] != [] || $history['user_interview1'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['user_interview3'] != [] || $history['user_interview2'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['user_interview3'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif

                    @if($history['document_sign'] != [] || $history['mcu'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif
                    @if($history['document_sign'] != [])
                        <div class="green-line"></div>
                    @else
                        <div class="gray-line"></div>
                    @endif
                </div>
                <div class="track-applican">
                    <div class="track-item {{ $history['apply'] != [] ? 'active' : '' }}">
                        <img src="{{$history['apply'] != [] ? asset('image/icon/homepage/track/track-resume-red.svg') : asset('image/icon/homepage/track/track-resume.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Resume Application</p>
                            @if($history['apply'] != [])
                            <p class="subtitle">{{last($history['apply'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                            <div class="track-status success"><p class="success">Success</p></div>
                        </div>
                    </div>
                    <div class="track-item {{ $history['online_test'] != [] ? 'active' : '' }}">
                        <img src="{{$history['online_test'] != [] ? asset('image/icon/homepage/track/track-online-test-red.svg') : asset('image/icon/homepage/track/track-online-test.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Online Test </p>
                            @if($history['online_test'] != [])
                            <p class="subtitle">{{last($history['online_test'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                            @if($status['status_online_test'] != '')
                            <div class="track-status {{$status['status_online_test']}}"><p class="{{$status['status_online_test']}}">{{ucfirst($status['status_online_test'])}}</p></div>
                            @endif
                        </div>
                    </div>
                    <div class="track-item {{ $history['hr_interview'] != [] ? 'active' : '' }}">
                        <img src="{{$history['hr_interview'] != [] ? asset('image/icon/homepage/track/track-hr-interview-red.svg') : asset('image/icon/homepage/track/track-hr-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">HR Interview</p>
                            @if($history['hr_interview'] != [])
                            <p class="subtitle">{{last($history['hr_interview'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                            @if($status['status_hr_interview'] != '')
                            <div class="track-status {{$status['status_hr_interview']}}"><p class="{{$status['status_hr_interview']}}">{{ucfirst($status['status_hr_interview'])}}</p></div>
                            @endif
                        </div>
                    </div>
                    <div class="track-item {{ $history['user_interview1'] != [] ? 'active' : '' }}">
                        <img src="{{$history['user_interview1'] != [] ? asset('image/icon/homepage/track/track-user-interview-red.svg') : asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">User Interview 1</p>
                            @if($history['user_interview1'] != [])
                            <p class="subtitle">{{last($history['user_interview1'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                            @if($status['status_user_interview1'] != '')
                            <div class="track-status {{$status['status_user_interview1']}}"><p class="{{$status['status_user_interview1']}}">{{ucfirst($status['status_user_interview1'])}}</p></div>
                            @endif
                        </div>
                    </div>
                    <div class="track-item {{ $history['user_interview2'] != [] ? 'active' : '' }}">
                        <img src="{{$history['user_interview2'] != [] ? asset('image/icon/homepage/track/track-user-interview-red.svg') : asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">User Interview 2</p>
                            @if($history['user_interview2'] != [])
                            <p class="subtitle">{{last($history['user_interview2'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                            @if($status['status_user_interview2'] != '')
                            <div class="track-status {{$status['status_user_interview2']}}"><p class="{{$status['status_user_interview2']}}">{{ucfirst($status['status_user_interview2'])}}</p></div>
                            @endif
                        </div>
                    </div>
                    <div class="track-item {{ $history['user_interview3'] != [] ? 'active' : '' }}">
                        <img src="{{$history['user_interview3'] != [] ? asset('image/icon/homepage/track/track-user-interview-red.svg') : asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">User Interview 3</p>
                            @if($history['user_interview3'] != [])
                            <p class="subtitle">{{last($history['user_interview3'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                            @if($status['status_user_interview3'] != '')
                            <div class="track-status {{$status['status_user_interview3']}}"><p class="{{$status['status_user_interview3']}}">{{ucfirst($status['status_user_interview3'])}}</p></div>
                            @endif
                        </div>
                    </div>
                    <div class="track-item {{ $history['mcu'] != [] ? 'active' : '' }}">
                        <img src="{{$history['mcu'] != [] ? asset('image/icon/homepage/track/track-medical-checkup-red.svg') : asset('image/icon/homepage/track/track-medical-checkup.svg') }}" alt="icon">
                        <div class="track-text">
                            <p class="title">Medical Checkup</p>
                            @if($history['mcu'] != [])
                            <p class="subtitle">{{last($history['mcu'])}}</p>
                            @else
                            <p class="subtitle"></p>
                            @endif
                            @if($status['status_mcu'] != '')
                            <div class="track-status {{$status['status_mcu']}}"><p class="{{$status['status_mcu']}}">{{ucfirst($status['status_mcu'])}}</p></div>
                            @endif
                        </div>
                    </div>
                    <div class="track-item {{ $history['document_sign'] != [] ? 'active' : '' }}">
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
<div class="modal fade" id="modalOnlineTest" aria-labelledby="modalOnlineTestLabel" aria-hidden="true">
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
                    <h6>{{$vacancy['job_title']}}</h6>
                    <p>{{$vacancy['lokasi']}}, Indonesia</p>
                </div>

                <div class="modal-fill">
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="">Date</label>
                            <p class="mb-0">{{isset($test[0]) ? date('d M y', strtotime($test[0]['date_test'])) : ''}}</p>
                        </div>
                        <div>
                            <label for="">Time</label>
                            <p class="mb-0">{{isset($test[0]) ? $test[0]['time'] : ''}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="">City</label>
                            <p class="mb-0">{{isset($test[0]) ? $test[0]['city'] : ''}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <label for="">Location</label>
                            <p class="mb-0">{{isset($test[0]) ? $test[0]['location'] : ''}}</p>
                        </div>
                    </div>
                    @if(isset($test[0]))
                        @if($test[0]['status_participant'] == 0 || $test[0]['status_participant'] == 2 || $test[0]['status_participant'] == 7)
                            @if(date('Y-m-d', strtotime($test[0]['date_test'])) < date('Y-m-d'))
                            <form action="{{route('post.confirm.test')}}" class="form stacked form-hr" ajax=true id="formConfirmTest">
                                <input type="hidden" name="idParticipant" value="{{$test[0]['id_participant']}}">
                                <input type="hidden" name="idJob" value="{{$job['id']}}">
                                <button type="submit" class="btn btn-home-color btn-block">Confirmation</button>
                            </form>
                            <a href="{{route('get.profile.test-reschedule', base64_encode(urlencode($job['id'])))}}" class="a-rescehdule"><button class="btn btn-white btn-block mt-2">Reschedule Test</button></a>
                            @endif
                        @endif
                    @endif
                </div>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalOnlineInterview" aria-labelledby="modalOnlineInterviewLabel" aria-hidden="true">
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
                    <h6>{{$vacancy['job_title']}}</h6>
                    <p>{{$vacancy['lokasi']}}, Indonesia</p>
                </div>

                <div class="modal-fill">
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="">Date</label>
                            <p class="mb-0">{{ isset($interview[0]['interview_date']) ? date('d M y', strtotime($interview[0]['interview_date'])) : '' }}</p>
                        </div>
                        <div>
                            <label for="">Time</label>
                            <p class="mb-0">{{ isset($interview[0]['time']) ? $interview[0]['time'] : '' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="">City</label>
                            <p class="mb-0">{{isset($interview[0]['city']) ? $interview[0]['city'] : ''}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <label for="">Location</label>
                            <p class="mb-0">{{isset($interview[0]['location']) ? $interview[0]['location'] : ''}}</p>
                        </div>
                    </div>
                    @if(isset($interview[0]['status']))
                        @if($interview[0]['status'] == 1 || $interview[0]['status'] == 5)
                        <form action="{{route('post.confirm.interview')}}" class="form stacked form-hr" ajax=true id="formConfirmInterview">
                            <input type="hidden" name="idInterview" value="{{isset($interview[0]['id']) ? $interview[0]['id'] : ''}}">
                            <input type="hidden" name="idJob" value="{{$job['id']}}">
                            <button type="submit" class="btn btn-home-color btn-block">Confirmation</button>
                        </form>
                        <a href="{{route('get.profile.interview-reschedule', base64_encode(urlencode($job['id'])))}}" class="a-rescehdule"><button class="btn btn-white btn-block mt-2">Reschedule Test</button></a>
                        @endif
                    @endif
                </div>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
@endsection