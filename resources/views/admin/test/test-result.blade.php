@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="text-title-page-small">Detail</p>
                        <p class="text-title-page-big">Candidate & Job Applied Information</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-md-12">
                        <div class="row mb-3 detail-candidate-text">
                            <div class="col-md-6">
                                @if($candidate->foto_profil == null || $candidate->foto_profil == "")
                                    <img src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="img" class="img-fluid img-profile-detail">
                                @else
                                    <img src="{{asset('storage/').'/'.$candidate->foto_profil }}" alt="img" class="img-fluid img-profile-detail">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Name</p>
                                <p class="content-alternatif">{{$candidate->name}}</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Job Position</p>
                                <p class="content-alternatif">{{$candidate->job_position}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">University</p>
                                <p class="content-alternatif">{{$candidate->universitas}}</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Major</p>
                                <p class="content-alternatif">{{$candidate->jurusan}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="text-title-page-small">Detail</p>
                        <p class="text-title-page-big">Test Information</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-md-12">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Test ID</p>
                                <p class="content-alternatif">{{$test['event_id']}}</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">City</p>
                                <p class="content-alternatif">{{$test['city']}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Location</p>
                                <p class="content-alternatif">{{$test['location']}}</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Time</p>
                                <p class="content-alternatif">{{$test['time']}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Date Test</p>
                                <p class="content-alternatif">{{date('d F y', strtotime($test['date_test']))}}</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">Test Longlat</p>
                                <p class="content-alternatif">{{$test['latlong']}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Set Test</p>
                                <p class="content-alternatif">{{$test['set_test']}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <p class="title-alternatif">Start Latlong</p>
                                <p class="content-alternatif">{{$test['location_start']}}</p>
                            </div>
                            <div class="col-md-5">
                                <p class="title-alternatif">End Latlong</p>
                                <p class="content-alternatif">{{$test['location_end']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <input type="hidden" value="{{$test['id']}}" id="idParticipant">
                        <canvas id="grafikResult" class="grafik-result"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection