<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="img-src * 'self' data: https:; default-src *; style-src 'self' http://* 'unsafe-inline'; script-src 'self' http://* 'unsafe-inline' 'unsafe-eval'" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base" content="{{ URL::route('home') }}" />
    <meta name="baseImage" content="{{ url('storage') }}" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{asset('image\main\logo_mini.png')}}" />
    <link rel="shortcut icon" href="{{asset('image\main \logo_mini.png')}}">
    <title>VA Aggregator</title>
    <!-- packages -->
    <link rel="stylesheet" href="{{asset('plugin/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/sweetalert//sweetalert2.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/datatable/Buttons-1.5.4/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/summernote/summernote-lite.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- additional -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('loginCSS/css/register.css')}}" /> -->
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
</head>
<div id="loading-overlay">
    <div class="loader"></div>
</div>
@php $notif = session('notif'); @endphp
        @if ($notif)
        <div id="notif" data-status="{!! $notif['status'] !!}" data-message="{!! $notif['message'] !!}" data-url="{!! $notif['url'] !!}">
        </div>
        @endif
<body class="main-body" style="display: flex; flex-direction: column">
    <div class="wrapper {{ Session::get('session_id.priviledge_id') == '1' ? '' : 'run-notif-institusi' }}" id="main-wrapper">
        @include('main.navbar')
        @include('main.sidebar')

        <div class="content-wrapper" style="flex: 1 0 auto">
            <div id="overlay"></div>
            @yield('content')
        </div>
{{--        <div class="content-footer main-header content-footer-tab w-100">--}}
{{--            @include('main.footer')--}}
{{--        </div>--}}
        @include('main.footer')
    </div>
    @section('modal')
    @show


</body>
<script src="{{asset('plugin/jquery/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/datatables.js')}}"></script>
<script src="{{asset('plugin/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/DataTables-1.10.18/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/datatable/Buttons-1.5.4/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/crypto-js/crypto-js.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/additional-methods.js') }}"></script>
<script src="{{asset('plugin/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugin/sweetalert/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugin/autoresize/autoresize.jquery.js')}}"></script>
<script src="{{asset('plugin/mask/jquery.mask.min.js')}}"></script>
<script src="{{asset('plugin/summernote/summernote-lite.min.js')}}"></script>
<script src="{{asset('plugin/moment/moment.js')}}"></script>
<script src="{{asset('plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('js/all.js')}}"></script>

</html>
