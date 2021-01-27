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
    <link rel="shortcut icon" type="image/png" href="{{asset('image/main/logo_mini.png')}}" />
    <link rel="shortcut icon" href="{{asset('image/main/logo_mini.png')}}">
    <link rel="stylesheet" href="{{asset('plugin/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <title>VA Aggregator</title>
    <!-- <link rel="shortcut icon" href="../favicon.ico"> -->
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/sweetalert/sweetalert2.min.css')}}" />
</head>
<div id="loading-overlay">
    <div class="loader"></div>
</div>

<body style="overflow-y: hidden;">
    @php $notif = session('notif'); @endphp
    @if ($notif)
    <div id="notif" data-status="{!! $notif['status'] !!}" data-message="{!! $notif['message'] !!}" data-url="{!! $notif['url'] !!}">
    </div>
    @endif

    <div class="half-bg-login"></div>

    <img src="{{asset('image/login/ilustrasi.png')}}" class="login-illustration">

    <div class="container">
        <nav class="navbar pt-4">
            <div class="row col-md-12">
                <div class="col-md-6">
                    <div>
                        <img src="{{asset('image/login/layout_set_logo.png')}}" class="login-logo">
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </nav>

        <div class="content mt-5 col-md-7">
            <div class="login-title">
                Admin Login <br>
                <span><span class="text-gray">to</span> VA Aggregator</span>
            </div>
            <form class="mt-5" id="formLoginAdminVascomm" ajax="true" action="{{ route('post.login-admin-vascomm') }}" method="post">
                <div class="input-container mt-4">
                    <img src="{{asset('image/login/icon_username.png')}}" class="icon">
                    <div class="form-group">
                        <input class="input-field form-control" type="text" placeholder="Enter your email...." id="email" name="email" required>
                    </div>
                </div>
                <div class="input-container mt-4">
                    <img src="{{asset('image/login/icon_password.png')}}" class="icon">
                    <div class="form-group">
                        <button type="submit" class="btn-login">Login</button>
                        <input class="input-field-passwd" type="password" placeholder="Password...." id="password" name="password" required>
                    </div>
                </div>
            </form>
            <div class="mt-5 text-gray link-bottom">
                <a href="#" data-toggle="modal" data-target="#modalForgetPassword" class="text-gray">Lupa Password</a>
            </div>
            <div class="mt-5 login-forget text-secondary"></div>
        </div>
    </div>


</body>
<script src="{{asset('plugin/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('plugin/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/crypto-js/crypto-js.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/additional-methods.js') }}"></script>
<script src="{{asset('js/all.js')}}"></script>
<script src="{{asset('plugin/sweetalert/sweetalert2.min.js')}}"></script>

</html>
