@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="text-title-page-small">Detail</p>
                        <p class="text-title-page-big">Candidate & Job Applied Information</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-md-12">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="img" class="img-fluid img-profile-detail">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Name</p>
                                <p class="content-alternatif">Ronald Richards</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Job Position</p>
                                <p class="content-alternatif">Marketing Coordinator</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">University</p>
                                <p class="content-alternatif">Universitas Indonesia</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Major</p>
                                <p class="content-alternatif">International Relations</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="text-title-page-small">Detail</p>
                        <p class="text-title-page-big">Test Information</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-md-12">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Test ID</p>
                                <p class="content-alternatif">A1D123</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">City</p>
                                <p class="content-alternatif">Surabaya</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Location</p>
                                <p class="content-alternatif">4140 Parker Rd. Allentown, New Mexico 31134</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Time</p>
                                <p class="content-alternatif">10:00 - 12:00</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Date Test</p>
                                <p class="content-alternatif">12 Maret 2021</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Test Longlat</p>
                                <p class="content-alternatif">6° 35' 51.4644'' S</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Set Test</p>
                                <p class="content-alternatif">1, 2, 4</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Start Latlong</p>
                                <p class="content-alternatif">6° 35' 51.4644'' S</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">End Latlong</p>
                                <p class="content-alternatif">6° 35' 51.4644'' S</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="text-title-page-small">Test Result</p>
                        <p class="text-title-page-big">Kognitif</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="text-title-page-small">Test Result</p>
                        <p class="text-title-page-big">Inventory</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection