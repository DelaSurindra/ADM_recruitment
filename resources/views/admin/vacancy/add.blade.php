@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 main-content">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-9">
                        <h4><strong>Form Add New Job Vacancy</strong></h4>
                    </div>
                    <div class="form-inline col justify-content-end">
                        <a href="{{ route('vacancy')}}" class="btn btn-outline-primary">Back</a>
                    </div>
                </div>

                <hr>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif


                <form action="{{ route('submitJob') }}" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Job ID</label>
                            <input name="job_id" type="text" class="form-control {{ $errors->has('job_id') ? ' is-invalid' : '' }}" placeholder="ID">
                            @if ($errors->has('job_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input name="job_title" type="test" class="form-control {{ $errors->has('job_title') ? ' is-invalid' : '' }}" placeholder="Job Title">
                            @if ($errors->has('job_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_title') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Available</label>
                            <select name="available" class="form-control ">
                                <option value="">Choose...</option>
                                <option value="1">Available</option>
                                <option value="0">Closed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>End Date</label>
                            <input name="end" type="date" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Target Hire</label>
                            <input name="target" type="text" class="form-control {{ $errors->has('target') ? ' is-invalid' : '' }}" placeholder="Target Hire for Job">
                            @if ($errors->has('target'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('target') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="job_des" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Requirement</label>
                        <textarea name="job_des" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Poster </label>
                            <input name="poster" type="file" class="form-control ">
                            
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
