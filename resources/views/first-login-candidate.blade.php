@extends('main-homepage.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <h2 class="candidate-page-title">Complete Your<br>Account</h2>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="tracking-form-first-login" style="border:1px solid black">
                <div class="icon-tracking-wrapper personal-information mx-4">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-user-red.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p>Personal<br>Information</p>
                    </div>
                </div>
                <div class="icon-tracking-wrapper education-information mx-4">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-toga.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p>Education<br>Information</p>
                    </div>
                </div>
                <div class="icon-tracking-wrapper other-information mx-4">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-pin.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p>Other<br>Information</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection