@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="breadcrumb-candidate">
        <a class="bread active" href="#">My Application</a>
        <a class="bread active" href="#">/{{$vacancy['job_title']}}</a>
        <p class="bread">/Online Test Reschedule</p>
    </div>
    <h2 class="candidate-page-title">Online Test Reschedule</h2>

    <hr class="margin-top-6rem">

    <div class="my-4">
        <div class="fulltime-badge mb-2">{{$vacancy['type'] == "1" ? "Full Time" : "Intership"}}</div>
        <h2 class="candidate-page-title">{{$vacancy['job_title']}}</h2>
        <div class="modal-fill">
            <div class="d-flex">
                <div class="mr-5">
                    <label for="">Date</label>
                    <p class="mb-0">{{date("d M Y", strtotime($test['date_test']))}}</p>
                </div>
                <div>
                    <label for="">Time</label>
                    <p class="mb-0">{{$test['time']}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="my-4">
        <h4 class="candidate-page-subtitle mb-3">Choose New Schedule</h4>
        @if($alternatif != [])
        <form action="{{route('post.reschedule.test')}}" class="form stacked form-hr" ajax=true id="formRescheduleTest">
            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="hidden" id="idReschedule" name="idReschedule">
                    <input type="hidden" id="idJob" name="idJob" value="{{$job['id']}}">
                    <input type="hidden" id="idParticipant" name="idParticipant" value="{{$test['id_participant']}}">
                    @foreach($alternatif as $value)
                        <button class="btn-reschedule ml-1" id="reschedule_{{$value['alternative_test_id']}}" value="{{$value['alternative_test_id']}}" type="button">{{date('d M y', strtotime($value['date']))}} {{$value['time']}}</button>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-home-color btn-block">Submit</button>

                </div>
            </div>
        </form>
        @else
        <form action="{{route('post.reschedule.wt')}}" class="form stacked form-hr" ajax=true id="formRescheduleWt">
            <input type="hidden" id="idParticipant" name="idParticipant" value="{{$test['id_participant']}}">
            <input type="hidden" id="idJob" name="idJob" value="{{$job['id']}}">
            <div class="card card-clear card-green mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 mr-3">
                            <img src="{{asset('image/icon/main/icon_start_test.svg')}}" class="img-reschedule">
                        </div>
                        <div class="col-md-8">
                            <p class="title-reschedule mt-2">We Dont Have Any Schedule Test Yet</p>
                            <p class="text-reschedule">We are sorry about that. Please wait for any information about schedule test</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-home-color btn-block">Remind Me Later</button>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection