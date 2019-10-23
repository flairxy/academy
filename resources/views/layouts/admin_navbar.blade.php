<div class="topbar-wrap">
    <div class="topbar is-sticky">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="topbar-nav d-lg-none">
                    <li class="topbar-nav-item relative">
                        <a class="toggle-nav" href="#">
                            <div class="toggle-icon">
                                <span class="toggle-line"></span><span class="toggle-line"></span><span
                                    class="toggle-line"></span><span class="toggle-line"></span></div>
                        </a>
                    </li>
                    <!-- .topbar-nav-item -->
                </ul>
                <!-- .topbar-nav -->
                <a class="mt-2" href="#">
                    <img style="width:30%" src="{{ asset('images/logo.png') }}" alt="logo" />
                </a>
                <ul class="topbar-nav">
                    <li class="topbar-nav-item relative">
                        <span class="user-welcome d-none d-lg-inline-block">{{ Auth::user()->name }}</span><a
                            class="toggle-tigger user-thumb" href="#"><em class="ti ti-user"></em></a>
                        <div
                            class="toggle-class dropdown-content dropdown-content-right dropdown-arrow-right user-dropdown">

                            <ul class="user-links bg-dark">
                                <li>
                                    <a class="cl2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="ti ti-power-off"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- .topbar-nav-item -->
                </ul>
                <!-- .topbar-nav -->
            </div>
        </div>
        <!-- .container -->
    </div>
    <div class="navbar">
        <div class="container">
            <div class="navbar-innr">
                <ul class="navbar-menu">
                    <router-link tag="li" to="dashboard">
                        <a href="#"><em class="ikon ikon-dashboard"></em> Dashboard</a>
                    </router-link>
                    <router-link tag="li" to="categories">
                        <a href="#"><em class="ikon ikon-distribution"></em> Categories</a>
                    </router-link>
                    <router-link tag="li" to="courses">
                        <a href="#"><em class="ikon ikon-coins"></em> Courses</a>
                    </router-link>
                    <router-link tag="li" to="contents">
                        <a href="#"><em class="ikon ikon-distribution"></em> Contents</a>
                    </router-link>
                    <router-link tag="li" to="users">
                        <a href="#"><em class="ikon ikon-user"></em> Users</a>
                    </router-link>
                    <router-link tag="li" to="gallery">
                        <a href="#"><em class="fa fa-gallery"></em> Gallery</a>
                    </router-link>
                </ul>
            </div>
            <!-- .navbar-innr -->
        </div>
        <!-- .container -->
    </div>
</div>
<!-- .topbar-wrap -->
