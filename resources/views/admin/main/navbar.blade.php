<header class="main-header">
    <div class="toggel-btn mbl" id="btn-mobile">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
    <div class="logo mbl bg-logo">
        <div class="row">
            <div class="col-md-12 col-7">
                <a href="{{route('home')}}" id="logo">
                    <img src="{{asset('image/icon/navbar/logo_navbar.svg')}}" class="logo-sidebar">
                </a>
            </div>
            <!-- <div class="col-md-3 col-5">
                <a href="#" id="menu-toggle">
                    <img class="img-custom-navbar" src="{{asset('image/icon/navbar/hamburger_menu.svg')}}">
                </a>
            </div> -->
        </div>
    </div>
    <div class="navbar-top">
        @if(isset($breadcrumb))
            <div class="breadcrumb-nav">
                <a class="bread active" href="{{$breadcrumb['route']}}">{{$breadcrumb['page']}}</a>
                <p class="bread">&nbsp/ {{$breadcrumb['detail']}}</p>
            </div>
        @else
            <div class="navbar-title">
                <p>Welcome Back, <strong>{{session('session_id.first_name')}} {{session('session_id.last_name')}}</strong></p>
            </div>
        @endif
        <div class="search">
            <!-- <div class="dropdown custom-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('image/icon/navbar/icon_setting.svg')}}"></a>
                <div class="dropdown-menu custom-dropdown-menu">
                    <a href="#" class="dropdown-item"><img src="{{asset('image/icon/navbar/icon_change_password.svg')}}" style="margin-right: 20px;">Change Password</a>
                    <a href="{{route('get.logout')}}" class="dropdown-item margin-right-20"><img src="{{asset('image/icon/navbar/icon_logout.svg')}}" style="margin-right: 20px;">Logout</a>
                </div>
            </div> -->
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
            <div class="profile-dropdown-hr dropdown">
                <div class="profile-access" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle img-profile" src="{{ asset('image/icon/homepage/dummy-profile.svg') }}" alt="avatar">
                    <p class="name-profile">{{session('session_id.first_name')}} {{session('session_id.last_name')}}</p>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
                    <h6 class="dropdown-item">{{session('session_id.first_name')}} {{session('session_id.last_name')}}</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('get.change-password')}}">
                        <img src="{{ asset('image/icon/homepage/edit-password-icon.svg') }}" alt="icon"> Edit Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item signout" href="{{route('get.logout')}}">
                        <img src="{{ asset('image/icon/homepage/logout-icon.svg') }}" alt="icon"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>