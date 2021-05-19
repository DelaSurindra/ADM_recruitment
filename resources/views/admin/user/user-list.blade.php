@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="title-page"><img src="{{asset('image/icon/main/icon_title_user.svg')}}" alt=""> Manage User/Role</p>
            </div>
            <div class="col-md-6">
                <a href="{{route('get.user.add')}}"><button type="button" class="btn btn-red right">Add User</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableUser" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>No. Telephone</th>
                            <th>Role</th>
                            <th>Status</th>
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
<div class="modal fade" id="modalDeleteUser" aria-labelledby="modalDeleteUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up mb-3">
                    <h4 class="modal-hr-title mb-0" id="titleDeleteUser"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-4"><span class="span-reschedule" id="textDeleteUser"></span></p>
                <form action="{{route('post.user.delete')}}" class="form stacked form-hr" ajax=true id="formDeleteUser">
                    <input type="hidden" name="idDeleteUser" id="idDeleteUser">
                    <input type="hidden" name="typeDeleteUser" id="typeDeleteUser">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100 btn-confirm" id="btnDeleteUser"></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection