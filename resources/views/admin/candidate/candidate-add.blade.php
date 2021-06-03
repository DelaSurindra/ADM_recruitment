@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<form action="{{route('post.candidate.add')}}" class="form stacked form-hr" method="POST" id="formAddCandidate" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card clear">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <p class="text-title-page-small">Create</p>
                            <p class="text-title-page-big">Personal Information</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
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
                                                            Upload <input type="file" name="photoProfile" id="photoProfile" accept=".jpg, .png, .jpeg">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group" >
                                                <label>First Name<span class="required-sign">*</span></label>
                                                <input id="firstName" name="firstName" class="form-control" type="text" placeholder="Enter first name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Last Name<span class="required-sign">*</span></label>
                                                <input id="lastName" name="lastName" class="form-control" type="text" placeholder="Enter last name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Date of Birth<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 with-icon">
                                                        <input type="text" name="birthDate" id="birthDate" class="form-control" placeholder="Choose date">
                                                        <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group" >
                                                <label>Email<span class="required-sign">*</span></label>
                                                <input id="email" name="email" class="form-control" type="text" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Phone Number<span class="required-sign">*</span></label>
                                                <input id="phoneNumber" name="phoneNumber" class="form-control" type="text" placeholder="Enter Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12" id="myLocationDiv">
                                            <div class="form-group">
                                                <label>Location<span class="required-sign">*</span></label>
                                                <select name="myLocation" id="myLocation" class="select2 form-control">
                                                    <option value="">Choose Location</option>
                                                    @foreach($wilayah as $options)
                                                    <option value="{{$options['kabupaten']}}">{{$options['kabupaten']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group" >
                                                <label>Linkedin Profile<span class="required-sign">*</span></label>
                                                <input id="lingkedInLink" name="lingkedInLink" class="form-control" type="text" placeholder="ex: www.linkedin.com/example">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card clear">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <p class="text-title-page-small">Create</p>
                            <p class="text-title-page-big">Education Information</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="listEducationCandidate">
                                <div class="listStudy">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">School/University<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <select name="university" id="university" class="select2-custom form-control">
                                                            <option selected disabled>Choose or input your university</option>
                                                            @foreach($universitas as $options)
                                                            <option value="{{$options['universitas']}}">{{$options['universitas']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">Degree<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
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
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">Faculty<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">Major<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
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
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">Start Year<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 with-icon">
                                                        <input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation">
                                                        <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">End Year<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 with-icon">
                                                        <input type="text" class="form-control" placeholder="Choose date" id="endDateEducation" name="endDateEducation">
                                                        <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">GPA<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <input type="text" class="form-control" placeholder="0 - 4" id="gpa" name="gpa">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <label for="">Certificate of Study<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
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
                                <div class="col-lg-10 col-md-12 firstBtnEducation">
                                    <button type="button" class="btn btn-white btn-block large btnAddListEducation">
                                        <i class="fas fa-plus mr-2" style="font-size:18px"></i> 
                                        Add Another Education
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card clear">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <p class="text-title-page-small">Create</p>
                        <p class="text-title-page-big">Other Information</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-xl-10 col-md-12">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Cover Letter</label>
                                            <input type="text" name="coverLetterLink" id="coverLetterLink" class="form-control file-input-label" placeholder="Attach file Here" readonly>
                                            <span class="btn btn-file pl-1 mb-2">
                                                Upload File <input type="file" name="coverLetter" id="coverLetter" class="uploadCertificate" accept=".jpg, .png, .jpeg, .pdf">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Resume</label>
                                            <input type="text" name="resumeLink" id="resumeLink" class="form-control file-input-label" placeholder="Attach file Here" readonly>
                                            <span class="btn btn-file pl-1 mb-2">
                                                Upload File <input type="file" name="resume" id="resume" class="uploadCertificate" accept=".jpg, .png, .jpeg, .pdf">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Portofolio</label>
                                            <input type="text" name="portofolioLink" id="portofolioLink" class="form-control file-input-label" readonly placeholder="Attach file Here">
                                            <span class="btn btn-file pl-1 mb-2">
                                                Upload File <input type="file" name="portofolio" id="portofolio" class="uploadCertificate" accept=".jpg, .png, .jpeg, .pdf">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Skill</label>
                                            <textarea name="skill" id="skill" class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Mention all your skill"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <button class="btn btn-red right w-100">Save</button>
        </div>
    </div>
</form>
@endsection