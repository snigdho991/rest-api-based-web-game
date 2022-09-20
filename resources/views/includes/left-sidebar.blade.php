<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
        @if(Auth::check())
            <ul class="metismenu list-unstyled" id="side-menu">

                @if(Auth::user()->role == 'Administrator')
                    <li class="menu-title" key="t-menu">Dashboard Stuff</li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-calendar">Dashboard</span>
                            </a>
                        </li>
                
                    <li class="menu-title" key="t-apps">Administrator Tools</li>
                        <li>
                            <a href="{{ route('all.families') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Manage All Families</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('api.url') }}" class="waves-effect">
                                <i class="bx bx-aperture"></i>
                                <span key="t-calendar">Set API Url</span>
                            </a>
                        </li>

                @elseif(Auth::user()->role == 'Local Administrator')
                    <?php
                        $find_family = \App\Models\FamilyAdmin::where('user_id', Auth::id())->first();
                    ?>
                    <li class="menu-title" key="t-menu">Dashboard Stuff</li>
                        <li>
                            <a href="{{ route('family.admin.dashboard') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-calendar">Dashboard</span>
                            </a>
                        </li>
                
                    <li class="menu-title" key="t-apps">Local Admin Tools</li>
                        <li>
                            <a href="{{ route('my.family', $find_family->family_name) }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Manage My Family</span>
                            </a>
                        </li>
                @else

                    <?php
                        $find_player = \App\Models\Player::where('user_id', Auth::id())->first();
                    ?>

                    <li class="menu-title" key="t-menu">Dashboard Stuff</li>
                        <li>
                            <a href="{{ route('user.dashboard') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-calendar">Dashboard</span>
                            </a>
                        </li>

                    <li class="menu-title" key="t-apps">User Tools</li>
                        <li>
                            <a href="{{ route('user.details', ['family' => $find_player->family_name, 'player' => $find_player->player_name]) }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Manage My Details</span>
                            </a>
                        </li>

                @endif

                <li class="menu-title" key="t-menu">Options</li>
                    <li>
                        <a href="{{ url('/user/profile') }}" class="waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-calendar">Profile Settings</span>
                        </a>
                    </li>


                    {{-- <li class="menu-title" key="t-apps">Customer Tools</li>
                        <li>
                            <a href="" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Customer List</span>
                            </a>
                        </li>

                        <li>
                            <a href="" class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-calendar">Add Customer</span>
                            </a>
                        </li>
                
                    <li class="menu-title" key="t-apps">History Stuffs</li>
                        <li>
                            <a href="" class="waves-effect">
                                <i class="mdi mdi-calendar-weekend"></i>
                                <span key="t-calendar">This Week</span>
                            </a>
                        </li>
                    
                        <li>
                            <a href="" class="waves-effect">
                                <i class="mdi mdi-clock-start"></i>
                                <span key="t-calendar">This Month</span>
                            </a>
                        </li>

                        <li>
                            <a href="" class="waves-effect">
                                <i class="mdi mdi-table-clock"></i>
                                <span key="t-calendar">This Year</span>
                            </a>
                        </li>

                        <li>
                            <a href="" class="waves-effect">
                                <i class="bx bx-aperture"></i>
                                <span key="t-calendar">Advanced Search</span>
                            </a>
                        </li> --}}
            </ul>
            
        @endif
        </div>
        <!-- Sidebar -->
    </div>
    
</div>