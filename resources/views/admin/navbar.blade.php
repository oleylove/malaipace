<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:void(0)">
                <h3>ระบบบริหารจัดการอพาร์ทเมนท์</h3>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">

            @include('admin.form-seach')

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/webconfig') }}">
                        <i class="material-icons">settings</i>
                        <p class="d-lg-none d-md-block">
                            Settings
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard') }}">
                        <i class="material-icons">leaderboard</i>
                        <p class="d-lg-none d-md-block">
                            Stats
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        @php
                        $invoice = App\Invoice::where('status','รอตรวจสอบ')->count();
                        $mtn = App\Maintenance::whereIn('status',['แจ้งซ่อม','กำลังซ่อม'])
                        ->selectRaw('status as status')
                        ->groupByRaw('status')
                        ->get();
                        $lease = App\Lease::whereIn('status',['จอง','ยืนยันจอง','แจ้งย้าย','ยืนยันแจ้งย้าย'])
                        ->selectRaw('status as status')
                        ->groupByRaw('status')
                        ->get();
                        @endphp
                        <span class="notification">
                            {{ $lease->count() + $invoice + $mtn->count() }}
                        </span>
                        <p class="d-lg-none d-md-block">
                            Some Actions
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        @if ($lease->count())
                        @foreach ($lease as $item)
                        @if ($item->status == 'จอง')
                        <a class="dropdown-item" href="{{ url('/booking?status=จอง') }}">จองห้องพัก</a>
                        @endif
                        @if ($item->status == 'ยืนยันจอง')
                        <a class="dropdown-item" href="{{ url('/booking?status=ยืนยันจอง') }}">ทำสัญญาเช่า</a>
                        @endif
                        @if ($item->status == 'แจ้งย้าย')
                        <a class="dropdown-item" href="{{ url('/lease?status=แจ้งย้าย') }}">แจ้งย้ายออก</a>
                        @endif
                        @if ($item->status == 'ยืนยันแจ้งย้าย')
                        <a class="dropdown-item" href="{{ url('/lease?status=แจ้งย้าย') }}">ทำเรื่องย้ายออก</a>
                        @endif
                        @endforeach
                        @endif
                        @if ($mtn->count())
                        @foreach ($mtn as $item)
                        @if ($item->status == 'แจ้งซ่อม')
                        <a class="dropdown-item" href="{{ url('/maintenance?status=แจ้งซ่อม') }}">แจ้งซ่อม</a>
                        @endif
                        @if ($item->status == 'กำลังซ่อม')
                        <a class="dropdown-item" href="{{ url('/maintenance?status=กำลังซ่อม') }}">กำลังซ่อม</a>
                        @endif
                        @endforeach
                        @endif
                        @if ($invoice)
                        <a class="dropdown-item" href="{{ url('/invoice?status=รอตรวจสอบ') }}">แจ้งชำระเงิน</a>
                        @endif
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            Account
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ url('/user/' .Auth::id()) }}">Profile</a>
                        <a class="dropdown-item" href="{{ url('/notice') }}">Notice</a>
                        <a class="dropdown-item" href="javascript:void(0)" id="AdminChangePassword">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Log out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@include('admin.model-change-password')
