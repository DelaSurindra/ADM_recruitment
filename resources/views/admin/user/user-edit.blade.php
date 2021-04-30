@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<form action="{{route('post.user.edit')}}" class="form stacked form-hr" method="POST" id="formEditUser" ajax="true">
    <input type="hidden" name="idUser" value="{{$user['id']}}">
    <div class="row">
        <div class="col-md-12">
            <div class="card clear">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <p class="text-title-page-small">Edit</p>
                            <p class="text-title-page-big">User & Role</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group" >
                                                <label>Email<span class="required-sign">*</span></label>
                                                <input id="emailUser" name="emailUser" class="form-control" type="text" placeholder="Input Email" value="{{$user['email']}}" disabled>
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
                                                <label>First Name<span class="required-sign">*</span></label>
                                                <input id="firstNameUser" name="firstNameUser" class="form-control" type="text" placeholder="Input first name" value="{{$user['first_name']}}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Last Name<span class="required-sign">*</span></label>
                                                <input id="lastNameUser" name="lastNameUser" class="form-control" type="text" placeholder="Input last name" value="{{$user['last_name']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Gender<span class="required-sign">*</span></label>
                                                <div class="d-flex">
                                                    <label class="custome-radio-wrapper mb-0 mr-4"> Male
                                                        <input type="radio" name="genderUser" id="gender1" value="1" {{$user['gender'] == '1' ? 'checked' : ''}}>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="custome-radio-wrapper mb-0"> Female
                                                        <input type="radio" name="genderUser" id="gender2" value="2" {{$user['gender'] == '2' ? 'checked' : ''}}>
                                                        <span class="checkmark"></span>
                                                    </label>
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
                                            <div class="form-group" >
                                                <label>Telephone<span class="required-sign">*</span></label>
                                                <input id="telpUser" name="telpUser" class="form-control" type="text" placeholder="Input telephone number" value="{{$user['telp']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-10 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="form-group" id="roleUserDiv">
                                                <label>Role<span class="required-sign">*</span></label>
                                                <select class="select2 tex-center select2-width" id="roleUser" name="roleUser">
                                                    <option value="">-- Choose Role --</option>
                                                    @foreach($role as $dataRole)
                                                    <option {{$user['role'] == $dataRole['id'] ? 'selected' : ''}} value="{{$dataRole['id']}}">{{$dataRole['role_name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
        <div class="col-lg-6 col-md-12 d-flex align-items-center">
            <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
        </div>
        <div class="col-lg-6 col-md-12">
            <button class="btn btn-red right w-100">Save</button>
        </div>
    </div>
</form>
@endsection