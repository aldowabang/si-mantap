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
                    <li class="nav-item {{ (request()->is('users') || $title === 'Add User' || $title === 'View User' || $title === 'Edit User') ? 'active show' : '' }}">        <a href="{{ route('admin-show') }}" class="nav-link"><i class="typcn typcn-user"></i>Data Pengguna</a>
                    </li>
                    <li class="nav-item {{ (request()->is('proyek') || request()->is('proyek/create') || request()->is('proyek/*') || $title === 'Monitoring Proyek') ? 'active show' : '' }}">
                        <a href="{{ route('admin-proyek') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i>Proyek</a>
                    </li>
                @endif
                
                @if(auth()->user()->role === 'pengawas')
                    <li class="nav-item {{ $title === 'Proyek Pengawas' || $title === 'Detail Proyek' ? 'active show' : '' }}">
                        <a href="{{ route('pengawas-proyek') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i>Proyek</a>
                    </li>
                @endif
            </ul>
            </div><!-- az-header-menu -->
            <div class="az-header-right">
            <a href="https://www.bootstrapdash.com/demo/azia-free/docs/documentation.html" target="_blank" class="az-header-search-link"><i class="far fa-file-alt"></i></a>
            <a href="" class="az-header-search-link"><i class="fas fa-search"></i></a>
            <div class="az-header-message">
                <a href="#"><i class="typcn typcn-messages"></i></a>
            </div><!-- az-header-message -->
            <div class="dropdown az-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                <div class="az-dropdown-header mg-b-20 d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <h6 class="az-notification-title">Notifications</h6>
                <p class="az-notification-text">You have 2 unread notification</p>
                <div class="az-notification-list">
                    <div class="media new">
                    <div class="az-img-user"><img src="../img/faces/face2.jpg" alt=""></div>
                    <div class="media-body">
                        <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                        <span>Mar 15 12:32pm</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media new">
                    <div class="az-img-user online"><img src="../img/faces/face3.jpg" alt=""></div>
                    <div class="media-body">
                        <p><strong>Joyce Chua</strong> just created a new blog post</p>
                        <span>Mar 13 04:16am</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                    <div class="az-img-user"><img src="Azia/img/faces/face4.jpg" alt=""></div> 
                    <div class="media-body">
                        <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                        <span>Mar 13 02:56am</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                    <div class="az-img-user"><img src="../img/faces/face5.jpg" alt=""></div>
                    <div class="media-body">
                        <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                        <span>Mar 12 10:40pm</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                </div><!-- az-notification-list -->
                <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                </div><!-- dropdown-menu -->
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
                <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                <a href="page-signin.html" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                </div><!-- dropdown-menu -->
            </div>
            </div><!-- az-header-right -->
        </div><!-- container -->
        </div><!-- az-header -->