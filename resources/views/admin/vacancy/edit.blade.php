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

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ url('admin/vacancy/edit/'.$vacancy->job_id) }}" method="post" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Job ID</label>
                            <input name="job_id" type="text" class="form-control {{ $errors->has('job_id') ? ' is-invalid' : '' }}" placeholder="ID"value="{{$vacancy->job_id}}" readonly>
                            @if ($errors->has('job_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('job_id') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input name="job_title" type="test" class="form-control {{ $errors->has('job_title') ? ' is-invalid' : '' }}" placeholder="Job Title"value="{{$vacancy->job_title}}" required>
                            @if ($errors->has('job_title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('job_title') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Available</label>
                            <select name="available" class="form-control " required>
                                <option value="" disabled>Choose...</option>
                                <option value="1"{{ $vacancy->is_available == 1 ? 'selected' : '' }}>Available</option>
                                <option value="0"{{ $vacancy->is_available == 2 ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>End Date</label>
                            <input name="end" type="date" class="form-control"value="{{$vacancy->end_date}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Target Hire</label>
                            <input name="target" type="text" class="form-control {{ $errors->has('target') ? ' is-invalid' : '' }}" placeholder="Target Hire for Job"value="{{$vacancy->job_target}}" required>
                            @if ($errors->has('target'))
                            <div class="invalid-feedback">
                                {{ $errors->first('target') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-md-3 ">
                            <label>Placement</label>
                            <?php
                                $location = [
                                        "Sidoarjo",
                                        "Malang",
                                        "Yogyakarta",
                                        "Jakarta"
                                    ];

                                $placement = $vacancy->placement != null ? json_decode($vacancy->placement,true):[];
                            ?>
                            @foreach($location as $loc)
                            <div class="custom-control custom-checkbox">
                                  <input name="placement[]" value="{{$loc}}" type="checkbox" {{in_array($loc,$placement)?'checked=""':''}} class="custom-control-input  " id="check_box_{{$loc}}">
                                  <label class="custom-control-label" for="check_box_{{$loc}}">{{$loc}}</label>
                            </div>
                            @endforeach

                            @if ($errors->has('placement'))
                            <input type="hidden" name="" class="form-control {{ $errors->has('placement') ? ' is-invalid' : '' }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('placement') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="job_des" class="form-control summernote" rows="3" required>{{ $vacancy->job_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Requirement</label>
                        <textarea name="job_req" class="form-control summernote" rows="3" required>{{ $vacancy->job_Req }}</textarea>
                    </div>                        
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Poster</label>
                            <input name="poster" type="file" class="">
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
