<div class="container">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
    </button>

    @guest
    <a class="navbar-brand text-brand" href="{{ url('/') }}">
        Malaiplace
        <span class="color-b">
            Apartment
        </span>
    </a>
    @else
    <a class="navbar-brand text-brand" href="{{ url('apartment') }}">
        Malaiplace
        <span class="color-b">
            Apartment
        </span>
    </a>
    @endguest

    <div class="navbar-collapse collapse" id="navbarDefault">
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link @yield('Home')" href="{{ url('/') }}">
                        {{ 'หน้าแรก' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('Booking')" href="{{ url('type-grid') }}">
                        {{ 'ดูห้องว่าง' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-toggle-box-collapse @yield('Login')" type="button" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
                        {{ 'เข้าสู่ระบบ' }}
                    </a>

                </li>

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link @yield('Register')" href="{{ route('register') }}">
                        {{ 'ลงทะเบียน' }}
                    </a>
                </li>
                @endif

            @else
                <li class="nav-item">
                    <a class="nav-link @yield('Home')" href="{{ url('apartment') }}">
                        {{ 'หน้าแรก' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('Booking')" href="{{ route('type.grid') }}">
                        {{ 'ดูห้องว่าง' }}
                    </a>
                </li>

                @if(Auth::user()->status == 'สมาชิกจอง')
                <li class="nav-item">
                    <a class="nav-link @yield('Status')" href="{{ url('status-booking') }}">
                        {{ 'สถานะจอง' }}
                    </a>
                </li>

                @elseif(Auth::user()->status == 'สมาชิกเช่า')
                <li class="nav-item">
                    <a class="nav-link @yield('Profile')" href="{{ url('user-profile') }}">
                        {{ 'โปรไฟล์' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('Invoice')" href="{{ url('user-invoice') }}">
                        {{ 'ใบแจ้งหนี้' }}
                    </a>
                </li>

                @elseif(Auth::user()->status == 'สมาชิกแจ้งย้าย')
                <li class="nav-item">
                    <a class="nav-link @yield('Profile')" href="{{ url('user-profile') }}">
                        {{ 'โปรไฟล์' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('Invoice')" href="{{ url('user-invoice') }}">
                        {{ 'ใบแจ้งหนี้' }}
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link Dasboard" href="{{ route('dashboard') }}">
                        {{ 'Dasboard' }}
                    </a>
                </li>
                @endif

                <li class="nav-item dropdown @yield('User')">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @switch(Auth::user()->status)
                            @case('สมาชิกเช่า')
                                <a class="dropdown-item" href="{{ url('user-maintenance') }}">
                                    {{ 'แจ้งซ่อมบำรุง' }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#userCheckpot">
                                    {{ 'แจ้งย้ายออก' }}
                                </a>
                            @break
                            @case('สมาชิกแจ้งย้าย')
                                <a class="dropdown-item" href="{{ url('user-maintenance') }}">
                                    {{ 'แจ้งซ่อมบำรุง' }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#userCheckpot">
                                    {{ 'แจ้งย้ายออก' }}
                                </a>
                            @break
                            @default
                        @endswitch
                        <a class="dropdown-item text-danger" href="javascript:void(0)" id="UserChangePassword">
                            {{ 'เปลี่ยนรหัสผ่าน' }}
                        </a>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ 'Logout' }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    @if (Auth::user()->role == 'admin')
                    <a class="nav-link" href="{{ url('notice') }}">
                        <i class="far fa-bell"></i>
                    </a>
                    @elseif(Auth::user()->role == 'guest')
                    <a class="nav-link @yield('Notice')" href="{{ url('user-notices') }}">
                        <i class="far fa-bell"></i>
                    </a>
                    @endif
                </li>
            @endguest
        </ul>
    </div>
</div>
