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
                <a href="{{route('get.candidate.detail', 1)}}"><button type="button" class="btn btn-red right">Add Candidate</button></a>
                <button type="button" class="btn btn-bulk-candidate right mr-3" data-toggle="modal" data-target="#modalSendNotif">Send Notification</button>
                <button type="button" class="btn btn-bulk-candidate right mr-3">Bulk Update</button>
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
                            <div class="job-search-wrapper" id="dropdownFilterCandidate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('image/icon/homepage/icon-filter-red.svg') }}" alt="icon">
                                <p>Filter</p>
                            </div>
                            <div class="dropdown-menu filter dropdown-menu-right dropdown-candidate" aria-labelledby="dropdownFilterCandidate">
                                <form class="form-hr" id="filterCandidate" filter="true">
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
                                            <option value="Sistem Informasi">Sistem Informasi</option>
                                            <option value="Akuntansi">Akuntansi</option>
                                        </select>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-item d-flex flex-column">
                                        <h6 class="mb-2">University</h6>
                                        <select name="university" id="university" class="form-control select2">
                                                <option value="">Choose University</option>
                                                <option value="Universitas Brawijaya">Universitas Brawijaya</option>
                                                <option value="Universitas Indonesia">Universitas Indonesia</option>
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
                <table id="tableCandidate" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th class="width-checkbox"><input type="checkbox"></th>
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
<div class="modal fade" id="modalSendNotif" tabindex="-1" aria-labelledby="modalSendNotifLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="mb-3">2 item selected</p>
                <form action="" class="form stacked form-hr" ajax=true id="updateStatusCandidate">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-column">
                                <label>Application Status</label>
                                <select class="select2 tex-center select2-width" id="aplicationStatus" name="aplicationStatus">
                                    <option value="">-- Pilih Status --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-column">
                                <label>Test ID</label>
                                <select class="select2 tex-center select2-width" id="TestId" name="TestId">
                                    <option value="">-- Pilih Test --</option>
                                </select>
                            </div>
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