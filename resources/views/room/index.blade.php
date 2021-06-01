@extends('admin.app')
@section('title','Malaiplace | ข้อมูลห้องเช่า')
@section('room','active')

@section('content')
<div class="container-fluid" id="roomPage">
    <div class="col-lg-12 col-md-12">
        <div class="card">

            <div class="card-header card-header-tabs card-header-danger">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item mr-2">
                                        <a class="nav-link {{ request('status') == '' ? ' active' : '' }}" href="{{ url('/room') }}">
                                            <i class="material-icons">meeting_room</i> ข้อมูลห้องเช่า
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-md-auto">
                                        <a href="{{ url('/room/create') }}" title="Create Room" rel="tooltip" class="btn btn-success btn-fab btn-round">
                                            <i class="material-icons">queue</i>
                                        </a>
                                    </li>

                                    <span class="nav-tabs-title">สถานะห้อง : </span>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'ว่าง' ? ' active' : '' }}" href="{{ url('/room?status=ว่าง') }}">
                                            <i class="material-icons">pending</i>ว่าง
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'เช่า' ? ' active' : '' }}" href="{{ url('/room?status=เช่า') }}">
                                            <i class="material-icons">switch_account</i>เช่าอยู่
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'จอง' ? ' active' : '' }}" href="{{ url('/room?status=จอง') }}">
                                            <i class="material-icons">recent_actors</i>จอง
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'แจ้งย้าย' ? ' active' : '' }}" href="{{ url('/room?status=แจ้งย้าย') }}">
                                            <i class="material-icons">record_voice_over</i>แจ้งย้าย
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link {{ request('status') == 'ปรับปรุง' ? ' active' : '' }}" href="{{ url('/room?status=ปรับปรุง') }}">
                                            <i class="material-icons">do_not_disturb_off</i>ปิดปรับปรุง
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>

                                    <li class="nav-item ml-md-auto">
                                        <a class="nav-link" href="#types" data-toggle="tab" id="tabTypes">
                                            <i class="material-icons">maps_home_work</i>ข้อมูลประเภทห้อง
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item ml-2">
                                        <a href="{{ url('/type/create') }}" title="Create Room Type" rel="tooltip" class="btn btn-success btn-fab btn-round">
                                            <i class="material-icons">queue</i>
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
                    <div class="tab-content">
                        {{-- table rooms --}}
                        <div class="tab-pane active" id="rooms">
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

                            <table class="table table-hover table-sm" id="dataTableType">
                                <thead class="text-info">
                                    <tr class="text-center">
                                        <th >No.</th>
                                        <th>ตึก - ห้อง</th>
                                        <th class="text-left">ประเภท</th>
                                        <th>มิเตอร์น้ำ</th>
                                        <th>มิเตอร์ไฟ</th>
                                        <th>สถานะ</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($room as $item)
                                    <tr class="text-center">
                                        <td>
                                            {{ ($room->currentpage()-1) * $room->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $item->building.' - '.$item->number }}</td>
                                        <td class="text-left">{{ $item->type->name }}</td>
                                        <td>{{ $item->meter_wn }}</td>
                                        <td>{{ $item->meter_pn }}</td>
                                        <td>
                                            {{ $item->status }}
                                            {{--
                                            ว่าง
                                            จอง
                                            เช่า
                                            แจ้งย้าย
                                            ปรับปรุง
                                            --}}

                                            @switch($item->status)
                                            @case('ว่าง')
                                            <span class="material-icons text-success">check_box_outline_blank</span>
                                            @break
                                            @case('จอง')
                                            <span class="material-icons text-warning">book_online</span>
                                            @break
                                            @case('เช่า')
                                            <span class="material-icons text-primary">account_circle</span>
                                            @break
                                            @case('แจ้งย้าย')
                                            <span class="material-icons text-danger">record_voice_over</span>
                                            @break
                                            @case('ปรับปรุง')
                                            <span class="material-icons text-default">do_disturb_off</span>
                                            @break
                                            @default
                                            <span class="material-icons text-warning">error</span>
                                            @break
                                        @endswitch

                                        </td>
                                        <td class="td-actions justify-content-center">
                                            <a href="{{ url('/room/' . $item->id) }}" title="View" type="button"
                                                rel="tooltip" class="btn btn-info btn-round mr-2">
                                                <i class="material-icons">search</i>
                                            </a>
                                            <a href="{{ url('/room/' . $item->id . '/edit') }}" title="Edit"
                                                type="button" rel="tooltip" class="btn btn-danger btn-round">
                                                <i class="material-icons">edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper pull-right">
                                {!! $room->appends(['status' => Request::get('status')])->render() !!}
                            </div>
                        </div>

                            {{-- table type --}}
                        <div class="tab-pane" id="types">
                            <table class="table table-hover table-sm" id="dataTableType">
                                <thead class="text-info">
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th class="text-left">ประเภท</th>
                                        <th>ค่าเช่า</th>
                                        <th>ค่าน้ำ</th>
                                        <th>ค่าไฟ</th>
                                        <th>ค่าส่วนกลาง</th>
                                        <th>ค่า Wifi</th>
                                        <th>ค่าจอดรถ</th>
                                        <th>ค่าปรับ</th>
                                        <th>ค่าจอง</th>
                                        <th>ค่ามัดจำ</th>
                                        <th>Actions</th>
                                    </tr>
                                        </thead>
                                <tbody>
                                    @foreach($type as $item)
                                    <tr class="text-center">
                                        <td>
                                            {{ ($type->currentpage()-1) * $type->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-left">{{ $item->name }}</td>
                                        <td>{{ number_format($item->price,2) }}</td>
                                        <td>{{ number_format($item->water,2) }}</td>
                                        <td>{{ number_format($item->power,2) }}</td>
                                        <td>{{ number_format($item->centric,2) }}</td>
                                        <td>{{ number_format($item->wifi,2) }}</td>
                                        <td>{{ number_format($item->vehicle,2) }}</td>
                                        <td>{{ number_format($item->mulct,2) }}</td>
                                        <td>{{ number_format($item->booking,2)}}</td>
                                        <td>{{ number_format($item->doposit,2) }}</td>
                                        <td class="td-actions justify-content-center">
                                            <a href="{{ url('/type/' . $item->id) }}" title="View" type="button"
                                                rel="tooltip" class="btn btn-info btn-round mr-2">
                                                <i class="material-icons">search</i>
                                            </a>
                                            <a href="{{ url('/type/' . $item->id . '/edit') }}" title="Edit"
                                                type="button" rel="tooltip" class="btn btn-danger btn-round">
                                                <i class="material-icons">edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper pull-right">
                                {!! $type->appends(['search' => Request::get('search')])->render() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
