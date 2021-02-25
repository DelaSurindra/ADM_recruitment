<nav class="navbar navbar-expand-lg navbar-light navbar-adm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{asset('image/icon/navbar/logo_navbar.svg')}}" loading="lazy" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Job List</a>
                </li>
                <li class="nav-item {{($topbar== 'news_event'?'active':'')}}">
                    <a class="nav-link" href="{{route('get.news.event.page')}}">News & Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Company Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
            </ul>

            <div class="form-inline my-2 my-lg-0">
                @if(Session::get('session_candidate'))
                <a href="{{ route('get.logout-candidate') }}" class="btn btn-red">Logout</a>
                @else
                <button class="btn btn-gray px-3 mr-3" data-toggle="modal" data-target="#modalSignUpCandidate" type="button">Sign Up</button>
                <button class="btn btn-red px-3" data-toggle="modal" data-target="#modalLoginCandidate" type="button">Login</button>
                @endif
            </div>
        </div>
    </div>
</nav>

@section('modal')
<div class="modal fade" id="modalSignUpCandidate" tabindex="-1" aria-labelledby="modalSignUpCandidateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sign-up">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="candidate-page-subtitle mb-0">Sign Up</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>

                <form action="{{ route('post.signup') }}" id="formSignUpCandidate" class="form-candidate-view" method="POST" ajax="true">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="firstNameCandidate" id="firstNameCandidate" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-6 pl-0">
                                <input type="text" name="lastNameCandidate" id="lastNameCandidate" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="with-icon">
                            <input type="text" name="emailCandidate" id="emailCandidate" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="with-icon">
                            <input type="password" name="passwordCandidate" id="passwordCandidate" class="form-control" placeholder="Password">
                            <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon" alt="icon" style="right: 13px;">
                        </div>
                    </div>
                    <!-- <div class="form-group d-flex align-items-center justify-content-between my-4">
                        <label class="container-custom-checked mb-0"> Remember me
                            <input type="checkbox" name="Candidate" id="Candidate" value="1">
                            <span class="checkmark"></span>
                        </label>
                    </div> -->
                    <div class="form-group pt-3">
                        <button class="btn btn-red btn-block">Sign Up</button>
                    </div>
                    <div class="form-group mb-0 signup-text">
                        <p class="text-center">Do you have an account? <span>Login</span></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLoginCandidate" tabindex="-1" aria-labelledby="modalLoginCandidateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm modal-sign-up">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="candidate-page-subtitle mb-0">Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                    </button>
                </div>

                <form action="{{ route('post.login') }}" id="formLoginCandidate" class="form-candidate-view" method="POST" ajax="true">
                    <div class="form-group">
                        <div class="with-icon">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="with-icon">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon" alt="icon" style="right: 13px;">
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between my-4">
                        <label class="container-custom-checked mb-0"> Remember me
                            <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <a class="forgot-login">Forgot Password?</a>
                    </div>
                    <div class="form-group pt-3">
                        <button class="btn btn-red btn-block">Login</button>
                    </div>
                    <div class="form-group mb-0 signup-text">
                        <p class="text-center">Dont you have an account? <span>Sign Up</span></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection