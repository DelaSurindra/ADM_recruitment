@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('post.vacancy.edit') }}" class="form stacked" method="POST" id="formEditVacancy" ajax="true">
                    @csrf
                    <input type="hidden" name="idVacancy" value="{{$data['job_id']}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xl-6 col-md-12">
                                        <div class="input-title-news">
                                            <h4 class="mb-4">Title</h4>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <img src="{{ asset('image/icon/main/add-circle.svg') }}" alt="icon">
                                                </div>
                                                <input type="text" class="form-control" name="titleVacancy" id="titleVacancy" placeholder="Add a vacancy titles..." value="{{$data['job_title']}}">
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
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" id="locationVacancyDiv">
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Location</label>
                                                <select class="select2 tex-center select2-width" id="locationVacancy" name="locationVacancy">
                                                    <option value="">Location</option>
                                                    <option value="Surabaya">Surabaya</option>
                                                    <option value="Sidoarjo">Sidoarjo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Min Salary</label>
                                                <input id="minSalaryVacancy" name="minSalaryVacancy" class="form-control" type="text" placeholder="Min Salary" value="{{$data['minSalary']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Max Salary</label>
                                                <input id="maxSalaryVacancy" name="maxSalaryVacancy" class="form-control" type="text" placeholder="Max Salary" value="{{$data['maxSalary']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" id="degreeVacancyDiv">
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Degree</label>
                                                <select class="select2 tex-center select2-width" id="degreeVacancy" name="degreeVacancy">
                                                    <option value="">Degree</option>
                                                    <option {{$data['degree'] == 'D3' ? 'selected':''}} value="D3">D3</option>
                                                    <option {{$data['degree'] == 'D3' ? 'selected':''}} value="S1">S1</option>
                                                    <option {{$data['degree'] == 'D3' ? 'selected':''}} value="S2">S2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" id="typeVacancyDiv">
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Type</label>
                                                <select class="select2 tex-center select2-width" id="typeVacancy" name="typeVacancy">
                                                    <option value="">Type</option>
                                                    <option {{$data['type'] == '1' ? 'selected':''}} value="1">Full Time</option>
                                                    <option {{$data['type'] == '2' ? 'selected':''}} value="2">Intership</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Working Time</label>
                                                <input id="workingTimeVacancy" name="workingTimeVacancy" class="form-control" type="text" placeholder="Working Time" value="{{$data['work_time']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Activated Date</label>
                                                <input id="activatedDate" name="activatedDate" class="form-control" type="text" placeholder="Activated Date" value="{{$data['active_date']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-11 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" id="majorVacancyDiv">
                                        <label>Major</label>
                                        <div id="fieldMajorDiv1">
                                            <select class="select2 min-width" id="field-syarat1" name="majorVacancy">
                                                <option value="">Major</option>
                                                <option value="Sistem Informasi">Sistem Informasi</option>
                                                <option value="Akuntansi">Akuntansi</option>
                                            </select>
                                            <button id="b2" class="btn add-more-syarat btn-plus margin-top-btn" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description News/Event</label>
                                <div class="summernote-news-wrapper">
                                    <textarea name="descriptionVacancy" id="descriptionVacancy" class="form-control" placeholder="Input Description">{{$data['job_requirement']}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection