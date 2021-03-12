@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div style="margin:20px 0px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red active" id="detailCandidate1-tab" data-toggle="tab" href="#detailCandidate1" role="tab" aria-controls="detailCandidate1" aria-selected="true">Candidate Information</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red" id="detailCandidate2-tab" data-toggle="tab" href="#detailCandidate2" role="tab" aria-controls="detailCandidate2" aria-selected="false">Recruitment Result</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="detailCandidate1" role="tabpanel" aria-labelledby="detailCandidate1-tab">
            <div class="card card-detail-candidate">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-title-page-small">View</p>
                                    <p class="text-title-page-big">Personal Information</p>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="col-md-12">
                                @if($data['foto_profil'] == null || $data['foto_profil'] == "")
                                    <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="img" class="img-fluid img-profile-detail">
                                @else
                                    <img src="{{asset('storage/').'/'.$data['foto_profil'] }}" alt="img" class="img-fluid img-profile-detail">
                                @endif
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">First Name</label>
                                    <p class="detail">{{$data['first_name']}}</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Last Name</label>
                                    <p class="detail">{{$data['last_name']}}</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Date of Birth</label>
                                    <p class="detail">{{$data['tanggal_lahir']}}</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Gender</label>
                                    <p class="detail">{{$data['gender'] == "1" ? 'Male':'Female'}}</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Email</label>
                                    <p class="detail">sahadilalalhi@gmail.com</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Phone Number</label>
                                    <p class="detail">{{$data['telp']}}</p>
                                </div>
                                <div class="distance col-md-12">
                                    <label for="">Location</label>
                                    <p class="detail">{{$data['kota']}}</p>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Linkedin Profile</label>
                                        <input type="text" id="linkedin" class="input-linkedin" readonly value="{{$data['linkedin']}}">
                                    </div>
                                    <button type="button" class="btn btn-copy" id="copyLinkedin">
                                        <img class="image-copy" src="{{ asset('image/icon/homepage/icon-copy.svg') }}" alt="icon">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-detail-candidate">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <p class="text-title-page-small">View</p>
                                    <p class="text-title-page-big">Education Information</p>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                @if($data['pendidikan'] != [])
                                @foreach($data['pendidikan'] as $pendidikan)
                                    <div class="distance col-lg-5 col-md-6 col-sm-12">
                                        <label for="">School/University</label>
                                        <p class="detail">{{$pendidikan['universitas']}}</p>
                                    </div>
                                    <div class="distance col-lg-5 col-md-6 col-sm-12">
                                        <label for="">Degree</label>
                                        @if($pendidikan['gelar'] == "1")
                                        <p class="detail">D3</p>
                                        @elseif($pendidikan['gelar'] == "2")
                                        <p class="detail">S1</p>
                                        @else
                                        <p class="detail">S2</p>
                                        @endif
                                    </div>
                                    <div class="distance col-lg-5 col-md-6 col-sm-12">
                                        <label for="">Faculty</label>
                                        <p class="detail">{{$pendidikan['fakultas']}}</p>
                                    </div>
                                    <div class="distance col-lg-5 col-md-6 col-sm-12">
                                        <label for="">Major</label>
                                        <p class="detail">{{$pendidikan['jurusan']}}</p>
                                    </div>
                                    <div class="distance col-md-12">
                                        <label for="">Education Year</label>
                                        <p class="detail">{{$pendidikan['start_year']}} - {{$pendidikan['end_year']}}</p>
                                    </div>
                                    <div class="distance col-lg-5 col-md-6 col-sm-12">
                                        <label for="">GPA</label>
                                        <p class="detail">{{$pendidikan['gpa']}}</p>
                                    </div>
                                    <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                        <div>
                                            <label for="">Certificate of Study</label>
                                            <p class="detail">{{$pendidikan['ijazah']}}</p>
                                        </div>
                                        <a href="{{route('post.download.file', base64_encode(urlencode($pendidikan['ijazah'])))}}">
                                            <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                        </a>
                                    </div>

                                    <div class="col-12">
                                        <hr class="divider">
                                    </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-detail-candidate">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11 col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <p class="text-title-page-small">View</p>
                                    <p class="text-title-page-big">Other Information</p>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Cover Letter</label>
                                        <p class="detail">{{$data['cover_letter']}}</p>
                                    </div>
                                    <a href="{{route('post.download.file', base64_encode(urlencode($data['cover_letter'])))}}">
                                        <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                    </a>
                                </div>
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Resume</label>
                                        <p class="detail">{{$data['resume']}}</p>
                                    </div>
                                    <a href="{{route('post.download.file', base64_encode(urlencode($data['resume'])))}}">
                                        <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                    </a>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="distance col-lg-5 col-md-6 col-sm-12 d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="">Portofolio</label>
                                        <p class="detail">{{$data['protofolio']}}</p>
                                    </div>
                                    <a href="{{route('post.download.file', base64_encode(urlencode($data['protofolio'])))}}">
                                        <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">
                                    </a>
                                </div>
                            </div>
                            <div class="row detail-candidate-text">
                                <div class="distance col-lg-5 col-md-6 col-sm-12">
                                    <label for="">Skill</label>
                                    <p class="detail">{{$data['skill']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="detailCandidate2" role="tabpanel" aria-labelledby="detailCandidate2-tab">
            <div class="card">
                <div class="card-body">
                    aaaa
                </div>
            </div>
        </div>
    </div>
</div>

@endsection