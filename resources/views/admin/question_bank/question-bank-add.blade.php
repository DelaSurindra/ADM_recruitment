@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{route('post.question.bank.add')}}" class="form stacked form-hr" method="POST" id="formAddQuestionBank" enctype="multipart/form-data">
    @csrf
    <div class="card clear">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <p class="text-title-page-small">Create New Question Bank</p>
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
                                        <option value="">-- Pilih Set Test --</option>
                                        <option value="1">Set Test 1</option>
                                        <option value="2">Set Test 2</option>
                                        <option value="3">Set Test 3</option>
                                        <option value="4">Set Test 4</option>
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
                                    <select class="select2 tex-center select2-width" id="testType" name="testType">
                                        <option value="">-- Pilih Test Type --</option>
                                        <option value="1">Cognitive</option>
                                        <option value="2">Inventory</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 hidden" id="subCognitiveDiv">
                                    <label>Subtest</label>
                                    <select class="select2 tex-center select2-width" id="subCognitive" name="subCognitive" disabled>
                                        <option value="">-- Pilih Subtest --</option>
                                        @foreach($cognitive as $data)
                                            <option value="{{$data['id']}}">{{$data['sub_type']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="subInventory" name="subInventory" value="{{isset($inventory['id']) ? $inventory['id'] : '13'}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question (Verbal 1,Verbal3 ,Verbal 4  dan Numeric 3) -->
    <div class="card clear div-all hidden" id="QA1">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <p class="text-title-page-small">Enter Question & Answer</p>
                    <p class="text-title-page-big">Question</p>
                    <div class="form-group mb-0">
                        <textarea name="question" id="question" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required></textarea>
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
                        <input type="hidden" id="chooseQA1" name="chooseAnswer" class="class-QA1 class-all">
                        <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA1 class-all">
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA1" id="btnQA1a" value="a" type="button">A</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer0" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice0" value="a" class="class-QA1 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA1" id="btnQA1b" value="b" type="button">B</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer1" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice1" value="b" class="class-QA1 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA1" id="btnQA1c" value="c" type="button">C</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer2" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice2" value="c" class="class-QA1 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA1" id="btnQA1d" value="d" type="button">D</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer3" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice3" value="d" class="class-QA1 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA1" id="btnQA1e" value="e" type="button">E</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <textarea name="answer4" class="form-control class-QA1 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice4" value="e" class="class-QA1 class-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question Numeric 1 -->
    <div class="card clear div-all hidden" id="QA2">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <p class="text-title-page-small">Enter Question & Answer</p>
                    <p class="text-title-page-big">Question</p>
                    <div class="form-group mb-0">
                        <textarea name="question" id="question" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required></textarea>
                    </div>
                    <div>
                        <span class="btn btn-file pl-1 mb-2">
                            <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgNumeric1" id="imgNumeric1" required>
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
                        <input type="hidden" id="chooseQA2" name="chooseAnswer" class="class-QA2 class-all">
                        <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA2 class-all">
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA2" id="btnQA2a" value="a" type="button">A</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer0" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice0" value="a" class="class-QA2 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA2" id="btnQA2b" value="b" type="button">B</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer1" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice1" value="b" class="class-QA2 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA2" id="btnQA2c" value="c" type="button">C</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer2" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice2" value="c" class="class-QA2 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA2" id="btnQA2d" value="d" type="button">D</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer3" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice3" value="d" class="class-QA2 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA2" id="btnQA2e" value="e" type="button">E</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <textarea name="answer4" class="form-control class-QA2 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice4" value="e" class="class-QA2 class-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question Numeric 4 -->
    <div class="card clear div-all hidden" id="QA3">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <p class="text-title-page-small">Enter Question & Answer</p>
                    <p class="text-title-page-big">Question</p>
                    <div class="form-group mb-0">
                        <textarea name="question" id="question" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required></textarea>
                    </div>
                    <div>
                        <span class="btn btn-file pl-1 mb-2">
                            <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgNumeric4" id="imgNumeric4" required>
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
                        <input type="hidden" id="chooseQA3" name="chooseAnswer" class="class-QA3 class-all">
                        <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA3 class-all">
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA3" id="btnQA3a" value="a" type="button">A</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer0" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice0" value="a" class="class-QA3 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA3" id="btnQA3b" value="b" type="button">B</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer1" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice1" value="b" class="class-QA3 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA3" id="btnQA3c" value="c" type="button">C</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer2" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice2" value="c" class="class-QA3 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA3" id="btnQA3d" value="d" type="button">D</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer3" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice3" value="d" class="class-QA3 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA3" id="btnQA3e" value="e" type="button">E</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <textarea name="answer4" class="form-control class-QA3 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice4" value="e" class="class-QA3 class-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question (Verbal 2) -->
    <div class="card clear div-all hidden" id="QA4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <p class="text-title-page-small">Enter Question & Answer</p>
                    <p class="text-title-page-big">Question</p>
                    <div class="form-group mb-0">
                        <textarea name="question" id="question" class="form-control class-QA4 class-all" placeholder="Enter your question" rows="5" required></textarea>
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
                        <input type="hidden" id="chooseQA4" name="chooseAnswer" class="class-QA4 class-all">
                    </div>
                    <p class="text-title-page-big">Conclusion</p>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA3" id="btnQA3e" value="e" type="button">E</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <textarea name="answer4" class="form-control class-QA4 class-all" placeholder="Enter your question" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question (Numeric 2) -->
    <div class="card clear div-all hidden" id="QA5">
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
                        <input type="hidden" id="chooseQA5" name="chooseAnswer" class="class-QA5 class-all">
                        <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA5 class-all">
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA5" id="btnQA5a" value="a" type="button">A</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer0" class="form-control class-QA5 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice0" value="a" class="class-QA5 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA5" id="btnQA5b" value="b" type="button">B</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer1" class="form-control class-QA5 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice1" value="b" class="class-QA5 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA5" id="btnQA5c" value="c" type="button">C</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer2" class="form-control class-QA5 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice2" value="c" class="class-QA5 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA5" id="btnQA5d" value="d" type="button">D</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer3" class="form-control class-QA5 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice3" value="d" class="class-QA5 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA5" id="btnQA5e" value="e" type="button">E</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <textarea name="answer4" class="form-control class-QA5 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice4" value="e" class="class-QA5 class-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question (Abstrak 1,2 dan 4) -->
    <div class="card clear div-all hidden" id="QA6">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <p class="text-title-page-small">Enter Question & Answer</p>
                    <p class="text-title-page-big">Question</p>
                    <div>
                        <span class="btn btn-file pl-1 mb-2">
                            <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAbstrak" id="imgAbstrak" required>
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
                        <input type="hidden" id="chooseQA6" name="chooseAnswer" class="class-QA6 class-all">
                        <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA6 class-all">
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA6" id="btnQA6a" value="a" type="button">A</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer0" id="imgAnswer0" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice0" value="a" class="class-QA6 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA6" id="btnQA6b" value="b" type="button">B</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer1" id="imgAnswer1" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice1" value="b" class="class-QA6 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA6" id="btnQA6c" value="c" type="button">C</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer2" id="imgAnswer2" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice2" value="c" class="class-QA6 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA6" id="btnQA6d" value="d" type="button">D</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer3" id="imgAnswer3" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice3" value="d" class="class-QA6 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA6" id="btnQA6e" value="e" type="button">E</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer4" id="imgAnswer4" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice4" value="e" class="class-QA6 class-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question (Abstrak 3) -->
    <div class="card clear div-all hidden" id="QA7">
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
                        <input type="hidden" id="chooseQA7" name="chooseAnswer" class="class-QA7 class-all">
                        <input type="hidden" id="countAnswer" name="countAnswer" value="5" class="class-QA7 class-all">
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA7" id="btnQA7a" value="a" type="button">A</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer0" id="imgAnswer0" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice0" value="a" class="class-QA7 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA7" id="btnQA7b" value="b" type="button">B</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer1" id="imgAnswer1" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice1" value="b" class="class-QA7 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA7" id="btnQA7c" value="c" type="button">C</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer2" id="imgAnswer2" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice2" value="c" class="class-QA7 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA7" id="btnQA7d" value="d" type="button">D</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer3" id="imgAnswer3" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice3" value="d" class="class-QA7 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA7" id="btnQA7e" value="e" type="button">E</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <div>
                                    <span class="btn btn-file pl-1 mb-2">
                                        <img src="{{asset('image/icon/main/icon_upload.svg')}}" alt=""> Upload File <input type="file" name="imgAnswer4" id="imgAnswer4" required>
                                    </span>
                                </div>
                                <input type="hidden" name="choice4" value="e" class="class-QA7 class-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Question (Inventory) -->
    <div class="card clear div-all hidden" id="QA8">
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
                        <!-- <div class="col-md-6">
                            <p class="right text-info"><img src="{{asset('image/icon/main/icon_info.svg')}}" alt="">&nbsp You can choose correct answer by clicked alphabetical button</p>
                        </div> -->
                        <input type="hidden" id="countAnswer" name="countAnswer" value="2" class="class-QA8 class-all">
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA8" id="btnQA8a" value="a" type="button">A</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer0" class="form-control class-QA8 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice0" value="a" class="class-QA8 class-all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn-answer btn-QA8" id="btnQA8b" value="b" type="button">B</button>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group mb-5">
                                <textarea name="answer1" class="form-control class-QA8 class-all" placeholder="Enter your question" rows="5" required></textarea>
                                <input type="hidden" name="choice1" value="b" class="class-QA8 class-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <input type="hidden" id="btnValue" name="btnValue">
        <div class="col-md-12">
            <button type="submit" class="btn btn-white w-100" id="continue" value="continue"><img src="{{asset('image/icon/main/icon_plus.svg')}}" alt="">&nbsp Add Question and Answer</button>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-red w-100" id="save" value="save">Save</button>
        </div>
    </div>
</form>

@endsection