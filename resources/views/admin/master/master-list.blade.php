@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card-question">
    <div class="row head">
        <div class="col-md-6">
            <p class="title-page"><img src="{{asset('image/icon/main/icon_title_master.svg')}}" alt=""> Manage Data Master</p>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-red right" data-toggle="modal" data-target="#modalAddMaster">Add Data</button>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red active" id="tabUniv" data-toggle="tab" href="#universitas" role="tab" aria-controls="universitas" aria-selected="true">University</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red" id="tabMajor" data-toggle="tab" href="#major" role="tab" aria-controls="major" aria-selected="false">Major</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="universitas" role="tabpanel" aria-labelledby="universitas">
            <div class="body">
                <table id="tableUniv" class="table-hr table table-strip stripe hover" width="100%">
                    <thead>
                        <tr>
                            <th class="width-univ">University</th>
                            <th class="width-edit"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="major" role="tabpanel" aria-labelledby="major">
            <div class="body">
                <table id="tableMajor" class="table-hr table table-strip stripe hover" width="100%">
                    <thead>
                        <tr>
                            <th class="width-univ">Major</th>
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
<div class="modal fade" id="modalAddMaster" tabindex="-1" aria-labelledby="modalAddMasterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <form action="{{route('post.master.add')}}" class="form stacked form-hr" ajax=true id="formAddMaster">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-column">
                                <label>Type</label>
                                <select class="select2 tex-center" id="typeMaster" name="typeMaster">
                                    <option value="1">University</option>
                                    <option value="2">Major</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="divUniv">
                            <div class="form-group" >
                                <label>University Name<span class="required-sign">*</span></label>
                                <input id="nameUniv" name="nameUniv" class="form-control" type="text" placeholder="Input university name" required>
                            </div>
                        </div>
                        <div class="col-md-12 hidden" id="divMajor">
                            <div class="form-group">
                                <label>Major Name<span class="required-sign">*</span></label>
                                <input id="nameMajor" name="nameMajor" class="form-control" type="text" placeholder="Input major name" required disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100 btn-confirm" value="decline">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditMaster" tabindex="-1" aria-labelledby="modalEditMasterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <form action="{{route('post.master.edit')}}" class="form stacked form-hr" ajax=true id="formEditMaster">
                    <input type="hidden" name="idEdit" id="idEdit">
                    <input type="hidden" name="typeEdit" id="typeEdit">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" >
                                <label id="labelMaster"><span class="required-sign">*</span></label>
                                <input id="nameEdit" name="nameEdit" class="form-control" type="text" placeholder="Input master name" required>
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

<div class="modal fade" id="modalDeleteMaster" tabindex="-1" aria-labelledby="modalDeleteMasterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0">Delete Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-4"><span class="span-reschedule"></span> Are you sure for delete data master "<span class="span-reschedule" id="spanMaster"></span>" ?</p>
                <form action="{{route('post.master.delete')}}" class="form stacked form-hr" ajax=true id="formDeleteMaster">
                    <input type="hidden" name="idDelete" id="idDelete">
                    <input type="hidden" name="typeDelete" id="typeDelete">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100 btn-confirm" value="decline">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection