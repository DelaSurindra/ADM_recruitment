@extends('candidate.profile.profile')
@section('profile')
<div class="breadcrumb-candidate">
    <a class="bread active" href="{{route('get.profile.view')}}">Edit Profil</a>
    <p class="bread">&nbsp/ Edit Education Information</p>
</div>
<h2 class="candidate-page-title">Edit Education Information</h2>
<div class="row mt-5">
    <div class="col-12">
        <form action="{{ route('post.profile.education-information') }}" id="formEditEducationInformation" method="POST" class="form-candidate-view" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idCandidate" id="idCandidate" value="{{ Session::get('session_candidate')['id'] }}">
            <div id="listEducationCandidate">
                @if(!empty(Session::get('session_candidate')))
                    @for ($i = 0; $i < count(Session::get('session_candidate')['pendidikan']); $i++)
                    <div class="listStudy">
                        <input type="hidden" name="idEducation" id="idEducation" value="{{ Session::get('session_candidate')['pendidikan'][$i]['id'] }}">
                        @if($i > 0)
                        <hr>
                        @endif
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">School/University<span class="required-sign">*</span></label>
                                    <div class="row">
                                        <div class="col-lg-11 col-md-12">
                                            <select name="university" id="university" class="select2-custom form-control">
                                                <option selected disabled>Choose or input your university</option>
                                                @foreach($univ as $options)
                                                    <option {{ Session::get('session_candidate')['pendidikan'][$i]['universitas'] == $options['universitas'] ? 'selected' : ''}} value="{{$options['universitas']}}">{{$options['universitas']}}</option>
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
                                                <option value="1" {{ Session::get('session_candidate')['pendidikan'][$i]['gelar'] == '1' ? 'selected' : '' }}>Diploma Degree</option>
                                                <option value="2" {{ Session::get('session_candidate')['pendidikan'][$i]['gelar'] == '2' ? 'selected' : '' }}>Bachelor Degree</option>
                                                <option value="3" {{ Session::get('session_candidate')['pendidikan'][$i]['gelar'] == '3' ? 'selected' : '' }}>Master Degree</option>
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
                                            <input type="text" name="faculty" id="faculty" class="form-control" value="{{ Session::get('session_candidate')['pendidikan'][$i]['fakultas'] }}" placeholder="Faculty">
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
                                                @foreach($major as $options)
                                                    <option {{Session::get('session_candidate')['pendidikan'][$i]['jurusan'] == $options['major'] ? 'selected' : ''}} value="{{$options['major']}}">{{$options['major']}}</option>
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
                                            <input type="text" class="form-control" placeholder="Choose date" value="{{ Session::get('session_candidate')['pendidikan'][$i]['start_year'] }}" id="startDateEducation" name="startDateEducation">
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
                                            <input type="text" class="form-control" placeholder="Choose date" value="{{ Session::get('session_candidate')['pendidikan'][$i]['end_year'] }}" id="endDateEducation" name="endDateEducation">
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
                                            <input type="text" class="form-control file-input-label" value="{{ Session::get('session_candidate')['pendidikan'][$i]['ijazah'] }}" placeholder="Format jpg/png maximum 2MB file" disabled>
                                            <p id="filenameCertificateStudy" class="m-1"></p>
                                            <span class="btn btn-file pl-1 mb-2">
                                                Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg" value="{{ Session::get('session_candidate')['pendidikan'][$i]['ijazah'] }}">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">GPA<span class="required-sign">*</span></label>
                                    <div class="row">
                                        <div class="col-lg-11 col-md-12">
                                            <input type="text" class="form-control" placeholder="0 - 100" value="{{ round(Session::get('session_candidate')['pendidikan'][$i]['gpa'], 2) }}" id="gpa" name="gpa">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                @else
                    <div class="listStudy">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">School/University<span class="required-sign">*</span></label>
                                    <div class="row">
                                        <div class="col-lg-11 col-md-12">
                                            <input type="text" name="university" id="university" class="form-control" placeholder="School/University">
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
                                            <select name="major" id="major" class="select2 form-control">
                                                <option value="">Choose your major</option>
                                                <option value="Sistem Informasi">Sistem Informasi</option>
                                                <option value="Akuntansi">Akuntansi</option>
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
                                    <label for="">Certificate of Study<span class="required-sign">*</span></label>
                                    <div class="row">
                                        <div class="col-lg-11 col-md-12">
                                            <input type="text" class="form-control file-input-label" placeholder="Format jpg/png maximum 2MB file" disabled>
                                            <p id="filenameCertificateStudy" class="m-1"></p>
                                            <span class="btn btn-file pl-1 mb-2">
                                                Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        </div>
                    </div>
                @endif
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

            <div class="row mb-4 margin-right-2rem">
                <div class="col-lg-12 col-md-12">
                    <button type="submit" class="btn btn-home-color btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('app')
    @include('candidate.profile.my-app-home')
@endsection