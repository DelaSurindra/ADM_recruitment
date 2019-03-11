<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">
    <title>Admin Page</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('vendor/summernote-lite.css')}}  " >
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.css')}}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/admin/home') }}"><img src="" alt=""> 
            <img src="/assets/img/vascomm_logo.png" height="40"  alt="">
        Admin Recruitment</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::path() == 'admin/home' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::path() == 'admin/pelamar' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('pelamar')}}">Pelamar</a>
                    </li>
                    <li class="nav-item {{ Request::path() == 'admin/vacancy' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('vacancy')}}">Vacancies</a>
                    </li>
                </ul>
                <div class="dropdown form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Option
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('profile')}}">Edit Profile</a>
                        <a class="dropdown-item" href="{{route('listUser')}}">Manage User Admin</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            <button class="dropdown-item" type="submit">Logout</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote-lite.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('.summernote').summernote();
        $('.js-example-basic-single').select2();
    });
    </script>
</body>

</html>