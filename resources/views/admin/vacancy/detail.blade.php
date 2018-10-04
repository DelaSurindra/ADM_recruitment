@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 main-content">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-9">
                        <h4><strong>{{ $vacancy->job_title }}</strong> ({{ $vacancy->job_id }})</h4>
                    </div>
                    <div class="form-inline col justify-content-end">
                        <a href="{{url('vacancy/edit/'.$vacancy->job_id)}}" class="btn btn-primary mr-2">Edit</a>
                        <a href="#" onclick="deleteJob('{{$vacancy->job_id}}')" class="btn btn-danger mr-2">Delete</a>
                        <a href="{{ route('vacancy')}}" class="btn btn-outline-primary">Back</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-6">
                            <img src="{{asset('mobile/'.$vacancy->job_poster)}}" alt="{{ $vacancy->job_title }}" class="img-thumbnail">
                            </div>
                            <div class="col-6">
                            <img src="{{asset('desktop/'.$vacancy->job_poster)}}" alt="{{ $vacancy->job_title }}" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <h5>Job Description</h5> 
                        <cite title="Source Title">Until : <span class="badge badge-info">{{ $vacancy->end_date ? $vacancy->end_date : '-' }}</span></cite>
                        <hr>
                        <p class="lead">
                            {{ $vacancy->job_description }}
                        </p>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/custom.js')}}" type="text/javascript"></script>



@endsection
