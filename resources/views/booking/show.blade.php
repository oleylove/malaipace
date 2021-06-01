@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลการจองห้อง')
@section('lease','active')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ดูข้อมูลการจองห้อง</h4>
                        <p class="card-category">{{ 'รหัสการจอง # ' .$booking->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/booking/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        @if ($booking->status != 'ยกเลิกจอง')
                        <form method="POST" action="{{ url('/booking/'. $booking->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-fab btn-round" title="Cancel Booking" rel="tooltip"
                                onclick="return confirm('คุณแน่ใจใช่หรือไม่ที่ต้องการยกเลิกการจองนี้ ?')">
                                <i class="material-icons">delete_forever</i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
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
                <div class="row no-gutters">
                    <div class="col-md-3 mt-4 text-center">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised">
                                @if (!empty($booking->bkg_slip))
                                    @if(Storage::exists('public/'.$booking->bkg_slip))
                                        <img src="{{ url('/') }}/storage/{{ $booking->bkg_slip }}" rel="nofollow" alt="...">
                                    @else
                                        <img src="{{ asset('assets/images/lostitem.png') }}" rel="nofollow" alt="...">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/selectimage.png') }}" rel="nofollow" alt="...">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md ml-3">
                        <div class="table-responsive">

                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <th width="150px"> ตึก - ห้อง </th>
                                        <td> {{ $booking->room->building .' - '. $booking->room->number }}  </td>
                                    </tr>
                                    <tr>
                                        <th> ประเภท </th>
                                        <td> {{ $booking->room->type->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> รหัสบัตร </th>
                                        <td> {{ $booking->idcard }} </td>
                                    </tr>
                                    <tr>
                                        <th> ชื่อ-สกุล </th>
                                        <td> {{ $booking->user->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> วันจอง</th>
                                        <td> {{get_jFY($booking->created_at) }} </td>
                                    </tr>
                                    <tr>
                                        <th> วันแจ้งย้ายเข้า</th>
                                        <td> {{ get_jFY($booking->date_start) }} </td>
                                    </tr>
                                    <tr>
                                        <th> ค่าจองห้องเช่า </th>
                                        <td> {{ number_format($booking->typ_booking,2) . ' บาท' }} </td>
                                    </tr>
                                    <tr>
                                        <th> สถานะห้องปัจจุบัน </th>
                                        <td> {{ $booking->room->status }} </td>
                                    </tr>
                                    <tr>
                                        <th> สถานะการจอง </th>
                                        <td>
                                            @switch($booking->status)
                                                @case('จอง')
                                                <button type="button" title="รอตรวจสอบ" rel="tooltip"
                                                    class="btn btn-outline-primary btn-sm">รอตรวจสอบ&nbsp;
                                                    <span class="spinner-grow spinner-grow-sm"
                                                        aria-hidden="true"></span>
                                                </button>
                                                @break
                                                @case('ยืนยันจอง')
                                                <button type="button" title="รอทำสัญญา" rel="tooltip"
                                                    class="btn btn-outline-success btn-sm">รอทำสัญญา&nbsp;
                                                    <span class="spinner-grow spinner-grow-sm"
                                                        aria-hidden="true"></span>
                                                </button>
                                                @break
                                                @case('ยกเลิกจอง')
                                                    <button type="button" title="ยกเลิกแล้ว" rel="tooltip" class="btn btn-outline-secondary btn-sm">ยกเลิกแล้ว</button>
                                                    @if ($booking->room->status == "ว่าง")
                                                    <form method="POST" action="{{ url('/re-booking/'.$booking->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('PATCH') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2"
                                                            title="คืนสถานะจอง" rel="tooltip"
                                                            onclick="return confirm('คุณแน่ใจใช่หรือไม่ที่ต้องการคืนสถานะจองการจองห้องเช่านี้ ?')">
                                                            คืนสถานะจอง
                                                        </button>
                                                        <span class="spinner-grow spinner-grow-sm text-success" aria-hidden="true"></span>
                                                    </form>
                                                    @endif
                                                @break
                                                @default
                                                <button type="button" title="ERROR" rel="tooltip" class="btn btn-outline-danger btn-sm">ข้อมูลผิดพลาด</button>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            @if ($booking->status == "จอง")
                            <form method="POST" action="{{ url('/booking/'.$booking->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn btn-success ml-2"
                                    title="ยืนยันการจอง" rel="tooltip"
                                    onclick="return confirm('คุณแน่ใจใช่หรือไม่ที่ต้องการยืนยันการจองห้องเช่านี้ ?')">
                                    ยืนยันการจอง
                                </button>
                            </form>
                            <form method="POST" action="{{ url('/booking/'.$booking->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn btn-danger ml-2"
                                    title="ยกเลิกจอง" rel="tooltip"
                                    onclick="return confirm('คุณแน่ใจใช่หรือไม่ที่ต้องยกเลิกจองห้องเช่านี้ ?')">
                                    ยกเลิกจอง
                                </button>
                            </form>
                            @endif
                            @if ($booking->status == "ยืนยันจอง")
                            <a href="{{ url('/lease/create/'.$booking->id) }}" class="btn btn btn-primary ml-2" title="ทำสัญญาเช่า" rel="tooltip">ทำสัญญาเช่า</a>
                            <form method="POST" action="{{ url('/booking/'.$booking->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn btn-danger ml-2"
                                    title="ยกเลิกจอง" rel="tooltip"
                                    onclick="return confirm('คุณแน่ใจใช่หรือไม่ที่ต้องยกเลิกจองห้องเช่านี้ ?')">
                                    ยกเลิกจอง
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
