@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

@if($data[0]['test_type'] == "2")
    @foreach($data as $question)
        <div class="row">
            <div class="col-md-12">
                <div class="card clear">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p class="text-title-page-small">Number {{$question['number']}}</p>
                                        <p class="text-title-page-big">Answer</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-11 pr-0">
                                                <button class="btn btn-white right">Edit Question Information</button>
                                            </div>
                                            <div class="col-md-1 pl-2">
                                                <button class="btn-trash" type="button"><img src="{{asset('image/icon/main/icon_trash_red.svg')}}" alt=""></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($question['answer_inventory'] as $answer)
                                    <div class="row mb-4">
                                        <div class="col-md-1 pr-0">
                                            <button class="btn-answer" type="button">{{$answer['choice']}}</button>
                                        </div>
                                        <div class="col-md-5 pl-0">
                                            <p class="text-detail-question mb-1">{{$answer['answer_text']}}</p>
                                            <div class="badge-question">{{$answer['facet_name']}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    @foreach($data as $question)
        <div class="row">
            <div class="col-md-12">
                <div class="card clear">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-title-page-small">Number {{$question['number']}}</p>
                                        <p class="text-title-page-big">Question</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-11 pr-0">
                                                <button class="btn btn-white right">Edit Question Information</button>
                                            </div>
                                            <div class="col-md-1 pl-2">
                                                <button class="btn-trash" type="button"><img src="{{asset('image/icon/main/icon_trash_red.svg')}}" alt=""></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($question['question_text'] != null)
                                        <p class="text-detail-question">{{$question['question_text']}}</p>
                                        @endif
                                        @if($question['question_image'] != null)
                                        <img src="{{asset('storage/').'/'.$question['question_image'] }}" class="img-detail-question">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($question['master_subtest_id'] == "2")
                                @foreach($question['answer_cognitive'] as $answer)
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p class="text-title-page-big">Conclusion</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <p class="text-detail-question">{{$answer['answer_text']}}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p class="text-title-page-big">Answer</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <button class="btn-answer btn-QA4 {{$question['answer_keys'] == 't' ? 'btn-answer-active' : ''}}" id="btnQA4t" value="t" type="button">T</button>
                                            <button class="btn-answer btn-QA4 ml-3 {{$question['answer_keys'] == 'f' ? 'btn-answer-active' : ''}}" id="btnQA4f" value="f" type="button">F</button>
                                            <button class="btn-answer btn-QA4 ml-3 {{$question['answer_keys'] == 'x' ? 'btn-answer-active' : ''}}" id="btnQA4x" value="x" type="button">X</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="text-title-page-big">Answer</p>
                                        </div>
                                    </div>
                                    @foreach($question['answer_cognitive'] as $answer)
                                        <div class="row mb-2">
                                            <div class="col-md-1 pr-0">
                                                <button class="btn-answer {{$question['answer_keys'] == $answer['choice'] ? 'btn-answer-active' : ''}}" type="button">{{$answer['choice']}}</button>
                                            </div>
                                            <div class="col-md-5 pl-0">
                                                @if($answer['answer_text'] != null)
                                                <p class="text-detail-question pt-2">{{$answer['answer_text']}}</p>
                                                @endif
                                                @if($answer['answer_image'] != null)
                                                <img src="{{asset('storage/').'/'.$answer['answer_image'] }}" class="img-detail-question">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection