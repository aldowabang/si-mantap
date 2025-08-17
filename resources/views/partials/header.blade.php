        <div class="az-header">
        <div class="container">
            <div class="az-header-left">
            <a href="index.html" class="az-logo"><span>Si Mantap</span></a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
            </div><!-- az-header-left -->
            <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="index.html" class="az-logo"><span></span> SI MANTAP</a>
                <a href="" class="close">&times;</a>
            </div><!-- az-header-menu-header -->
            <ul class="nav">
                <li class="nav-item {{ (request()->is('dashboard-admin') || request()->is('dashboard-tender') || request()->is('dashboard-pengawas')) ? 'active show' : '' }}">
                    <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('dashboard-admin') }}
                    @elseif(auth()->user()->role === 'tender')
                        {{ route('dashboard-tender') }}
                    @elseif(auth()->user()->role === 'pengawas')
                        {{ route('dashboard-pengawas') }}
                    @endif
                    " class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item {{ (request()->is('users') || $title === 'Add User' || $title === 'View User' || $title === 'Edit User') ? 'active show' : '' }}"><a href="{{ route('admin-show') }}" class="nav-link"><i class="typcn typcn-user"></i>Data Pengguna</a>
                    </li>
                    <li class="nav-item {{ (request()->is('proyek') || request()->is('proyek/create') || request()->is('proyek/*') || $title === 'Monitoring Proyek' || $title === 'Cek Dokumen Monitoring') ? 'active show' : '' }}">
                        <a href="{{ route('admin-proyek') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i>Proyek</a>
                    </li>
                @endif
                
                @if(auth()->user()->role === 'pengawas')
                    <li class="nav-item {{ $title === 'Proyek Pengawas' || $title === 'Detail Proyek' || $title === 'Cek Dokumen Monitoring' || $title === 'Tambah Dokument Pengawas' || $title === 'Edit Dokument Pengawas' || $title === 'Tambah Tahap' ? 'active show' : '' }}">
                        <a href="{{ route('pengawas-proyek') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i>Proyek</a>
                    </li>
                @endif

                @if(auth()->user()->role === 'tender')
                    <li class="nav-item {{ $title === 'Proyek Tender' || $title === 'Detail Proyek Tender' || $title === 'Monitoring Proyek Tender' || $title === 'Cek Dokumen Monitoring Tender' ? 'active show' : '' }}">
                        <a href="{{ route('tender-proyek') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i>Proyek</a>
                    </li>
                @endif
            </ul>
            </div><!-- az-header-menu -->
            <div class="az-header-right">
            
            </div><!-- az-header-notification -->
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="Azia/img/faces/face1.jpg" alt=""></a>
                <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                    <div class="az-img-user">
                    <img src="Azia/img/faces/face1.jpg" alt="">
                    </div><!-- az-img-user -->
                    <h6>{{ auth()->user()->name }}</h6>
                    <span>{{ auth()->user()->role }}</span>
                </div><!-- az-header-profile -->

                <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <form method="POST" class="logout-form" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</button>
                </form>
                </div><!-- dropdown-menu -->
            </div>
            </div><!-- az-header-right -->
        </div><!-- container -->
        </div><!-- az-header -->