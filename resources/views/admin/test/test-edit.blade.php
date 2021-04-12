@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{ route('post.test.edit') }}" class="form stacked form-hr" method="POST" id="formAddTest" ajax="true">
    @csrf
    <input type="hidden" name="idTest" value="{{$data['id']}}">
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
                                        <label>Test ID</label>
                                        <input type="text" class="form-control" name="eventTest" id="eventTest" disabled value="{{$data['event_id']}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>City<span class="required-sign">*</span></label>
                                        <input type="text" class="form-control" name="cityTest" id="cityTest" placeholder="Enter City" value="{{$data['city']}}">
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
                                    <textarea name="locationTest" id="locationTest" class="form-control" placeholder="Enter Location">{{$data['location']}}</textarea>
                                    
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Time<span class="required-sign">*</span></label>
                                        <input id="timeTest" name="timeTest" class="form-control" type="text" placeholder="00:00 - 23-59" value="{{$data['time']}}">
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
                                        <input id="dateTest" name="dateTest" class="form-control" type="text" placeholder="Choose Date" value="{{date('d-m-Y', strtotime($data['date_test']))}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12" id="degreeVacancyDiv">
                                    <div class="form-group" >
                                        <label>Longlat<span class="required-sign">*</span></label>
                                        <input id="longlatTest" name="longlatTest" class="form-control" type="text" placeholder="Enter Longlat" value="{{$data['latlong']}}">
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
                                        <input type="checkbox" name="setTest" id="setTest1" value="1" {{in_array('1', $data['set_test']) ? 'checked' : ''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container-custom-checked mb-0 mr-3"> 2
                                        <input type="checkbox" name="setTest" id="setTest2" value="2" {{in_array('2', $data['set_test']) ? 'checked' : ''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container-custom-checked mb-0 mr-3"> 3
                                        <input type="checkbox" name="setTest" id="setTest3" value="3" {{in_array('3', $data['set_test']) ? 'checked' : ''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container-custom-checked mb-0"> 4
                                        <input type="checkbox" name="setTest" id="setTest4" value="4" {{in_array('4', $data['set_test']) ? 'checked' : ''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="countTest" value="{{count($alternative)}}">
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-xl-10 col-md-12" id="divAlternatif">
                            @foreach($alternative as $value)
                                <div class="div-alternatif" id="setAlternatif{{$value['alternative_test_id']}}">
                                    <input type="hidden" name="alternatifTest" class="id-alternatif-test id-check" value="{{$value['alternative_test_id']}}">
                                    <input type="hidden" name="alternatifTestDate" class="id-alternatif-test" value="{{$value['date']}}">
                                    <div class="dropdown-divider mb-4"></div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="title-alternatif title-id">Test Alternative 1 ID</p>
                                            <p class="content-alternatif">{{$value['event_id']}}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="title-alternatif title-date">Date Test Alternative 1</p>
                                            <p class="content-alternatif">{{$value['date']}}</p>
                                        </div>
                                        <div class="col-md-2 pt-2">
                                        <button value="{{$value['alternative_test_id']}}" type="button" class="btn btn-delete-alternatif btn-transparent"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Alternative Test">&nbspDelete</button>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider mt-4 mb-4"></div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <button type="button" class="btn btn-white w-100 {{count($alternative) == '3' ? 'hidden' : ''}}" id="addAlternative"><img src="{{asset('image/icon/main/icon_plus.svg')}}" alt="">&nbsp Add Another Alternative Test</button>
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