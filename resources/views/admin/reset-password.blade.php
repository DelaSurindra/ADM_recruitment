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
    <link rel="shortcut icon" type="image/png" href="{{asset('image/icon/navbar/logo_navbar.svg')}}" />
    <link rel="stylesheet" href="{{asset('plugin/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <title>ADM Recruitment</title>
    <link rel="stylesheet" type="text/css" href="{{asset('loginCSS/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/all.css')}}"><link rel="stylesheet" type="text/css" href="{{asset('plugin/sweetalert/sweetalert2.min.css')}}" />
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
    <div class="container">
        <nav class="navbar pt-4">
            <div class="row col-md-12">
                <div class="col-md-6">
                    <div>
                        <img src="{{asset('image/icon/login/logo_login.svg')}}" class="login-logo">
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </nav>
        <div class="content mt-5 col-md-7">
            <div class="login-title">
                Reset Password<br>
            </div>
            @if($type == 1)
            <form class="form-login" id="formResetPassword" ajax="true" action="{{route('post.reset.password')}}" method="post">
                <input type="hidden" name="idUser" id="idUser" value="{{$data['id']}}">
                <div class="input-container mt-4">
                    <img src="{{asset('image/icon/login/icon_password.svg')}}" class="icon">
                    <div class="form-group">
                        <input class="input-field form-control" type="password" placeholder="New Password" id="newPassword" name="newPassword">
                    </div>
                </div>
                <div class="input-container mt-4">
                    <img src="{{asset('image/icon/login/icon_password.svg')}}" class="icon">
                    <div class="form-group">
                        <input class="input-field form-control" type="password" placeholder="Konfirmation Password" id="konfirmasiPassword" name="konfirmasiPassword">
                    </div>
                </div>
                <div class="input-container mt-4">
                    <button type="submit" class="btn-login">Reset</button>
                </div>
            </form>
            @else
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p class="text-forget-pass"><span>Tautan telah kadaluarsa.</span></p>
                        <p class="text-forget-pass"><span>Silahkan lakukan reset password.</span></p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <button class="btn-login"><a href="{{route('get.login.view')}}">Back</a></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
<script src="{{asset('plugin/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('loginCSS/js/modernizr.custom.63321.js')}}"></script>
<script src="{{asset('plugin/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/crypto-js/crypto-js.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{asset('plugin/jquery-validate/dist/additional-methods.js') }}"></script>
<script src="{{asset('js/all.js')}}"></script>
<script src="{{asset('plugin/sweetalert/sweetalert2.min.js')}}"></script>

</html>