@extends('admin.app')
@section('title','Malaiplace | แก้ไขข้อมูลซ่อม')
@section('maintenance','active')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title">{{ 'แก้ไขข้อมูลซ่อม' }}</h4>
                        <p class="card-category">{{ 'รหัสแจ้งซ่อม # '.$maintenance->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/maintenance/') }}" title="Back" class="btn btn-warning btn-fab btn-round">
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

                <form method="POST" action="{{ url('/maintenance/' . $maintenance->id) }}" accept-charset="UTF-8"
                    class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
                                <label for="number" class="control-label">{{ 'เลขห้อง' }}</label>
                                <input class="form-control" name="number" type="number" id="number"
                                    value="{{ isset($maintenance->rm_id) ? $maintenance->room->number : ''}}">
                                {!! $errors->first('rm_id', '<p class="help-block">:message</p>') !!}
                            </div>

                        </div>
                        <div class="col-md mt-2">
                            <div class="form-group {{ $errors->has('building') ? 'has-error' : ''}}">
                                <label for="building" class="control-label">{{ 'ตึก' }}</label>
                                <select class="form-control" name="building" id="building" style="margin-top: -17px">
                                    @if(isset($maintenance->rm_id))
                                    <option value="{{ $maintenance->room->building }}">{{ $maintenance->room->building }}</option>
                                    <option value="A">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A</option>
                                    <option value="B">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B</option>
                                    @else
                                    <option value="">เลือกตึก....</option>
                                    <option value="A">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A</option>
                                    <option value="B">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B</option>
                                    @endif
                                </select>
                                {!! $errors->first('rm_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                                <label for="date" class="control-label">{{ 'วันที่แจ้ง' }}</label>
                                @if (isset($maintenance->date))
                                <input class="form-control" type="text"
                                    value="{{ isset($maintenance->date) ? $maintenance->date : ''}}" disabled>
                                @else
                                <input class="form-control" name="date_done" type="datetime-local" id="date_done"
                                    value="{{ isset($maintenance->date) ? $maintenance->date : ''}}" required>
                                @endif

                                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('ready_date') ? 'has-error' : ''}}">
                                <label for="ready_date" class="control-label">{{ 'วันที่ต้องการซ่อม' }}</label>
                                @if (isset($maintenance->ready_date))
                                <input class="form-control" type="text"
                                    value="{{ isset($maintenance->ready_date) ? $maintenance->ready_date : ''}}" disabled>
                                @else
                                <input class="form-control" name="date_done" type="datetime-local" id="date_done"
                                    value="{{ isset($maintenance->ready_date) ? $maintenance->ready_date : ''}}" required>
                                @endif

                                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
                                <label for="detail" class="control-label">{{ 'รายละเอียดการซ่อม' }}</label>
                                <input class="form-control" name="detail" type="text" id="detail"
                                value="{{ isset($maintenance->detail) ? $maintenance->detail : ''}}">
                                {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mt-2">
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                <label for="status" class="control-label">{{ 'สถานะซ่อม' }}</label>
                                <select class="form-control" name="status" id="status" style="margin-top: -17px" required>
                                    @if(isset($maintenance->status))
                                    <option value="{{ $maintenance->status }}">{{ $maintenance->status }}</option>
                                    <option value="แจ้งซ่อม">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แจ้งซ่อม</option>
                                    <option value="ยืนยันรับแจ้ง">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยืนยันรับแจ้ง</option>
                                    <option value="ยกเลิกแจ้งซ่อม">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยกเลิกแจ้งซ่อม</option>
                                    <option value="ซ่อมเสร็จแล้ว">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ซ่อมเสร็จแล้ว</option>
                                    @else
                                    <option value="">เลือกสถานะ.....</option>
                                    <option value="แจ้งซ่อม">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แจ้งซ่อม</option>
                                    <option value="ยืนยันรับแจ้ง">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยืนยันรับแจ้ง</option>
                                    <option value="ยกเลิกแจ้งซ่อม">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยกเลิกแจ้งซ่อม</option>
                                    <option value="ซ่อมเสร็จแล้ว">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ซ่อมเสร็จแล้ว</option>
                                    @endif
                                </select>
                                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                <label for="price" class="control-label">{{ 'ค่าซ่อม' }}</label>
                                <input class="form-control" name="price" type="number" id="price"
                                    value="{{ isset($maintenance->price) ? $maintenance->price : ''}}">
                                {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('date_done') ? 'has-error' : ''}}">
                                <label for="date_done" class="control-label">{{ 'วันซ่อมเสร็จ' }}</label>
                                @if (isset($maintenance->date_done))
                                <input class="form-control" type="text"
                                    value="{{ isset($maintenance->date_done) ? $maintenance->date_done : ''}}" disabled>
                                @else
                                <input class="form-control" name="date_done" type="datetime-local" id="date_done"
                                    value="{{ isset($maintenance->date_done) ? $maintenance->date_done : ''}}" required>
                                @endif
                                {!! $errors->first('date_done', '<p class="help-block">:message</p>') !!}
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mt-4 text-right">
                            <div class="form-group">
                                <input class="d-none" name="Get_Notified" type="hidden" id="Get_Notified"
                                value="แก้ไข">
                                <input class="btn btn-primary" type="submit" value="บันทึกการแก้ไขข้อมูล">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
