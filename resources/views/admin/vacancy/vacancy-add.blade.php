@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('post.vacancy.add') }}" class="form stacked" method="POST" id="formAddVacancy" ajax="true">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <!-- <div class="col-xl-2 col-md-3">
                                        <div class="dropzone-wrapper">
                                            <div class="dropzone-desc">
                                                <img src="{{ asset('image/icon/main/add-image.png') }}" alt="icon">
                                                <p>Upload Image</p>
                                            </div>
                                            <input type="file" name="imageNewsEvent" class="dropzone" id="imageNewsEvent">
                                        </div>
                                        <small>*Jpeg(.jpg or .jpeg) max 2mb</small>
                                    </div> -->
                                    <div class="col-xl-6 col-md-12">
                                        <div class="input-title-news">
                                            <h4 class="mb-4">Title</h4>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <img src="{{ asset('image/icon/main/add-circle.svg') }}" alt="icon">
                                                </div>
                                                <input type="text" class="form-control" name="titleVacancy" id="titleVacancy" placeholder="Add a vacancy titles...">
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
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Location</label>
                                                <select class="select2 tex-center" id="locationVacancy" name="locationVacancy">
                                                    <option value="">Location</option>
                                                    <option value="1">Surabaya</option>
                                                    <option value="2">Sidoarjo</option>
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
                                                <input id="minSalaryVacancy" name="minSalaryVacancy" class="form-control" type="text" placeholder="Min Salary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Max Salary</label>
                                                <input id="maxSalaryVacancy" name="maxSalaryVacancy" class="form-control" type="text" placeholder="Max Salary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Degree</label>
                                                <select class="select2 tex-center" id="degreeVacancy" name="degreeVacancy">
                                                    <option value="">Degree</option>
                                                    <option value="1">News</option>
                                                    <option value="2">Event</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Major</label>
                                                <select class="select2" multiple="multiple" id="majorVacancy" name="majorVacancy[]">
                                                    <option value="1">Major 1</option>
                                                    <option value="2">Major 2</option>
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
                                                <input id="workingTimeVacancy" name="workingTimeVacancy" class="form-control" type="text" placeholder="Working Time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-xl-11 col-md-12">
                                                <label>Activated Date</label>
                                                <input id="activatedDate" name="activatedDate" class="form-control" type="text" placeholder="Activated Date">
                                            </div>
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