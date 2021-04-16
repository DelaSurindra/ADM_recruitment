@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="title-page"><img src="{{asset('image/icon/main/icon_title_interview.svg')}}" alt=""> Manage Interview</p>
            </div>
            <div class="col-md-6">
                <a href="{{route('get.interview.add')}}"><button type="button" class="btn btn-red right">Add Interview</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableInterview" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th>Interview Date</th>
                            <th>Interview ID</th>
                            <th>Name</th>
                            <th>Job Position</th>
                            <th>Area</th>
                            <th>Interview Type</th>
                            <th>Interviewer</th>
                            <th>Time</th>
                            <th>City</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection