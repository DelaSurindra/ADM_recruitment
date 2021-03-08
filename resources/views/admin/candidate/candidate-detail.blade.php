@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="" class="form stacked" method="POST" id="formEditCandidate" ajax="true">
    @csrf
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Edit</p>
                    <p class="text-title-page-big">Application Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label class="label-hr">Submit Date</label>
                                        <input type="text" class="form-control form-hr" name="submitDate" id="submitDate" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label class="label-hr">Job Position</label>
                                        <input type="text" class="form-control form-hr" name="jobPosition" id="jobPosition" disabled>
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
                                        <label class="label-hr">Area</label>
                                        <input id="area" name="area" class="form-control form-hr" type="text" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="aplicationStatusDiv">
                                    <label class="label-hr">Application Status</label>
                                    <select class="select2 tex-center select2-width" id="aplicationStatus" name="aplicationStatus">
                                        <option value="">-- Pilih Status --</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-hr">Name</label>
                                        <input id="name" name="name" class="form-control form-hr" type="text" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-hr">Age</label>
                                        <input id="age" name="age" class="form-control form-hr" type="text" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Edit</p>
                    <p class="text-title-page-big">Education Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-12" id="universitasDiv">
                                    <label class="label-hr">School/University<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="universitas" name="universitas">
                                        <option value="">-- Pilih Universitas --</option>

                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label class="label-hr">Degree</label>
                                        <input type="text" class="form-control form-hr" name="degree" id="degree" disabled>
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
                                        <label class="label-hr">Faculty<span class="required-sign">*</span></label>
                                        <input id="faculty" name="faculty" class="form-control form-hr" type="text">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-hr">Major<span class="required-sign">*</span></label>
                                        <input id="Major" name="Major" class="form-control form-hr" type="text">
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
                                        <label class="label-hr">Start Year<span class="required-sign">*</span></label>
                                        <input id="start_year" name="start_year" class="form-control form-hr" type="text">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-hr">End Year<span class="required-sign">*</span></label>
                                        <input id="end_year" name="end_year" class="form-control form-hr" type="text">
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
                                        <label class="label-hr">GPA<span class="required-sign">*</span></label>
                                        <input id="gpa" name="gpa" class="form-control form-hr" type="text" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-12" id="universitasDiv">
                                    <label class="label-hr">School/University<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="universitas" name="universitas">
                                        <option value="">-- Pilih Universitas --</option>

                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label class="label-hr">Degree</label>
                                        <input type="text" class="form-control form-hr" name="degree" id="degree" disabled>
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
                                        <label class="label-hr">Faculty<span class="required-sign">*</span></label>
                                        <input id="faculty" name="faculty" class="form-control form-hr" type="text">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-hr">Major<span class="required-sign">*</span></label>
                                        <input id="Major" name="Major" class="form-control form-hr" type="text">
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
                                        <label class="label-hr">Start Year<span class="required-sign">*</span></label>
                                        <input id="start_year" name="start_year" class="form-control form-hr" type="text">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-hr">End Year<span class="required-sign">*</span></label>
                                        <input id="end_year" name="end_year" class="form-control form-hr" type="text">
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
                                        <label class="label-hr">GPA<span class="required-sign">*</span></label>
                                        <input id="gpa" name="gpa" class="form-control form-hr" type="text" disabled>
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
            <button type="submit" class="btn btn-red w-100">Save</button>
        </div>
    </div>
</form>

@endsection