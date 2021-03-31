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
                                            <a href="{{route('get.question.bank.edit', base64_encode(urlencode($question['master_subtest_id'].'_'.$question['set'].'_'.$question['test_type'].'_'.$question['id'])))}}"><button class="btn btn-white right">Edit Question Information</button></a>
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
                                                <a href="{{route('get.question.bank.edit', base64_encode(urlencode($question['master_subtest_id'].'_'.$question['set'].'_'.$question['test_type'].'_'.$question['id'])))}}"><button class="btn btn-white right">Edit Question Information</button></a>
                                            </div>
                                            <div class="col-md-1 pl-2">
                                                <button class="btn-trash btn-delete-question" value="{{$question['number']}}" type="button"><img src="{{asset('image/icon/main/icon_trash_red.svg')}}" alt=""></button>
                                                <input type="hidden" id="numberQuestion{{$question['number']}}" value="{{$question['number']}}">
                                                <input type="hidden" id="idQuestion{{$question['number']}}" value="{{$question['id'].'_'.$question['test_type'].'_'.$question['master_subtest_id'].'_'.$question['set']}}">
                                                <input type="hidden" id="urlQuestion{{$question['number']}}" value="{{$id}}">
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

@section('modal')
<div class="modal fade" id="modalKonfirmQuestion" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-color">Delete Question Bank</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form action="{{route('post.question.bank.delete')}}" id="formDeleteQuestion" method="post" ajax="true" class="form stacked">
                                <div class="form-multi-row row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" id="titleKonfirmasiQuestion"></label>
                                        <input id="idDeleteQuestion" class="form-input" type="hidden" name="idDeleteQuestion" />
                                        <input id="urlDeleteQuestion" class="form-input" type="hidden" name="urlDeleteQuestion" />
                                    </div>
                                </div>
                                </br>
                                <div class="right">
                                    <button type="button" class="left btn btn-back" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn bnt-login btn-hapus-modal">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection