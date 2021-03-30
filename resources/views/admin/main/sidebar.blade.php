<aside class="main-sidebar mbl custom-width">
    <section class="sidebar">
        <ul class="menu-sidebar">
            <!-- user active -->
            <li class="user">
                <div class="name">
                    
                </div>
            </li>
            <!-- list menu -->
            <p class="text-title">GLOBAL</p>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('home') }}" class="menu {{($sidebar== 'dashboard'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $sidebar== 'dashboard' ? asset('image/icon/sidebar/icon_menu_home_active.svg') : asset('image/icon/sidebar/icon_menu_home.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar">Dashboard</span>
                        </div>
                    </div>
                </a>
            </li>
            <p class="text-title title-bottom">HOMEPAGE CONTENT</p>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.news.event') }}" class="menu {{($sidebar== 'manajemen_news_event'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{asset('image/icon/sidebar/icon_menu_news_event.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar">Manage News & Event</span>
                        </div>
                    </div>
                </a>
            </li>
            <p class="text-title title-bottom">RECRUITMENT</p>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.candidate') }}" class="menu {{($sidebar== 'manajemen_candidate'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $sidebar== 'manajemen_candidate' ? asset('image/icon/sidebar/icon_menu_candidate_active.svg') : asset('image/icon/sidebar/icon_menu_candidate.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar">Manage Candidate</span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.vacancy') }}" class="menu {{($sidebar== 'manajemen_vacancy'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $sidebar== 'manajemen_vacancy' ? asset('image/icon/sidebar/icon_menu_vacancy_active.svg') : asset('image/icon/sidebar/icon_menu_vacancy.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar">Manage Vacancy</span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.test') }}" class="menu {{($sidebar== 'manajemen_test'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $sidebar== 'manajemen_test' ? asset('image/icon/sidebar/icon_menu_test_active.svg') : asset('image/icon/sidebar/icon_menu_test.svg')}}" alt="" width="20px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar">Manage Test</span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.question-bank') }}" class="menu {{($sidebar== 'manajemen_question'?'active':'')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $sidebar== 'manajemen_question' ? asset('image/icon/sidebar/icon_menu_question_active.svg') : asset('image/icon/sidebar/icon_menu_question.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                        </div>
                        <div class="col-md-10">
                            <span class="font-color-sidebar">Manage Question Bank</span>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </section>
</aside>