@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <h2 class="candidate-page-title">Create New<br>Password</h2>
            <p>Your new password must be different with previous password</p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12">
        <img src="{{ asset('image/icon/login/ilustrasi_password.svg') }}" alt="logo" style="width: 40%; height: auto;">
        </div>
    </div>
    @if($type == 1)
    <form action="{{ route('do.forget') }}" id="formResetPass" class="form-candidate-view mt-5" method="POST" ajax="true">
            <input type="hidden" name="idCandidate" id="idCandidate" value="{{$data['id']}}">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">New Password<span class="required-sign">*</span></label>
                        <div class="with-icon">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon thisIconEye" alt="icon" style="right: 13px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
            <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Confirm New Password<span class="required-sign">*</span></label>
                        <div class="with-icon">
                            <input type="password" name="passwordRe" id="passwordRe" class="form-control" placeholder="Password">
                            <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon thisIconEye" alt="icon" style="right: 13px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 d-flex align-items-center">
                    <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <div class="form-group pt-3">
                                <button class="btn btn-red btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    @else
        <h2 class="candidate-page-title">Link Invalid</h2>
        <p>Silahkan ulangi reset password</p>
    @endif
</div>
@endsection