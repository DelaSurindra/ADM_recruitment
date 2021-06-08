@extends('candidate.main-homepage.main')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="candidate-page-title">Job Vacancy for You</h2>
                <div class="d-flex justify-content-end">
                    <div class="job-search dropdown mr-4">
                        <div class="job-search-wrapper" id="dropdownJobSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('image/icon/homepage/icon-search-red.svg') }}" alt="icon">
                            <p>Search</p>
                        </div>
                        <div class="dropdown-menu search dropdown-menu-right" aria-labelledby="dropdownJobSearch">
                            <div class="dropdown-item">
                                <form id="filterSearchList" class="form-candidate-view" filter="true">
                                    <h6 class="mb-2">Search</h6>
                                    <input type="text" name="searchJob" id="searchJob" class="form-control mb-2" placeholder="Search Job">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" for="filterSearchList" class="submit-filter mr-2 mt-1">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
    
                    <div class="job-search dropdown">
                        <div class="job-search-wrapper" id="dropdownJobFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('image/icon/homepage/icon-filter-red.svg') }}" alt="icon">
                            <p>Filter</p>
                        </div>
                        <div class="dropdown-menu filter dropdown-menu-right" aria-labelledby="dropdownJobFilter">
                            <form class="form-candidate-view" id="filterJobList" filter="true">
                                <div class="dropdown-item">
                                    <h6 class="mb-2">Job Type</h6>
                                    <div class="list-type-job">
                                        <div class="fulltime-badge job-type-select not-active mr-1">Full-time</div>
                                        <div class="internship-badge job-type-select not-active mr-1">Internship</div>
                                    </div>
                                    <input type="checkbox" name="jobTypeFulltime" value="1" id="checkFilterFulltime" class="d-none">
                                    <input type="checkbox" name="jobTypeInternship" value="2" id="checkFilterInternship" class="d-none">
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <h6 class="mb-2">Location</h6>
                                    <select name="locationFilter" id="locationFilter" class="form-control select2">
                                        <option value="">Choose Location</option>
                                        @foreach($wilayah as $data)
                                        <option value="{{$data['kabupaten']}}">{{$data['kabupaten']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <h6 class="mb-2">Education</h6>
                                    <div class="d-flex align-items-center">
                                        <label class="container-custom-checked mb-0 mr-2"> D3
                                            <input type="checkbox" name="educationFilterD3" id="degree1" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container-custom-checked mb-0 mr-2"> S1
                                            <input type="checkbox" name="educationFilterS1" id="degree2" value="2">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container-custom-checked mb-0"> S2
                                            <input type="checkbox" name="educationFilterS2" id="degree3" value="3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <h6>Major</h6>
                                    <select name="majorFilter" id="majorFilter" class="form-control select2">
                                        <option value="">Choose Major</option>
                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                        <option value="Akuntansi">Akuntansi</option>
                                    </select>
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
            <div class="row" id="loadJobs">
                @foreach($job as $data)
                <div class="col-lg-4 col-md-6 col-sm-12 my-3">
                    <div class="card card-job-list">
                        <a href="{{ route('get.job.page.detail', base64_encode(urlencode($data['job_id']))) }}" class="text-decoration-none">
                            <div class="card-body">
                                @if($data['type'] == 1)
                                <div class="fulltime-badge mb-3">Full-time</div>
                                @elseif($data['type'] == 2)
                                <div class="internship-badge mb-3">Internship</div>
                                @endif
                                <label class="label-no-margin mb-1">{{ $data['lokasi'] }}, Indonesia</label>
                                <h4 class="candidate-page-subtitle mb-3">{{ $data['job_title'] }}</h4>
    
                                <div class="d-flex align-items-center job-list-detail mb-1">
                                    <div class="icon-wrapper">
                                        <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
                                    </div>
                                    <p class="text">{{ $data['education_req'] }}</p>
                                </div>
                                <div class="d-flex align-items-center job-list-detail">
                                    <div class="icon-wrapper">
                                        <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
                                    </div>
                                    <p class="text">{{ $data['major'] }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @if(count($job) > 9)
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                    <button class="btn btn-white px-5 loadMoreJob">Load More</button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

