@extends('admin.app')
@section('title','Malaiplace | ข้อมูลสมาชิก')
@section('user','active')

@section('content')
<div class="container-fluid" id="userPage">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-danger">
                <div class="row">
                    <div class="col-md">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">สถานะ : </span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == '' ? ' active' : '' }}" href="{{ url('/user') }}">
                                            <i class="material-icons">people</i> ทั้งหมด
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'สมาชิกใหม่' ? ' active' : '' }}" href="{{ url('/user?status=สมาชิกใหม่') }}">
                                            <i class="material-icons">person_pin</i>สมัครใหม่
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'สมาชิกจอง' ? ' active' : '' }}" href="{{ url('/user?status=สมาชิกจอง') }}">
                                            <i class="material-icons">recent_actors</i>จองห้อง
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'สมาชิกเช่า' ? ' active' : '' }}" href="{{ url('/user?status=สมาชิกเช่า') }}">
                                            <i class="material-icons">switch_account</i>เช่าอยู่
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'สมาชิกแจ้งย้าย' ? ' active' : '' }}" href="{{ url('/user?status=สมาชิกแจ้งย้าย') }}">
                                            <i class="material-icons">record_voice_over</i>แจ้งย้าย
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'สมาชิกออกแล้ว' ? ' active' : '' }}" href="{{ url('/user?status=สมาชิกออกแล้ว') }}">
                                            <i class="material-icons">no_accounts</i>ย้ายออก
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/user/create') }}" title="Create" rel="tooltip" class="btn btn-success btn-fab btn-round">
                            <i class="material-icons">person_add</i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    {{-- table user --}}
                    <div class="tab-pane active" id="user">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('fail') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <table class="table table-hover table-sm" id="dataTableuser">
                            <thead class=" text-info">
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th class="text-left">ชื่อ-สกุล</th>
                                    <th>อายุ</th>
                                    <th>เพศ</th>
                                    <th>เบอร์โทร</th>
                                    <th class="text-left">อีเมลล์</th>
                                    <th class="text-right pr-3">สถานะ</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $item)
                                <tr class="text-center">
                                    <td>
                                        {{ ($user->currentpage()-1) * $user->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td class="text-left">{{ $item->name }}</td>
                                    <td>{{ $item->age }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td class="text-left">{{ $item->email }}</td>
                                    <td class="text-right pr-3">
                                        @switch($item->status)
                                            @case('สมาชิกใหม่')
                                            {{ 'สมัครใหม่' }}
                                            <span class="material-icons text-warning">person_add_alt_1</span>
                                            @break
                                            @case('สมาชิกจอง')
                                            {{ 'จองห้องพัก' }}
                                            <span class="material-icons text-warning">book_online</span>
                                            @break
                                            @case('สมาชิกเช่า')
                                            {{ 'เช่าอยู่' }}
                                            <span class="material-icons text-success">account_circle</span>
                                            @break
                                            @case('สมาชิกแจ้งย้าย')
                                            {{ 'แจ้งย้าย' }}
                                            <span class="material-icons text-danger">record_voice_over</span>
                                            @break
                                            @case('สมาชิกออกแล้ว')
                                            {{ 'ย้ายออกแล้ว' }}
                                            <span class="material-icons text-default">no_accounts</span>
                                            @break
                                            @case('ผู้ดูแลหอพัก')
                                            {{ 'ผู้ดูแลหอพัก' }}
                                            <span class="material-icons text-success">admin_panel_settings</span>
                                            @break
                                            @default
                                            {{ 'ข้อมูลผิดพลาด' }}
                                            <span class="material-icons text-warning">error</span>
                                            @break
                                        @endswitch
                                    </td>

                                    <td class="td-actions justify-content-center">
                                        <a href="{{ url('/user/' . $item->id) }}" title="View" type="button"
                                            rel="tooltip" class="btn btn-info btn-round mr-2">
                                            <i class="material-icons">search</i>
                                        </a>
                                        <a href="{{ url('/user/' . $item->id . '/edit') }}" title="Edit"
                                            type="button" rel="tooltip" class="btn btn-danger btn-round">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        {{-- <form method="POST" action="{{ url('/user' . '/' . $item->id) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" rel="tooltip" title="Delete"
                                            class="btn btn-danger btn-round"
                                            onclick="return confirm(&quot;Confirm delete?&quot;)">
                                            <i class="material-icons">close</i>
                                        </button>
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper pull-right">
                            {!! request('status') != '' ? $user->appends(['status' => Request::get('status')])->render() : $user->appends(['search' => Request::get('search')])->render() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
