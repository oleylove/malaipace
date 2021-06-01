@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลซ่อมบำรุง')
@section('maintenance','active')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ดูข้อมูลซ่อมบำรุง</h4>
                        <p class="card-category">{{ 'รหัสซ่อมบำรุง # ' .$maintenance->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/maintenance/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        <a href="{{ url('/maintenance/' . $maintenance->id . '/edit') }}" title="Edit" rel="tooltip"
                            class="btn btn-danger btn-fab btn-round">
                            <i class="material-icons">edit</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md ml-3">
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

                        <table class="table table-hover table-sm" id="dataTableMaintenance">
                            <tbody>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                                @if (isset($maintenance->rm_id))
                                <tr>
                                    <th> ห้อง </th>
                                    <td> {{ isset($maintenance->rm_id) ? $maintenance->room->number : '' }} </td>
                                </tr>
                                <tr>
                                    <th> ตึก</th>
                                    <td> {{ isset($maintenance->rm_id) ? $maintenance->room->building : '' }} </td>
                                </tr>
                                @endif
                                <tr>
                                    <th width="150px"> วันที่แจ้งซ่อม </th>
                                    <td> {{ get_dateTime($maintenance->date) }} </td>
                                </tr>
                                <tr>
                                    <th> วันที่พร้อมให้ซ่อม </th>
                                    <td> {{ get_dateTime($maintenance->ready_date) }} </td>
                                </tr>
                                <tr>
                                    <th> วันซ่อมเสร็จ </th>
                                    <td> {{ isset($maintenance->date_done) ? get_dateTime($maintenance->date_done) : '' }}</td>
                                </tr>
                                <tr>
                                    <th> รายละเอียดการซ่อม </th>
                                    <td> {{ $maintenance->detail }} </td>
                                </tr>
                                <tr>
                                    <th> ค่าซ่อม </th>
                                    <td> {{ number_format($maintenance->price,2) }} บาท</td>
                                </tr>
                                <tr>
                                    <th> สถานะซ่อม </th>
                                    <td class="td-actions justify-content-center">
                                        @switch($maintenance->status)
                                        @case('แจ้งซ่อม')
                                        {{ $maintenance->status }}
                                        <form method="POST" action="{{ url('/maintenance/'.$maintenance->id) }}"
                                            accept-charset="UTF-8" class="form-horizontal d-inline"
                                            enctype="multipart/form-data">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <input class="d-none" name="status" type="hidden" id="status"
                                                value="กำลังซ่อม">
                                            <input class="d-none" name="Get_Notified" type="hidden" id="Get_Notified" value="รับแจ้ง">
                                            <button type="submit" class="btn btn-outline-success btn-round ml-1"
                                                title="ยืนยันการรับทราบการแจ้งซ่อม" rel="tooltip"
                                                onclick="return confirm(&quot;คุณแน่ใช่ใช่หรือไม่ที่จะยืนยันรับแจ้งซ่อมนี้ ?&quot;)">
                                                <i class="material-icons">check_circle</i>รับแจ้ง
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ url('/maintenance/'.$maintenance->id) }}"
                                            accept-charset="UTF-8" class="form-horizontal d-inline"
                                            enctype="multipart/form-data">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <input class="d-none" name="status" type="hidden" id="status"
                                                value="ยกเลิกแจ้งซ่อม">
                                            <button type="submit" class="btn btn-outline-danger btn-round ml-1"
                                                title="ยกเลิกการแจ้งซ่อม" rel="tooltip"
                                                onclick="return confirm(&quot;คุณแน่ใช่ใช่หรือไม่ที่จะยกเลิกการแจ้งซ่อมนี้ ?&quot;)">
                                                <span class="material-icons">cancel</span>ยกเลิก
                                            </button>
                                        </form>
                                        @break
                                        @case('กำลังซ่อม')
                                        {{ $maintenance->status }}
                                        <button type="button" class="btn btn-outline-success btn-sm btn-round ml-1"
                                            title="ยืนยันการแจ้งซ่อม" id="mtn_confirm" rel="tooltip"
                                            data-id="{{ $maintenance->id }}" data-date="{{ get_jFY($maintenance->date) }}"
                                            data-detail="{{ $maintenance->detail }}">
                                            ยืนยัน
                                        </button>
                                        @break
                                        @case('ยกเลิกแจ้งซ่อม')
                                        {{ $maintenance->status }}
                                        @break
                                        @case('ซ่อมเสร็จแล้ว')
                                        {{ $maintenance->status }}
                                            <span class="material-icons text-success">check_circle</span>
                                        @break
                                        @default
                                        {{'ข้อมูลผิดพลาด'}}
                                        @break
                                        @endswitch
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.model-confirm-maintenance')
@endsection
