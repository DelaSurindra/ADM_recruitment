<aside class="main-sidebar mbl custom-width menu-va">
    <section class="sidebar">
        <ul class="menu-sidebar">
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="{{ route('home') }}" class="menu {{($sidebar== 'dashboard'?'active':'')}}">
                    <div class="menu-icon">
                        <img src="{{asset('image\main\icon\sidebar\dashboard.png')}}">
                    </div>
                    <span class="menu-name">Dashboard</span>
                </a>
            </li>
            <li class="tree-menu custom-height-menu-sidebar">
                <a href="#" class="menu {{($sidebar== 'manajemen_upgrade_account'?'active':'')}}">
                    <div class="menu-icon">
                        <img src="{{asset('image\main\icon\sidebar\credit.png')}}">
                    </div>
                    <span class="menu-name">Manajemen upgrade account</span>
                </a>
            </li>

            
        </ul>
    </section>
</aside>
