@extends('admin.app')
@section('title','Malaiplace | ข้อมูลการจองห้อง')
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
                                        <h4 class="card-title ">ตารางข้อมูลจองห้อง</h4>
                                        <p class="card-category">{{ 'ทั้งหมด ' .$bookingCount.' รายการ' }}</p>
                                    </div>
                                    <div class="col-md d-flex justify-content-end align-items-center">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <span class="nav-tabs-title">สถานะ : </span>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == '' ? ' active' : '' }}"
                                                    href="{{ url('/booking') }}">
                                                    <i class="material-icons">collections_bookmark</i>ทั้งหมด
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'จอง' ? ' active' : '' }}"
                                                    href="{{ url('/booking?status=จอง') }}">
                                                    <i class="material-icons">hourglass_top</i>รอตรวจสอบ
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'ยืนยันจอง' ? ' active' : '' }}"
                                                    href="{{ url('/booking?status=ยืนยันจอง') }}">
                                                    <i class="material-icons">thumb_up_alt</i>ยืนยันแล้ว
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'ยกเลิกจอง' ? ' active' : '' }}"
                                                    href="{{ url('/booking?status=ยกเลิกจอง') }}">
                                                    <i class="material-icons">do_not_disturb_off</i>ยกเลิกจอง
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

                    <table class="table table-hover table-sm" id="dataTableBooking">
                        <thead class="text-info">
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>ห้อง</th>
                                    <th>ตึก</th>
                                    <th>รหัสบัตร</th>
                                    <th class="text-left">ชื่อ-สกุล</th>
                                    <th class="text-left">วันจอง</th>
                                    <th class="text-left">วันย้ายเข้า</th>
                                    <th>สถานะ</th>
                                    <th>สลิป</th>
                                    <th>ดูข้อมูล</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach($booking as $item)
                            <tr class="text-center">
                                <td>
                                    {{ ($booking->currentpage()-1) * $booking->perpage() + $loop->index + 1 }}
                                </td>
                                <td>{{ $item->room->number }}</td>
                                <td>{{ $item->room->building }}</td>
                                <td>{{ $item->idcard }}</td>
                                <td class="text-left">{{ $item->user->name }}</td>
                                <td class="text-left">{{ get_jFY($item->created_at) }}</td>
                                <td class="text-left">{{ get_jFY($item->date_start) }}</td>
                                <td>
                                    @switch($item->status)
                                    @case('จอง')
                                    <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm btn-round"
                                        id="photoBooking" data-img="{{ $item->bkg_slip }}"
                                        data-status="{{ $item->status }}" data-id="{{ $item->id }}"
                                        data-title="{{ ' ห้อง '.$item->room->number . ' ตึก ' .$item->room->building  }}">
                                        รอตรวจสอบ&nbsp;
                                    </a>
                                    @break
                                    @case('ยืนยันจอง')
                                    <a href="{{ url('/lease/create/'.$item->id) }}"
                                        class="btn btn-outline-success btn-sm btn-round">
                                        รอทำสัญญา&nbsp;
                                    </a>
                                    @break
                                    @case('ยกเลิกจอง')
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-round">
                                        ยกเลิกแล้ว
                                    </button>
                                    @break
                                    @default
                                    <button type="button"
                                        class="btn btn-outline-danger btn-sm btn-round">ข้อมูลผิดพลาด</button>
                                    @break
                                    @endswitch
                                </td>
                                <td>
                                    @if (!empty($item->bkg_slip))
                                    @if(Storage::exists('public/'.$item->bkg_slip))
                                        <a href="javascript:void(0)" id="photoBooking" data-img="{{ $item->bkg_slip }}"
                                            data-status="{{ $item->status }}" data-id="{{ $item->id }}"
                                            data-title="หลักฐานการโอนเงินจอง{{ ' ห้อง '.$item->room->number . ' ตึก ' .$item->room->building  }}">
                                            <img src="{{ url('/') }}/storage/{{ $item->bkg_slip }}" width="40px"
                                                height="35px" class="rounded-lg">
                                        </a>
                                        @else
                                            <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                    @endif
                                </td>
                                <td class="td-actions text-center">
                                    <a href="{{ url('/booking/' . $item->id) }}" title="View" type="button" rel="tooltip"
                                        class="btn btn-info btn-round mr-2">
                                        <i class="material-icons">search</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper pr-3">
                        {!! $booking->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.model-show-booking')
@endsection
