@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div class="nav flex-column nav-pills tabs-edit-profile" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                    <img src="{{ asset('image/icon/homepage/edit-profile-icon.svg') }}" alt="icon"> Edit Profile
                </a>
                <div class="divider-nav-link"></div>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                    <img src="{{ asset('image/icon/homepage/edit-password-icon.svg') }}" alt="icon"> Edit Password
                </a>
                <div class="divider-nav-link"></div>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                    <img src="{{ asset('image/icon/homepage/myapp-icon.svg') }}" alt="icon"> My Application
                </a>
                <div class="divider-nav-link"></div>
                <a class="nav-link" href="#">
                    <img src="{{ asset('image/icon/homepage/logout-icon.svg') }}" alt="icon"> Logout
                </a>
            </div>
        </div>
        <div class="col-lg-9 col-md-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    @yield('profile')
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    @include('candidate.edit-password')
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    @yield('app')
                </div>
            </div>
        </div>
    </div>
</div>