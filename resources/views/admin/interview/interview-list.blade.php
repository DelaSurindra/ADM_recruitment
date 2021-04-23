@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="title-page"><img src="{{asset('image/icon/main/icon_title_interview.svg')}}" alt=""> Manage Interview</p>
            </div>
            <div class="col-md-6">
                <a href="{{route('get.interview.add')}}"><button type="button" class="btn btn-red right">Add Interview</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableInterview" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th>Interview Date</th>
                            <th>Name</th>
                            <th>Job Position</th>
                            <th>Area</th>
                            <th>Interview Type</th>
                            <th>Interviewer</th>
                            <th>Time</th>
                            <th>City</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th></th>
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

@section('modal')
<div class="modal fade" id="modalUpdateStatus" tabindex="-1" aria-labelledby="modalUpdateStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3" class="textItem"></p>
                <form action="{{route('post.update.status.interview')}}" class="form stacked form-hr" ajax=true id="updateStatusInterview">
                    <input type="hidden" id="idUpdateStatus" name="idUpdateStatus">
                    <input type="hidden" id="idJobApp" name="idJobApp">
                    <input type="hidden" id="statusJobApp" name="statusJobApp">
                    <input type="hidden" id="idKandidat" name="idKandidat">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-column">
                                <label>Status</label>
                                <select class="select2 tex-center" id="statusInterview" name="statusInterview">
                                    <option value="2">Pass</option>
                                    <option value="3">Fail</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row row-location">
                        <div class="col-md-12">
                            <label>Reason<span class="required-sign">*</span></label>
                            <textarea name="noteInterview" id="noteInterview" class="form-control" placeholder="Enter Note"></textarea>
                        </div>
                    </div>
                    <div class="row hidden" id="divFail">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="custome-radio-wrapper mb-2 mr-4"> Dapat lanjut ketahap berikutnya
                                    <input type="radio" name="statusFail" id="statusFail1" value="1" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custome-radio-wrapper mb-0"> Dinyatakan gagal
                                    <input type="radio" name="statusFail" id="statusFail2" value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection