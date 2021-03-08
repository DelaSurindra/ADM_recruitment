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
            <a href="{{route('get.vacancy.add')}}"><button type="button" class="btn btn-red right">Create New Question Bank</button></a>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red active" id="setTest1-tab" data-toggle="tab" href="#setTest1" role="tab" aria-controls="setTest1" aria-selected="true">Set Test 1</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red" id="setTest2-tab" data-toggle="tab" href="#setTest2" role="tab" aria-controls="setTest2" aria-selected="false">Set Test 2</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link border-red" id="setTest3-tab" data-toggle="tab" href="#setTest3" role="tab" aria-controls="setTest3" aria-selected="false">Set Test 3</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="setTest1" role="tabpanel" aria-labelledby="setTest1-tab">
            <div class="body">
                <!-- Accordion -->
                <div class="accordion accordion-question-bank" id="accordionExample">
                    <div class="card-accordion">
                        <div class="card-accordion-head" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="subtitle mb-0">Abstract</h4>
                            <!-- <i class="fas fa-chevron-up"></i> -->
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-accordion-body">
                                <div class="row">
                                    @for ($i = 0; $i < 10; $i++)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card-question-inside">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">Abstract</h5>
                                                <button id="dropdownMenuQuestion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-question" aria-labelledby="dropdownMenuQuestion">
                                                    <a class="dropdown-item" href="{{ route('get.profile.view') }}">
                                                        <img src="{{ asset('image/icon/main/edit.svg') }}" alt="icon">
                                                        <p class="mb-0 edit">Edit</p>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('get.profile.view') }}">
                                                        <img src="{{ asset('image/icon/main/delete_red.svg') }}" alt="icon">
                                                        <p class="mb-0 delete">Delete</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content-question">
                                                <p><b>Subtest {{$i}}</b> : Abstract Reasoning Abstract Reasoning Abstract Reasoning</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-accordion">
                        <div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="subtitle mb-0">Inventory</h4>
                            <!-- <i class="fas fa-chevron-down"></i> -->
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-accordion-body">
                                <div class="row">
                                    @for ($i = 0; $i < 10; $i++)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card-question-inside">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">Abstract</h5>
                                                <button id="dropdownMenuQuestion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-question" aria-labelledby="dropdownMenuQuestion">
                                                    <a class="dropdown-item" href="{{ route('get.profile.view') }}">
                                                        <img src="{{ asset('image/icon/main/edit.svg') }}" alt="icon">
                                                        <p class="mb-0 edit">Edit</p>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('get.profile.view') }}">
                                                        <img src="{{ asset('image/icon/main/delete_red.svg') }}" alt="icon">
                                                        <p class="mb-0 delete">Delete</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content-question">
                                                <p><b>Subtest {{$i}}</b> : Abstract Reasoning Abstract Reasoning Abstract Reasoning</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="setTest2" role="tabpanel" aria-labelledby="setTest2-tab">...</div>
        <div class="tab-pane fade" id="setTest3" role="tabpanel" aria-labelledby="setTest3-tab">...</div>
    </div>
</div>

@endsection