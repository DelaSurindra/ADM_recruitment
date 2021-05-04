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

<div class="modal fade" id="modalAddBulk" tabindex="-1" aria-labelledby="modalAddBulkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Add Bulk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="text-add-bulk">You can download excel format example here</p>
                <form action="{{route('post.bulk.add.candidate')}}" method="POST" class="form stacked form-hr" enctype="multipart/form-data" id="addBulkCandidate">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File Name</label>
                                <input type="text" class="form-control file-input-label" placeholder="Format xlsx" disabled>
                                <span class="btn btn-file pl-1 mb-2">
                                    Upload File <input type="file" name="fileBulk" id="fileBulk" class="uploadCertificate">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <a href="{{route('post.download.file', base64_encode('default-bulk.xlsx'))}}" class="download-bulk-default">
                                <img class="image-copy" src="{{ asset('image/icon/main/icon_donwload.svg') }}" alt="icon">&nbsp Download Default File
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection