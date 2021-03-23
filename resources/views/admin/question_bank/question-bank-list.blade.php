@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card-question">
    <div class="row head">
        <div class="col-md-6">
            <p class="title-page"><img src="{{asset('image/icon/main/icon_title_question_bank.svg')}}" alt=""> Manage Question Bank</p>
        </div>
        <div class="col-md-6">
            <a href="{{route('get.question.bank.add')}}"><button type="button" class="btn btn-red right">Create New Question Bank</button></a>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red active setTest" data-value="1" id="tab_1" data-toggle="tab" href="#setTest_1" role="tab" aria-controls="setTest_1" aria-selected="true">Set Test 1</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red setTest" data-value="2" id="tab_2" data-toggle="tab" href="#setTest_2" role="tab" aria-controls="setTest_2" aria-selected="false">Set Test 2</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red setTest"  data-value="3" id="tab_3" data-toggle="tab" href="#setTest_3" role="tab" aria-controls="setTest_3" aria-selected="false">Set Test 3</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red setTest"  data-value="4" id="tab_4" data-toggle="tab" href="#setTest_4" role="tab" aria-controls="setTest_4" aria-selected="false">Set Test 4</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="setTest_1" role="tabpanel" aria-labelledby="setTest_1">
            <div class="body" id="bodyTest1">
                <!-- Accordion -->
                <div class="accordion accordion-question-bank">
                    @if($question['verbal'] != [])
                    <div class="card-accordion">
                        <div class="card-accordion-head" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="subtitle mb-0">Verbal</h4>
                            <!-- <i class="fas fa-chevron-up"></i> -->
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-accordion-body">
                                <div class="row">
                                    @foreach ($question['verbal'] as $verbal)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <a href="{{route('get.question.bank.detail', base64_encode(urlencode($verbal['master_id'].'_'.$verbal['set'])))}}">
                                            <div class="card-question-inside">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">Verbal</h5>
                                                </div>
                                                <div class="content-question">
                                                    <p><b>{{$verbal['sub_type']}}</b> : {{$verbal['name']}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($question['numeric'] != [])
                    <div class="card-accordion">
                        <div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <h4 class="subtitle mb-0">Numeric</h4>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-accordion-body">
                                <div class="row">
                                    @foreach ($question['numeric'] as $numeric)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <a href="{{route('get.question.bank.detail', base64_encode(urlencode($verbal['master_id'].'_'.$verbal['set'])))}}">
                                            <div class="card-question-inside">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">Numeric</h5>
                                                </div>
                                                <div class="content-question">
                                                    <p><b>{{$numeric['sub_type']}}</b> : {{$numeric['name']}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($question['abstrak'] != [])
                    <div class="card-accordion">
                        <div class="card-accordion-head" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <h4 class="subtitle mb-0">Abstrak</h4>
                            <!-- <i class="fas fa-chevron-up"></i> -->
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-accordion-body">
                                <div class="row">
                                    @foreach ($question['abstrak'] as $abstrak)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <a href="{{route('get.question.bank.detail', base64_encode(urlencode($verbal['master_id'].'_'.$verbal['set'])))}}">
                                            <div class="card-question-inside">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">Abstrak</h5>
                                                </div>
                                                <div class="content-question">
                                                    <p><b>{{$abstrak['sub_type']}}</b> : {{$abstrak['name']}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($question['inventory'] != [])
                    <div class="card-accordion">
                        <div class="card-accordion-head" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            <h4 class="subtitle mb-0">Inventory</h4>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="card-accordion-body">
                                <div class="row">
                                    
                                    @foreach ($question['inventory'] as $inventory)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <a href="{{route('get.question.bank.detail', base64_encode(urlencode($verbal['master_id'].'_'.$verbal['set'])))}}">
                                            <div class="card-question-inside">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">Inventory</h5>
                                                </div>
                                                <div class="content-question">
                                                    <p><b>{{$inventory['sub_type']}}</b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="setTest_2" role="tabpanel" aria-labelledby="setTest_2">
            <div class="body" id="bodyTest2">
            </div>
        </div>
        <div class="tab-pane fade" id="setTest_3" role="tabpanel" aria-labelledby="setTest_3">
            <div class="body" id="bodyTest3">
            </div>
        </div>
        <div class="tab-pane fade" id="setTest_4" role="tabpanel" aria-labelledby="setTest_4">
            <div class="body" id="bodyTest4">
            </div>
        </div>
    </div>
</div>

@endsection