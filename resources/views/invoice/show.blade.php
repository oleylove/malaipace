@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลใบแจ้งหนี้')
@section('invoice','active')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ดูข้อมูลใบแจ้งหนี้</h4>
                        <p class="card-category">{{ 'รหัสใบแจ้งหนี้ # ' .$invoice->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/invoice/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        <a href="{{ url('/invoice/' . $invoice->id . '/edit') }}" title="Edit" rel="tooltip"
                            class="btn btn-danger btn-fab btn-round">
                            <i class="material-icons">edit</i>
                        </a>
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
                                @if (!empty($invoice->slip))
                                    @if(Storage::exists('public/'.$invoice->slip))
                                        <img src="{{ url('/') }}/storage/{{ $invoice->slip }}" rel="nofollow" alt="...">
                                    @else
                                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md ml-3">
                        <div class="row no-gutters">
                            <div class="col-md">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <th width="120px"> ชื่อ-สกุล ผู้เช่า </th>
                                                <td> {{ $invoice->lease->user->name }} </td>
                                            </tr>
                                            <tr>
                                                <th> ตึก/เลขห้อง </th>
                                                <td> {{ $invoice->lease->room->building .' / '. $invoice->lease->room->number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> วันแจ้งชำระเงิน </th>
                                                <td> {{ isset($invoice->date_pay) ? $invoice->date_pay : 'ยังไม่ชำระเงิน'}} </td>
                                            </tr>
                                            <tr>
                                                <th> รวมค่าน้ำ </th>
                                                <td> {{ number_format($invoice->meter_wtp,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> รวมค่าไฟ </th>
                                                <td> {{ number_format($invoice->meter_ptp,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าส่วนกลาง </th>
                                                <td> {{ number_format($invoice->typ_centric,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าอินเทอร์เน็ต </th>
                                                <td> {{ number_format($invoice->typ_wifi,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าที่จอดรถ </th>
                                                <td> {{ number_format($invoice->typ_vehicle,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าปรับล่าช้า </th>
                                                <td> {{ number_format($invoice->typ_mulct,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าเช่าห้อง </th>
                                                <td> {{ number_format($invoice->les_price,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                @if ($invoice->net_pay > 0)
                                                <th> รวมจ่ายสุทธิ </th>
                                                <td> {{ number_format($invoice->net_pay,2) }} บาท</td>
                                                @else
                                                <th> คืนเงินประกัน </th>
                                                <td> {{ number_format($invoice->net_pay * (-1),2) }} บาท</td>
                                                @endif
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <th width="120px"> วันกำหนดชำระเงิน </th>
                                                <td> {{ get_jFY($invoice->pay_date) }} </td>
                                            </tr>
                                            <tr>
                                                <th> วันเกินกำหนด </th>
                                                <td> {{ $invoice->delay_date > 0 ? $invoice->delay_date.' วัน' : '0 วัน' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> มิเตอร์น้ำใหม่ </th>
                                                <td> {{ $invoice->meter_wn }} </td>
                                            </tr>
                                            <tr>
                                                <th> มิเตอร์น้ำเก่า </th>
                                                <td> {{ $invoice->meter_wo }} </td>
                                            </tr>
                                            <tr>
                                                <th> จำนวนหน่วย </th>
                                                <td> {{ $invoice->meter_wu }} หน่วย</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าน้ำต่อหน่วย </th>
                                                <td> {{ $invoice->meter_wpu }} บาท/หน่วย</td>
                                            </tr>
                                            <tr>
                                                <th> มิเตอร์ไฟใหม่ </th>
                                                <td> {{ $invoice->meter_pn }} </td>
                                            </tr>
                                            <tr>
                                                <th> มิเตอร์ไฟเก่า </th>
                                                <td> {{ $invoice->meter_po }} </td>
                                            </tr>
                                            <tr>
                                                <th> จำนวนหน่วย </th>
                                                <td> {{ $invoice->meter_pu }} หน่วย</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าไฟต่อหน่วย </th>
                                                <td> {{ $invoice->meter_ppu }} บาท/หน่วย</td>
                                            </tr>
                                            <tr>
                                                <th> สถานะใบแจ้งหนี้ </th>
                                                <td>
                                                    @switch($invoice->status)
                                                    @case('รอชำระเงิน')
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-round">
                                                        {{ $invoice->status }}
                                                    </button>
                                                    @break
                                                    @case('รอตรวจสอบ')
                                                    <button type="button" class="btn btn-outline-primary btn-sm btn-round">
                                                        {{ $invoice->status }}
                                                    </button>
                                                    @break
                                                    @case('ชำระเงินแล้ว')
                                                    <button type="button" class="btn btn-outline-success btn-sm btn-round">
                                                        {{ $invoice->status }}
                                                    </button>
                                                    @break
                                                    @case('ยกเลิกการชำระเงิน')
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-round">
                                                        {{ $invoice->status }}
                                                    </button>
                                                    @break
                                                    @default
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-round">
                                                        {{ 'ข้อมูลผิดพลาด' }}
                                                    </button>
                                                    @break
                                                    @endswitch
                                                </td>
                                                {{-- <td>
                                                    @if ($invoice->status != 'ชำระเงินแล้ว')
                                                    <form method="POST" action="{{ url('/invoice/confirm/payment/'.$invoice->id) }}"
                                                        accept-charset="UTF-8" enctype="multipart/form-data">
                                                        {{ method_field('PATCH') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-success btn-block" title="ยืนยันการชำระเงิน"
                                                            onclick="return confirm('คุณแน่ใจใช่หรือไม่ที่ต้องการยืนยันการชำระเงิน ของใบแจ้งหนี้นี้?')">
                                                            ยืนยันการชำระเงินค่าเช่าห้อง
                                                        </button>
                                                    </form>
                                                    @endif
                                                </td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
