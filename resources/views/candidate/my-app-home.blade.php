<h2 class="candidate-page-title">My Application</h2>
<div class="row mt-4">
    <div class="col-12">
        <ul class="nav nav-pills mb-3 tabs-my-app" id="pills-tab" role="tablist">
            <li class="nav-item pr-2" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
            </li>
            <li class="nav-item px-2" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Successed</a>
            </li>
            <li class="nav-item px-2" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Rejected</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <!-- <div class="card-list-my-app">
                    <div class="card-head-my-app success d-flex justify-content-center">
                        <p>Success</p>
                    </div>
                    <div class="card-body-my-app p-4">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="fulltime-badge mb-3">Full-time</div>
                                <label class="label-no-margin mb-1">Banten, Indonesia</label>
                                <h4 class="candidate-page-subtitle mb-0">Pre Sales Solution Architect</h4>
                            </div>
                            <div class="col-lg-4 col-md-12 border-left1">
                                <button class="btn btn-white btn-block">View Detail</button>
                                <button class="btn btn-red btn-block">Doc. Sign & Contract</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-list-my-app">
                    <div class="card-head-my-app reject d-flex justify-content-center">
                        <p>Reject</p>
                    </div>
                    <div class="card-body-my-app p-4">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="internship-badge mb-3">Internship</div>
                                <label class="label-no-margin mb-1">Banten, Indonesia</label>
                                <h4 class="candidate-page-subtitle mb-0">Pre Sales Solution Architect</h4>
                            </div>
                            <div class="col-lg-4 col-md-12 border-left1">
                                <button class="btn btn-white btn-block">View Detail</button>
                                <button class="btn btn-red btn-block">Doc. Sign & Contract</button>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-5">
                        <img src="{{ asset('image/icon/homepage/icon-koper.svg') }}" alt="icon">
                        <h4 class="candidate-page-subtitle mb-2 mt-5">You haven't applied for a job </h4>
                        <p class="text-empty-job mb-3">Join our team right now</p>
                        <button class="btn btn-red px-5">See Job Vacancy</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>
    </div>
</div>