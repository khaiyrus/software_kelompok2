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

                    {{-- <li class="sidebar-item {{ request()->routeIs('kandidat.kandidat') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kandidat.kandidat') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Candidat</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('kandidat.wilayah') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kandidat.wilayah') }}">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Wilayah</span>
                        </a>
                    </li> --}}



                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('kandidat.voter') }}">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Voter</span>
                        </a>
                    </li> --}}

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-forms.html">
                            <i class="align-middle" data-feather="check-square"></i> <span
                                class="align-middle">Forms</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-cards.html">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-typography.html">
                            <i class="align-middle" data-feather="align-left"></i> <span
                                class="align-middle">Typography</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Plugins & Addons
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="charts-chartjs.html">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span
                                class="align-middle">Charts</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                        </a>
                    </li>
                </ul>


            </div>
        </nav>
