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
        <div class="fulltime-badge mb-2">Full-time</div>
        <h2 class="candidate-page-title">Pre Sales Solution Architect</h2>
        <div class="modal-fill">
            <div class="d-flex">
                <div class="mr-5">
                    <label for="">Date</label>
                    <p class="mb-0">17 Februari 2021 10:00</p>
                </div>
                <div>
                    <label for="">Duration</label>
                    <p class="mb-0">60 Minutes</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="my-4">
        <h4 class="candidate-page-subtitle mb-3">Choose New Schedule</h4>
        <form action="" class="form-candidate-view">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Date</label>
                        <div class="with-icon">
                            <input type="text" class="form-control" placeholder="Choose date">
                            <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Time</label>
                        <div class="with-icon">
                            <input type="text" class="form-control" placeholder="Choose time">
                            <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-red btn-block">Submit</button>
        </form>
    </div>
</div>
@endsection