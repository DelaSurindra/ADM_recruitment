@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="title-page"><img src="{{asset('image/icon/main/icon_title_timesubtest.svg')}}" alt=""> Manage Time Sub Test</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableTimeSubTest" class="table-hr table table-strip stripe hover" width="100%">
                    <thead>
                        <tr>
                            <th class="width-univ">Sub Type</th>
                            <th class="width-univ">Time</th>
                            <th class="width-edit"></th>
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
<div class="modal fade" id="modalEditTimeSubTest" aria-labelledby="modalEditTimeSubTestLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">Edit Time Sub Test "<span id="nameSubTest"></span>"</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <form action="{{route('post.edit.time-subtest')}}" class="form stacked form-hr" ajax=true id="formEditTimeSubtest">
                    <input type="hidden" name="idTimeSubTest" id="idTimeSubTest">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" >
                                <label id="labelMaster">Time<span class="required-sign">*</span></label>
                                <input id="timeSubTest" name="timeSubTest" class="form-control" type="text" placeholder="Input Time Sub Test">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100 btn-confirm" value="decline">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection