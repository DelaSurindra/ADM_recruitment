@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
            <p class="title-page"><img src="{{asset('image/icon/main/icon_title_candidate.svg')}}" alt=""> Manage Candidate</p>
            </div>
            <div class="col-md-8">
                <a href="{{route('get.candidate.detail', 1)}}"><button type="button" class="btn btn-red right">Add Candidate</button></a>
                <button type="button" class="btn btn-bulk-candidate right mr-3">Send Notification</button>
                <button type="button" class="btn btn-bulk-candidate right mr-3">Bulk Update</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableCandidate" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Submit Date</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Graduate</th>
                            <th>University</th>
                            <th>Faculty</th>
                            <th>Major</th>
                            <th>GPA</th>
                            <th>Graduate Year</th>
                            <th>Job Position</th>
                            <th>Area</th>
                            <th>Application Status</th>
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