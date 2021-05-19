@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <h2 class="candidate-page-title">Complete Your<br>Account</h2>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="tracking-form-first-login">
                <div class="tracking-line">
                    <div class="gray-line"></div>
                    <div class="gray-line"></div>
                </div>
                <div class="icon-tracking-wrapper personal-information active">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-user-red.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p class="mb-0 mt-2">Personal<br>Information</p>
                    </div>
                </div>
                <div class="icon-tracking-wrapper education-information">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-toga.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p class="mb-0 mt-2">Education<br>Information</p>
                    </div>
                </div>
                <div class="icon-tracking-wrapper other-information">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-pin.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p class="mb-0 mt-2">Other<br>Information</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <form action="{{ route('post.first-login') }}" id="formFirstLogin" class="form-candidate-view mt-5" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="idCandidate" id="idCandidate" value="{{ Session::get('session_candidate')['id'] }}">
        <div data-speed="100" id="page-1" class="item active">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Photo Profile<span class="required-sign">*</span></label>
                        <div class="input-group d-flex align-items-center">
                            <div class="input-group-prepend">
                                <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" class="photoProfileImage" alt="image">
                            </div>
                            <div class="ml-3 d-flex align-items-center" style="width:80%">
                                <div style="width:inherit">
                                    <label class="photoProfileLabel mb-0">Filename</label>
                                </div>
                                <span class="btn btn-file d-flex justify-content-end">
                                    Upload <input type="file" name="photoProfile" id="photoProfile">
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
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name">
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
                                <input type="text" name="birthDate" id="birthDate" class="form-control" placeholder="Choose date">
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
                                <input type="radio" name="gender" id="gender1" value="1">
                                <span class="checkmark"></span>
                            </label>
                            <label class="custome-radio-wrapper mb-0"> Female
                                <input type="radio" name="gender" id="gender2" value="2">
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
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ Session::get('session_candidate')['user_email'] }}" disabled>
                                <input type="hidden" name="emailCandidate" value="{{ Session::get('session_candidate')['user_email'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Phone Number<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="usually 10 - 13 numberic digit">
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
                                <select name="myLocation" id="myLocation" class="select2 form-control">
                                    <option value="">Choose Location</option>
                                    @foreach($wilayah as $data)
                                        <option value="{{$data['kabupaten']}}">{{$data['kabupaten']}}</option>
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
                        <label for="">Linkedin Profile</label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="lingkedInLink" id="lingkedInLink" class="form-control" placeholder="ex: http://linkedin.com/example">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 d-flex align-items-center">
                    <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <button type="button" class="btn btn-home-color btn-block right slideBtn btn-next" for="page-1">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div data-speed="100" id="page-2" class="item">
            <div id="listEducationCandidate">
                <div class="listStudy">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">School/University<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <select name="university" id="university" class="select2-custom form-control">
                                            <option selected disabled>Choose or input your university</option>
                                            @foreach($univ as $options)
                                            <option value="{{$options['universitas']}}">{{$options['universitas']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Degree<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <select name="degree" id="degree" class="select2 form-control">
                                            <option value="">Choose your degree</option>
                                            <option value="1">Diploma Degree</option>
                                            <option value="2">Bachelor Degree</option>
                                            <option value="3">Master Degree</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Faculty<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Major<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <select name="major" id="major" class="select2-custom form-control">
                                            <option selected disabled>Choose or input  your major</option>
                                            @foreach($major as $options)
                                            <option value="{{$options['major']}}">{{$options['major']}}</option>
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
                                <label for="">Start Year<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12 with-icon">
                                        <input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation">
                                        <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">End Year<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12 with-icon">
                                        <input type="text" class="form-control" placeholder="Choose date" id="endDateEducation" name="endDateEducation">
                                        <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">GPA<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <input type="text" class="form-control" placeholder="0 - 4" id="gpa" name="gpa">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Certificate of Study<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <input type="text" class="form-control file-input-label" placeholder="Format jpg/png maximum 2MB file" disabled>
                                        <span class="btn btn-file pl-1 mb-2">
                                            Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 margin-right-2rem firstBtnListEducation">
                <div class="col-lg-12 col-md-12 firstBtnEducation">
                    <button type="button" class="btn btn-white btn-block large btnAddListEducation">
                        <i class="fas fa-plus mr-2" style="font-size:18px"></i> 
                        Add Another Education
                    </button>
                </div>
                <div class="col-lg-6 col-md-12 display-none removeThisEducation">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <button type="button" class="btn btn-white btn-block btnAddListEducation">
                                    <i class="fas fa-trash mr-2" style="font-size:18px"></i> 
                                    Delete the Education Data Above 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 display-none secondBtnEducation">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <button type="button" class="btn btn-white btn-block btnAddListEducation">
                                    <i class="fas fa-plus mr-2" style="font-size:18px"></i> 
                                    Add Another Education
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 d-flex align-items-center">
                    <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-11 col-md-12 d-flex">
                            <button class="btn btn-home-color slideBtn mr-2" for="page-2"><i class="fas fa-chevron-circle-left"></i></button>
                            <button type="button" class="btn btn-home-color btn-block right slideBtn btn-next" for="page-2">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div data-speed="100" id="page-3" class="item">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Cover Letter</label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="coverLetterLink" id="coverLetterLink" class="form-control" placeholder="Attach file Here" readonly>
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file" name="coverLetter" id="coverLetter">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Resume</label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="resumeLink" id="resumeLink" class="form-control" placeholder="Attach file Here" readonly>
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file" name="resume" id="resume">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Portofolio</label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" name="portofolioLink" id="portofolioLink" class="form-control" readonly placeholder="You can attach file or send a link direct to your file">
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file" name="portofolio" id="portofolio">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Skill</label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <textarea name="skill" id="skill" class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Mention all your skill"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 d-flex align-items-center">
                    <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-11 col-md-12 d-flex">
                            <button class="btn btn-home-color slideBtn mr-2" for="page-3"><i class="fas fa-chevron-circle-left"></i></button>
                            <button type="submit" class="btn btn-home-color btn-block">Save Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection