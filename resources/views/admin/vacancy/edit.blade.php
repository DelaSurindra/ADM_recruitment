@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 main-content">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-9">
                        <h4><strong>Form Edit Job Vacancy</strong></h4>
                    </div>
                    <div class="form-inline col justify-content-end">
                        <a href="{{ route('vacancy')}}" class="btn btn-outline-primary">Back</a>
                    </div>
                </div>

                <hr>

                <form action="{{ url('vacancy/edit/'.$vacancy->job_id) }}" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Job ID</label>
                            <input name="job_id" type="text" class="form-control" placeholder="ID" value="{{$vacancy->job_id}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input name="job_title" type="test" class="form-control" value="{{$vacancy->job_title}}" placeholder="Job Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="job_des" class="form-control" rows="3">{{ $vacancy->job_description }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Available</label>
                            <select name="available" class="form-control">
                                <option value="">Choose...</option>
                                <option value="1" {{ $vacancy->is_available == 1 ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ $vacancy->is_available == 2 ? 'selected' : '' }}>Full</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>End Date</label>
                            <input name="end" type="date" class="form-control" value="{{$vacancy->end_date}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Poster Desktop</label>
                            <input name="posterMobile" type="file" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Poster Mobile</label>
                            <input name="posterDesktop" type="file" class="form-control">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    @csrf
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection
