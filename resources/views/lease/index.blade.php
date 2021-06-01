@extends('admin.app')
@section('title','Malaiplace | ข้อมูลเช่า')
@section('lease','active')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-danger">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-title ">ตารางข้อมูลเช่าห้องพัก</h4>
                                        <p class="card-category">{{ 'ทั้งหมด ' .$leaseCount.' รายการ' }}</p>
                                    </div>
                                    <div class="col-md d-flex justify-content-end align-items-center">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <span class="nav-tabs-title">สถานะ : </span>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'เช่าอยู่' ? ' active' : '' }}"
                                                    href="{{ url('/lease?status=เช่าอยู่') }}">
                                                    <i class="material-icons">switch_account</i>เช่าอยู่
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'แจ้งย้าย' ? ' active' : '' }}"
                                                    href="{{ url('/lease?status=แจ้งย้าย') }}">
                                                    <i class="material-icons">record_voice_over</i>แจ้งย้าย
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'ย้ายออก' ? ' active' : '' }}"
                                                    href="{{ url('/lease?status=ย้ายออก') }}">
                                                    <i class="material-icons">do_not_disturb_off</i>ย้ายออก
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
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

                    <table class="table table-hover table-sm" id="dataTableLease">
                        <thead class="text-info">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>ตึก - ห้อง</th>
                                <th class="text-left">ชื่อ-สกุล ผู้เช่า</th>
                                <th>เบอร์โทร</th>
                                <th class="text-left">วันทำสัญญา</th>
                                <th class="text-left">วันครบสัญญา</th>
                                <th class="text-right">สถานะเช่า</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lease as $item)
                            <tr class="text-center">
                                <td>{{ ($lease->currentpage()-1) * $lease->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $item->room->building. ' - ' .$item->room->number }}</td>
                                <td class="text-left">{{ $item->user->name }}</td>
                                <td>{{ $item->user->phone }}</td>
                                <td class="text-left">{{ get_jFY($item->date_start) }}</td>
                                <td class="text-left">{{ get_jFY($item->date_end) }}</td>
                                <td class="text-right">
                                    {{ $item->status }}
                                    {{-- เช่าอยู่
                                    แจ้งย้าย
                                    ยืนยันแจ้งย้าย
                                    ย้ายออก --}}
                                    @switch($item->status)
                                    @case('เช่าอยู่')
                                    <span class="material-icons text-success">account_circle</span>
                                    @break
                                    @case('แจ้งย้าย')
                                    <span class="material-icons text-danger">record_voice_over</span>
                                    @break
                                    @case('ยืนยันแจ้งย้าย')
                                    <span class="material-icons text-primary">check_circle</span>
                                    @break
                                    @case('ย้ายออก')
                                    <span class="material-icons text-default">no_accounts</span>
                                    @break
                                    @default
                                    <span class="material-icons text-warning">error</span>
                                    @break
                                @endswitch

                                </td>
                                </td>
                                <td class="td-actions justify-content-center">
                                    <a href="{{ url('/lease/' . $item->id) }}" title="View" type="button" rel="tooltip"
                                        class="btn btn-info btn-round mr-2">
                                        <i class="material-icons">search</i>
                                    </a>
                                    <a href="{{ url('/lease/' . $item->id . '/edit') }}" title="Edit" type="button"
                                        rel="tooltip" class="btn btn-danger btn-round">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper pull-right">
                        {!! $lease->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
