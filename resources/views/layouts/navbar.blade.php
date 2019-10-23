<div class="topbar-wrap">
    <div class="topbar is-sticky">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- .topbar-nav -->
                <a class="mt-2" href="/">
                    <img style="width:30%" src="{{ asset('images/logo.png') }}" srcset=" images/logo-light2x.png 2x"
                        alt="logo" />
                </a>
                @guest

                @else
                <ul class="topbar-nav">
                    <li class="topbar-nav-item relative">
                        <span class="user-welcome d-none d-lg-inline-block">{{ Auth::user()->name }}</span><a
                            class="toggle-tigger user-thumb" href="#"><em class="ti ti-user"></em></a>
                        <div
                            class="toggle-class dropdown-content dropdown-content-right dropdown-arrow-right user-dropdown">

                            <ul class="user-links bg-dark">
                                <router-link tag="li" to="/my/profile">
                                    <a class="cl2" href="#"><i class="ti ti-id-badge"></i>Profile</a>
                                </router-link>
                                <router-link tag="li" to="/my/courses">
                                    <a class="cl2" href="#"><i class="ti ti-book"></i>Courses</a>
                                </router-link>
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
                @endguest
            </div>
        </div>
        <!-- .container -->
    </div>
    <!-- .topbar -->
</div>
<!-- .topbar-wrap -->
