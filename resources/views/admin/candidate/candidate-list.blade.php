@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
            <p class="title-page"><img src="{{asset('image/icon/main/icon_title_candidate.svg')}}" alt=""> Manage Candidate</p>
            </div>
            <div class="col-md-8">
                <a href="{{route('get.candidate.add')}}"><button type="button" class="btn btn-red right">Add Candidate</button></a>
                <button type="button" class="btn btn-white right mr-3" data-toggle="modal" data-target="#modalAddBulk">Add Candidate Bulk</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableCandidate" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Location</th>
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

<div class="modal fade" id="modalAddBulk" aria-labelledby="modalAddBulkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Add Bulk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="text-add-bulk">You can download excel format example <a href="{{route('get.download.bulk')}}" class="download-bulk-default">here</a></p>
                <form action="{{route('post.bulk.add.candidate')}}" method="POST" class="form stacked form-hr" enctype="multipart/form-data" id="addBulkCandidate">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="dropzone-wrapper">
                                    <div class="dropzone-desc">
                                        <img src="{{ asset('image/icon/main/icon_add_bulk.svg') }}" alt="icon">
                                        <p class="file-input-label">Upload excel file that match with format example</p>
                                    </div>
                                    <input type="file" name="fileBulk" class="dropzone" id="fileBulk">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Upload File</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection