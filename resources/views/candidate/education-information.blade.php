@extends('candidate.profile')
@section('profile')
<div class="breadcrumb-candidate">
    <a class="bread active" href="#">Edit Profil</a>
    <p class="bread">/Edit Education Information</p>
</div>
<h2 class="candidate-page-title">Edit Education Information</h2>
<div class="row mt-5">
    <div class="col-12">
        <form action="" id="formEditEducationInformation" method="POST" class="form-candidate-view">
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
                                        <input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation">
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
        </form>
    </div>
</div>
@endsection

@section('app')
    @include('candidate.my-app-home')
@endsection