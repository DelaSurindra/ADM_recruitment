@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div style="margin:20px 0px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red active" id="detailCandidate1-tab" data-toggle="tab" href="#detailCandidate1" role="tab" aria-controls="detailCandidate1" aria-selected="true">Candidate Information</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red" id="detailCandidate2-tab" data-toggle="tab" href="#detailCandidate2" role="tab" aria-controls="detailCandidate2" aria-selected="false">Recruitment Result</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="detailCandidate1" role="tabpanel" aria-labelledby="detailCandidate1-tab">
            <div class="card card-detail-candidate">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-title-page-small">View</p>
                                    <p class="text-title-page-big">Personal Information</p>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="col-md-12">
                                    <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="img" class="img-fluid img-profile-detail">
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">First Name</label>
                                    <p class="detail">Sahadi</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Last Name</label>
                                    <p class="detail">Ilaihi Zamani</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Date of Birth</label>
                                    <p class="detail">17 Agustus 2020</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Gender</label>
                                    <p class="detail">Male</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Email</label>
                                    <p class="detail">sahadilalalhi@gmail.com</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Phone Number</label>
                                    <p class="detail">081234567899</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Location</label>
                                    <p class="detail">Surabaya, East Java</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Linkedin Profile</label>
                                        <p class="detail">www.linkedin.com/example</p>
                                    </div>
                                    <a href="#">
                                        <img class="image-copy" src="{{ asset('image/icon/homepage/icon-copy.svg') }}" alt="icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-detail-candidate">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <p class="text-title-page-small">View</p>
                                    <p class="text-title-page-big">Education Information</p>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">School/University</label>
                                    <p class="detail">UPN “Veteran” Jawa Timur</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Degree</label>
                                    <p class="detail">S1</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Faculty</label>
                                    <p class="detail">Computer Science Faculty</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Major</label>
                                    <p class="detail">Informatic Engineering</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Education Year</label>
                                    <p class="detail">2015 - 2019</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">GPA</label>
                                    <p class="detail">3,5</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Certificate of Study</label>
                                        <p class="detail">ijazahupn.jpg</p>
                                    </div>
                                    <a href="#">
                                        <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                    </a>
                                </div>

                                <div class="col-12">
                                    <hr class="divider">
                                </div>

                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">School/University</label>
                                    <p class="detail">UPN “Veteran” Jawa Timur</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Degree</label>
                                    <p class="detail">S1</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Faculty</label>
                                    <p class="detail">Computer Science Faculty</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Major</label>
                                    <p class="detail">Informatic Engineering</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Education Year</label>
                                    <p class="detail">2015 - 2019</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">GPA</label>
                                    <p class="detail">3,5</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Certificate of Study</label>
                                        <p class="detail">ijazahupn.jpg</p>
                                    </div>
                                    <a href="#">
                                        <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-detail-candidate">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <p class="text-title-page-small">View</p>
                                    <p class="text-title-page-big">Other Information</p>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Cover Letter</label>
                                    <p class="detail text-red">No Data</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Resume</label>
                                        <p class="detail">Resume2020.jpg</p>
                                    </div>
                                    <a href="#">
                                        <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                    </a>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Portofolio</label>
                                        <p class="detail">Porto2020.jpg</p>
                                    </div>
                                    <a href="#">
                                        <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                    </a>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Skill</label>
                                    <p class="detail">Editing, After Effect, Design, Public Speaking</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="detailCandidate2" role="tabpanel" aria-labelledby="detailCandidate2-tab">
            <div class="card">
                <div class="card-body">
                    aaaa
                </div>
            </div>
        </div>
    </div>
</div>

@endsection