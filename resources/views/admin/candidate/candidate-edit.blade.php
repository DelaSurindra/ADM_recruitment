@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{route('post.candidate.edit')}}" class="form stacked form-hr" method="POST" id="formEditCandidate" ajax="true">
    @csrf
    <input type="hidden" name="idJob" value="{{$data['id']}}">
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
                                        <label>Submit Date</label>
                                        <input type="text" class="form-control" name="submitDate" id="submitDate" value="{{$data['submit_date']}}" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>Job Position</label>
                                        <input type="text" class="form-control" name="jobPosition" id="jobPosition" value="{{$data['job_title']}}" disabled>
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
                                        <label>Area</label>
                                        <input id="area" name="area" class="form-control" type="text" value="{{$data['lokasi']}}" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="aplicationStatusDiv">
                                    <label>Application Status</label>
                                    <select class="select2 tex-center select2-width" id="aplicationStatus" name="aplicationStatus">
                                        <option {{$data['status'] == '0' ? 'selected':''}} value="0">Application Resume</option>
                                        <option {{$data['status'] == '1' ? 'selected':''}} value="1">Proses to Written Test</option>
                                        <option {{$data['status'] == '2' ? 'selected':''}} value="2">Scheduled to Written Test</option>
                                        <option {{$data['status'] == '3' ? 'selected':''}} value="3">Written Test Pass</option>
                                        <option {{$data['status'] == '4' ? 'selected':''}} value="4">Written Test failed</option>
                                        <option {{$data['status'] == '5' ? 'selected':''}} value="5">Process to HR interview</option>
                                        <option {{$data['status'] == '6' ? 'selected':''}} value="6">Process to User Interview 1</option>
                                        <option {{$data['status'] == '7' ? 'selected':''}} value="7">Process to User Interview 2</option>
                                        <option {{$data['status'] == '8' ? 'selected':''}} value="8">Process to User Interview 3</option>
                                        <option {{$data['status'] == '9' ? 'selected':''}} value="9">Process to MCU</option>
                                        <option {{$data['status'] == '10' ? 'selected':''}} value="10">Process to Doc Sign</option>
                                        <option {{$data['status'] == '11' ? 'selected':''}} value="11">Failed</option>
                                        <option {{$data['status'] == '12' ? 'selected':''}} value="12">Hired</option>
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
                                        <label>Name</label>
                                        <input id="name" name="name" class="form-control" type="text" value="{{$data['first_name']}} {{$data['last_name']}}" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input id="age" name="age" class="form-control" type="text" value="{{$data['age']}}" disabled>
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
                                    <div class="col-xl-6 col-md-6 col-sm-12" id="universitasDiv">
                                            <label>School/University<span class="required-sign">*</span></label>
                                            <select class="select2 tex-center select2-width" id="universitas" name="universitas">
                                                <option {{$pendidikan['universitas'] == 'UPN' ? 'selected':''}} value="UPN">UPN</option>
                                                <option {{$pendidikan['universitas'] == 'Universitas Brawijaya' ? 'selected':''}} value="Universitas Brawijaya">Universitas Brawijaya</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group" >
                                                <label>Degree</label>
                                                <select class="select2 tex-center select2-width" id="gelar" name="gelar" disabled>
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
                                                    <option value="Sistem Informasi" {{ $pendidikan['jurusan'] == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                                    <option value="Akuntansi" {{ $pendidikan['jurusan'] == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
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
                                                <input id="gpa" name="gpa" class="form-control" type="text" value="{{$pendidikan['gpa']}}" disabled>
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