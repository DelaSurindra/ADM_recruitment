@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="row mt-4">
    <div class="col-md-12">
        <p class="title-dashboard">Global Summary</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card clear">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="title-card-dashboard">Job Vacancy</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <p class="count-text">{{$dataDashboard['openVacancy']}}</p>
                            <p class="content-text ml-4 mt-3">Open</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-right">
                        <div class="d-flex">
                            <p class="count-text">{{$dataDashboard['closeVacancy']}}</p>
                            <p class="content-text ml-4 mt-3">Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card clear">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="title-card-dashboard">Total Applicant</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <p class="count-text">{{$dataDashboard['totalJob']}}</p>
                            <p class="content-text ml-4 mt-3">Total Applicant</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-right">
                        <div class="d-flex">
                            <p class="count-text">{{$dataDashboard['formatHired']}}</p>
                            <p class="content-text ml-4 mt-3">Hired</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card clear">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="title-card-dashboard">Recruitment Funnel</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="card-chart-pie">
                            <canvas id="chartRecruitment" width="600" height="600"></canvas>
                        </div>
                    </div>
                    <div class="col-md-5 mt-5">
                        <div class="d-flex">
                            <p class="count-text">{{$dataDashboard['totalJob']}}</p>
                            <p class="content-text ml-4 mt-2">Processed Recruitment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card clear">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="title-card-dashboard">Application Source</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="chartApplication" height="167"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-5">
        <p class="title-dashboard">Written Test Result</p>
    </div>
    <div class="col-md-6">
        <form class="form-hr" filter="true" id="formFilterDashboard">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-5">
                        <div class="with-icon">
                            <input type="text" class="form-control" placeholder="Choose date" name="dateStart" id="dateStart" value="{{date('d-m-Y', strtotime(date('Y-m-d').'-30 days'))}}">
                            <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <img src="{{asset('image/icon/homepage/icon-until.svg')}}" alt="" class="mt-3">
                    </div>
                    <div class="col-md-5">
                        <div class="with-icon">
                            <input type="text" class="form-control" placeholder="Choose date" name="dateEnd" id="dateEnd" value="{{date('d-m-Y')}}">
                            <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon" >
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" for="formFilterDashboard" class="btn-filter-dashboard btn-red"><img src="{{asset('image/icon/main/icon_centang.svg')}}"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-10">
                        <p class="title-card-dashboard">Top 3 Test Score</p>
                    </div>
                    @if(session('session_id.role') == "1")
                    <div class="col-md-2">
                        <a href="" id="downloadTopScore"><img src="{{asset('image/icon/main/icon_donwload_red.svg')}}" alt=""></a>
                    </div>
                    @endif
                </div>
                <div id="dataTopScore"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-10">
                        <p class="title-card-dashboard">Candidate Passed</p>
                    </div>
                    @if(session('session_id.role') == "1")
                    <div class="col-md-2">
                        <a href="" id="downloadCandidatePass"><img src="{{asset('image/icon/main/icon_donwload_red.svg')}}" alt=""></a>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4" id="divProgressCandidate">
                        <div id="progressCandidate" class="progress-bar-dashboard"></div>
                    </div>
                    <div class="col-md-8 mt-2">
                        <div class="d-flex">
                            <p class="count-text" id="candidatePass"></p>
                            <p class="content-text ml-4 mt-3">Passed Test</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8 mt-2">
                        <p class="content-text">From All Candidate</p>
                    </div>
                    <div class="col-md-4">
                        <p class="count-text-grey" id="candidateAll"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card clear">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <p class="title-card-dashboard">Average Score</p>
                    </div>
                    @if(session('session_id.role') == "1")
                    <div class="col-md-2">
                        <a href="" id="downloadAverage"><img src="{{asset('image/icon/main/icon_donwload_red.svg')}}" alt=""></a>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <p class="count-text-grey mt-1 black" id="averageVerbal"></p>
                    </div>
                    <div class="col-md-4">
                        <p class="content-text mt-3 right">Verbal</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <p class="count-text-grey mt-1 black" id="averageNumeric"></p>
                    </div>
                    <div class="col-md-4">
                        <p class="content-text mt-3 right">Numeric</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <p class="count-text-grey mt-1 black" id="averageAbstrak"></p>
                    </div>
                    <div class="col-md-4">
                        <p class="content-text mt-3 right">Abstrak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-10">
                        <p class="title-card-dashboard">Applicant University</p>
                    </div>
                    @if(session('session_id.role') == "1")
                    <div class="col-md-2">
                        <a href="" id="downloadUniversitas"><img src="{{asset('image/icon/main/icon_donwload_red.svg')}}" alt=""></a>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6" id="divChartUniv">
                        <center>
                            <canvas class="chart-dashboard" id="chartApplicantUniversity" width="50" height="50"></canvas>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-10">
                        <p class="title-card-dashboard">Application Major</p>
                    </div>
                    @if(session('session_id.role') == "1")
                    <div class="col-md-2">
                        <a href="" id="downloadMajor"><img src="{{asset('image/icon/main/icon_donwload_red.svg')}}" alt=""></a>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6" id="divChartMajor">
                        <center>
                            <canvas class="chart-dashboard" id="chartApplicantMajor" width="50" height="50"></canvas>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection