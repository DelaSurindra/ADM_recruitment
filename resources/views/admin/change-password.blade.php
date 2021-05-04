@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('post.change-password') }}" class="form stacked form-hr" method="POST" id="formChangePassword" ajax="true">
        <input type="hidden" name="idUser" value="{{session('session_id.id')}}">
        @csrf
            <div class="card clear">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <p class="text-title-page-small">Edit</p>
                            <p class="text-title-page-big">Change Password</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Old Password<span class="required-sign">*</span></label>
                                                <input id="oldPassword" name="oldPassword" class="form-control" type="password" placeholder="Input Old Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>New Password<span class="required-sign">*</span></label>
                                                <input id="newPassword" name="newPassword" class="form-control" type="password" placeholder="Input New Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>New Password Confirmation<span class="required-sign">*</span></label>
                                                <input id="konfirmationPassword" name="konfirmationPassword" class="form-control" type="password" placeholder="Input Konfirmation Password">
                                            </div>
                                        </div>
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
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <button type="submit" class="btn btn-red w-100 right">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection