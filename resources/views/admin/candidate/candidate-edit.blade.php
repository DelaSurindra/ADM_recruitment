@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<form action="{{route('post.candidate.edit')}}" class="form stacked form-hr" method="POST" id="formEditCandidate" ajax="true">
    @csrf
    <input type="hidden" name="idKandidat" value="{{$data['id']}}">
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
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input id="firstName" name="firstName" class="form-control" type="text" value="{{$data['first_name']}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input id="lastName" name="lastName" class="form-control" type="text" value="{{$data['last_name']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="email" name="email" class="form-control" type="text" value="{{$data['email']}}" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input id="birthDate" name="birthDate" class="form-control" type="text" value="{{date('d-m-Y', strtotime($data['tanggal_lahir']))}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Gender<span class="required-sign">*</span></label>
                                        <div class="d-flex">
                                            <label class="custome-radio-wrapper mb-0 mr-4"> Male
                                                <input type="radio" name="gender" id="gender1" value="1" {{$data['gender'] == '1' ? 'checked' : ''}}>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custome-radio-wrapper mb-0"> Female
                                                <input type="radio" name="gender" id="gender2" value="2" {{$data['gender'] == '2' ? 'checked' : ''}}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="phoneNumber" name="phoneNumber" class="form-control" type="text" value="{{$data['telp']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input id="myLocation" name="myLocation" class="form-control" type="text" value="{{$data['kota']}}">
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
            @if($data['pendidikan'] != [])
                @foreach($data['pendidikan'] as $pendidikan)
                    <div class="row">
                        <input type="hidden" name="idPendidikan" value="{{$pendidikan['id']}}">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>School/University<span class="required-sign">*</span></label>
                                                <select class="select2 tex-center select2-width" id="universitas" name="universitas" required>
                                                    <option value="">Choose Universitas</option>
                                                    @foreach($universitas as $dataUniv)
                                                        <option {{$pendidikan['universitas'] == $dataUniv['universitas'] ? 'selected':''}} value="{{$dataUniv['universitas']}}">{{$dataUniv['universitas']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group" >
                                                <label>Degree</label>
                                                <select class="select2 tex-center select2-width" id="gelar" name="gelar">
                                                    <option {{$pendidikan['gelar'] == '1' ? 'selected':''}} value="1">D3</option>
                                                    <option {{$pendidikan['gelar'] == '2' ? 'selected':''}} value="2">S1</option>
                                                    <option {{$pendidikan['gelar'] == '3' ? 'selected':''}} value="3">S2</option>
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
                                            <div class="form-group">
                                                <label>Faculty<span class="required-sign">*</span></label>
                                                <input id="faculty" name="faculty" class="form-control" type="text" value="{{$pendidikan['fakultas']}}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Major<span class="required-sign">*</span></label>
                                                <select class="select2 tex-center select2-width" id="jurusan" name="jurusan">
                                                    <option value="">Choose Major</option>
                                                    @foreach($major as $dataMajor)
                                                        <option {{$pendidikan['jurusan'] == $dataMajor['major'] ? 'selected':''}} value="{{$dataMajor['major']}}">{{$dataMajor['major']}}</option>
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
                                            <div class="form-group">
                                                <label>Start Year<span class="required-sign">*</span></label>
                                                <input id="start_year" name="start_year" class="form-control year_date" type="text" value="{{$pendidikan['start_year']}}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>End Year<span class="required-sign">*</span></label>
                                                <input id="end_year" name="end_year" class="form-control year_date" type="text" value="{{$pendidikan['end_year']}}">
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
                                                <label>GPA</label>
                                                <input id="gpa" name="gpa" class="form-control gpa" type="text" value="{{$pendidikan['gpa']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="divider">
                    </div>
                @endforeach
            @else
            <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-xl-10 col-md-12">
                                <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="universitasDiv">
                                        <label>School/University<span class="required-sign">*</span></label>
                                        <select class="select2 tex-center select2-width" id="universitas" name="universitas">
                                            <option value="UPN">UPN</option>
                                            <option value="Universitas Brawijaya">Universitas Brawijaya</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group" >
                                            <label>Degree</label>
                                            <select class="select2 tex-center select2-width" id="gelar" name="gelar" disabled>
                                                <option value="1">D3</option>
                                                <option value="2">S1</option>
                                                <option value="3">S2</option>
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
                                        <div class="form-group">
                                            <label>Faculty<span class="required-sign">*</span></label>
                                            <input id="faculty" name="faculty" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Major<span class="required-sign">*</span></label>
                                            <select class="select2 tex-center select2-width" id="jurusan" name="jurusan">
                                                <option value="Sistem Informasi">Sistem Informasi</option>
                                                <option value="Akuntansi">Akuntansi</option>
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
                                        <div class="form-group">
                                            <label>Start Year<span class="required-sign">*</span></label>
                                            <input id="start_year" name="start_year" class="form-control year_date" type="text">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>End Year<span class="required-sign">*</span></label>
                                            <input id="end_year" name="end_year" class="form-control year_date" type="text">
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
                                            <label>GPA</label>
                                            <input id="gpa" name="gpa" class="form-control" type="text" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-red w-100">Save</button>
        </div>
    </div>
</form>

@endsection