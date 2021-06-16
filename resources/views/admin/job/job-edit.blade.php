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
                            <form action="{{route('post.job.edit')}}" class="form stacked form-hr" method="POST" id="formEditJob" ajax="true">
                                <input type="hidden" name="idJob" value="{{$data['job_id']}}">
                                <input type="hidden" name="idKandidat" value="{{$data['id']}}">
                                <div class="row">
                                    <div class="col-xl-10 col-md-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 col-sm-12" id="aplicationStatusDiv">
                                                <label>Application Status</label>
                                                <select class="select2 tex-center select2-width" id="aplicationStatus" name="aplicationStatus">
                                                    <option {{$data['status_job'] == '1' ? 'selected':''}} value="1">Process To Written Test</option>
                                                    <option {{$data['status_job'] == '11' ? 'selected':''}} value="11">Failed</option>
                                                    <option {{$data['status_job'] == '12' ? 'selected':''}} value="12">Hired</option>
                                                    <option {{$data['status'] == '3' ? 'selected':''}} value="99">Talent Stock</option>
                                                    <option {{$data['status_job'] == '3' ? 'selected':''}} value="3">Written Test Pass</option>
                                                    <option {{$data['status_job'] == '0' ? 'selected':''}} disabled value="0">Application Resume</option>
                                                    <option {{$data['status_job'] == '2' ? 'selected':''}} disabled value="2">Scheduled to Written Test</option>
                                                    <option {{$data['status_job'] == '4' ? 'selected':''}} disabled value="4">Written Test failed</option>
                                                    <option {{$data['status_job'] == '5' ? 'selected':''}} disabled value="5">Process to HR interview</option>
                                                    <option {{$data['status_job'] == '6' ? 'selected':''}} disabled value="6">Process to User Interview 1</option>
                                                    <option {{$data['status_job'] == '7' ? 'selected':''}} disabled value="7">Process to User Interview 2</option>
                                                    <option {{$data['status_job'] == '8' ? 'selected':''}} disabled value="8">Process to Direktur Interview</option>
                                                    <option {{$data['status_job'] == '9' ? 'selected':''}} disabled value="9">Process to MCU</option>
                                                    <option {{$data['status_job'] == '10' ? 'selected':''}} disabled value="10">Process to Doc Sign</option>

                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-sm-12">
                                                <button type="submit" class="btn btn-red btn-edit-status" id="btnEditJob">Edit Status Job</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <p class="detail">{{$data['email']}}</p>
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
                                        <p class="detail">{{round($pendidikan['gpa'], 2)}}</p>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card clear">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-title-page-small">View</p>
                                    <p class="text-title-page-big">Summary Recruitment Result</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="track-applican-line">
                                        @if($history['online_test'] != [])
                                            <div class="green-line"></div>
                                        @else
                                            <div class="gray-line"></div>
                                        @endif

                                        @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['direktur_interview'] != [] || $history['user_interview2'] != [] || $history['user_interview1'] != [] || $history['hr_interview'] != [])
                                            <div class="green-line"></div>
                                        @else
                                            <div class="gray-line"></div>
                                        @endif

                                        @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['direktur_interview'] != [] || $history['user_interview2'] != [] || $history['user_interview1'] != [])
                                            <div class="green-line"></div>
                                        @else
                                            <div class="gray-line"></div>
                                        @endif

                                        @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['direktur_interview'] != [] || $history['user_interview2'] != [])
                                            <div class="green-line"></div>
                                        @else
                                            <div class="gray-line"></div>
                                        @endif

                                        @if($history['document_sign'] != [] || $history['mcu'] != [] || $history['direktur_interview'] != [])
                                            <div class="green-line"></div>
                                        @else
                                            <div class="gray-line"></div>
                                        @endif

                                        @if($history['document_sign'] != [] || $history['mcu'] != [])
                                            <div class="green-line"></div>
                                        @else
                                            <div class="gray-line"></div>
                                        @endif
                                        @if($history['document_sign'] != [])
                                            <div class="green-line"></div>
                                        @else
                                            <div class="gray-line"></div>
                                        @endif
                                    </div>
                                    <div class="track-applican">
                                        <div class="track-item {{ $history['apply'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['apply'] != [] ? asset('image/icon/homepage/track/track-resume-red.svg') : asset('image/icon/homepage/track/track-resume.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">Resume Application</p>
                                                @if($history['apply'] != [])
                                                <p class="subtitle">{{last($history['apply'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                                <div class="track-status success"><p class="success">Success</p></div>
                                            </div>
                                        </div>
                                        <div class="track-item {{ $history['online_test'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['online_test'] != [] ? asset('image/icon/homepage/track/track-online-test-red.svg') : asset('image/icon/homepage/track/track-online-test.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">Online Test </p>
                                                @if($history['online_test'] != [])
                                                <p class="subtitle">{{last($history['online_test'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                                @if($status['status_online_test'] != '')
                                                <div class="track-status {{$status['status_online_test']}}"><p class="{{$status['status_online_test']}}">{{ucfirst($status['status_online_test'])}}</p></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="track-item {{ $history['hr_interview'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['hr_interview'] != [] ? asset('image/icon/homepage/track/track-hr-interview-red.svg') : asset('image/icon/homepage/track/track-hr-interview.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">HR Interview</p>
                                                @if($history['hr_interview'] != [])
                                                <p class="subtitle">{{last($history['hr_interview'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                                @if($status['status_hr_interview'] != '')
                                                <div class="track-status {{$status['status_hr_interview']}}"><p class="{{$status['status_hr_interview']}}">{{ucfirst($status['status_hr_interview'])}}</p></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="track-item {{ $history['user_interview1'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['user_interview1'] != [] ? asset('image/icon/homepage/track/track-user-interview-red.svg') : asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">User Interview 1</p>
                                                @if($history['user_interview1'] != [])
                                                <p class="subtitle">{{last($history['user_interview1'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                                @if($status['status_user_interview1'] != '')
                                                <div class="track-status {{$status['status_user_interview1']}}"><p class="{{$status['status_user_interview1']}}">{{ucfirst($status['status_user_interview1'])}}</p></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="track-item {{ $history['user_interview2'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['user_interview2'] != [] ? asset('image/icon/homepage/track/track-user-interview-red.svg') : asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">User Interview 2</p>
                                                @if($history['user_interview2'] != [])
                                                <p class="subtitle">{{last($history['user_interview2'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                                @if($status['status_user_interview2'] != '')
                                                <div class="track-status {{$status['status_user_interview2']}}"><p class="{{$status['status_user_interview2']}}">{{ucfirst($status['status_user_interview2'])}}</p></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="track-item {{ $history['direktur_interview'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['direktur_interview'] != [] ? asset('image/icon/homepage/track/track-user-interview-red.svg') : asset('image/icon/homepage/track/track-user-interview.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">Direktur Interview</p>
                                                @if($history['direktur_interview'] != [])
                                                <p class="subtitle">{{last($history['direktur_interview'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                                @if($status['status_direktur_interview'] != '')
                                                <div class="track-status {{$status['status_direktur_interview']}}"><p class="{{$status['status_direktur_interview']}}">{{ucfirst($status['status_direktur_interview'])}}</p></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="track-item {{ $history['mcu'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['mcu'] != [] ? asset('image/icon/homepage/track/track-medical-checkup-red.svg') : asset('image/icon/homepage/track/track-medical-checkup.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">Medical Checkup</p>
                                                @if($history['mcu'] != [])
                                                <p class="subtitle">{{last($history['mcu'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                                @if($status['status_mcu'] != '')
                                                <div class="track-status {{$status['status_mcu']}}"><p class="{{$status['status_mcu']}}">{{ucfirst($status['status_mcu'])}}</p></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="track-item {{ $history['document_sign'] != [] ? 'active' : '' }}">
                                            <img src="{{$history['document_sign'] != [] ? asset('image/icon/homepage/track/track-document-sign-red.svg') : asset('image/icon/homepage/track/track-document-sign.svg') }}" alt="icon">
                                            <div class="track-text">
                                                <p class="title">Document Sign and Contract</p>
                                                @if($history['document_sign'] != [])
                                                <p class="subtitle">{{last($history['document_sign'])}}</p>
                                                @else
                                                <p class="subtitle"></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($cognitiveResult))
            <div class="row">
                <div class="col-md-12">
                    <div class="card clear">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <p class="text-title-page-small">Test Result</p>
                                    <p class="text-title-page-big">Kognitif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-result stripe">
                                        <tbody>
                                            <tr>
                                                <td rowspan="4" class="green"><center><b>Abstrak</b></center></td>
                                                <td class="green">Subtest 1 : {{$masterSubtest[0]['name']}}</td>
                                                <td class="green">{{(int)$cognitiveResult[0]['abstrak1']}}</td>
                                                <td rowspan="4" class="green">
                                                    <center>
                                                        <p class="mb-0">{{$cognitiveResult[0]['skorAbstrak']}}</p>
                                                        @if($cognitiveResult[0]['resultAbstrak'] == "PASS")
                                                        <b class="test-pass">({{$cognitiveResult[0]['resultAbstrak']}})</b>
                                                        @elseif($cognitiveResult[0]['resultAbstrak'] == "FAIL")
                                                        <b class="test-fail">({{$cognitiveResult[0]['resultAbstrak']}})</b>
                                                        @else
                                                        @endif
                                                    </center
                                                ></td>
                                            </tr>
                                            <tr>
                                                <td>Subtest 2 : {{$masterSubtest[1]['name']}}</td>
                                                <td>{{(int)$cognitiveResult[0]['abstrak2']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="green">Subtest 3 : {{$masterSubtest[2]['name']}}</td>
                                                <td class="green">{{(int)$cognitiveResult[0]['abstrak3']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Subtest 4 : {{$masterSubtest[3]['name']}}</td>
                                                <td>{{(int)$cognitiveResult[0]['abstrak4']}}</td>
                                            </tr>

                                            <tr>
                                                <td rowspan="4"><b><center><b>Numeric</b></center></b></td>
                                                <td class="green">Subtest 1 : {{$masterSubtest[4]['name']}}</td>
                                                <td class="green">{{(int)$cognitiveResult[0]['numerical1']}}</td>
                                                <td rowspan="4" class="green">
                                                    <center>
                                                        <p class="mb-0">{{$cognitiveResult[0]['skorNumeric']}}</p>
                                                        @if($cognitiveResult[0]['resultNumeric'] == "PASS")
                                                        <b class="test-pass">({{$cognitiveResult[0]['resultNumeric']}})</b>
                                                        @elseif($cognitiveResult[0]['resultNumeric'] == "FAIL")
                                                        <b class="test-fail">({{$cognitiveResult[0]['resultNumeric']}})</b>
                                                        @else
                                                        @endif
                                                    </center
                                                ></td>
                                            </tr>
                                            <tr>
                                                <td>Subtest 2 : {{$masterSubtest[5]['name']}}</td>
                                                <td>{{(int)$cognitiveResult[0]['numerical2']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="green">Subtest 3 : {{$masterSubtest[6]['name']}}</td>
                                                <td class="green">{{(int)$cognitiveResult[0]['numerical3']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Subtest 4 : {{$masterSubtest[7]['name']}}</td>
                                                <td>{{(int)$cognitiveResult[0]['numerical4']}}</td>
                                            </tr>

                                            <tr>
                                                <td rowspan="4" class="green"><b><center><b>Verbal</b></center></b></td>
                                                <td class="green">Subtest 1 : {{$masterSubtest[8]['name']}}</td>
                                                <td class="green">{{(int)$cognitiveResult[0]['verbal1']}}</td>
                                                <td rowspan="4" class="green">
                                                    <center>
                                                        <p class="mb-0">{{$cognitiveResult[0]['skorVerbal']}}</p>
                                                        @if($cognitiveResult[0]['resultVerbal'] == "PASS")
                                                        <b class="test-pass">({{$cognitiveResult[0]['resultVerbal']}})</b>
                                                        @elseif($cognitiveResult[0]['resultVerbal'] == "FAIL")
                                                        <b class="test-fail">({{$cognitiveResult[0]['resultVerbal']}})</b>
                                                        @else
                                                        @endif
                                                    </center
                                                ></td>
                                            </tr>
                                            <tr>
                                                <td>Subtest 2 : {{$masterSubtest[9]['name']}}</td>
                                                <td>{{(int)$cognitiveResult[0]['verbal2']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="green">Subtest 3 : {{$masterSubtest[10]['name']}}</td>
                                                <td class="green">{{(int)$cognitiveResult[0]['verbal3']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Subtest 4 : {{$masterSubtest[11]['name']}}</td>
                                                <td>{{(int)$cognitiveResult[0]['verbal4']}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="dropdown-divider mb-4"></div>
                                    <center>
                                        <p class="title-result">Overall Result</p>
                                        <p class="value-result">{{(int)$cognitiveResult[0]['skor']}} <span class="{{$cognitiveResult[0]['resultSkor'] == 'PASS' ? 'test-past' : 'test-fail'}}">({{$cognitiveResult[0]['resultSkor']}})</span></p>
                                    </center>
                                    <div class="dropdown-divider mt-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card clear">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <p class="text-title-page-small">Test Result</p>
                                    <p class="text-title-page-big">Inventory</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" value="{{$test['id']}}" id="idPart">
                                    <canvas id="grafikResultInventory" class="grafik-result"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection