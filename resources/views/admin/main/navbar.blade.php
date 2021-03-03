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
                <p>Welcome Back, <strong>Sahadi</strong></p>
            </div>
        @endif
        <div class="search">
            <div class="dropdown custom-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('image/icon/navbar/icon_setting.svg')}}"></a>
                <div class="dropdown-menu custom-dropdown-menu">
                    <a href="#" class="dropdown-item"><img src="{{asset('image/icon/navbar/icon_change_password.svg')}}" style="margin-right: 20px;">Change Password</a>
                    <a href="{{route('get.logout')}}" class="dropdown-item margin-right-20"><img src="{{asset('image/icon/navbar/icon_logout.svg')}}" style="margin-right: 20px;">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>