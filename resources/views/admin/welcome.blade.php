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

@endsection