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
    <link rel="shortcut icon" type="image/png" href="{{asset('image/gambar/hicoffe_logo.png')}}" />
    <link rel="stylesheet" href="{{asset('plugin/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <title>Hasanah Lifestyle</title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{asset('loginCSS/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/sweetalert2.min.css')}}" />
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
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 left-side">
            <center>
            </center>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 right-side">
            <header>
                <h2><strong>Hello</strong></h2>
                <h6 class="font-color"><span>Masukkan username dan password untuk masuk ke dalam</span></h6>
                <h6 class="font-color"><span>halaman admin hasanah lifestyle</span></h6>
            </header>
            <section>
                <form class="form-login form stacked" id="formLoginAdmin" ajax="true" action="" method="post">
                    <div class="form-group">
                        <label class="form-label font-color-label" for="username">Username</label>
                        <div class="row">
                            <div class="col-md-6 col-10">
                                <input id="username" name="username" class="form-input" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-color-label" for="password">Password</label>
                        <div class="row">
                            <div class="col-md-6 col-10">
                                <input id="password" name="password" type="password" class="form-input">
                            </div>
                        </div>
                    </div>
                    <p>
                        <div class="row">
                            <div class="col-md-6">
                                <a class="font-color" href="#">Forgot Password ? </a>
                            </div>
                        </div>
                    </p>
                    <p class="clearfix">
                        <button type="log-twitter" class="btn bnt-login"><strong>Log in</strong></button>
                    </p>
                </form>​​
            </section>
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
<script src="{{asset('js/login.js')}}"></script>
<script src="{{asset('js/sweetalert2.min.js')}}"></script>

</html>