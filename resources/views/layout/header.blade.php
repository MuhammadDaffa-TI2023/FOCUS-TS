<div class="container-fluid">
    <div class="row justify-content-between align-items-center">

        <!-- Header Logo (Header Left) Start -->
        <div class="header-logo col-auto">
            <a href="{{route('dashboard-admin')}}">
                <img src="{{asset('assets/images/logofocus.png')}}" alt="" height="80">
                <img src="{{asset('assets/images/logofocus.png')}}" class="logo-light" alt="">
            </a>
        </div><!-- Header Logo (Header Left) End -->

        <!-- Header Right Start -->
        <div class="header-right flex-grow-1 col-auto">
            <div class="row justify-content-between align-items-center">

                <!-- Side Header Toggle & Search Start -->
                <div class="col-auto">
                    <div class="row align-items-center">

                        <!--Side Header Toggle-->
                        <div class="col-auto"><button class="side-header-toggle text-white"><i class="zmdi zmdi-menu"></i></button></div>
                    </div>
                </div><!-- Side Header Toggle & Search End -->

                <!-- Header Notifications Area Start -->
                <div class="col-auto">
                    <ul class="header-notification-area">
                        <!--User-->
                        <li class="adomx-dropdown col-auto">
                            <a class="toggle" href="#">
                                <h3 class="name">{{ Auth::user()->name }}</h3>
                            </a>

                            <!-- Dropdown -->
                            <div class="adomx-dropdown-menu dropdown-menu-user">
                                <div class="head">
                                    <h5 class="name"><a href="#">{{ Auth::user()->name }}</a></h5>
                                </div>
                                <div class="body">
                                    <ul>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <a :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- Header Notifications Area End -->
            </div>
        </div><!-- Header Right End -->

    </div>
</div>
{{-- @php
$mahasiswa = $mahasiswa ?? null; // Ambil mahasiswa pertama dari koleksi
@endphp --}}

