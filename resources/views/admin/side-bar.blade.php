<nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('home') }}">
                    <span class="align-middle">Vote</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item  {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.user') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.kandidat') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.kandidat') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Candidat</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Vote & Voting
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.voter') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.voter') }}">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Voter</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.wilayah') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.wilayah') }}">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Wilayah</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.voting') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.voting') }}">
                            <i class="align-middle" data-feather="bookmark"></i> <span
                                class="align-middle">Forms</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.galery') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.galery') }}">
                            <i class="align-middle" data-feather="bookmark"></i> <span
                                class="align-middle">Forms</span>
                        </a>
                    </li>
            </div>
        </nav>
