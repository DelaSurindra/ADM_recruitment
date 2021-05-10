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
    <!-- <div class="row">
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
    </div> -->
    <div class="half-bg-login"></div>

    <!-- <img src="{{asset('image/icon/login/ilustrasi_login.svg')}}" class="login-illustration"> -->

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
                Login Admin<br>
            </div>
            <form class="form-login" id="formLoginAdmin" ajax="true" action="{{route('post.login-admin')}}" method="post">
                <div class="input-container mt-4">
                    <img src="{{asset('image/icon/login/icon_username.svg')}}" class="icon">
                    <div class="form-group">
                        <input class="input-field form-control" type="text" placeholder="Enter your Email" id="email" name="email" required>
                    </div>
                </div>
                <div class="input-container mt-4">
                    <img src="{{asset('image/icon/login/icon_password.svg')}}" class="icon">
                    <div class="form-group">
                        <input class="input-field-passwd" type="password" placeholder="Password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                    <!-- <a href="/main-design" class="btn-login">Login</a> -->
                </div>
            </form>
            <div class="mt-3 text-gray link-bottom">
                <a type="button" data-toggle="modal" data-target="#modalForgetPass" class="text-red">Lupa Password</a>
            </div>
            <div class="mt-5 login-forget text-secondary"></div>
        </div>
    </div>
    <div class="modal fade" id="modalForgetPass" aria-labelledby="modalForgetPassLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-hr">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-up mb-3">
                        <h4 class="modal-hr-title mb-0">Forget Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                        </button>
                    </div>
                    <p class="mb-4">Enter email that associated to your account and we’ll send an email with instructions to reset password</p>
                    <form action="{{route('post.forget.password')}}" class="form stacked form-hr" ajax=true id="formForgetPassword">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <input id="email" name="email" class="form-control" type="text" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-red w-100 btn-confirm">Send Instructions</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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