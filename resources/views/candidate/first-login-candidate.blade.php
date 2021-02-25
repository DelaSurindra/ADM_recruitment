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
                <div class="icon-tracking-wrapper personal-information">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-user-red.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p>Personal<br>Information</p>
                    </div>
                </div>
                <div class="icon-tracking-wrapper education-information">
                    <div class="icon">
                        <img src="{{ asset('image/icon/homepage/track-toga.svg') }}" alt="icon">
                    </div>
                    <div class="desc">
                        <p>Education<br>Information</p>
                    </div>
                </div>
                <div class="icon-tracking-wrapper other-information">
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
    
    <form action="{{ route('post.first-login') }}" id="formFirstLogin" class="form-candidate-view mt-5" method="POST">
        <div data-speed="100" id="page-1" class="item active">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Photo Profile<span class="required-sign">*</span></label>
                        <div class="input-group d-flex align-items-center">
                            <div class="input-group-prepend">
                                <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="">
                            </div>
                            <div class="ml-3 d-flex align-items-center" style="width:80%">
                                <div class="w-100">
                                    <label class="mb-0" for="inputGroupFile01">Filename</label>
                                </div>
                                <span class="btn btn-file d-flex justify-content-end">
                                    Upload <input type="file">
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
            <div class="row">
                <div class="col-lg-6 col-md-12 d-flex align-items-center">
                    <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <button type="button" class="btn btn-red btn-block right slideBtn btn-next" for="page-1">Next</button>
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
                                        <input type="text" class="form-control" placeholder="School/University">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Degree<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <select name="" id="" class="select2 form-control">
                                            <option value="">Choose your degree</option>
                                            <option value="">Opt 1</option>
                                            <option value="">Opt 1</option>
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
                                        <input type="text" class="form-control" placeholder="Faculty">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Major<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <input type="text" class="form-control" placeholder="Major">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Start Date<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12 with-icon">
                                        <input type="text" class="form-control" placeholder="Choose date" id="startDateEdication" name="startDateEdication">
                                        <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">End Date<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12 with-icon">
                                        <input type="text" class="form-control" placeholder="Choose date" id="endDateEdication" name="endDateEdication">
                                        <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">Certificate of Study<span class="required-sign">*</span></label>
                                <div class="row">
                                    <div class="col-lg-11 col-md-12">
                                        <input type="text" class="form-control" placeholder="Format jpg/png maximum 2MB file">
                                        <p id="filenameCertificateStudy" class="m-1"></p>
                                        <span class="btn btn-file pl-1 mb-2">
                                            Upload File <input type="file">
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
                    <button type="button" class="btn btn-white btn-block large btnAddListEdication">
                        <i class="fas fa-plus mr-2" style="font-size:18px"></i> 
                        Add Another Education
                    </button>
                </div>
                <div class="col-lg-6 col-md-12 display-none removeThisEducation">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <button type="button" class="btn btn-white btn-block btnAddListEdication">
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
                                <button type="button" class="btn btn-white btn-block btnAddListEdication">
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
                        <div class="col-lg-11 col-md-12">
                            <button type="button" class="btn btn-red btn-block right slideBtn btn-next" for="page-2">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div data-speed="100" id="page-3" class="item">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Cover Letter<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="You can attach file or send a link direct to your file">
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Resume<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="You can attach file or send a link direct to your file">
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Portofolio<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <input type="text" class="form-control" placeholder="You can attach file or send a link direct to your file">
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Skill<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Mention all your skill"></textarea>
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
                            <button type="submit" class="btn btn-red btn-block">Save Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection