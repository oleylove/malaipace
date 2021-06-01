@extends('admin.app')
@section('title','Malaiplace | ออกใบแจ้งหนี้')
@section('invoice','active')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 col-lg-12">

        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title">{{ 'ออกใบแจ้งหนี้' }}</h4>
                        <p class="card-category">กรุณากรอกเลขมิเตอร์น้ำ มิเตอร์ไฟให้ถูกต้อง</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/invoice/') }}" title="Back" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
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

                <form method="POST" action="{{ url('/invoice') }}" accept-charset="UTF-8"
                    class="" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    @if($rooms->count() == 0)
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="button">ไม่มีรายการเช่า</button>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover table-sm" id="dataTableMeter">
                            <thead class="text-primary">
                                <tr class="text-center">
                                    <th width="60px">ลำดับ</th>
                                    <th width="100px">ตึก</th>
                                    <th width="100px">ห้อง</th>
                                    <th>มิเตอร์น้ำล่าสุด</th>
                                    <th class="text-left">กรอกมิเตอร์น้ำใหม่</th>
                                    <th>มิเตอร์ไฟล่าสุด</th>
                                    <th class="text-left">กรอกมิเตอร์ไฟใหม่</th>
                                    <th>แก้ไขล่าสุด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}
                                    <td>{{ $item->building }}</td>
                                    <td>{{ $item->number }}</td>

                                    <td>{{ $item->meter_wn }}
                                        <input class="d-none" name="meter_wn_old{{ $item->id }}" type="hidden"
                                            id="meter_wn_old{{ $item->id }}" required>
                                    </td>
                                    <td class="text-left">
                                        <input class="form-control" style="width:60%;"
                                            name="meter_wn{{ $item->id }}" type="number" id="meter_wn{{ $item->id }}"
                                            min="{{ $item->meter_wn }}" required>
                                    </td>

                                    <td>{{ $item->meter_pn }}
                                        <input class="d-none" name="meter_pn_old{{ $item->id }}" type="hidden"
                                            id="meter_pn_old{{ $item->id }}" required>
                                    </td>
                                    <td class="text-left">
                                        <input class="form-control" style="width:60%;"
                                            name="meter_pn{{ $item->id }}" type="number" id="meter_pn{{ $item->id }}"
                                            style="width:60%;" min="{{ $item->meter_pn }}" required>
                                        <input class="d-none" type="hidden" name="id{{ $item->id }}"
                                            id="id{{ $item->id }}" value="{{ $item->id }}" style="width:60%;" required>
                                    </td>

                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group pull-right">
                        <button class="btn btn-success btn-round btn-lg" type="submit"> บันทึกข้อมูล
                            เพื่อออกใบแจ้งหนี้ประจำเดือน</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
