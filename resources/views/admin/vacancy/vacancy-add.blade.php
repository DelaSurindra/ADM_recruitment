@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-12">
                <p class="text-title-page-small">Create</p>
                <p class="text-title-page-big">Job Vacancy Information</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('post.vacancy.add') }}" class="form stacked form-hr" method="POST" id="formAddVacancy" ajax="true">
                    @csrf
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>Job Title<span class="required-sign">*</span></label>
                                        <input type="text" class="form-control" name="titleVacancy" id="titleVacancy" placeholder="Add a vacancy titles...">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="typeVacancyDiv">
                                    <label>Type<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="typeVacancy" name="typeVacancy">
                                        <option value="">Type</option>
                                        <option value="1">Full Time</option>
                                        <option value="2">Intership</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="locationVacancyDiv">
                                    <label>Location<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="locationVacancy" name="locationVacancy">
                                        <option value="">-- Pilih Location --</option>
                                        @foreach($wilayah as $dataWilayah)
                                            <option value="{{$dataWilayah['kabupaten']}}">{{$dataWilayah['kabupaten']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Working Time<span class="required-sign">*</span></label>
                                        <input id="workingTimeVacancy" name="workingTimeVacancy" class="form-control" type="text" placeholder="Working Time">
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
                                        <label>Actived Date<span class="required-sign">*</span></label>
                                        <input id="activatedDate" name="activatedDate" class="form-control" type="text" placeholder="Activated Date">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="degreeVacancyDiv">
                                    <label>Degree<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="degreeVacancy" name="degreeVacancy">
                                        <option value="">Degree</option>
                                        <option value="1">D3</option>
                                        <option value="2">S1</option>
                                        <option value="3">S2</option>
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
                                        <label>Major<span class="required-sign">*</span></label>
                                        <div id="fieldMajorDiv1">
                                            <select class="select2 min-width" id="field-syarat1" name="majorVacancy">
                                                <option value="">-- Pilih Major --</option>
                                                <option value="all">ALL</option>
                                                @foreach($major as $dataMajor)
                                                    <option value="{{$dataMajor['major']}}">{{$dataMajor['major']}}</option>
                                                @endforeach
                                            </select>
                                            <button id="b2" class="add-more-syarat btn-plus" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description Vacancy<span class="required-sign">*</span></label>
                                <div class="summernote-news-wrapper">
                                    <textarea name="descriptionVacancy" id="descriptionVacancy" class="form-control" placeholder="Input Description"></textarea>
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