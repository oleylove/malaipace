@extends('admin.app')
@section('title','Malaiplace | ข้อมูลใบแจ้งหนี้')
@section('invoice','active')


@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-danger">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <div class="row no-gutters">
                                    <div class="col-md-2">
                                        <h4 class="card-title ">ตารางข้อมูลแจ้งหนี้</h4>
                                        <p class="card-category">{{ 'ทั้งหมด ' .$invoiceCount.' รายการ' }}</p>
                                    </div>
                                    <div class="col-md d-flex justify-content-end align-items-center">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <span class="nav-tabs-title">สถานะ : </span>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == '' ? ' active' : '' }}"
                                                    href="{{ url('/invoice') }}" rel="tooltip">
                                                    <i class="material-icons">receipt_long</i>ทั้งหมด
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'รอชำระเงิน' ? ' active' : '' }}"
                                                    href="{{ url('/invoice?status=รอชำระเงิน') }}" rel="tooltip">
                                                    <i class="material-icons">hourglass_top</i>รอชำระเงิน
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'รอตรวจสอบ' ? ' active' : '' }}"
                                                    href="{{ url('/invoice?status=รอตรวจสอบ') }}" rel="tooltip">
                                                    <i class="material-icons">hourglass_bottom</i>รอตรวจสอบ
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'ชำระเงินแล้ว' ? ' active' : '' }}"
                                                    href="{{ url('/invoice?status=ชำระเงินแล้ว') }}" rel="tooltip">
                                                    <i class="material-icons">library_add_check</i>ชำระเงินแล้ว
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('status') == 'ยกเลิกการชำระเงิน' ? ' active' : '' }}"
                                                    href="{{ url('/invoice?status=ยกเลิกการชำระเงิน') }}" rel="tooltip">
                                                    <i class="material-icons">do_disturb_off</i>ยกเลิกการชำระเงิน
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ url('/invoice/create') }}" title="ออกใบแจ้งหนี้" class="ml-5 btn btn-success btn-fab btn-round" rel="tooltip">
                                                    <i class="material-icons">library_add</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>

                                            {{-- <form method="GET" action="{{ url('/invoice') }}" accept-charset="UTF-8" class="form-inline float-right mt-2" role="search">
                                                <div class="input-group">
                                                    <select class="form-control form-control-sm" name="building" required>
                                                        <option value="{{ !empty(request('building')) ? request('building') : ''}}">{{ !empty(request('building')) ? request('building') : 'เลือกตึก...'}}</option>
                                                        <option value="A">ตึก A</option>
                                                        <option value="B">ตึก B</option>
                                                    </select>
                                                    <input type="text" class="form-control form-control-sm" name="number" placeholder="ค้นหาจากเลขห้อง...."
                                                        value="{{ request('number') }}" size="30" required>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-secondary btn-sm" type="submit">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </form> --}}
                                            {{-- <div class="col-md-2 text-right">
                                                <a href="{{ url('/user/create') }}" title="Create" class="btn btn-success btn-fab btn-round">
                                                    <i class="material-icons">library_add</i>
                                                </a>
                                            </div> --}}

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

                    <table class="table table-hover table-sm" id="dataTableInvoice">
                        <thead class="text-info">
                            <tr class="text-center">
                                <th>ลำดับ</th>
                                <th>วันที่</th>
                                <th class="text-left">ชื่อ-สกุล</th>
                                <th>ตึก - ห้อง</th>
                                <th>ค่าเช่า</th>
                                <th>รวมทั้งหมด</th>
                                <th>วันชำระเงิน</th>
                                <th>สถานะ</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice as $item)
                            <tr class="text-center">
                                <td>{{ ($invoice->currentpage()-1) * $invoice->perpage() + $loop->index + 1 }}
                                    <td>{{ get_dmY($item->date) }}</td>
                                    <td class="text-left">{{ $item->lease->user->name }}</td>
                                    <td>{{ $item->lease->room->building.' - '.$item->lease->room->number}}</td>
                                    <td>{{ number_format($item->les_price,2) }}</td>
                                    <td>{{ number_format($item->net_pay,2) }}</td>
                                    <td>
                                        @if(isset($item->date_pay))
                                            {{ get_dmY($item->date_pay)}}
                                        @else
                                            @if ($item->pay_date < get_Ymd(Date::now()))
                                                {{'คิดค่าปรับ '.dateDifference(get_Ymd(Date::now()),$item->pay_date). ' วัน'}}
                                            @else
                                                {{'เหลืออีก '.dateDifference(get_Ymd(Date::now()),$item->pay_date). ' วัน'}}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @switch($item->status)
                                            @case('รอชำระเงิน')
                                            {{ $item->status }}
                                                <div class="spinner-border text-danger spinner-border-sm mr-1" role="status"></div>
                                            @break
                                            @case('รอตรวจสอบ')
                                            {{ $item->status }}
                                                <div class="spinner-border text-primary spinner-border-sm" role="status"> </div>
                                            @break
                                            @case('ชำระเงินแล้ว')
                                                {{ $item->status }}
                                            @break
                                            @case('ยกเลิกการชำระเงิน')
                                                {{ $item->status }}
                                            @break
                                            @default
                                                {{'ข้อมูลผิดพลาด'}} <i class="text-danger fas fa-exclamation-circle mr-1"></i>
                                            @break
                                        @endswitch
                                    </td>
                                    <td class="td-actions justify-content-center">
                                    <a href="{{ url('/invoice/' . $item->id) }}" title="View" type="button" rel="tooltip"
                                        class="btn btn-info btn-round mr-2">
                                        <i class="material-icons">search</i>
                                    </a>
                                    <a href="{{ url('/invoice/' . $item->id . '/edit') }}" title="Edit" type="button"
                                        rel="tooltip" class="btn btn-danger btn-round">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper pull-right">
                        {!! $invoice->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
