<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Admin Page</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">Admin Page</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::path() == 'home' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::path() == 'pelamar' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('pelamar')}}">Pelamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vacancies</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>