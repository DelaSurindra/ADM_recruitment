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
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/sweetalert/sweetalert2.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/datatable/Buttons-1.5.4/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/summernote/summernote-lite.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/image-picker-2/image-picker.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <title>ADM Recruitment</title>
</head>
<div id="loading-overlay">
    <div class="loader"></div>
</div>

<body>
    <div class="wrapper" id="main-wrapper">
        @php $notif = session('notif'); @endphp
        @if ($notif)
        <div id="notif" data-status="{!! $notif['status'] !!}" data-message="{!! $notif['message'] !!}" data-url="{!! $notif['url'] !!}" data-id="{!! $notif['id'] !!}" data-value="{{ $notif['value'] }}">
        </div>
        @endif
        @include('admin.main.navbar')
        @include('admin.main.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- <div class="content-footer main-header content-footer-tab">
            @include('admin.main.footer')
        </div> -->
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
<script type="text/javascript" src="{{asset('plugin/datatable/datatables.min.js')}}"></script>
<script src="{{asset('plugin/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/DataTables-1.10.18/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/buttons.flash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/JSZip-2.5.0/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/buttons.print.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/crypto-js/crypto-js.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/additional-methods.js') }}"></script>
<script src="{{asset('plugin/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugin/toastr/toastr.min.js')}}"></script>
<script src="{{asset('plugin/raphael/raphael.js')}}"></script>
<script src="{{asset('plugin/sweetalert/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugin/autoresize/autoresize.jquery.js')}}"></script>
<script src="{{asset('plugin/mask/jquery.mask.min.js')}}"></script>
<script src="{{asset('plugin/summernote/summernote-lite.min.js')}}"></script>
<script src="{{asset('plugin/moment/moment.js')}}"></script>
<script src="{{asset('plugin/chartjs/chart.min.js')}}"></script>
<script src="{{asset('plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('plugin/image-picker-2/image-picker.min.js')}}"></script>
<script src="{{asset('plugin/progress-bar/progressbar.min.js')}}"></script>
<script src="{{asset('js/all.js')}}"></script>

</html>