<aside class="main-sidebar mbl custom-width">
    <section class="sidebar">
        <ul class="menu-sidebar">
            <!-- user active -->
            <li class="user">
                <div class="name">
                    
                </div>
            </li>
            <!-- list menu -->
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('home') }}" class="menu {{($sidebar== 'dashboard'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{asset('image/icon/sidebar/icon_menu_home.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar"><strong>Manajemen Homepage</strong></span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.news.event') }}" class="menu {{($sidebar== 'manajemen_news_event'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{asset('image/icon/sidebar/icon_menu_news_event.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar"><strong>Manajemen News/Event</strong></span>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </section>
</aside>