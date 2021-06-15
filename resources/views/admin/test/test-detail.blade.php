@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card clear">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-title-page-small">Manage</p>
                            <p class="text-title-page-big">Test Information</p>
                        </div>
                        @if(date('Y-m-d', strtotime($data['date_test'])) != date('Y-m-d'))
                        <div class="col-md-6">
                            <a href="{{route('get.test.edit', base64_encode(urlencode($data['id'])))}}"><button type="button" class="btn btn-white right">Edit Test Information</button></a>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <input type="hidden" id="idData" value="{{$data['id']}}">
                        <div class="col-xl-10 col-md-12" id="divAlternatif">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <p class="title-alternatif title-id">Test ID</p>
                                    <p class="content-alternatif">{{$data['event_id']}}</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="title-alternatif title-date">City</p>
                                    <p class="content-alternatif">{{$data['city']}}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <p class="title-alternatif title-id">Location</p>
                                    <p class="content-alternatif">{{$data['location']}}</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="title-alternatif title-date">Time</p>
                                    <p class="content-alternatif">{{$data['time']}}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <p class="title-alternatif title-id">Date Test</p>
                                    <p class="content-alternatif">{{date('d/m/Y', strtotime($data['date_test']))}}</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="title-alternatif title-date">Longlat</p>
                                    <p class="content-alternatif">{{$data['latlong']}}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <p class="title-alternatif title-id">Set Test</p>
                                    <p class="content-alternatif">{{$data['set_test']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-xl-10 col-md-12" id="divAlternatif">
                            @foreach($alternative as $value)
                                <div class="div-alternatif" id="setAlternatif{{$value['alternative_test_id']}}">
                                    <input type="hidden" name="alternatifTest" class="id-alternatif-test id-check" value="{{$value['alternative_test_id']}}">
                                    <input type="hidden" name="alternatifTestDate" class="id-alternatif-test" value="{{$value['date']}}">
                                    <div class="dropdown-divider mb-4"></div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="title-alternatif title-id">Test Alternative ID</p>
                                            <p class="content-alternatif">{{$value['event_id']}}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="title-alternatif title-date">Date Test Alternative</p>
                                            <p class="content-alternatif">{{date('d/m/Y', strtotime($value['date']))}}</p>
                                        </div>
                                        
                                    </div>
                                    <div class="dropdown-divider mt-4 mb-4"></div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @if(date('Y-m-d', strtotime($data['date_test'])) == date('Y-m-d'))
            <div class="card clear">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{asset('image/icon/main/icon_start_test.svg')}}" alt="">
                        </div>
                        @if($data['status_test'] == 1)
                        <div class="col-md-7">
                            <p class="title-start-test">Start Test to Allow Candidate Login to Mobile Apps</p>
                            <p class="text-start-test">Before that please ensure all candidate absence and receive OTP Code</p>
                        </div>
                        <div class="col-md-4">
                            <form action="{{route('post.start.end.test')}}" class="form stacked form-hr" ajax=true id="formStartTest">
                                <input type="hidden" name="statusStart" value="2">
                                <input type="hidden" name="idStart" value="{{$data['id']}}">
                                <button type="submit" class="btn btn-red right">Start Test</button>
                            </form>
                        </div>
                        @elseif($data['status_test'] == 2)
                        <div class="col-md-7">
                            <p class="title-start-test">Your Test is Ongoing...</p>
                            <p class="text-start-test">The Candidate can login in mobile apps</p>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-white right" data-toggle="modal" data-target="#modalEndTest">End Test</button>
                        </div>
                        @else
                        <div class="col-md-7">
                            <p class="title-start-test">Your Test Schedule is Done</p>
                            <p class="text-start-test">Ended on 12 Maret 2021, 10:00 - 12:00</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            <div class="card clear">
                <div class="card-body">
                    @if($countPart != 0)
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <p class="text-title-page-small">Manage</p>
                                <p class="text-title-page-big">Test Participant</p>
                            </div>
                            <div class="col-md-9">
                                @if($data['status_test'] == 3)
                                    <a class="btn btn-red right" href="{{route('download.result', base64_encode(urlencode($data['id'])))}}">Download Test Result</a>
                                    <button class="btn btn-white right mr-2" type="button" data-toggle="modal" data-target="#modalSendEmail">Send Email Result</button>
                                    
                                @else
                                    @if(date('Y-m-d', strtotime($data['date_test'])) == date('Y-m-d'))
                                        <!-- <button class="btn btn-red right" type="button">Send OTP to All</button> -->
                                        <button class="btn btn-white right mr-2 hidden" id="btnSendOtp" type="button" data-toggle="modal" data-target="#modalSendOtpBulk">Send OTP to Selected Item</button>
                                        <button class="btn btn-white right mr-2 hidden" id="btnSetAbsen" type="button" data-toggle="modal" data-target="#modalSetAbsen">Update Selected Item</button>
                                        <button class="btn btn-white right mr-2 hidden" type="button" id="btnUpdateSet" data-toggle="modal" data-target="#modalSetTest">Update Set Test</button>
                                    @else
                                        <button class="btn btn-red right choose-candidate" type="button">Add Participant</button>
                                        <button class="btn btn-white right mr-2 hidden" type="button" id="btnUpdateSet" data-toggle="modal" data-target="#modalSetTest">Update Set Test</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="countParticipant" name="countParticipant" value=0>
                                
                                @if($data['status_test'] == 3)
                                    <table id="tableParticipantFinish" class="table-hr table table-strip stripe hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>University</th>
                                                <th>Major</th>
                                                <th>Job Position</th>
                                                <th>Job Type</th>
                                                <th>Set Test</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Start Latlong</th>
                                                <th>End Latlong</th>
                                                <th>Kognitif Result</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                @else
                                    @if(date('Y-m-d', strtotime($data['date_test'])) == date('Y-m-d'))
                                    <table id="tableParticipantTestTheDay" class="table-hr table table-strip stripe hover">
                                        <thead>
                                            <tr>
                                                <th class="width-checkbox"><input type="checkbox" id="checkAll"></th>
                                                <th>Name</th>
                                                <th>University</th>
                                                <th>Major</th>
                                                <th>Job Position</th>
                                                <th>Job Type</th>
                                                <th>Set Test</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Start Latlong</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    @else
                                    <table id="tableParticipantTest" class="table-hr table table-strip stripe hover">
                                        <thead>
                                            <tr>
                                                <th class="width-checkbox"></th>
                                                <th>Name</th>
                                                <th>University</th>
                                                <th>Major</th>
                                                <th>Job Position</th>
                                                <th>Job Type</th>
                                                <th>Set Test</th>
                                                <th>City</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <img src="{{asset('image/icon/main/icon_empty_participant.svg')}}" class="img-empty-participant mb-3">
                                    <p class="title-empty-participant mb-2">There is no candidate here</p>
                                    <p class="text-empty-participant mb-4">Please add some candidate to join your test</p>
                                    <button type="button" class="btn btn-red choose-candidate">Add Candidate</button>
                                </center>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('modal')
<div class="modal fade" id="modalChooseCandidate" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-title-page-big pt-2">Choose Candidate</p>
                    </div>
                    <div class="col-md-6">
                        <form action="{{route('post.add.candidate.test')}}" id="formChooseCandidateTest" method="post" ajax="true" class="form stacked">
                            <input type="hidden" id="countChoose" name="countChoose" value="0">
                            <input type="hidden" id="idTest" name="idTest" value="{{$data['id']}}">
                            <div id="divChooseCandidate"></div>
                            <button class="btn btn-red right" id="btnAddCandidateTest">Add Selected Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <table id="tableChooseCandidate" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th class="width-checkbox"></th>
                            <th>Submit Date</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Graduate</th>
                            <th>University</th>
                            <th>Faculty</th>
                            <th>Major</th>
                            <th>GPA</th>
                            <th>Graduate Year</th>
                            <th>Job Position</th>
                            <th>Area</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalSetAbsen" aria-labelledby="modalSetAbsenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3 textItem" ></p>
                <form action="{{route('post.set.absen.participant')}}" class="form stacked form-hr" ajax=true id="updateSetAbsenParticipant">
                    <input type="hidden" id="idSetAbsen" name="idSetAbsen" value="{{$data['id']}}">
                    <div id="listAbsen"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-column">
                                <label>Status</label>
                                <select class="select2 tex-center" id="absenParticipant" name="absenParticipant">
                                    <option value="3">Attend</option>
                                    <option value="4">Absence</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSetTest" aria-labelledby="modalSetTestLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Choose Set Test</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3" id="textItem"></p>
                <form action="{{route('post.set.test.participant')}}" class="form stacked form-hr" ajax=true id="updateSetTestParticipant">
                    <input type="hidden" id="idSetTest" name="idSetTest" value="{{$data['id']}}">
                    <div id="listPart"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="label-set-test">Set Test</label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="hidden" id="valueSet" name="valueSet">
                            @foreach($data['set_test_array'] as $setTest)
                                <button class="btn-answer ml-1 btn-set-test" id="btnPart{{$setTest}}" value="{{$setTest}}" type="button">{{$setTest}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Done</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSetTest" aria-labelledby="modalSetTestLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Choose Set Test</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3" id="textItem"></p>
                <form action="{{route('post.set.test.participant')}}" class="form stacked form-hr" ajax=true id="updateSetTestParticipant">
                    <input type="hidden" id="idSetTest" name="idSetTest" value="{{$data['id']}}">
                    <div id="listPart"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="label-set-test">Set Test</label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="hidden" id="valueSet" name="valueSet">
                            @foreach($data['set_test_array'] as $setTest)
                                <button class="btn-answer ml-1 btn-set-test" id="btnPart{{$setTest}}" value="{{$setTest}}" type="button">{{$setTest}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Done</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEndTest" aria-labelledby="modalEndTestLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">End Test Now?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-4">Are you sure to end test now? Your participants will end the test automatically</p>
                <form action="{{route('post.start.end.test')}}" class="form stacked form-hr" ajax=true id="formStartTest">
                    <input type="hidden" name="statusStart" value="3">
                    <input type="hidden" name="idStart" value="{{$data['id']}}">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">End Test</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReschedule" aria-labelledby="modalRescheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">Reschedule Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-4"><span class="span-reschedule" id="spanName"></span> want reschedule test to <span class="span-reschedule" id="spanDate"></span></p>
                <form action="{{route('post.reschedule')}}" class="form stacked form-hr" ajax=true id="formAccReschedule">
                    <input type="hidden" id="idTestValue" name="idTestValue" value="{{$data['id']}}">
                    <input type="hidden" name="idParticipant" id="idParticipant">
                    <input type="hidden" name="idTestRechedule" id="idTestRechedule">
                    <input type="hidden" name="valueBtn" id="valueBtn">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <button type="submit" class="btn btn-red w-100 btn-confirm" value="confirm">Confirm</button>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-green w-100 btn-confirm" value="decline">Decline Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSendOtpBulk" aria-labelledby="modalSendOtpBulkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Send OTP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3 textItem"></p>
                <form action="{{route('post.send.otp.bulk')}}" class="form stacked form-hr" ajax=true id="formSendOTPBulk">
                    <input type="hidden" id="idSetAbsen" name="idSetAbsen" value="{{$data['id']}}">
                    <input type="hidden" id="countSend" name="countSend">
                    <div id="listSendOtp"></div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Send OTP</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSendEmail" aria-labelledby="modalSendEmailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Send Email Result</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-4"><span class="span-reschedule" id="spanName">Are you sure for send email result ?</span></span></p>
                <form action="{{route('post.send.email.result')}}" class="form stacked form-hr" ajax=true id="formSendEmailResult">
                    <input type="hidden" id="idSendResult" name="idSendResult" value="{{$data['id']}}">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Send Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection