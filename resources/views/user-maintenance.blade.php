@extends('layouts.app')

@section('title','Malaiplace | Maintenance')

@section('User','active')

@section('content')
<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single mb-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="title-single-box">
                        <h1 class="title-single">
                            รายการซ่อม
                            ห้อง {{ Auth::user()->lease->room->number }}
                            ตึก {{ Auth::user()->lease->room->building }}
                            ประเภทห้อง {{ Auth::user()->lease->room->type->name }}
                        </h1>
                        <span class="color-text-a">ทั้งหมด : {{ $mtns->Count() }} รายการ</span>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Blog Single ======= -->
    <section class="news-single nav-arrow-b">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="form-comments">
                        <div class="row justify-content-center">
                            <div class="col-md">
                                <div class="title-box-d">
                                    <a href="{{ url('user-maintenance') }}" title="Maintenance ทั้งหมด">
                                        <h3 class="title-d">ทั้งหมด</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="title-box-d">
                                    <a href="{{ url('user-maintenance') }}?status=กำลังซ่อม" title="Maintenance รอซ่อม">
                                        <h3 class="title-d">รอซ่อม</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="title-box-d">
                                    <a href="{{ url('user-maintenance') }}?status=ซ่อมเสร็จแล้ว"
                                        title="Maintenance ซ่อมเสร็จแล้ว">
                                        <h3 class="title-d">ซ่อมเสร็จแล้ว</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="title-box-d">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#notifyMaintenance"
                                        title="Maintenance แจ้งซ่อม">
                                        <h3 class="title-d">แจ้งซ่อม</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($mtns->Count() <= 0) <div class="row section-t3">
                <div class="col-sm-12">
                    <div class="title-box-d">
                        <a href="{{ url('user-maintenance') }}">
                            <h3 type="button" class="title-d btn btn-outline-danger btn-block">
                                ไม่มีรายการคะ...
                            </h3>
                        </a>
                    </div>
                </div>
                @else
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="table-responsive">
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <table class="table table-striped table-sm" id="dataMaintenance"
                                style="font-family: Kanit">
                                <thead>
                                    <tr class="text-center">
                                        <th>ลำดับ</th>
                                        <th>วันที่แจ้ง</th>
                                        <th class="text-left">รายละเอียด</th>
                                        <th>ค่าซ่อม</th>
                                        <th>วันซ่อมเสร็จ</th>
                                        <th class="text-left">สถานะ</th>
                                        <th class="text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mtns as $item)
                                    <tr class="text-center">
                                        <td>
                                            {{ ($mtns->currentpage()-1) * $mtns->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ get_dmY($item->date) }}</td>
                                        <td class="text-left">{{ $item->detail }}</td>
                                        <td>{{ number_format($item->price,2) }}</td>
                                        <td>{{ isset($item->date_done) ? get_dmY($item->date_done) : '' }}</td>
                                        <td class="text-left">
                                            @switch($item->status)
                                            @case('แจ้งซ่อม')
                                            {{ 'รอตรวจสอบ' }}
                                            <div class="spinner-border text-danger spinner-border-sm" role="status">
                                            </div>
                                            @break
                                            @case('กำลังซ่อม')
                                            {{ 'ยืนยันแล้วรอซ่อม' }}
                                            <div class="spinner-border text-primary spinner-border-sm" role="status">
                                            </div>
                                            @break
                                            @case('ซ่อมเสร็จแล้ว')
                                            {{ 'ซ่อมเสร็จแล้ว' }}
                                            <i class="fas fa-circle text-success ml-1"></i>
                                            @break
                                            @default
                                            {{ 'ผิดพลาด' }}
                                            <i class="text-danger fas fa-exclamation-circle mr-1"></i>
                                            @endswitch
                                        </td>
                                        <td class="text-left">
                                            <button type="button" class="btn btn-primary btn-sm" id="ShowMaintenance"
                                                data-detail="{{ $item->detail }}" data-user="{{ Auth::user()->name }}"
                                                data-number="{{ $item->room->number }}"
                                                data-building="{{ $item->room->building }}"
                                                data-date="{{ get_dmY($item->date) }}"
                                                data-done="{{ isset($item->date_done) ? get_dmY($item->date_done) : '' }}"
                                                data-price="{{ $item->price }}" data-status="{{ $item->status }}">
                                                ดูข้อมูล
                                            </button>
                                            @if ($item->status == 'แจ้งซ่อม')
                                            <form method="POST"
                                                action="{{ url('/user-maintenance' . '/' . $item->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    title="ยกเลิกแจ้งซ่อม"
                                                    onclick="return confirm(&quot;คุฯแน่ใจใช่หรือไม่ที่ต้องการยกเลิกการแจ้งซอมนี้ ?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    ยกเลิก
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {!! $mtns->appends(['search' => Request::get('search')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="modal fade" id="notifyMaintenance" tabindex="-1" role="dialog"
            aria-labelledby="notifyMaintenanceLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notifyMaintenanceLabel">แจ้งซ่อมบำรุง ห้อง :
                            {{ Auth::user()->lease->room->number }} ตึก : {{ Auth::user()->lease->room->building }}</h5>
                        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ url('/user-notify-maintenance') }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">รายละเอียด <span class="text-danger"> *</span> </label>
                                <textarea class="form-control" rows="3" id="detail" name="detail" required></textarea>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="ready_date" class="control-label">วันที่พร้อมให้ซ่อม<span class="text-danger"> *</span></label>
                                <input class="form-control" name="ready_date" type="datetime-local" id="ready_date" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md">
                                <button type="submit" class="btn btn-primary btn-block">บันทึกแจ้งซ่อมบำรุง</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.model-show-maintenance')
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main><!-- End #main -->
<!-- End Blog Single-->
@endsection
