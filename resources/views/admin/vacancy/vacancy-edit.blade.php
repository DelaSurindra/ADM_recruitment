@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-12">
                <p class="text-title-page-small">Edit</p>
                <p class="text-title-page-big">Job Vacancy Information</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('post.vacancy.edit') }}" class="form stacked" method="POST" id="formEditVacancy" ajax="true">
                    @csrf
                    <input type="hidden" name="idVacancy" value="{{$data['job_id']}}">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label class="label-hr">Job Title<span class="required-sign">*</span></label>
                                        <input type="text" class="form-control form-hr" name="titleVacancy" id="titleVacancy" placeholder="Add a vacancy titles..." value="{{$data['job_title']}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="typeVacancyDiv">
                                    <label class="label-hr">Type<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="typeVacancy" name="typeVacancy">
                                        <option value="">Type</option>
                                        <option {{$data['type'] == '1' ? 'selected':''}} value="1">Full Time</option>
                                        <option {{$data['type'] == '2' ? 'selected':''}} value="2">Intership</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="locationVacancyDiv">
                                    <label class="label-hr">Location<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="locationVacancy" name="locationVacancy">
                                        <option value="">-- Pilih Location --</option>
                                        @foreach($wilayah as $dataWilayah)
                                            <option {{$data['lokasi'] == $dataWilayah['kabupaten'] ? 'selected' : ''}} value="{{$dataWilayah['kabupaten']}}">{{$dataWilayah['kabupaten']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-hr">Working Time<span class="required-sign">*</span></label>
                                        <input id="workingTimeVacancy" name="workingTimeVacancy" class="form-control form-hr" type="text" placeholder="Working Time" value="{{$data['work_time']}}">
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
                                        <label class="label-hr">Activated Date<span class="required-sign">*</span></label>
                                        <input id="activatedDate" name="activatedDate" class="form-control form-hr" type="text" placeholder="Activated Date" value="{{$data['active_date']}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="degreeVacancyDiv">
                                    <label class="label-hr">Degree<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="degreeVacancy" name="degreeVacancy">
                                        <option value="">Degree</option>
                                        <option {{$data['degree'] == '1' ? 'selected':''}} value="D3">D3</option>
                                        <option {{$data['degree'] == '2' ? 'selected':''}} value="S1">S1</option>
                                        <option {{$data['degree'] == '3' ? 'selected':''}} value="S2">S2</option>
                                    </select>
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
                                            @for ($i = 0; $i < count($data['major']); $i++)
                                            <select class="select2 min-width" id="field-syarat{{ $i+1 }}" name="majorVacancy">
                                                <option value="">-- Pilih Major --</option>
                                                <option value="Sistem Informasi" {{ $data['major'][$i] == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                                <option value="Akuntansi" {{ $data['major'][$i] == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                            </select>
                                            @if(count($data['major']) > 1 && count($data['major']) != $i+1 )
                                            <button type="button" id="remove-syarat{{ $i+1 }}" class="remove-me-syarat btn-min">-</button>
                                            @endif
                                            @endfor
                                            <button id="b2" class="add-more-syarat btn-plus margin-top-btn" type="button">+</button>
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