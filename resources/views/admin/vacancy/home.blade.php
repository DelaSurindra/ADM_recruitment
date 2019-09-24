@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-10">
                        <h4><strong>List of Vacancies</strong></h4>
                    </div>
                    <div class="form-inline col justify-content-end">
                        <a href="{{ route('formAdd')}}" class="btn btn-outline-primary">Add New Job</a>
                    </div>
                </div>

                <hr>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                @if(count($vacancy) === 0)
                    <div class="alert alert-info">
                        No Applicants Found
                    </div>
                @else
                    <table class="table table-bordered table-striped table-hover mt-2">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Job ID</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Total Applicant</th>
                                <th scope="col">Target Hire</th>
                                <th scope="col">Avaliable</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Placement</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vacancy as $d => $key)
                                <tr>
                                    <th scope="row">{{ ($vacancy->currentpage()-1) * $vacancy->perpage() + $d + 1 }}</th>
                                    <td>{{ $key->job_id }}</td>
                                    <td>{{ $key->job_title }}</td>
                                    <td>{{ $key->total }}</td>
                                    <td class="text-center">{{ $key->job_target }}</td>
                                    <td>
                                        @if($key->is_available)
                                            <h5><span class="badge badge-pill badge-success">Available</span></h5>
                                        @else
                                            <h5><span class="badge badge-pill badge-danger">Closed</span></h5>
                                        @endif
                                    </td>
                                    <td>{{ $key->end_date }}</td>
                                    <td>{!! $key->placement != null ? implode(',<br>',json_decode($key->placement,true)) : '-' !!}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('admin/vacancy/'.str_replace('/', '_', $key->job_id))}}" type="button" class="btn btn-outline-primary">Detail</a>
                                            <a href="{{url('admin/vacancy/edit/'.str_replace('/', '_', $key->job_id))}}" type="button" class="btn btn-primary">Edit</a>
                                            <a href="#" onclick="deleteJobList('{{str_replace('/', '_', $key->job_id)}}')" type="button" class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$vacancy->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/custom.js')}}" type="text/javascript"></script>
@endsection