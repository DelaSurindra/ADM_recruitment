@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-7 login-left" style="background-image: url({{asset('assets/img/login.jpg')}}); background-size: cover;"> 
      </div>
      <div class="col-sm-12 col-md-6 col-lg-5 login-right">
        @if(session('err'))
            <div class="alert alert-danger">
                {{ session('err') }}
            </div>
        @endif
        <div class="container-login">
            <div class="app-name-login">
                <div class="login-logo">
                    <img src="asset/image/icon/profile.png" alt="" height="80" class="img-profile">
                </div>
                <h3>Career Vascomm</h3>
                <!-- <p>Application subtitle description</p> -->
            </div>
            <div class="form-login">
                <p>Sign in to start the session</p>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="form-for-login">
                        @csrf
                    <div class="group-form">
                        <!-- <input type="text" name="username"  placeholder="Username" class="input-login"> -->
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-login" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="group-form">
                        <!-- <input type="password" name="password" placeholder="Password" class="input-icon"> -->
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-icon" name="password" required placeholder="Password" >
                        <span><i class="fas fa-lock"></i> </span> 
                        @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                
            
            <div class="login-center">
                <div class="left">
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
              </div>
          </div>            

         <div class="login-center clear">
            <div class="left">
                <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="" for="remember">
                    {{ __('Remember Me') }}
                </label>
              <!-- <input type="checkbox">Keep me signed in<br> -->
            </div>
            <div class="right">
               <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>
            
          </div>
      </div>
        </form>
      </div>
  </div>
</div>
</div>

@endsection
