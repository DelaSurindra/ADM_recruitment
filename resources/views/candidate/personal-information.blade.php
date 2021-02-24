@extends('candidate.profile')
@section('profile')
<div class="breadcrumb-candidate">
    <a class="bread active" href="#">Edit Profil</a>
    <p class="bread">/Edit Personal Information</p>
</div>
<h2 class="candidate-page-title">Edit Personal Information</h2>
<div class="row mt-5">
    <div class="col-12">
        <form action="" id="formEditPersonalInformation" method="POST" class="form-candidate-view">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Photo Profile<span class="required-sign">*</span></label>
                        <div class="input-group d-flex align-items-center">
                            <div class="input-group-prepend">
                                <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="">
                            </div>
                            <div class="ml-3 d-flex align-items-center" style="width:70%">
                                <div class="w-100">
                                    <label class="mb-0" for="inputGroupFile01">Filename</label>
                                </div>
                                <span class="btn btn-file d-flex justify-content-end w-100">
                                    Upload New Photo <input type="file">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">First Name<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Last Name<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Date of Birth<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12 with-icon">
                                <input type="text" class="form-control" placeholder="Choose date">
                                <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Gender<span class="required-sign">*</span></label>
                        <div class="d-flex">
                            <label class="custome-radio-wrapper mb-0 mr-4"> Male
                                <input type="radio" name="radio">
                                <span class="checkmark"></span>
                            </label>
                            <label class="custome-radio-wrapper mb-0"> Female
                                <input type="radio" name="radio">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Email<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Phone Number<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="usually 10 - 13 numberic digit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Location (City)<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control mb-2" placeholder="Location">
                                <small id="LocateMe" class="locate-me pt-3">Locate Me</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Linkedin Profile<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="ex: www.linkedin.com/example">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 margin-right-1rem">
                <div class="col-lg-12 col-md-12">
                    <button type="button" class="btn btn-red btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('app')
    @include('candidate.my-app-home')
@endsection