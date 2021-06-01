

<ul class="nav">
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="material-icons">leaderboard</i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item @yield('webconfig')">
        <a class="nav-link" href="{{ url('/webconfig') }}">
            <i class="material-icons">business</i>
            <p>ขูอมูลอพาร์ทเม้นท์</p>
        </a>
    </li>
    <li class="nav-item @yield('user')">
        <a class="nav-link" href="{{ url('/user') }}">
            <i class="material-icons">people_alt</i>
            <p>ข้อมูลสมาชิก</p>
        </a>
    </li>
    <li class="nav-item @yield('room')">
        <a class="nav-link" href="{{ url('/room') }}">
            <i class="material-icons">meeting_room</i>
            <p>ข้อมูลห้องพัก</p>
        </a>
    </li>
    {{-- <li class="nav-item @yield('booking')">
        <a class="nav-link" href="{{ url('/booking') }}">
            <i class="material-icons">person</i>
            <p>รายการจองห้อง</p>
        </a>
    </li> --}}
    <li class="nav-item @yield('lease')">
        <a class="nav-link" href="{{ url('/lease') }}">
            <i class="material-icons">book_online</i>
            <p>รายการเช่าห้อง</p>
        </a>
    </li>
    <li class="nav-item @yield('invoice')">
        <a class="nav-link" href="{{ url('/invoice') }}">
            <i class="material-icons">description</i>
            <p>ใบแจ้งหนี้</p>
        </a>
    </li>
    <li class="nav-item @yield('maintenance')">
        <a class="nav-link" href="{{ url('/maintenance') }}">
            <i class="material-icons">build_circle</i>
            <p>ซ่อมบำรุง</p>
        </a>
    </li>
    <li class="nav-item @yield('report')">
        <a class="nav-link" href="{{ url('/report/income?report=รายงานบัญชี') }}">
            <i class="material-icons">summarize</i>
            <p>ดูรายงาน</p>
        </a>
    </li>
</ul>
