@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{route('post.question.bank.edit')}}" class="form stacked form-hr" method="POST" id="formAddQuestionBank" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="idQuestion" value="{{$data['id']}}">
    <input type="hidden" name="id" value="{{$id}}">
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Edit Question Bank</p>
                    <p class="text-title-page-big">Global Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="setTestDiv">
                                    <label>Set Test</label>
                                    <select class="select2 tex-center select2-width" id="setTest" name="setTest">
                                        <option {{$data['set'] == '1' ? 'selected' : ''}} value="1">Set Test 1</option>
                                        <option {{$data['set'] == '2' ? 'selected' : ''}} value="2">Set Test 2</option>
                                        <option {{$data['set'] == '3' ? 'selected' : ''}} value="3">Set Test 3</option>
                                        <option {{$data['set'] == '4' ? 'selected' : ''}} value="4">Set Test 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-10 col-md-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12" id="testTypeDiv">
                                    <label>Test Type</label>
                                    <select class="select2 tex-center select2-width" disabled>
                                        <option {{$data['test_type'] == '1' ? 'selected' : ''}} value="1">Cognitive</option>
                                        <option {{$data['test_type'] == '2' ? 'selected' : ''}} value="2">Inventory</option>
                                    </select>
                                    <input type="hidden" name="testType" value="{{$data['test_type']}}">
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <label>Subtest</label>
                                    <select class="select2 tex-center select2-width" id="subTest" name="subTest" disabled>
                                        <option value="">{{$data['master_subtest']['name'] != null ? $data['master_subtest']['name'] : $data['master_subtest']['sub_type']}}</option>
                                    </select>
                                    <input type="hidden" name="subTest" value="{{$data['master_subtest_id']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($data['test_type'] == "2")
        <!-- Question (Inventory) -->
        <div class="card clear div-all" id="QA8">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <p class="text-title-page-small">Enter Answer</p>
                    </div>
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-title-page-big">Answer</p>
                            </div>
                            <input type="hidden" id="countAnswer" name="countAnswer" value="2" class="class-QA8 class-all">
                        </div>
                        @foreach($data['answer_inventory'] as $answer)
                        <div class="row">
                            <div class="col-md-1">
                                <button class="btn-answer btn-QA8" id="btnQA8{{$answer['choice']}}" value="{{$answer['choice']}}" type="button">{{$answer['choice']}}</button>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group mb-5 facet">
                                    <textarea name="answerQA8{{$answer['index']}}" id="answerQA8{{$answer['index']}}" class="form-control class-QA8 class-all mb-1" placeholder="Enter your question" rows="5" required>{{$answer['answer_text']}}</textarea>
                                    <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                                    <select class="mt-1 select2 tex-center select2-width class-QA8 class-all" id="facetType{{$answer['index']}}" name="facetType{{$answer['index']}}" required>
                                        <option value="">Choose Facet</option>
                                        @foreach($facet as $dataFacet)
                                            <option {{$answer['master_facet_id'] == $dataFacet['id'] ? 'selected' : ''}} value="{{$dataFacet['id']}}">{{$dataFacet['category']}} : {{$dataFacet['facet_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        @if($data['master_subtest_id'] == "1" || $data['master_subtest_id'] == "3" || $data['master_subtest_id'] == "4" || $data['master_subtest_id'] == "7")
            <!-- Question (Verbal 1,Verbal3 ,Verbal 4  dan Numeric 3) -->
            <div class="card clear div-all" id="QA1">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-small">Enter Question & Answer</p>
                            <p class="text-title-page-big">Question</p>
                            <div class="form-group mb-0">
                                <textarea name="questionQA1" id="questionQA1" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required>{{$data['question_text']}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-title-page-big">Answer</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                                </div>
                                <input type="hidden" id="chooseQA1" name="chooseAnswer" value="{{$data['answer_keys']}}" class="class-QA1 class-all">
                                <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA1 class-all">
                            </div>
                            @foreach($data['answer_cognitive'] as $answer)
                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn-answer btn-QA1 {{$data['answer_keys'] == $answer['choice'] ? 'btn-answer-active' : ''}}" id="btnQA1{{$answer['choice']}}" value="{{$answer['choice']}}" type="button">{{$answer['choice']}}</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group mb-5">
                                        <textarea name="answerQA1{{$answer['index']}}" id="answerQA1{{$answer['index']}}" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required>{{$answer['answer_text']}}</textarea>
                                        <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @elseif($data['master_subtest_id'] == "5")
            <!-- Question Numeric 1 -->
            <div class="card clear div-all" id="QA2">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-small">Enter Question & Answer</p>
                            <p class="text-title-page-big">Question</p>
                            <div class="form-group mb-0">
                                <textarea name="questionQA2" id="questionQA2" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required>{{$data['question_text']}}</textarea>
                            </div>
                            <div class="col-md-12 p-0">
                                <img src="{{asset('storage/').'/'.$data['question_image'] }}" alt="" class="img-preview">
                                <span class="btn btn-file pl-1 mb-2 btn-file-right" id="spanImgQA2">
                                    <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Edit Gambar <input type="file" name="imgNumeric1" id="imgNumeric1" class="upload-image class-QA2 class-all">
                                    <input type="hidden" name="imgNumeric1Old" value="{{$data['question_image']}}">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-title-page-big">Answer</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                                </div>
                                <input type="hidden" id="chooseQA2" name="chooseAnswer" value="{{$data['answer_keys']}}" class="class-QA2 class-all">
                                <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA2 class-all">
                            </div>
                            @foreach($data['answer_cognitive'] as $answer)
                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn-answer btn-QA2 {{$data['answer_keys'] == $answer['choice'] ? 'btn-answer-active' : ''}}" id="btnQA2{{$answer['choice']}}" value="{{$answer['choice']}}" type="button">{{$answer['choice']}}</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group mb-5">
                                        <textarea name="answerQA2{{$answer['index']}}" id="answerQA2{{$answer['index']}}" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required>{{$answer['answer_text']}}</textarea>
                                        <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    
        @elseif($data['master_subtest_id'] == "8")
            <!-- Question Numeric 4 -->
            <div class="card clear div-all" id="QA3">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-small">Enter Question & Answer</p>
                            <p class="text-title-page-big">Question</p>
                            <div class="form-group mb-0">
                                <textarea name="questionQA3" id="questionQA3" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required>{{$data['question_text']}}</textarea>
                            </div>
                            <div class="col-md-12 p-0">
                                <img src="{{asset('storage/').'/'.$data['question_image'] }}" alt="" class="img-preview">
                                <span class="btn btn-file pl-1 mb-2 btn-file-right" id="spanImgQA3">
                                    <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Edit Gambar <input type="file" name="imgNumeric4" id="imgNumeric4" class="upload-image class-QA3 class-all">
                                    <input type="hidden" name="imgNumeric4Old" value="{{$data['question_image']}}">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-title-page-big">Answer</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                                </div>
                                <input type="hidden" id="chooseQA3" name="chooseAnswer" value="{{$data['answer_keys']}}" class="class-QA3 class-all">
                                <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA3 class-all">
                            </div>
                            @foreach($data['answer_cognitive'] as $answer)
                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn-answer btn-QA3 {{$data['answer_keys'] == $answer['choice'] ? 'btn-answer-active' : ''}}" id="btnQA3{{$answer['choice']}}" value="{{$answer['choice']}}" type="button">{{$answer['choice']}}</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group mb-5">
                                        <textarea name="answerQA3{{$answer['index']}}" id="answerQA3{{$answer['index']}}" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required>{{$answer['answer_text']}}</textarea>
                                        <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @elseif($data['master_subtest_id'] == "2")
            <!-- Question (Verbal 2) -->
            <div class="card clear div-all" id="QA4">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-small">Enter Question & Answer</p>
                            <p class="text-title-page-big">Question</p>
                            <div class="form-group mb-0">
                                <textarea name="questionQA4" id="questionQA4" class="form-control class-QA4 class-all" placeholder="Enter your question" rows="5" required>{{$data['question_text']}}</textarea>
                            </div>
                        </div>
                        @foreach($data['answer_cognitive'] as $answer)
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-big">Conclusion</p>
                            <div class="form-group mb-0">
                                <textarea name="conclusionQA4" id="conclusionQA4" class="form-control class-QA4 class-all" placeholder="Enter your conclusion" rows="5" required>{{$answer['answer_text']}}</textarea>
                                <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-title-page-big">Answer</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                                </div>
                                <input type="hidden" id="chooseQA4" name="chooseAnswer"value="{{$data['answer_keys']}}" class="class-QA4 class-all">
                            </div>
                            <div class="row">
                                <button class="btn-answer btn-QA4 ml-3 {{$data['answer_keys'] == 't' ? 'btn-answer-active' : ''}}" id="btnQA4t" value="t" type="button">T</button>
                                <button class="btn-answer btn-QA4 ml-3 {{$data['answer_keys'] == 'f' ? 'btn-answer-active' : ''}}" id="btnQA4f" value="f" type="button">F</button>
                                <button class="btn-answer btn-QA4 ml-3 {{$data['answer_keys'] == 'x' ? 'btn-answer-active' : ''}}" id="btnQA4x" value="x" type="button">X</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($data['master_subtest_id'] == "6")
            <!-- Question (Numeric 2) -->
            <div class="card clear div-all" id="QA5">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-small">Enter Answer</p>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-title-page-big">Answer</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                                </div>
                                <input type="hidden" id="chooseQA5" name="chooseAnswer" value="{{$data['answer_keys']}}" class="class-QA5 class-all">
                                <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA5 class-all">
                            </div>
                            @foreach($data['answer_cognitive'] as $answer)
                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn-answer btn-QA5 {{$data['answer_keys'] == $answer['choice'] ? 'btn-answer-active' : ''}}" id="btnQA5{{$answer['choice']}}" value="{{$answer['choice']}}" type="button">{{$answer['choice']}}</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group mb-5">
                                        <textarea name="answerQA5{{$answer['index']}}" id="answerQA5{{$answer['index']}}" class="form-control class-QA5 class-all" placeholder="Enter your question" rows="5" required>{{$answer['answer_text']}}</textarea>
                                        <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @elseif($data['master_subtest_id'] == "9" || $data['master_subtest_id'] == "10" || $data['master_subtest_id'] == "12")
            <!-- Question (Abstrak 1,2 dan 4) -->
            <div class="card clear div-all" id="QA6">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-small">Enter Question & Answer</p>
                            <p class="text-title-page-big">Question</p>
                            <div class="col-md-12 p-0">
                                <img src="{{asset('storage/').'/'.$data['question_image'] }}" alt="" class="img-preview">
                                <span class="btn btn-file pl-1 mb-2 btn-file-right" id="spanImgQA6">
                                    <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Edit Gambar <input type="file" name="imgAbstrak" id="imgAbstrak" class="upload-image class-QA6 class-all">
                                    <input type="hidden" name="imgAbstrakOld" value="{{$data['question_image']}}">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-title-page-big">Answer</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                                </div>
                                <input type="hidden" id="chooseQA6" name="chooseAnswer" value="{{$data['answer_keys']}}" class="class-QA6 class-all">
                                <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA6 class-all">
                            </div>
                            @foreach($data['answer_cognitive'] as $answer)
                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn-answer btn-QA6 {{$data['answer_keys'] == $answer['choice'] ? 'btn-answer-active' : ''}}" id="btnQA6{{$answer['choice']}}" value="{{$answer['choice']}}" type="button">{{$answer['choice']}}</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group mb-5">
                                        <div class="col-md-12">
                                            <img src="{{asset('storage/').'/'.$answer['answer_image'] }}" alt="" class="img-preview">
                                            <span class="btn btn-file pl-1 mb-2 btn-file-right" id="spanImgQA6a">
                                                <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Edit Gambar <input type="file" name="imgAnswer{{$answer['index']}}" id="imgAnswer{{$answer['index']}}" class="upload-image class-QA6 class-all">
                                                <input type="hidden" name="imgAnswerOld{{$answer['index']}}" value="{{$answer['answer_image']}}">
                                            </span>
                                        </div>
                                        <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @elseif($data['master_subtest_id'] == "11")
            <!-- Question (Abstrak 3) -->
            <div class="card clear div-all" id="QA7">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <p class="text-title-page-small">Enter Answer</p>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-title-page-big">Answer</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                                </div>
                                <input type="hidden" id="chooseQA7" name="chooseAnswer" value="{{$data['answer_keys']}}" class="class-QA7 class-all">
                                <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA7 class-all">
                            </div>
                            @foreach($data['answer_cognitive'] as $answer)
                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn-answer btn-QA7 {{$data['answer_keys'] == $answer['choice'] ? 'btn-answer-active' : ''}}" id="btnQA7{{$answer['choice']}}" value="{{$answer['choice']}}" type="button">{{$answer['choice']}}</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group mb-5">
                                        <div class="col-md-12">
                                            <img src="{{asset('storage/').'/'.$answer['answer_image'] }}" alt="" class="img-preview">
                                            <span class="btn btn-file pl-1 mb-2 btn-file-right" id="spanImgQA7a">
                                                <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Edit Gambar <input type="file" name="imgAbstrak{{$answer['index']}}" id="imgAbstrak{{$answer['index']}}" class="upload-image class-QA7 class-all">
                                                <input type="hidden" name="imgAbstrakOld{{$answer['index']}}" value="{{$answer['answer_image']}}">
                                            </span>
                                        </div>
                                        <input type="hidden" name="idAnswer{{$answer['index']}}" value="{{$answer['id']}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endif

    @endif
    <div class="row">
        <input type="hidden" id="btnValue" name="btnValue">
        <div class="col-md-12">
            <button type="submit" class="btn btn-red w-100" id="continue" value="continue">Save</button>
        </div>
    </div>
</form>

@endsection