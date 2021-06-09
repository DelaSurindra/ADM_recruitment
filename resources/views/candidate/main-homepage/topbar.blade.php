<nav class="navbar navbar-expand-lg navbar-light navbar-adm">
    <div class="container">
        <div class="wrapper-mobile-nav">
            <a class="navbar-brand" href="#">
                <img src="{{asset('image/icon/navbar/logo_navbar.svg')}}" loading="lazy" alt="logo">
            </a>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <button class="navbar-toggler" type="button" id="btnDrawer">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mobile-nav-head">
                <!-- <a href="#">
                    <img src="{{asset('image/icon/navbar/logo_navbar.svg')}}" loading="lazy" alt="logo">
                </a> -->
                <button class="navbar-btn-mobile" type="button" id="btnDrawerClose">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                    </svg>
                </button>
            </div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{($topbar== 'home'?'active':'')}}">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item {{($topbar== 'job'?'active':'')}}">
                    <a class="nav-link" href="{{route('get.job.page')}}">Job List</a>
                </li>
                <li class="nav-item {{($topbar== 'news_event'?'active':'')}}">
                    <a class="nav-link" href="{{route('get.news.event.page')}}">News & Event</a>
                </li>
                <li class="nav-item {{($topbar== 'company-profile'?'active':'')}}">
                    <a class="nav-link" href="{{route('get.candidate.company-profile')}}">Company Profile</a>
                </li>
                <li class="nav-item {{($topbar== 'contact-us'?'active':'')}}">
                    <a class="nav-link" href="{{route('get.candidate.contact-us')}}">Contact Us</a>
                </li>
                <li class="nav-item {{($topbar== 'faq'?'active':'')}}">
                    <a class="nav-link" href="{{route('get.candidate.faq')}}">FAQ</a>
                </li>
            </ul>

            <div class="form-inline my-2 my-lg-0">
                @if(Session::get('session_candidate'))
                <!-- <div class="notif-dropdown dropdown">
                    <div class="notif-count" id="notifCount">99</div>
                    <div class="notif-access" id="dropdownMenuNotif" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('image/icon/homepage/icon-bell.svg') }}" alt="icon">
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuNotif">
                        <div class="dropdown-item">
                            <div class="notif-header">
                                <h6>Notification <span class="notif-count-inside">99</span></h6>
                                <a href="#">View All</a>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="dropdown-item">
                            <p class="notif-title">Notification Title</p>
                            <p class="notif-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in molestie diam ele</p>
                            <div class="notif-detail">
                                <p class="date-notif">12 Feb 2021 13:15</p>
                                <a href="#" class="link-notif">See Details</a>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item">
                            <p class="notif-title">Notification Title</p>
                            <p class="notif-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in molestie diam ele</p>
                            <div class="notif-detail">
                                <p class="date-notif">12 Feb 2021 13:15</p>
                                <a href="#" class="link-notif">See Details</a>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="profile-dropdown-mobile">
                    <button class="btn-collapse btn-block" type="button" data-toggle="collapse" data-target="#collapseProfileMobile" aria-expanded="false" aria-controls="collapseExample">
                        @if(session('session_candidate.foto_profil') == null)
                        <img class="rounded-circle img-profile" src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="avatar">
                        @else
                        <img class="rounded-circle img-profile" src="{{asset('storage/').'/'.session('session_candidate.foto_profil') }}" alt="avatar">
                        @endif
                        <p class="name-profile">{{ Session::get('session_candidate')['first_name'] }} {{ Session::get('session_candidate')['last_name'] }}</p>
                    </button>
                    <div class="collapse" id="collapseProfileMobile">
                        <div class="list-group">
                            <a href="{{ route('get.profile.view') }}" class="list-group-item list-group-item-action">
                                <img src="{{ asset('image/icon/homepage/edit-profile-icon.svg') }}" alt="icon"> Edit Profile
                            </a>
                            <a href="{{ route('get.profile.edit-password') }}" class="list-group-item list-group-item-action">
                                <img src="{{ asset('image/icon/homepage/edit-password-icon.svg') }}" alt="icon"> Edit Password
                            </a>
                            <a href="{{route('get.profile.my-app')}}" class="list-group-item list-group-item-action">
                                <img src="{{ asset('image/icon/homepage/myapp-icon.svg') }}" alt="icon"> My Application
                            </a>
                            <a href="{{ route('get.logout-candidate') }}" class="list-group-item list-group-item-action">
                                <img src="{{ asset('image/icon/homepage/logout-icon.svg') }}" alt="icon"> Logout
                            </a>
                        </div>
                    </div>
                </div>
                <div class="profile-dropdown dropdown">
                    <div class="profile-access" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(session('session_candidate.foto_profil') == null)
                        <img class="rounded-circle img-profile" src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="avatar">
                        @else
                        <img class="rounded-circle img-profile" src="{{asset('storage/').'/'.session('session_candidate.foto_profil') }}" alt="avatar">
                        @endif
                        <p class="name-profile">{{ Session::get('session_candidate')['first_name'] }} {{ Session::get('session_candidate')['last_name'] }}</p>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
                        <h6 class="dropdown-item">{{ Session::get('session_candidate')['first_name'] }} {{ Session::get('session_candidate')['last_name'] }}</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('get.profile.view') }}">
                            <img src="{{ asset('image/icon/homepage/edit-profile-icon.svg') }}" alt="icon"> Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('get.profile.edit-password') }}">
                            <img src="{{ asset('image/icon/homepage/edit-password-icon.svg') }}" alt="icon"> Edit Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('get.profile.my-app')}}">
                            <img src="{{ asset('image/icon/homepage/myapp-icon.svg') }}" alt="icon"> My Application
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item signout" href="{{ route('get.logout-candidate') }}">
                            <img src="{{ asset('image/icon/homepage/logout-icon.svg') }}" alt="icon"> Logout
                        </a>
                    </div>
                </div>
                @else
                <button class="btn btn-gray px-3 mr-3" data-toggle="modal" data-target="#modalSignUpCandidate" type="button">Sign Up</button>
                <button class="btn btn-home-color px-3" data-toggle="modal" data-target="#modalLoginCandidate" type="button">Login</button>
                @endif
            </div>
        </div>
    </div>
</nav>

@section('modal')
<div class="modal fade" id="modalSignUpCandidate" aria-labelledby="modalSignUpCandidateLabel" aria-hidden="true">
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
                            <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon thisIconEye" alt="icon" style="right: 13px;">
                        </div>
                    </div>
                    <!-- <div class="form-group d-flex align-items-center justify-content-between my-4">
                        <label class="container-custom-checked mb-0"> Remember me
                            <input type="checkbox" name="Candidate" id="Candidate" value="1">
                            <span class="checkmark"></span>
                        </label>
                    </div> -->
                    <div class="form-group pt-3">
                        <button class="btn btn-home-color btn-block">Sign Up</button>
                    </div>
                    <div class="form-group mb-0 signup-text">
                        <p class="text-center">Do you have an account? <span class="goToLogin">Login</span></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLoginCandidate" aria-labelledby="modalLoginCandidateLabel" aria-hidden="true">
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
                            <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon thisIconEye" alt="icon" style="right: 13px;">
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between my-4">
                        <label class="container-custom-checked mb-0"> Remember me
                            <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <a class="goToForget" >Forgot Password?</a>
                    </div>
                    <div class="form-group pt-3">
                        <button class="btn btn-home-color btn-block">Login</button>
                    </div>
                    <div class="form-group mb-0 signup-text">
                        <p class="text-center">Dont you have an account? <span class="goToRegister">Sign Up</span></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForgetPassword" aria-labelledby="modalForgetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm modal-sign-up">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="candidate-page-subtitle mb-0">Forget Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis m-0" alt="icon">
                    </button>
                </div>

                <form action="{{ route('post.forget') }}" id="formForgetCandidate" class="form-candidate-view" method="POST" ajax="true">
                    <div class="form-group">
                        <p>Enter email that associated to your account and we’ll send an email with instructions to reset password</p>
                    </div>
                    <div class="form-group">
                        <div class="with-icon">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group pt-3">
                        <button class="btn btn-home-color btn-block">Send Instructions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection