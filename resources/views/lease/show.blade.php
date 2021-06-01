@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลเช่า')
@section('lease','active')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col">
                        <h4 class="card-title ">ดูข้อมูลเช่า</h4>
                        <p class="card-category">{{ 'รหัสเช่า # ' .$lease->id }}</p>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/lease/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        <a href="{{ url('/lease/' . $lease->id . '/edit') }}" title="Edit" rel="tooltip"
                            class="btn btn-danger btn-fab btn-round">
                            <i class="material-icons">edit</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mt-4 text-center">
                        <label for="photo4" class="control-label">{{ 'สัญญาเช่า' }}</label>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised">
                                @if (!empty($lease->idcard_doc))
                                    @if(Storage::exists('public/'.$lease->idcard_doc))
                                        <a href="{{ url('/') }}/storage/{{ $lease->idcard_doc }}" target="_blank" title="Download" rel="tooltip">
                                            <img src="{{ asset('assets/images/pdf.png')  }}" rel="nofollow" class="img-fluid" alt="...">
                                        </a>
                                    @else
                                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/nopdf.png')  }}" rel="nofollow" alt="...">
                                @endif
                            </div>
                        </div>
                        <label for="photo4" class="control-label">{{ 'สำเนาบัตรประชาชน' }}</label>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised">
                                @if (!empty($lease->lease_doc))
                                    @if(Storage::exists('public/'.$lease->lease_doc))
                                        <a href="{{ url('/') }}/storage/{{ $lease->lease_doc }}" target="_blank" title="Download" rel="tooltip">
                                            <img src="{{ asset('assets/images/pdf.png')  }}" rel="nofollow" class="img-fluid" alt="...">
                                        </a>
                                    @else
                                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/nopdf.png')  }}" rel="nofollow" alt="...">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="row no-gutters">
                            <div class="col-md-5">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <th width="150px"> ห้อง </th>
                                                <td> {{ $lease->room->number }} </td>
                                            </tr>
                                            <tr>
                                                <th> ตึก </th>
                                                <td> {{ $lease->room->building }} </td>
                                            </tr>
                                            <tr>
                                                <th> ประเภทห้อง </th>
                                                <td> {{ $lease->room->type->name }} </td>
                                            </tr>
                                            <tr>
                                                <th> ค่าเช่าห้อง </th>
                                                <td> {{ number_format($lease->typ_price,2) }} บาท/เดือน</td>
                                            </tr>
                                            <tr>
                                                <th> ค่าจองห้อง </th>
                                                <td> {{ number_format($lease->typ_booking,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> ค่ามัดจำ</th>
                                                <td> {{ number_format($lease->typ_doposit,2) }} บาท</td>
                                            </tr>
                                            <tr>
                                                <th> ค่า WiFi</th>
                                                <td>
                                                    @if ($lease->typ_wifi === 'yes')
                                                    {{ number_format($lease->room->type->wifi,2) }} บาท/เดือน
                                                    @else
                                                    {{ 'ไม่ได้ใช้' }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> จ่ายสุทธิวันทำสัญญา </th>
                                                <td> {{ number_format($lease->net_pay,2) }} บาท
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> มิเตอร์น้ำเริ่มต้น </th>
                                                <td> {{ $lease->meter_ws }} </td>
                                            </tr>
                                            <tr>
                                                <th> มิเตอร์ไฟเริมต้น </th>
                                                <td> {{ $lease->meter_ps }} </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <th width="150px"> ชื่อ-สกุล ผู้เช่า </th>
                                                <td> {{ $lease->user->name }} </td>
                                            </tr>
                                            <tr>
                                                <th> รหัสบัตรผู้เช่า </th>
                                                <td> {{ $lease->idcard }} </td>
                                            </tr>
                                            <tr>
                                                <th> วันทำสัญญา </th>
                                                <td> {{ get_jFY($lease->date_start) }} </td>
                                            </tr>
                                            <tr>
                                                <th> วันครบสัญญา </th>
                                                <td> {{ get_jFY($lease->date_end) }} </td>
                                            </tr>
                                            <tr>
                                                <th> ค่าเช่าที่จอดรถ</th>
                                                <td>
                                                    {{ $lease->typ_vehicle == 'yes' ? number_format($lease->room->type->vehicle,2).' บาท/เดือน' : 'ไม่ได้เช่า'}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> รถยนต์/จักรยายยนต์ </th>
                                                <td> {{ $lease->vehicle }} </td>
                                            </tr>
                                            <tr>
                                                <th> ทะเบียนรถ </th>
                                                <td> {{ $lease->vehicle_reg }} </td>
                                            </tr>
                                            <tr>
                                                <th> จำนวนผู้อาศัย </th>
                                                <td> {{ $lease->number }} คน</td>
                                            </tr>
                                            <tr>
                                                <th> วันแจ้งย้ายออก </th>
                                                <td> {{ isset($lease->checkout) ? get_dateTime($lease->checkout) : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> สถานะเช่า </th>
                                                <td>{{ $lease->status }}
                                                    <span class="float-right">
                                                        @if (isset($lease->checkout))
                                                        {{ get_timespan(get_Ymd($lease->checkout),get_Ymd($lease->date_start)) }}
                                                        @else
                                                        {{ get_timespan(get_Ymd(Date::now()),get_Ymd($lease->date_start)) }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                @if ($lease->status == 'แจ้งย้าย' && isset($lease->checkout))
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md text-right">
                                            <form method="POST"
                                                action="{{ url('/lease' . '/checkout/' . $lease->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <input class="d-none" type="hidden" name="id" id="id"
                                                    value="{{ $lease->id }}">
                                                <button type="submit" class="btn btn-success btn-round"
                                                    title="ยืนยันการแจ้งย้าย"
                                                    onclick="return confirm(&quot;คุณแน่ใจใช่หรือไม่ที่จะยืนยันการแจ้งย้ายนี้ ?&quot;)">
                                                    <span class="material-icons">check_circle</span>
                                                    ยืนยันการแจ้งย้าย
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md text-right">
                                            <form method="POST"
                                                action="{{ url('/lease' . '/checkout/' . $lease->id . '/cencel') }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <input class="d-none" type="hidden" name="id" id="id"
                                                    value="{{ $lease->id }}">
                                                <button type="submit" class="btn btn-danger btn-round"
                                                    title="ยกเลิกการแจ้งย้าย"
                                                    onclick="return confirm(&quot;คุณแน่ใจใช่หรือไม่ที่จะยกเลิกการแจ้งย้ายนี้ ?&quot;)">
                                                    <span class="material-icons">cancel</span>
                                                    ยกเลิกการแจ้งย้าย
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if ($lease->status == 'ยืนยันแจ้งย้าย' && isset($lease->checkout))
                                <div class="row no-gutters align-items-center">
                                    <div class="col-md text-right">
                                            <button type="submit" class="btn btn-success btn-block"
                                                title="ทำเรื่องย้ายออก" data-toggle="modal"
                                                data-target="#adminCheckout">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                ทำเรื่องย้ายออก
                                            </button>
                                        </div>
                                        <div class="col-md text-right">
                                            <form method="POST"
                                                action="{{ url('/lease' . '/checkout/' . $lease->id . '/cencel') }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <input class="d-none" type="hidden" name="id" id="id"
                                                    value="{{ $lease->id }}">
                                                <button type="submit" class="btn btn-danger btn-block"
                                                    title="ยกเลิกการแจ้งย้าย"
                                                    onclick="return confirm(&quot;คุณแน่ใจใช่หรือไม่ที่จะยกเลิกการแจ้งย้ายนี้ ?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    ยกเลิกการแจ้งย้าย
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if ($lease->status == 'ย้ายออก' && isset($lease->checkout))
                                <div class="row no-gutters align-items-center">
                                    <div class="col-md text-right">
                                        <a href="{{  url('/admin-print/receipt/lease/'.$lease->id.'/checkout') }}"
                                            target="_blank" title="พิมพ์ใบเสร็จรับเงินย้ายออก"
                                            class="btn btn-primary btn-block">
                                            <i class="fas fa-file-invoice-dollar mr-1"
                                                style="font-size: 18px"></i>
                                            พิมพ์ใบเสร็จรับเงินย้ายออก
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
