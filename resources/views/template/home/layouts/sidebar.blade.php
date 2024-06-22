<div class="nk-sidebar position-fixed">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>

            </li>

            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa-regular fa-file"></i><span class="nav-text">Applications</span>
                </a>
                <ul aria-expanded="false">
                    @if(auth()->user()->role == 'admin')
                    <li><a href="{{ route('ad-account-application') }}" aria-expanded="false">
                        New
                    </a></li> 
                    @endif
                    
                    @if(auth()->user()->role == 'customer')
                        <li><a href="{{ route('adaccount.adaccount', auth()->user()->id) }}" aria-expanded="false">
                            New
                        </a></li>
                        @endif
                    <li><a href="{{ route('ad-account.index') }}">All Applications</a></li>
                    <li><a href="{{ route('pending-ad-account-application') }}">Pending</a></li>
                    <li><a href="{{ route('approved-ad-account-application') }}">Approved</a></li>

                </ul>
            </li>

            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Accounts</span>
                </a>
                <ul aria-expanded="false">
                    @if(auth()->user()->role == 'customer')
                    <li><a href="{{ route('my-account.index') }}">My Account</a></li>
                    @elseif (auth()->user()->role == 'admin')
                    <li><a href="{{ route('my-account.index') }}">All Account</a></li>
                    @endif
                </ul>
            </li>

            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-fill"></i><span class="nav-text">Refill</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('refill-application') }}" aria-expanded="false">
                            New
                        </a></li>
                    <li><a href="{{ route('refills.index') }}">All</a></li>
                    <li><a href="{{ route('refills.pending') }}">Pending</a></li>

                </ul>
            </li>
            @if (auth()->user()->role == 'admin')
                <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-building"></i><span class="nav-text">Agencies</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('add-agency') }}" aria-expanded="false">
                                New
                            </a></li>
                        <li><a href="{{ route('all-agency') }}">All</a></li>

                    </ul>
                </li>
            @endif

            @if (auth()->user()->role == 'admin')
                <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-solid fa-user-tie"></i><span class="nav-text">Admins</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('register.admin') }}" aria-expanded="false">
                                New
                            </a></li>
                        <li><a href="{{ route('user.admin') }}">All</a></li>

                    </ul>
                </li>
            @endif

            @if (auth()->user()->role == 'admin')
                <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-user"></i><span class="nav-text">Managers</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('register.manager') }}" aria-expanded="false">
                                New
                            </a></li>
                        <li><a href="{{ route('user.manager') }}">All</a></li>

                    </ul>
                </li>
            @endif



            @if (auth()->user()->role == 'admin')
                <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-solid fa-users"></i></i><span class="nav-text">Clients</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('register') }}" aria-expanded="false">
                                New
                            </a></li>
                        <li><a href="{{ route('user.client') }}">All</a></li>

                    </ul>
                </li>
            @endif




            @if (auth()->user()->role == 'admin')
                <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-money"></i></i><span class="nav-text">Deposit</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('deposit.create') }}" aria-expanded="false">
                                New
                            </a></li>
                        <li><a href="{{ route('deposits.index') }}">All</a></li>
                        <li><a href="{{ route('averageUsdRate') }}">Monthly Avarage USD Rate</a></li>

                    </ul>
                </li>
            @endif


            @if (auth()->user()->role == 'admin')
                <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-solid fa-chart-simple"></i><span class="nav-text">Report</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a aria-expanded="false">
                                Monthly Report
                            </a>
                        </li>

                    </ul>
                </li>
            @endif

            @if (auth()->user()->role == 'admin')
            <li>
                <a href="{{ route('settings') }}" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i><span class="nav-text">Settings</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
</div>
