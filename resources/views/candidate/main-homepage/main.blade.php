<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="img-src * 'self' data: https:; default-src *; style-src 'self' http://* 'unsafe-inline'; script-src 'self' http://* 'unsafe-inline' 'unsafe-eval'" />
    <meta charset="UTF-8">
    <meta name="base" content="{{ URL::route('home') }}" />
    <meta name="baseImage" content="{{ url('storage') }}" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{asset('image/icon/navbar/logo_navbar.svg')}}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('plugin/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/select2/dist/css/select2.min.css')}}">
    <!-- <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/sweetalert/sweetalert2.min.css')}}" />
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('plugin/datatable/datatables.min.css')}}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('plugin/datatable/Buttons-1.5.4/css/buttons.dataTables.min.css')}}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('plugin/summernote/summernote-lite.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('plugin/image-picker-2/image-picker.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css/candidate-style.min.css')}}">
    <title>ADM Recruitment</title>
</head>

<body id="bodyCandidate">
    <div id="loading-overlay">
        <div class="loader"></div>
    </div>
    <div class="wrapper" id="main-wrapper">
        @php $notif = session('notif'); @endphp
        @if ($notif)
        <div id="notif" data-status="{!! $notif['status'] !!}" data-message="{!! $notif['message'] !!}" data-url="{!! $notif['url'] !!}">
        </div>
        @endif

        @php $notifModal = session('notifModal'); @endphp
        @if ($notifModal)
        <div id="notifModal" data-status="{!! $notifModal['status'] !!}" data-message="{!! $notifModal['message'] !!}" data-url="{!! $notifModal['url'] !!}">
        </div>
        @endif

        @php $mustLogin = session('mustLogin'); @endphp
        @if ($mustLogin)
        <div id="mustLogin">
        </div>
        @endif

        @php $profileSaved = session('profileSaved'); @endphp
        @if ($profileSaved)
        <div id="profileSaved">
        </div>
        @endif

        @include('candidate.main-homepage.topbar')
        
        <div class="content-wrapper">
            @yield('content')
        </div>
        
        @include('candidate.main-homepage.footer')
    </div>
    <div id="modalSession" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <p class="p-session">Anda sudah tidak aktif selama 15 menit. Silahkan login kembali</p>
                            <center>
                                <button class="btn btn-success" id="btnSession" onclick="reload();">Login</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notif For SUCCESS -->
    <div class="modal fade" id="modalNotifForSuccess" aria-labelledby="modalNotifForSuccessLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-for-notif">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-icon-notif d-flex justify-content-between align-items-start">
                        <div class="ilustrasi">
                            <img src="{{ asset('image/icon/homepage/ilustrasi-sukses.svg') }}" class="img-fluid" alt="ilustrasi">
                        </div>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                        </button> -->
                    </div>

                    <div class="modal-content-notif">
                        <h4 id="titleSuccessNotif" class="candidate-page-subtitle mb-2">Your Password Saved</h4>
                        <p id="subtitleSuccessNotif" class="mb-0"></p>
                        <div id="changeBtnNotif">
                            <a href="#" class="btn btn-home-color btn-block mt-4 d-none">Okay</a>
                            <button class="btn btn-home-color btn-block mt-4" data-dismiss="modal" type="button">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Notif For ERROR -->
    <div class="modal fade" id="modalNotifForError" aria-labelledby="modalNotifForErrorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-for-notif">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-icon-notif d-flex justify-content-between align-items-start">
                        <div class="ilustrasi">
                            <img src="{{ asset('image/icon/homepage/ilustrasi-gagal.svg') }}" class="img-fluid" alt="ilustrasi">
                        </div>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                        </button> -->
                    </div>

                    <div class="modal-content-notif">
                        <h4 id="titleErrorNotif" class="candidate-page-subtitle mb-2">Edit Password Failed</h4>
                        <p id="subtitleErrorNotif" class="mb-0"></p>
                        <button class="btn btn-home-color btn-block mt-4" data-dismiss="modal" type="button">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notif Must Login -->
    <div class="modal fade" id="modalNotifForLogin" aria-labelledby="modalNotifForLoginLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-for-notif">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-icon-notif d-flex justify-content-between align-items-start">
                        <div class="ilustrasi">
                            <img src="{{ asset('image/icon/homepage/ilustrasi-gagal.svg') }}" class="img-fluid" alt="ilustrasi">
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                        </button>
                    </div>

                    <div class="modal-content-notif">
                        <h4 class="candidate-page-subtitle">Login</h4>
                        <p class="mb-0">To apply this job you need to <b class="goToLogin">Login</b> or <b class="goToRegister">Register</b>. You can find it in the top corner of the website</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notif For Profile Saved -->
    <div class="modal fade" id="modalNotifProfileSaved" aria-labelledby="modalNotifProfileSavedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-for-notif">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-icon-notif">
                        <div class="ilustrasi">
                            <img src="{{ asset('image/icon/homepage/ilustrasi-sukses.svg') }}" class="img-fluid" alt="ilustrasi">
                        </div>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                        </button> -->
                    </div>

                    <div class="modal-content-notif">
                        <h4 class="candidate-page-subtitle">Your Profile Saved</h4>
                        <p class="my-4">Thankyou for sign up to our<br>platform.</p>

                        <div class="row">
                            <div class="col-6" style="padding-left:7px; padding-right:7px">
                                <a href="{{ route('get.profile.view') }}" class="btn btn-block btn-blue-red">Go to Profile</a>
                            </div>
                            <div class="col-6" style="padding-left:7px; padding-right:7px">
                                <a href="{{ route('get.job.page') }}" class="btn btn-block btn-home-color">See Job List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notif For Apply Success -->
    <div class="modal fade" id="modalNotifApplySuccess" aria-labelledby="modalNotifProfileSavedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-for-notif">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-icon-notif">
                        <div class="ilustrasi">
                            <img src="{{ asset('image/icon/homepage/ilustrasi-sukses.svg') }}" class="img-fluid" alt="ilustrasi">
                        </div>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                        </button> -->
                    </div>

                    <div class="modal-content-notif">
                        <h4 class="candidate-page-subtitle">Apply Success</h4>
                        <p class="my-4">Congratulations, your application has been sent. Please wait for the announcement for the next recruitment step. Lastly, we have one question for you</p>

                        <form action="{{ route('post.tell-me') }}" id="formTellMe" class="form-candidate-view" method="POST" ajax="true">
                            <input type="hidden" name="idApply" id="idApply" value="">
                            <label for="">How did you hear about this job?</label>
                            <select id="tellMe" name="tellMe" class="select2 form-control">'+
                                <option selected disabled>Choose or input</option>
                                
                            </select>
                            <button type="submit" class="btn btn-home-color btn-block mt-3">Go to My Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCheckTest" aria-labelledby="modalCheckTestLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-online-test">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-up">
                        <h4 class="candidate-page-subtitle mb-0">Online Test<br>Schedule</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                        </button>
                    </div>

                    <div class="modal-card mb-3">
                        <h6 id="vacancyTitle"></h6>
                        <p id="vacancyLocation"></p>
                    </div>

                    <div class="modal-fill">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="">Date</label>
                                <p class="mb-0" id="testDate"></p>
                            </div>
                            <div>
                                <label for="">Time</label>
                                <p class="mb-0" id="testTime"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="">City</label>
                                <p class="mb-0" id="testCity"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <label for="">Location</label>
                                <p class="mb-0" id="testLocation"></p>
                            </div>
                        </div>
                        <form action="{{route('post.confirm.test')}}" class="form stacked form-hr" ajax=true id="formCheckTest"></form>
                        <div id="divRescheduleTest"></div>
                                
                    </div>
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCheckInterview" aria-labelledby="modalCheckInterviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-online-test">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-up">
                        <h4 class="candidate-page-subtitle mb-0">Online Test<br>Schedule</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                        </button>
                    </div>

                    <div class="modal-card mb-3">
                        <h6 id="interVacancyTitle"></h6>
                        <p id="interVacancyLocation"></p>
                    </div>

                    <div class="modal-fill">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="">Date</label>
                                <p class="mb-0" id="interviewDate"></p>
                            </div>
                            <div>
                                <label for="">Time</label>
                                <p class="mb-0" id="interviewTime"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="">City</label>
                                <p class="mb-0" id="interviewCity"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <label for="">Location</label>
                                <p class="mb-0" id="interviewLocation"></p>
                            </div>
                        </div>
                        <form action="{{route('post.confirm.interview')}}" class="form stacked form-hr" ajax=true id="formCheckInterview"></form>
                        <div id="divRescheduleInterview"></div>
                    </div>
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    @section('modal')

    @show
</body>

<script src="{{asset('plugin/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('plugin/popper/popper.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/datatables.min.js')}}"></script> -->
<script src="{{asset('plugin/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/DataTables-1.10.18/js/dataTables.bootstrap.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/dataTables.buttons.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/buttons.flash.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/JSZip-2.5.0/jszip.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/pdfmake-0.1.36/pdfmake.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/pdfmake-0.1.36/vfs_fonts.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/buttons.html5.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/buttons.print.min.js')}}"></script> -->
<script type="text/javascript" src="{{asset('plugin/crypto-js/crypto-js.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/additional-methods.js') }}"></script>
<script src="{{asset('plugin/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugin/toastr/toastr.min.js')}}"></script>
<script src="{{asset('plugin/raphael/raphael.js')}}"></script>
<script src="{{asset('plugin/sweetalert/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugin/autoresize/autoresize.jquery.js')}}"></script>
<script src="{{asset('plugin/mask/jquery.mask.min.js')}}"></script>
<!-- <script src="{{asset('plugin/summernote/summernote-lite.min.js')}}"></script> -->
<script src="{{asset('plugin/moment/moment.js')}}"></script>
<script src="{{asset('plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<!-- <script src="{{asset('plugin/image-picker-2/image-picker.min.js')}}"></script> -->
<script src="{{asset('js/all.js')}}"></script>

</html>