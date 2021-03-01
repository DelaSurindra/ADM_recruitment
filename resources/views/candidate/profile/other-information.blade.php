@extends('candidate.profile.profile')
@section('profile')
<div class="breadcrumb-candidate">
    <a class="bread active" href="#">Edit Profil</a>
    <p class="bread">/Edit Other Information</p>
</div>
<h2 class="candidate-page-title">Edit Other Information</h2>
<div class="row mt-5">
    <div class="col-12">
        <form action="{{ route('post.profile.other-information') }}" id="formEditOtherInformation" method="POST" class="form-candidate-view" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idCandidate" id="idCandidate" value="{{ Session::get('session_candidate')['id'] }}">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Cover Letter<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12 with-icon">
                                <input type="text" name="coverLetterLink" id="coverLetterLink" class="form-control" placeholder="You can attach file or send a link direct to your file">
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file" name="coverLetter" id="coverLetter">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Resume<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12 with-icon">
                                <input type="text" name="resumeLink" id="resumeLink" class="form-control" placeholder="You can attach file or send a link direct to your file">
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file" name="resume" id="resume">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Portofolio<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12 with-icon">
                                <input type="text" name="portofolioLink" id="portofolioLink" class="form-control" placeholder="You can attach file or send a link direct to your file">
                                <p id="filenameCertificateStudy" class="m-1"></p>
                                <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file" name="portofolio" id="portofolio">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="">Skill<span class="required-sign">*</span></label>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Mention all your skill"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <button type="submit" class="btn btn-red btn-block">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('app')
    @include('candidate.profile.my-app-home')
@endsection