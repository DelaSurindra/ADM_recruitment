@extends('candidate.profile.profile')
@section('profile')
<div class="breadcrumb-candidate">
    <a class="bread active" href="#">Edit Profil</a>
    <p class="bread">/Edit Personal Information</p>
</div>
<h2 class="candidate-page-title">Edit Personal Information</h2>
<div class="row mt-5">
    <div class="col-12">
        <form action="{{ route('post.profile.personal-information') }}" id="formEditPersonalInformation" method="POST" class="form-candidate-view" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idCandidate" id="idCandidate" value="{{ Session::get('session_candidate')['id'] }}">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Photo Profile<span class="required-sign">*</span></label>
                        <div class="input-group d-flex align-items-center">
                            <div class="input-group-prepend">
                                @if(session('session_candidate.foto_profil') == null)
                                <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" class="photoProfileImage" alt="image">
                                @else
                                <img src="{{asset('storage/').'/'.session('session_candidate.foto_profil') }}" class="photoProfileImage" alt="image">
                                @endif
                            </div>
                            <div class="ml-3 d-flex align-items-center" style="width:70%">
                                <div class="w-100">
                                    <label class="photoProfileLabel mb-0"></label>
                                </div>
                                <span class="btn btn-file d-flex justify-content-end w-100">
                                    Upload New Photo <input type="file" name="photoProfile" id="photoProfile">
                                    <input type="hidden" name="oldImage" value="{{session('session_candidate.foto_profil')}}">
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
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="{{session('session_candidate.first_name')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Last Name<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" value="{{session('session_candidate.last_name')}}">
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
                                <input type="text" name="birthDate" id="birthDate" class="form-control" placeholder="Choose date" value="{{session('session_candidate.tanggal_lahir')}}">
                                <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12" >
                    <div class="form-group" >
                        <label for="">Gender<span class="required-sign">*</span></label>
                        <div class="d-flex" id="genderDiv">
                            <label class="custome-radio-wrapper mb-0 mr-4"> Male
                                <input {{session('session_candidate.gender') == "1" ? 'checked':''}} type="radio" name="gender" id="gender1" value="1">
                                <span class="checkmark"></span>
                            </label>
                            <label class="custome-radio-wrapper mb-0"> Female
                                <input {{session('session_candidate.gender') == "2" ? 'checked':''}} type="radio" name="gender" id="gender2" value="2">
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
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" readonly value="{{session('session_candidate.user_email')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Phone Number<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="usually 10 - 13 numberic digit" value="{{session('session_candidate.telp')}}">
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
                            <div class="col-lg-11 col-md-12" id="myLocationDiv">
                                <select name="myLocation" id="myLocation" class="select2 form-control">
                                    <option value="">Choose Location</option>
                                    @foreach($wilayah as $data)
                                        <option {{session('session_candidate.kota') == $data['kabupaten'] ? 'selected':''}} value="{{$data['kabupaten']}}">{{$data['kabupaten']}}</option>
                                    @endforeach
                                </select>
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
                                <input type="text" name="lingkedInLink" id="lingkedInLink" class="form-control" placeholder="ex: http://linkedin.com/example" value="{{session('session_candidate.linkedin')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 margin-right-1rem">
                <div class="col-lg-12 col-md-12">
                    <button type="submit" class="btn btn-red btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('app')
    @include('candidate.profile.my-app-home')
@endsection