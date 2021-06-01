@extends('admin.app')
@section('title','Malaiplace | ข้อมูลซ่อมบำรุง')
@section('maintenance','active')

@section('content')
<div class="container-fluid" id="maintenancePage">

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
                                        <a class="nav-link {{ request('status') == '' ? ' active' : '' }}"
                                            href="{{ url('/maintenance') }}" >
                                            <i class="material-icons">settings_suggest</i> ทั้งหมด
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'แจ้งซ่อม' ? ' active' : '' }}"
                                            href="{{ url('/maintenance?status=แจ้งซ่อม') }}">
                                            <i class="material-icons">record_voice_over</i>แจ้งซ่อม
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'กำลังซ่อม' ? ' active' : '' }}"
                                            href="{{ url('/maintenance?status=กำลังซ่อม') }}">
                                            <i class="material-icons">engineering</i>กำลังซ่อม
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'ซ่อมเสร็จแล้ว' ? ' active' : '' }}"
                                            href="{{ url('/maintenance?status=ซ่อมเสร็จแล้ว') }}">
                                            <i class="material-icons">library_add_check</i>ซ่อมเสร็จแล้ว
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'ยกเลิกแจ้งซ่อม' ? ' active' : '' }}"
                                            href="{{ url('/maintenance?status=ยกเลิกแจ้งซ่อม') }}">
                                            <i class="material-icons">do_disturb_off</i>ยกเลิกแจ้งซ่อม
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item ml-md-auto">
                                        <a href="{{ url('/maintenance/create') }}" title="Create Maintenance" rel="tooltip"
                                            class="btn btn-success btn-fab btn-round">
                                            <i class="material-icons">library_add</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    {{-- table maintenance --}}
                    <div class="tab-pane active" id="maintenance">
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
                            <thead class=" text-info">
                                <tr class="text-center">
                                    <th>ลำดับ</th>
                                    <th>วันที่แจ้ง</th>
                                    <th class="text-left">วันที่พร้อมให้ซ่อม</th>
                                    <th class="text-left">รายละเอียด</th>
                                    <th class="text-right pr-3">ค่าซ่อม</th>
                                    <th>ซ่อมเสร็จ</th>
                                    <th>สถานะ</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($maintenance as $item)
                                <tr class="text-center">
                                    <td>
                                        {{ ($maintenance->currentpage()-1) * $maintenance->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td>{{ get_dmY($item->date) }}</td>
                                    <td class="text-left">{{ get_dateTime_dmY($item->ready_date) }}</td>
                                    <td class="text-left">
                                        {{ Str::length($item->detail) < 30 ? $item->detail : Str::substr($item->detail, 0, 30) ." ...." }}
                                    </td>
                                    <td class="text-right pr-3">
                                        {{ $item->price > 0 ? number_format($item->price,2) : ''}}</td>
                                    <td>{{ isset($item->date_done) ? get_dmY($item->date_done) : '' }}
                                    </td>
                                    <td class="td-actions justify-content-center">
                                        @switch($item->status)
                                        @case('แจ้งซ่อม')
                                        {{ $item->status }}
                                        <form method="POST" action="{{ url('/maintenance/'.$item->id) }}"
                                            accept-charset="UTF-8" class="form-horizontal d-inline"
                                            enctype="multipart/form-data">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <input class="d-none" name="status" type="hidden" id="status"
                                                value="กำลังซ่อม">
                                            <input class="d-none" name="Get_Notified" type="hidden" id="Get_Notified"
                                                value="รับแจ้ง">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-round ml-1"
                                                title="รับแจ้งแจ้งซ่อม" rel="tooltip"
                                                onclick="return confirm(&quot;คุณแน่ใช่ใช่หรือไม่ที่จะยืนยันรับแจ้งซ่อมนี้ ?&quot;)">
                                                รับแจ้ง
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ url('/maintenance/'.$item->id) }}"
                                            accept-charset="UTF-8" class="form-horizontal d-inline"
                                            enctype="multipart/form-data">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <input class="d-none" name="status" type="hidden" id="status"
                                                value="ยกเลิกแจ้งซ่อม">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-round ml-1"
                                                title="ยกเลิกแจ้งซ่อม" rel="tooltip"
                                                onclick="return confirm(&quot;คุณแน่ใช่ใช่หรือไม่ที่จะยกเลิกการแจ้งซ่อมนี้ ?&quot;)">
                                                ยกเลิก
                                            </button>
                                        </form>
                                        @break
                                        @case('กำลังซ่อม')
                                        {{ $item->status }}
                                        <button type="button" class="btn btn-outline-success btn-sm btn-round ml-1"
                                            title="ยืนยันการรับทราบการแจ้งซ่อม" id="mtn_confirm" rel="tooltip"
                                            data-id="{{ $item->id }}" data-date="{{ get_jFY($item->date) }}"
                                            data-detail="{{ $item->detail }}">
                                            ยืนยัน
                                        </button>
                                        @break
                                        @case('ยกเลิกแจ้งซ่อม')
                                        {{ $item->status }}
                                        @break
                                        @case('ซ่อมเสร็จแล้ว')
                                        {{ $item->status }}
                                        @break
                                        @default
                                        {{'ข้อมูลผิดพลาด'}} <i class="text-danger fas fa-exclamation-circle mr-1"></i>
                                        @break
                                        @endswitch
                                    </td>
                                    <td class="td-actions justify-content-center">
                                        <a href="{{ url('/maintenance/' . $item->id) }}" title="View" type="button"
                                            rel="tooltip" class="btn btn-info btn-round mr-2">
                                            <i class="material-icons">search</i>
                                        </a>
                                        <a href="{{ url('/maintenance/' . $item->id . '/edit') }}" title="Edit"
                                            type="button" rel="tooltip" class="btn btn-danger btn-round">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        {{-- <form method="POST" action="{{ url('/maintenance' . '/' . $item->id) }}"
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
                            {!! $maintenance->appends(['status' => Request::get('status')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.model-confirm-maintenance')
@endsection
