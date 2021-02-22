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
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                    <img src="{{ asset('image/icon/homepage/logout-icon.svg') }}" alt="icon"> Logout
                </a>
            </div>
        </div>
        <div class="col-lg-9 col-md-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <h2 class="candidate-page-title">Edit Profile</h2>
                    <div class="row mt-4">
                        <div class="col-lg-7 col-md-12">
                            <div class="wrapper-card-edit-profile d-flex align-items-center justify-content-between">
                                <h4 class="candidate-page-subtitle mb-0">Personal Information</h4>
                                <a href="#" class="edit-text d-flex align-items-center mr-1">
                                    <img src="{{ asset('image/icon/homepage/edit-icon-red.svg') }}" alt="icon"> Edit
                                </a>
                            </div>
                            <div class="card card-profile mt-3">
                                <div class="card-body">
                                    <div class="text-center wrapper-header-card-personal">
                                        <img class="rounded-circle img-profile" src="https://instagram.fcgk9-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/p640x640/36687395_1833002890090498_1311641978080854016_n.jpg?_nc_ht=instagram.fcgk9-1.fna.fbcdn.net&_nc_cat=110&_nc_ohc=xRSWiQpr3Z4AX8TfB-s&tp=1&oh=f0b27cf086b3be75608151d4375e2384&oe=605D5A77" alt="avatar">
                                        <div class="d-flex justify-content-center align-items-center mb-1">
                                            <h6 class="mb-0 mr-2">Ian Ahmad</h6>
                                            <span class="gender-badge">Male</span>
                                        </div>
                                        <p class="email-text">ianahmad@gmail.com</p>
                                    </div>
                                    <div class="wrapper-content-card-personal">
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="">Date of Birth</label>
                                                <p class="value-profile">17 Agustus 2020</p>
                                            </div>
                                            <div class="col-7">
                                                <label for="">Phone Number</label>
                                                <p class="value-profile">081234567899</p>
                                            </div>
                                            <div class="col-12">
                                                <label for="">Location</label>
                                                <p class="value-profile">Surabaya, East Java</p>
                                            </div>
                                            <div class="col-12">
                                                <label for="">Linkedin Profile</label>
                                                <p class="value-profile">www.linkedin.com/sahadilalalili</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="wrapper-card-edit-profile d-flex align-items-center justify-content-between">
                                <h4 class="candidate-page-subtitle mb-0">Other Information</h4>
                                <a href="#" class="edit-text d-flex align-items-center mr-1">
                                    <img src="{{ asset('image/icon/homepage/edit-icon-red.svg') }}" alt="icon"> Edit
                                </a>
                            </div>
                            <div class="card card-profile mt-3">
                                <div class="card-body">
                                    <div class="wrapper-content-card-personal mt-0">
                                        <div class="row">
                                            <div class="col-12 form-candidate-view">
                                                <div class="form-group">
                                                    <label for="">Linkedin Profile</label>
                                                    <input type="text" class="form-control" value="www.drive.com/aIksjKJKKSnasLKWSC" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Resume</label>
                                                    <input type="text" class="form-control" value="resume2021.jpg" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Portofolio</label>
                                                    <input type="text" class="form-control" value="portofolioterbaru_adm.jpg" disabled>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label for="">Skill</label>
                                                    <textarea name="" id="" class="form-control" rows="3" style="height:auto" disabled>Editing, Photography, Design</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-7 col-md-12">
                            <div class="wrapper-card-edit-profile d-flex align-items-center justify-content-between">
                                <h4 class="candidate-page-subtitle mb-0">Education Information</h4>
                                <a href="#" class="edit-text d-flex align-items-center mr-1">
                                    <img src="{{ asset('image/icon/homepage/edit-icon-red.svg') }}" alt="icon"> Edit
                                </a>
                            </div>
                            <div class="card card-profile mt-3">
                                <div class="card-body">
                                    <div class="wrapper-header-card-personal">
                                        <span class="gender-badge">S1</span>
                                        <h6 class="my-2">Universitas Pembanngunan Nasional “Veteran” Jawa Timur</h6>
                                        <p class="email-text">Informatic Engineering, Faculty of Computer Science</p>
                                    </div>
                                    <div class="wrapper-content-card-personal">
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="">Start Date</label>
                                                <p class="value-profile">17 Agustus 2020</p>
                                            </div>
                                            <div class="col-7">
                                                <label for="">End Date</label>
                                                <p class="value-profile">17 Agustus 2020</p>
                                            </div>
                                            <div class="col-12 form-candidate-view">
                                                <div class="form-group mb-0">
                                                    <label for="">Certificate of Study</label>
                                                    <input type="text" class="form-control" value="ijazah2021.jpg" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
            </div>
        </div>
    </div>
</div>