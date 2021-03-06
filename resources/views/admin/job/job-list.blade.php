@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
            <p class="title-page"><img src="{{asset('image/icon/main/icon_title_job.svg')}}" alt=""> Manage Job Application</p>
            </div>
            <div class="col-md-8">
                <!-- <button type="button" class="btn btn-bulk-candidate right mr-3 hidden">Send Notification</button> -->
                <a href="" class="btn btn-white right" id="btnDownloadJob">Download Job</a>
                <button type="button" class="btn btn-bulk-candidate right mr-3 hidden" id="btnBulkUpdate">Bulk Update</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-between mb-4 right">
                    <div class="d-flex justify-content-end">
                        <!-- <div class="job-search dropdown mr-4">
                            <div class="job-search-wrapper" id="dropdownJobSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('image/icon/homepage/icon-search-red.svg') }}" alt="icon">
                                <p>Search</p>
                            </div>
                            <div class="dropdown-menu search dropdown-menu-right" aria-labelledby="dropdownJobSearch">
                                <div class="dropdown-item">
                                    <form id="filterSearchList" class="form-hr" filter="true">
                                        <h6 class="mb-2">Search</h6>
                                        <input type="text" name="searchJob" id="searchJob" class="form-control mb-2" placeholder="Search Job">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" for="filterSearchList" class="submit-filter mr-2 mt-1">Apply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->

                        <div class="job-search dropdown">
                            <div class="job-search-wrapper" id="dropdownFilterJob" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('image/icon/homepage/icon-filter-red.svg') }}" alt="icon">
                                <p>Filter</p>
                            </div>
                            <div class="dropdown-menu filter dropdown-menu-right dropdown-candidate" aria-labelledby="dropdownFilterJob">
                                <form class="form-hr" id="filterJob" filter="true">
                                    <div class="dropdown-item">
                                        <h6 class="mb-2">IPK Minimum</h6>
                                        <input type="text" class="form-control" name="ipkMinimum" id="ipkMinimum" placeholder="IPK Minimum">
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-item d-flex flex-column">
                                        <h6 class="mb-2">Job Vacancy</h6>
                                        <select name="job" id="job" class="form-control select2">
                                            <option value="">Choose Vacancy</option>
                                            @foreach($vacancy as $data)
                                            <option value="{{$data['job_id']}}">{{$data['job_title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-item d-flex flex-column">
                                        <h6>Major</h6>
                                        <select name="major" id="major" class="form-control select2">
                                            <option value="">Choose Major</option>
                                            @foreach($major as $dataMajor)
                                            <option value="{{$dataMajor['major']}}">{{$dataMajor['major']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-item d-flex flex-column">
                                        <h6 class="mb-2">University</h6>
                                        <select name="university" id="university" class="form-control select2">
                                            <option value="">Choose University</option>
                                            @foreach($universitas as $univ)
                                                <option value="{{$univ['universitas']}}">{{$univ['universitas']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-item">
                                        <h6 class="mb-2">Tahun Lahir</h6>
                                        <input type="text" class="form-control" name="usia" id="usia" placeholder="Tahun Lahir">
                                    </div>
                                    <div class="dropdown-item">
                                        <h6 class="mb-2">Tahun Lulus</h6>
                                        <input type="text" class="form-control" name="tahunLulus" id="tahunLulus" placeholder="Tahun Lulus">
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-item">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button type="button" class="clear-filter">Clear all filter</button>
                                            <button type="submit" for="filterJobList" class="submit-filter">Apply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="countCheck" value=0>
                <table id="tableJob" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th class="width-checkbox"></th>
                            <th>Submit Date</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Graduate</th>
                            <th>University</th>
                            <th>Faculty</th>
                            <th>Major</th>
                            <th>GPA</th>
                            <th>Graduate Year</th>
                            <th>Job Position</th>
                            <th>Area</th>
                            <th>Application Status</th>
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
<div class="modal fade" id="modalUpdateBulk" aria-labelledby="modalUpdateBulkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3" id="textItem"></p>
                <form action="{{route('post.bulk.update.job')}}" class="form stacked form-hr" ajax=true id="updateStatusCandidate">
                    <div id="inputID"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-column" id="aplicationStatusDivv">
                                <label>Application Status</label>
                                <select class="select2 tex-center select2-width" id="aplicationStatus" name="aplicationStatus">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1">Process To Written Test</option>
                                    <option value="11">Failed</option>
                                    <option value="12">Hired</option>
                                    <option value="99">Talent Stock</option>
                                    <option value="3">Written Test Pass</option>
                                    <option disabled value="0">Application Resume</option>
                                    <option disabled value="2">Scheduled to Written Test</option>
                                    <option disabled value="4">Written Test failed</option>
                                    <option disabled value="5">Process to HR interview</option>
                                    <option disabled value="6">Process to User Interview 1</option>
                                    <option disabled value="7">Process to User Interview 2</option>
                                    <option disabled value="8">Process to Direktur Interview</option>
                                    <option disabled value="9">Process to MCU</option>
                                    <option disabled value="10">Process to Doc Sign</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group d-flex flex-column" id="TestIdDiv">
                                <label>Test ID</label>
                                <select class="select2 tex-center select2-width" id="TestId" name="TestId" disabled>
                                    <option value="">-- Pilih Test --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100" id="btnUpdateStatusBulk">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection