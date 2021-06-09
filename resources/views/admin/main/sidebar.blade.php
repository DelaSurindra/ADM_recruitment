<aside class="main-sidebar mbl custom-width" id="sidebarUtama">
    <section class="section-logo-mobile">
        <a href="{{route('home')}}">
            <img src="{{asset('image/icon/navbar/logo_navbar.svg')}}" class="logo-sidebar">
        </a>
        <button class="navbar-btn-mobile" type="button" id="btn-mobile-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
            </svg>
        </button>
    </section>
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
                <a href="{{ route('home.admin') }}" class="menu {{($sidebar== 'dashboard'?'active':'')}} ">
                    <img src="{{ $sidebar== 'dashboard' ? asset('image/icon/sidebar/icon_menu_home_active.svg') : asset('image/icon/sidebar/icon_menu_home.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Dashboard</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.report') }}" class="menu {{($sidebar== 'manajemen_report'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_report' ? asset('image/icon/sidebar/icon_menu_report_active.svg') : asset('image/icon/sidebar/icon_menu_report.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Report</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.user') }}" class="menu {{($sidebar== 'manajemen_user'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_user' ? asset('image/icon/sidebar/icon_menu_user_active.svg') : asset('image/icon/sidebar/icon_menu_user.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage User/Role</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.master') }}" class="menu {{($sidebar== 'manajemen_master'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_master' ? asset('image/icon/sidebar/icon_menu_master_active.svg') : asset('image/icon/sidebar/icon_menu_master.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Data Master</span>
                </a>
            </li>
            <p class="text-title title-bottom">HOMEPAGE CONTENT</p>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.homepage') }}" class="menu {{($sidebar== 'manajemen_homepage'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_homepage' ? asset('image/icon/sidebar/icon_menu_homepage_active.svg') : asset('image/icon/sidebar/icon_menu_homepage.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Homepage</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.news.event') }}" class="menu {{($sidebar== 'manajemen_news_event'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_news_event' ? asset('image/icon/sidebar/icon_menu_news_event_active.svg') : asset('image/icon/sidebar/icon_menu_news_event.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage News & Event</span>
                </a>
            </li>
            <p class="text-title title-bottom">RECRUITMENT</p>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.candidate') }}" class="menu {{($sidebar== 'manajemen_candidate'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_candidate' ? asset('image/icon/sidebar/icon_menu_candidate_active.svg') : asset('image/icon/sidebar/icon_menu_candidate.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Candidate</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.job') }}" class="menu {{($sidebar== 'manajemen_job'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_job' ? asset('image/icon/sidebar/icon_menu_job_active.svg') : asset('image/icon/sidebar/icon_menu_job.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Job Application</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.vacancy') }}" class="menu {{($sidebar== 'manajemen_vacancy'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_vacancy' ? asset('image/icon/sidebar/icon_menu_vacancy_active.svg') : asset('image/icon/sidebar/icon_menu_vacancy.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Vacancy</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.test') }}" class="menu {{($sidebar== 'manajemen_test'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_test' ? asset('image/icon/sidebar/icon_menu_test_active.svg') : asset('image/icon/sidebar/icon_menu_test.svg')}}" alt="" width="20px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Test</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.question-bank') }}" class="menu {{($sidebar== 'manajemen_question'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_question' ? asset('image/icon/sidebar/icon_menu_question_active.svg') : asset('image/icon/sidebar/icon_menu_question.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Question Bank</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('get.interview') }}" class="menu {{($sidebar== 'manajemen_interview'?'active':'')}} ">
                    <img src="{{ $sidebar== 'manajemen_interview' ? asset('image/icon/sidebar/icon_menu_interview_active.svg') : asset('image/icon/sidebar/icon_menu_interview.svg')}}" alt="" width="25px" class="right-icon-sidebar icon-sidebar-mobile">
                    <span class="font-color-sidebar">Manage Interview</span>
                </a>
            </li>
        </ul>
    </section>
</aside>