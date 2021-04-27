@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{ route('post.test.add') }}" class="form stacked form-hr" method="POST" id="formAddTest">
    @csrf
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Create</p>
                    <p class="text-title-page-big">Test Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>City<span class="required-sign">*</span></label>
                                        <input type="text" class="form-control" name="cityTest" id="cityTest" placeholder="Enter City">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-location">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="locationVacancyDiv">
                                    <label>Location<span class="required-sign">*</span></label>
                                    <textarea name="locationTest" id="locationTest" class="form-control" placeholder="Enter Location"></textarea>
                                    
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Time<span class="required-sign">*</span></label>
                                        <input id="timeTest" name="timeTest" class="form-control" type="text" placeholder="00:00 - 23-59">
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
                                        <label>Date Test<span class="required-sign">*</span></label>
                                        <input id="dateTest" name="dateTest" class="form-control" type="text" placeholder="Choose Date">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="degreeVacancyDiv">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Latitude & Longitude<span class="required-sign">*</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{asset('image/icon/main/icon_info_red.svg')}}" id="btnInfoLatlong" class="right info-latlong">
                                            </div>
                                        </div>
                                        <input id="longlatTest" name="longlatTest" class="form-control" type="text" placeholder="latitude number,longitude number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="form-group" id="setTestDiv">
                                <label>Set Test<span class="required-sign">*</span></label>
                                <div class="d-flex align-items-center">
                                    <label class="container-custom-checked mb-0 mr-3"> 1
                                        <input type="checkbox" name="setTest" id="setTest1" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container-custom-checked mb-0 mr-3"> 2
                                        <input type="checkbox" name="setTest" id="setTest2" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container-custom-checked mb-0 mr-3"> 3
                                        <input type="checkbox" name="setTest" id="setTest3" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container-custom-checked mb-0"> 4
                                        <input type="checkbox" name="setTest" id="setTest4" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="countTest" value="0">
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-xl-10 col-md-12" id="divAlternatif">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <button type="button" class="btn btn-white w-100" id="addAlternative"><img src="{{asset('image/icon/main/icon_plus.svg')}}" alt="">&nbsp Add Another Alternative Test</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-red w-100">Save</button>
        </div>
    </div>
</form>
    
@endsection

@section('modal')
<div class="modal fade" id="modalAlternativeTest" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-title-page-big pt-2">Choose Maximum 3 Test</p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-red right" id="btnAddAlternative">Add Selected Data</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <table id="tableAlternatifTest" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th class="width-checkbox"></th>
                            <th>Date</th>
                            <th>Test ID</th>
                            <th>Test Date</th>
                            <th>Time</th>
                            <th>City</th>
                            <th>Location</th>
                            <th>Set Test</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection