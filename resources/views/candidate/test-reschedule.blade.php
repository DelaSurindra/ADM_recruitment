@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="breadcrumb-candidate">
        <a class="bread active" href="#">My Application</a>
        <a class="bread active" href="#">/Pre Sales Solution Architect</a>
        <p class="bread">/Online Test Reschedule</p>
    </div>
    <h2 class="candidate-page-title">Online Test Reschedule</h2>

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
        <form action="">
            <input type="radio">
            <button class="btn btn-red btn-block">Submit</button>
        </form>
    </div>
</div>
@endsection