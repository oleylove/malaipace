@extends('layouts.app')

@section('title','Malaiplace | Invoice')

@section('Invoice','active')

@section('content')
<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single mb-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="title-single-box">
                        <h1 class="title-single">
                            ใบแจ้งหนี้
                            ห้อง {{ Auth::user()->lease->room->number }}
                            ตึก {{ Auth::user()->lease->room->building }}
                            ประเภทห้อง {{ Auth::user()->lease->room->type->name }}
                        </h1>
                        <span class="color-text-a">ทั้งหมด : {{ $invs->Count() }} รายการ</span>
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
                                    <a href="{{ url('user-invoice') }}" title="Invoice ทั้งหมด">
                                        <h3 class="title-d">ทั้งหมด</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="title-box-d">
                                    <a href="{{ url('user-invoice') }}?status=รอชำระเงิน" title="Invoice รอชำระเงิน">
                                        <h3 class="title-d">รอชำระเงิน</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="title-box-d">
                                    <a href="{{ url('user-invoice') }}?status=รอตรวจสอบ" title="Invoice รอตรวจสอบ">
                                        <h3 class="title-d">รอตรวจสอบ</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="title-box-d">
                                    <a href="{{ url('user-invoice') }}?status=ชำระเงินแล้ว"
                                        title="Invoice ชำระเงินแล้ว">
                                        <h3 class="title-d">ชำระเงินแล้ว</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($invs->Count() <= 0) <div class="row section-t3">
                <div class="col-sm-12">
                    <div class="title-box-d">
                        <a href="{{ url('user-invoice') }}">
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
                        <table class="table table-striped table-sm" id="dataInvoice" style="font-family: Kanit">
                            <thead>
                                <tr class="text-center">
                                    <th>ลำดับ</th>
                                    <th>วันที่</th>
                                    <th>ค่าเช่า</th>
                                    <th>ค่าน้ำ</th>
                                    <th>ค่าไฟ</th>
                                    <th>ค่าส่วนกลาง</th>
                                    <th>ค่าเน็ต</th>
                                    <th>ค่าที่จอดรถ</th>
                                    <th>ค่าปรับล่าช้า</th>
                                    <th>รวมทั้งหมด</th>
                                    <th>สถานะ</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invs as $item)
                                <tr class="text-center">
                                    <td>
                                        {{ ($invs->currentpage()-1) * $invs->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td>{{ get_dmY($item->date) }}</td>
                                    <td>{{ number_format($item->les_price,2) }}</td>
                                    <td>{{ number_format($item->meter_wtp,2) }}</td>
                                    <td>{{ number_format($item->meter_ptp,2) }}</td>
                                    <td>{{ number_format($item->typ_centric,2) }}</td>
                                    <td>{{ number_format($item->typ_wifi,2) }}</td>
                                    <td>{{ number_format($item->typ_vehicle,2) }}</td>
                                    <td>{{ number_format($item->typ_mulct,2) }}</td>
                                    <td>{{ number_format($item->net_pay,2) }}</td>
                                    <td>
                                        @switch($item->status)
                                            @case('รอชำระเงิน')
                                            {{ 'รอชำระเงิน' }}
                                            <div class="spinner-border text-danger spinner-border-sm" role="status"></div>
                                                @break
                                            @case('รอตรวจสอบ')
                                            {{ 'รอตรวจสอบ' }}
                                            <div class="spinner-border text-primary spinner-border-sm" role="status"></div>
                                                @break
                                            @case('ชำระเงินแล้ว')
                                            {{ 'ชำระเงินแล้ว' }}
                                            <i class="fas fa-circle text-success ml-1"></i>
                                                @break
                                            @case('ยกเลิกการชำระเงิน')
                                            {{ 'ยกเลิกการชำระเงิน' }}
                                            <i class="fas fa-circle text-danger ml-1"></i>
                                                @break
                                            @default
                                            {{ 'ผิดพลาด' }}
                                            <i class="text-danger fas fa-exclamation-circle mr-1"></i>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($item->status == 'รอชำระเงิน')
                                        <button type="button" class="btn btn-outline-danger btn-sm" id="confirmIvn"
                                            inv_id="{{$item->id}}">
                                            แจ้งชำระเงิน
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-success btn-sm" id="confirmIvn"
                                            inv_id="{{$item->id}}">
                                            ดูข้อมูล
                                        </button>
                                        @endif
                                        <!-- **** MODEL COMFIRM INVOICE ***** -->
                                        <div id="ModalInv{{$item->id}}" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="invoiceModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">
                                                            <i class="far fa-question-circle"></i>
                                                            ใบแจ้งหนี้
                                                            {{ get_dmY($item->date) }}
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">
                                                                <i class="far fa-times-circle text-danger"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card border-primary">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    <div class="col-md col-sm text-left ml-5">
                                                                        ใบแจ้งหนี้ห้องพักประจำเดือน
                                                                        {{ Date::parse($item->date)->format('F Y') }}<br>
                                                                        ห้อง : {{ $item->lease->room->number }}
                                                                        ตึก : {{ $item->lease->room->building }}
                                                                        ประเภทห้อง :
                                                                        {{ $item->lease->room->type->name }}<br>
                                                                        ผู้เช่า : {{ $item->lease->user->name }}
                                                                        เบอร์โทร : {{ $item->lease->user->phone }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-left ml-5">
                                                                            กำหนดวันจ่ายไม่เกิน
                                                                            {{ Date::parse($item->pay_date)->format('d F Y') }}
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-left ml-5">
                                                                            ค่าไฟ {{ $item->meter_ppu }}
                                                                            บาท/หน่วย
                                                                            ค่าน้ำ {{ $item->meter_wpu }}
                                                                            บาท/หน่วย
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-left ml-5">
                                                                            มิเตอร์น้ำ
                                                                            {{ '( '.$item->meter_wn .' - '.$item->meter_wo .' )' }}
                                                                            = {{ $item->meter_wu }} หน่วย รวมค่าน้ำ
                                                                            {{ $item->meter_wtp }} บาท
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-left ml-5">
                                                                            มิเตอร์ไฟ
                                                                            {{ '( '.$item->meter_pn .' - '.$item->meter_po .' )' }}
                                                                            = {{ $item->meter_pu }} หน่วย รวมค่าไฟ
                                                                            {{ $item->meter_ptp }} บาท
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-left ml-5">
                                                                            ค่าเช่าห้อง
                                                                            {{ number_format($item->les_price) }}
                                                                            บาท
                                                                            ค่าส่วนกลาง {{ $item->typ_centric }} บาท
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-left ml-5">
                                                                            ค่าเน็ต {{ $item->typ_wifi }} บาท
                                                                            ค่าที่จอดรถ {{ $item->typ_vehicle }} บาท
                                                                            ค่าปรับล่าช้า {{ $item->typ_mulct }} บาท
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div
                                                                            class="col-md col-sm text-left ml-5 font-weight-bold">
                                                                            รวมจ่ายต้องชำระ
                                                                            {{ number_format($item->net_pay) }}
                                                                            บาท
                                                                            {{-- ({{ $item->net_pay > 0 ? Functions::baht_text($item->net_pay) : "-" }}) --}}
                                                                            ({{ $item->net_pay > 0 ? Sawasdee::readThaiCurrency($item->net_pay) : "-" }})
                                                                            <br>

                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-left ml-5 font-weight-bold">
                                                                        @switch($item->status)
                                                                            @case('รอชำระเงิน')
                                                                                {{ 'สถานะ รอชำระเงิน' }}
                                                                                <div class="spinner-border text-danger spinner-border-sm" role="status">
                                                                                </div>
                                                                            @break
                                                                            @case('รอตรวจสอบ')
                                                                                {{ 'สถานะ รอตรวจสอบ' }}
                                                                            @break
                                                                            @case('ชำระเงินแล้ว')
                                                                                {{ 'สถานะ ชำระเงินแล้ว' }}
                                                                            @break
                                                                            @case('ยกเลิกการชำระเงิน')
                                                                                {{ 'สถานะ ยกเลิกการชำระเงิน' }}
                                                                            @break
                                                                            @default
                                                                                {{ 'สถานะ ผิดพลาด' }}
                                                                            @break
                                                                        @endswitch
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                @if($item->status == 'รอชำระเงิน')
                                                                <form method="POST" action="{{ url('user-confirm-invoice') }}"
                                                                    accept-charset="UTF-8"
                                                                    class="form-horizontal was-validated"
                                                                    enctype="multipart/form-data">
                                                                    {{ method_field('POST') }}
                                                                    {{ csrf_field() }}
                                                                    <li class="list-group-item">
                                                                        <div class="row">
                                                                            <div class="col-md col-sm text-center">
                                                                                <div name="receipt" id="receipt"
                                                                                    class="text-center receipt">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="row">
                                                                            <div class="col-md col-sm">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">
                                                                                        หลักฐานการชำระเงิน
                                                                                    </label>
                                                                                    <input type="file"
                                                                                        class="form-control is-invalid"
                                                                                        id="inv_slip"
                                                                                        name="inv_slip" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="row">
                                                                            <div class="col-md col-sm text-right">
                                                                                <input type="hidden" name="inv_id"
                                                                                    id="inv_id" value="{{$item->id}}">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">ยืนยัน</button>
                                                                                <button type="button" class="btn btn-danger"
                                                                                    data-dismiss="modal">ยกเลิก</button>
                                                                            </div>

                                                                        </div>
                                                                    </li>
                                                                </form>
                                                                @else
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md col-sm text-right">
                                                                            <a href="{{ url('user-print/receipt/invoice/'.$item->id) }}"
                                                                                target="_blank">
                                                                                <img src="{{ url('/') }}/storage/leases/doc.png"
                                                                                    width="28px"> พิมพ์ใบแจ้งหนี้
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- *** END MODEL COMFIRM INVOICE **** -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper">
                            {!! $invs->appends(['search' => Request::get('search')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

    </section>
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main><!-- End #main -->
<!-- End Blog Single-->
@endsection
