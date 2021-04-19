@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{ route('post.interview.add') }}" class="form stacked form-hr" method="POST" id="formAddInterview" ajax="true">
    @csrf
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Create</p>
                    <p class="text-title-page-big">Interview Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="typeInterviewDiv">
                                    <label>Interview Type<span class="required-sign">*</span></label>
                                    <select class="select2 tex-center select2-width" id="typeInterview" name="typeInterview">
                                        <option value="">-- Pilih Type --</option>
                                        @foreach($interviewType as $dataType)
                                            <option value="{{$dataType['id']}}">{{$dataType['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 hidden" id="lastInterviewDiv">
                                    <div class="d-flex align-items-center mt-4">
                                        <label class="container-custom-checked mb-0 mr-3"> Last Interview
                                            <input type="checkbox" name="lastInterview" id="lastInterview" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="locationVacancyDiv">
                                    <div class="form-group" >
                                        <label>Interview Date<span class="required-sign">*</span></label>
                                        <input id="dateInterview" name="dateInterview" class="form-control" type="text" placeholder="Choose Date">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Time<span class="required-sign">*</span></label>
                                        <input id="timeInterview" name="timeInterview" class="form-control" type="text" placeholder="00:00 - 23-59">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-location">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <label>Location<span class="required-sign">*</span></label>
                                    <textarea name="locationInterview" id="locationInterview" class="form-control" placeholder="Enter Location"></textarea>
                                    
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>City<span class="required-sign">*</span></label>
                                        <input id="cityInterview" name="cityInterview" class="form-control" type="text" placeholder="Enter City">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label>Interviewer<span class="required-sign">*</span></label>
                                        <input id="interviewer" name="interviewer" class="form-control" type="text" placeholder="Enter Interviewer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card clear" id="cardAddCandidate">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <center>
                        <img src="{{asset('image/icon/main/icon_empty_participant.svg')}}" class="img-empty-participant mb-3">
                        <p class="title-empty-participant mb-2">There is no candidate here</p>
                        <p class="text-empty-participant mb-4">Please add some candidate to join your interview</p>
                        <button type="button" class="btn btn-red" id="addCandidateInterview" data-toggle="modal" data-target="#modalChooseInterview">Add Candidate</button>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <div id="chooseInterview"></div>
    <input type="hidden" id="countChoose" name="countChoose" value="0">
    
    <div class="card clear hidden" id="cardListCandidate">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3">
                    <p class="text-title-page-small">Add</p>
                    <p class="text-title-page-big">Interview Participant</p>
                </div>
                <div class="col-md-9">
                    <button type="button" class="btn btn-red right" id="addCandidateInterview" data-toggle="modal" data-target="#modalChooseInterview">Add Candidate</button>
                </div>
            </div>
            <div class="row">
                <table id="tablePickInterview" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>University</th>
                            <th>Major</th>
                            <th>Job Position</th>
                            <th>Job Type</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyInterview">
                        
                    </tbody>
                </table>
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
<div class="modal fade" id="modalChooseInterview" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-title-page-big pt-2">Choose Candidate</p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-red right hidden" id="btnAddCandidateInterview">Add Selected Data</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <table id="tableChooseInterview" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th class="width-checkbox"></th>
                            <th>Submit Date</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Graduate</th>
                            <th>University</th>
                            <th>Faculty</th>
                            <th>Major</th>
                            <th>GPA</th>
                            <th>Graduate Year</th>
                            <th>Job Position</th>
                            <th>Area</th>
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