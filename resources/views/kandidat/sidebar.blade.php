<nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('home') }}">
                    <span class="align-middle">Vote</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Home
                    </li>

                    <li class="sidebar-item  {{ request()->routeIs('kandidat.dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kandidat.dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Information                    </li>
                    <li class="sidebar-item {{ request()->routeIs('kandidat.profile') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kandidat.profile') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                        </a>
                    </li>
            </div>
        </nav>
