@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
@php $addTest = session('addTest'); @endphp
@if ($addTest)
<div id="addTest" data-url="{!! $addTest['url'] !!}">
</div>
@endif
<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="title-page"><img src="{{asset('image/icon/main/icon_title_test.svg')}}" alt=""> Manage Test</p>
            </div>
            <div class="col-md-6">
                <a href="{{route('get.test.add')}}"><button type="button" class="btn btn-red right">Add Test</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableTest" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Test ID</th>
                            <th>Test Date</th>
                            <th>Time</th>
                            <th>City</th>
                            <th>Location</th>
                            <th>Set Test</th>
                            <th>Status</th>
                            <th class="width-edit"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('modal')
    <!-- Modal Notif For Apply Success -->
    <div class="modal fade" id="modalSuccessAddTest" tabindex="-1" aria-labelledby="modalSuccessAddTestLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-for-notif">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-icon-notif">
                        <div class="ilustrasi">
                            <img src="{{ asset('image/icon/homepage/ilustrasi-sukses.svg') }}" class="img-fluid" alt="ilustrasi">
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                        </button>
                    </div>

                    <div class="modal-content-notif">
                        <h4 class="modal-page-subtitle">Create Test Success</h4>
                        <p class="my-4">But you need to add some participant to join this test</p>

                        <div class="row">
                            <div class="col-md-12">
                                <a href="" id="urlTest" class="btn btn-red w-100">Add Participant Test</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection