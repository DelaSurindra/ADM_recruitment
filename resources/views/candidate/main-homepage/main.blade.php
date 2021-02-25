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
<div id="loading-overlay">
    <div class="loader"></div>
</div>

<body>
    <div class="wrapper" id="main-wrapper">
        @php $notif = session('notif'); @endphp
        @if ($notif)
        <div id="notif" data-status="{!! $notif['status'] !!}" data-message="{!! $notif['message'] !!}" data-url="{!! $notif['url'] !!}">
        </div>
        @endif

        @include('candidate.main-homepage.topbar')
        
        <div class="content-wrapper">
            @yield('content')
        </div>
        
        <footer>
            <div class="container">
                <div class="row">
                    <div class="mt-4 col-lg-3 col-md-6 col-sm-12 d-flex flex-column justify-content-between">
                        <img src="{{ asset('image/icon/homepage/logo-footer.svg') }}" alt="logo" style="width: 65%; height: auto;">
                        <p class="mb-0 all-right-reserved">C2021 Astra Daihatsu All Right Reserved</p>
                    </div>
                    <div class="mt-4 col-lg-3 col-md-6 col-sm-12 d-flex flex-column justify-content-between">
                        <div>
                            <p class="title-usefull-link">Usefull Link</p>
                            <ul class="usefull-link">
                                <li><a href="#">Job Vacancy</a></li>
                                <li><a href="#">News & Event</a></li>
                                <li><a href="#">Company Profile</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Terms And Policies</a></li>
                            </ul>
                        </div>
                        <div>
                            <p class="title-usefull-link mt-5">Follow Us</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#"><img src="{{ asset('image/icon/homepage/footer/icon_facebook.svg') }}" alt="icon"></a>
                                <a href="#"><img src="{{ asset('image/icon/homepage/footer/icon_twitter.svg') }}" alt="icon"></a>
                                <a href="#"><img src="{{ asset('image/icon/homepage/footer/icon_linkedin.svg') }}" alt="icon"></a>
                                <a href="#"><img src="{{ asset('image/icon/homepage/footer/icon_instagram.svg') }}" alt="icon"></a>
                                <a href="#"><img src="{{ asset('image/icon/homepage/footer/icon_youtube.svg') }}" alt="icon"></a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-lg-3 col-md-6 col-sm-12">
                        <p class="title-usefull-link">Location</p>
                        <p class="mb-1 subtitle-usefull-link">Head Office</p>
                        <ul class="location-list">
                            <li>
                                <p>Jl. Gaya Motor III, No,5, Sunter II, Jakarta 14330, Telp (021) 6510 300</p>
                            </li>
                        </ul>
                        <p class="mb-1 subtitle-usefull-link">Sunter Plant</p>
                        <ul class="location-list">
                            <li>
                                <p>Sunter Assembly Plant : Jl. Gaya Motor Barat, No.4, Sunter II, Jakarta 14330, Telp (021) 6531 0202</p>
                            </li>
                            <li>
                                <p>Sunter Press Plant : Jl. Gaya Motor II No. 2, Sunter II, Jakarta 14330, Telp (021) 6511 792</p>
                            </li>
                        </ul>
                        <p class="mb-1 subtitle-usefull-link">Parts Center</p>
                        <ul class="location-list mb-0">
                            <li>
                                <p>Jl. Gaya Motor III, No,5, Sunter II, Jakarta 14330, Telp (021) 6510 300</p>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4 col-lg-3 col-md-6 col-sm-12">
                        <p class="title-usefull-link text-white">Location</p>
                        <p class="mb-1 subtitle-usefull-link">Karawang Plant</p>
                        <ul class="location-list">
                            <li>
                                <p>Karawang Assembly Plant and R&D Center:Kawasan Industri Suryacipta Karawang, Jl. Surya Pratama Blok I Kav. 50 AB Karawang 41361, Telp (021) 2957 6900</p>
                            </li>
                            <li>
                                <p>Karawang Engine Plant : Jl. Maligi VI-M16, Kawasan Industri KIIC, Jl. Tol Jakarta, Cikampek KM 47 Karawang 41361, Telp (021) 8911 4030</p>
                            </li>
                            <li>
                                <p>Karawang Casting Plant : Jl. Maligi Raya Lot A5, Kawasan Industri KIIC, Jl. Tol Jakarta, CIkampek KM 47 Karawang 41361, Telp (021) 8901495</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
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