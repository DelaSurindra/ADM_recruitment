@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="breadcrumb-candidate">
        <a class="bread active" href="#">My Application</a>
        <a class="bread active" href="#">/Pre Sales Solution Architect</a>
        <p class="bread">/Interview Reschedule</p>
    </div>
    <h2 class="candidate-page-title">Interview Reschedule</h2>

    <hr class="margin-top-6rem">

    <div class="my-4">
        <div class="fulltime-badge mb-2">{{$vacancy['type'] == "1" ? "Full Time" : "Intership"}}</div>
        <h2 class="candidate-page-title">{{$vacancy['job_title']}}</h2>
        <div class="modal-fill">
            <div class="d-flex">
                <div class="mr-5">
                    <label for="">Date</label>
                    <p class="mb-0">{{date("d M Y", strtotime($interview['interview_date']))}}</p>
                </div>
                <div>
                    <label for="">Time</label>
                    <p class="mb-0">{{$interview['time']}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-4">
        <h4 class="candidate-page-subtitle mb-3">Choose New Schedule</h4>
        <form action="{{route('post.reschedule.interview')}}" class="form-candidate-view" ajax="true" id="formRescheduleInterview">
            <input type="hidden" name="idInterview" value="{{$interview['id']}}">
            <input type="hidden" name="countInterview" value="{{$interview['reshedule_count']}}">
            <input type="hidden" id="idJob" name="idJob" value="{{$job['id']}}">
            <div class="row mb-3">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Date</label>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="with-icon">
                                    <input type="text" class="form-control" placeholder="Choose date" name="dateStart" id="dateStart">
                                    <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <img src="{{asset('image/icon/homepage/icon-until.svg')}}" alt="" class="mt-3">
                            </div>
                            <div class="col-md-5">
                                <div class="with-icon">
                                    <input type="text" class="form-control" placeholder="Choose date" name="dateEnd" id="dateEnd">
                                    <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Time</label>
                        <div class="row">
                            <div class="col-md-5" id="timeStartDiv">
                                <select name="timeStart" id="timeStart" class="select2 form-control">
                                    <option value="">Choose time</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <img src="{{asset('image/icon/homepage/icon-until.svg')}}" alt="" class="mt-3">
                            </div>
                            <div class="col-md-5" id="timeEndDiv">
                                <select name="timeEnd" id="timeEnd" class="select2 form-control">
                                    <option value="">Choose time</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-red btn-block">Submit</button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection