@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{ route('post.interview.edit') }}" class="form stacked form-hr" method="POST" id="formEditInterview" ajax="true">
    @csrf
    <input type="hidden" name="idInterview" value="{{$interview['id']}}">
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Edit</p>
                    <p class="text-title-page-big">Status Interview</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="title-alternatif title-id">Status</p>
                    <p class="content-alternatif">{{$interview['status_interview']}}</p>
                </div>
                <div class="col-md-4">
                    @if($interview['status'] == "4")
                    <button type="button" class="btn-detail-interview mt-3" data-toggle="modal" data-target="#modalAcceptReschedule" id="btnAccInterview"><img src="{{asset('image/icon/main/icon_update_status.svg')}}" >&nbsp Update Status</button>
                    <input type="hidden" id="maxDate" value="{{date('d F Y', strtotime($interview['date_end']))}}">
                    <input type="hidden" id="minDate" value="{{date('d F Y', strtotime($interview['date_start']))}}">
                    <button type="button" class="btn-detail-interview mt-3" data-toggle="modal" data-target="#modalDeclineReschedule"><img src="{{asset('image/icon/main/delete_red.svg')}}" alt="">&nbsp Decline Reschedule</button>
                    @elseif($interview['status'] == "1" || $interview['status'] == "5")
                    <button type="button" class="btn-detail-interview mt-3" data-toggle="modal" data-target="#modalUpdateStatus"><img src="{{asset('image/icon/main/icon_update_status.svg')}}">&nbsp Update Status</button>
                    @else
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-10">
                    <div class="dropdown-divider"></div>
                </div>
            </div>
            <div class="row mb-3">
                @if($interview['status'] == "4")
                <div class="col-md-5">
                    <p class="title-alternatif title-id">Reschedule Date to</p>
                    <p class="content-alternatif">{{date('d F Y', strtotime($interview['date_start']))}} - {{date('d F Y', strtotime($interview['date_end']))}}</p>
                </div>
                <div class="col-md-4">
                    <p class="title-alternatif title-id">Reschedule Time to</p>
                    <p class="content-alternatif">{{$interview['time_start']}} - {{$interview['time_end']}}</p>
                </div>
                @else
                <div class="col-md-6">
                    <p class="title-alternatif title-id">Notes</p>
                    <p class="content-alternatif">{{$interview['note']}}</p>
                </div>
                @endif
            </div>
            <div class="row mb-3">
                <div class="col-md-10">
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Edit</p>
                    <p class="text-title-page-big">Interview Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="typeInterviewDiv">
                                    <label>Interview Type<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="typeInterview" name="typeInterview" disabled>
                                        <option value="">-- Pilih Type --</option>
                                        @foreach($interviewType as $dataType)
                                            <option value="{{$dataType['id']}}" {{$interview['type_id'] == $dataType['id'] ? 'selected' : ''}}>{{$dataType['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($interview['type_id'] != "5" || $interview['type_id'] != "6")
                                <div class="col-xl-6 col-md-6 col-sm-12" id="lastInterviewDiv">
                                    <div class="d-flex align-items-center mt-4">
                                        <label class="container-custom-checked mb-0 mr-3"> Last Interview
                                            <input type="checkbox" name="lastInterview" id="lastInterview" value="1" {{$interview['disabled']}}>
                                            <span class="checkmark"></span>
                                        </label>
                                        
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="locationVacancyDiv">
                                    <div class="form-group" >
                                        <label>Interview Date<span class="required-sign">*</span></label>
                                        <input id="dateInterview" name="dateInterview" class="form-control" type="text" placeholder="Choose Date" value="{{date('d-m-Y', strtotime($interview['interview_date']))}}" {{$interview['disabled']}}>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Time<span class="required-sign">*</span></label>
                                        <input id="timeInterview" name="timeInterview" class="form-control" type="text" placeholder="00:00 - 23-59" value="{{$interview['time']}}" {{$interview['disabled']}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-location">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <label>Location<span class="required-sign">*</span></label>
                                    <textarea name="locationInterview" id="locationInterview" class="form-control" placeholder="Enter Location" {{$interview['disabled']}}>{{$interview['location']}}</textarea>
                                    
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>City<span class="required-sign">*</span></label>
                                        <select class="select2 tex-center select2-width" id="cityInterview" name="cityInterview" {{$interview['disabled']}}>
                                            <option value="">-- Choose Location --</option>
                                            @foreach($wilayah as $dataWilayah)
                                                <option {{$interview['city'] == $dataWilayah['kabupaten'] ? 'selected':''}} value="{{$dataWilayah['kabupaten']}}">{{$dataWilayah['kabupaten']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>Interviewer<span class="required-sign">*</span></label>
                                        <input id="interviewer" name="interviewer" class="form-control" type="text" placeholder="Enter Interviewer" {{$interview['disabled']}} value="{{$interview['interviewer']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Detail</p>
                    <p class="text-title-page-big">Interview Participant</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="title-alternatif title-id">Nama</p>
                    <p class="content-alternatif">{{$kandidat['first_name']}} {{$kandidat['last_name']}}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-5">
                    <p class="title-alternatif title-id">Gender</p>
                    <p class="content-alternatif">{{$kandidat['gender'] == "1" ? "Male" : "Female"}}</p>
                </div>
                <div class="col-md-4">
                    <p class="title-alternatif title-id">Phone</p>
                    <p class="content-alternatif">{{$kandidat['telp']}}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-5">
                    <p class="title-alternatif title-id">City</p>
                    <p class="content-alternatif">{{$kandidat['kota']}}</p>
                </div>
                <div class="col-md-4">
                    <p class="title-alternatif title-id">Job Title</p>
                    <p class="content-alternatif">{{$kandidat['job_title']}}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="title-alternatif title-id">Status</p>
                    <p class="content-alternatif">{{$kandidat['status_user']}}</p>
                </div>
            </div>
        </div>
    </div>
    @if($interview['status'] == "1" || $interview['status'] == "4" || $interview['status'] == "5")
    <div class="row">
        <div class="col-xl-12 col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-red w-100">Save</button>
        </div>
    </div>
    @endif
</form>
    
@endsection

@section('modal')
<div class="modal fade" id="modalUpdateStatus" aria-labelledby="modalUpdateStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3" class="textItem"></p>
                <form action="{{route('post.update.status.interview')}}" class="form stacked form-hr" ajax=true id="updateStatusInterview">
                    <input type="hidden" id="idUpdateStatus" name="idUpdateStatus" value="{{$interview['id']}}">
                    <input type="hidden" id="idJobApp" name="idJobApp" value="{{$interview['id_job_application']}}">
                    <input type="hidden" id="statusJobApp" name="statusJobApp" value="{{$kandidat['status']}}">
                    <input type="hidden" id="idKandidat" name="idKandidat" value="{{$kandidat['kandidat_id']}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-column">
                                <label>Status</label>
                                <select class="select2 tex-center" id="statusInterview" name="statusInterview">
                                    <option value="2">Pass</option>
                                    <option value="3">Fail</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row row-location">
                        <div class="col-md-12">
                            <label>Reason<span class="required-sign">*</span></label>
                            <textarea name="noteInterview" id="noteInterview" class="form-control" placeholder="Enter Note"></textarea>
                        </div>
                    </div>
                    <div class="row hidden" id="divFail">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="custome-radio-wrapper mb-2 mr-4"> Dapat lanjut ketahap berikutnya
                                    <input type="radio" name="statusFail" id="statusFail1" value="1" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custome-radio-wrapper mb-0"> Dinyatakan gagal
                                    <input type="radio" name="statusFail" id="statusFail2" value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeclineReschedule" aria-labelledby="modalDeclineRescheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">Decline Request</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-4"><span class="span-reschedule" id="spanName"></span> want reschedule test to <span class="span-reschedule" id="spanDate">{{$kandidat['first_name']}} {{$kandidat['last_name']}}</span></p>
                <form action="{{route('post.decline.interview')}}" class="form stacked form-hr" ajax=true id="formDeclineInterview">
                    <input type="hidden" name="idDecline" value="{{$interview['id']}}">
                    <input type="hidden" name="idReschedule" value="{{$interview['id_reschedule']}}">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100 btn-confirm" value="decline">Yes, Declined</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAcceptReschedule" aria-labelledby="modalAcceptRescheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <form action="{{route('post.acc.interview')}}" class="form stacked form-hr" ajax=true id="formAccInterview">
                    <input type="hidden" name="idAcc" value="{{$interview['id']}}">
                    <input type="hidden" name="idReschedule" value="{{$interview['id_reschedule']}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" >
                                <label>Choose Date<span class="required-sign">*</span></label>
                                <input id="dateAccInterview" name="dateAccInterview" class="form-control" type="text" placeholder="Choose Date">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Time<span class="required-sign">*</span></label>
                                <input id="timeAccInterview" name="timeAccInterview" class="form-control" type="text" placeholder="{{$interview['time_start']}} - {{$interview['time_end']}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100 btn-confirm" value="decline">Create New Schedule</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
