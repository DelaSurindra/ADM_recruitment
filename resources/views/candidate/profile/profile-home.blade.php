<h2 class="candidate-page-title">Edit Profile</h2>
<div class="row mt-4">
    <div class="col-lg-7 col-md-12">
        <div class="wrapper-card-edit-profile d-flex align-items-center justify-content-between">
            <h4 class="candidate-page-subtitle mb-0">Personal Information</h4>
            <a href="{{ route('get.profile.personal-information') }}" class="edit-text d-flex align-items-center mr-1">
                <img src="{{ asset('image/icon/homepage/edit-icon-red.svg') }}" alt="icon"> Edit
            </a>
        </div>
        <div class="card card-profile mt-3">
            <div class="card-body">
                <div class="text-center wrapper-header-card-personal">
                    @if(session('session_candidate.foto_profil') == null)
                    <img class="rounded-circle img-profile" src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="avatar">
                    @else
                    <img class="rounded-circle img-profile" src="{{asset('storage/').'/'.session('session_candidate.foto_profil') }}" alt="avatar">
                    @endif
                    <div class="d-flex justify-content-center align-items-center mb-1">
                        <h6 class="mb-0 mr-2">{{session('session_candidate.first_name')}} {{session('session_candidate.last_name')}}</h6>
                        <span class="gender-badge">Male</span>
                    </div>
                    <p class="email-text">{{session('session_candidate.user_email')}}</p>
                </div>
                <div class="wrapper-content-card-personal">
                    <div class="row">
                        <div class="col-5">
                            <label for="">Date of Birth</label>
                            <p class="value-profile">{{date('d F Y', strtotime(session('session_candidate.tanggal_lahir')))}}</p>
                        </div>
                        <div class="col-7">
                            <label for="">Phone Number</label>
                            <p class="value-profile">{{session('session_candidate.telp')}}</p>
                        </div>
                        <div class="col-12">
                            <label for="">Location</label>
                            <p class="value-profile">{{session('session_candidate.kota')}}</p>
                        </div>
                        <div class="col-12">
                            <label for="">Linkedin Profile</label>
                            <p class="value-profile">{{session('session_candidate.linkedin')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <div class="wrapper-card-edit-profile d-flex align-items-center justify-content-between">
            <h4 class="candidate-page-subtitle mb-0">Other Information</h4>
            <a href="{{ route('get.profile.other-information') }}" class="edit-text d-flex align-items-center mr-1">
                <img src="{{ asset('image/icon/homepage/edit-icon-red.svg') }}" alt="icon"> Edit
            </a>
        </div>
        <div class="card card-profile mt-3">
            <div class="card-body">
                <div class="wrapper-content-card-personal mt-0">
                    <div class="row">
                        <div class="col-12 form-candidate-view">
                            <div class="form-group">
                                <label for="">Cover Letter</label>
                                <input type="text" class="form-control" value="{{session('session_candidate.cover_letter')}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Resume</label>
                                <input type="text" class="form-control" value="{{session('session_candidate.resume')}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Portofolio</label>
                                <input type="text" class="form-control" value="{{session('session_candidate.protofolio')}}" disabled>
                            </div>
                            <div class="form-group mb-0">
                                <label for="">Skill</label>
                                <textarea name="" id="" class="form-control" rows="3" style="height:auto" disabled>{{session('session_candidate.skill')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-7 col-md-12">
        <div class="wrapper-card-edit-profile d-flex align-items-center justify-content-between">
            <h4 class="candidate-page-subtitle mb-0">Education Information</h4>
            <a href="{{ route('get.profile.education-information') }}" class="edit-text d-flex align-items-center mr-1">
                <img src="{{ asset('image/icon/homepage/edit-icon-red.svg') }}" alt="icon"> Edit
            </a>
        </div>
        @foreach(session('session_candidate.pendidikan') as $pendidikan)
            <div class="card card-profile mt-3">
                <div class="card-body">
                    <div class="wrapper-header-card-personal">
                        @if($pendidikan['gelar'] == "1")
                        <span class="gender-badge">D3</span>
                        @elseif($pendidikan['gelar'] == "2")
                        <span class="gender-badge">S1</span>
                        @else
                        <span class="gender-badge">S2</span>
                        @endif
                        <h6 class="my-2">{{$pendidikan['universitas']}}</h6>
                        <p class="email-text">{{$pendidikan['jurusan']}}, {{$pendidikan['fakultas']}}</p>
                    </div>
                    <div class="wrapper-content-card-personal">
                        <div class="row">
                            <div class="col-5">
                                <label for="">Start Year</label>
                                <p class="value-profile">{{$pendidikan['start_year']}}</p>
                            </div>
                            <div class="col-7">
                                <label for="">End Date</label>
                                <p class="value-profile">{{$pendidikan['end_year']}}</p>
                            </div>
                            <div class="col-12 form-candidate-view">
                                <div class="form-group mb-0">
                                    <label for="">Certificate of Study</label>
                                    <input type="text" class="form-control" value="{{$pendidikan['ijazah']}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>