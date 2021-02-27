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
                                <form class="form-candidate-view">
                                    <h6 class="mb-2">Search</h6>
                                    <input type="text" class="form-control mb-2" placeholder="Search">
                                    <button type="submit" class="submit-filter">Apply</button>
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
                            <form class="form-candidate-view" id="filterJobList" ajax="true">
                                <div class="dropdown-item">
                                    <h6 class="mb-2">Job Type</h6>
                                    <div class="list-type-job">
                                        <div class="fulltime-badge mr-1">Full-time</div>
                                        <div class="internship-badge mr-1">Internship</div>
                                        <div class="fulltime-badge not-active">Full-time</div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <h6 class="mb-2">Location</h6>
                                    <select name="" id="" class="form-control select2">
                                        <option value="">Loc 1</option>
                                        <option value="">Loc 2</option>
                                        <option value="">Loc 3</option>
                                    </select>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <h6 class="mb-2">Education</h6>
                                    <div class="d-flex align-items-center">
                                        <label class="container-custom-checked mb-0 mr-2"> D3
                                            <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container-custom-checked mb-0 mr-2"> S1
                                            <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container-custom-checked mb-0"> S2
                                            <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <h6>Major</h6>
                                    <select name="" id="" class="form-control select2">
                                        <option value="">Loc 1</option>
                                        <option value="">Loc 2</option>
                                        <option value="">Loc 3</option>
                                    </select>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="clear-filter">Clear all filter</button>
                                        <button type="submit" class="submit-filter">Apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @for($i=0; $i < 3; $i++)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-job-list">
                        <div class="card-body">
                            <div class="internship-badge mb-3">Internship</div>
                            <label class="label-no-margin mb-1">Banten, Indonesia</label>
                            <h4 class="candidate-page-subtitle mb-3">Pre Sales Solution Architect</h4>

                            <div class="d-flex align-items-center job-list-detail mb-1">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('image/icon/homepage/icon-graduate.svg') }}" alt="icon">
                                </div>
                                <p>Diploma, Bachelor's Degree in Engineering</p>
                            </div>
                            <div class="d-flex align-items-start job-list-detail">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('image/icon/homepage/icon-book.svg') }}" alt="icon">
                                </div>
                                <p>DevOps & Cloud Management Software, Enterprise Resource Planning</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection