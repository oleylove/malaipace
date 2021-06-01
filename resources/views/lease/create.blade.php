@extends('admin.app')
@section('title','Malaiplace | ทำสัญญาเช่าห้อง')
@section('lease','active')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 col-lg-12">

        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title">{{ 'ทำสัญญาเช่าห้อง' }}</h4>
                        <p class="card-category">กรุณากรอกข้อมูลให้ครบ</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/lease/') }}" title="Back" class="btn btn-warning btn-fab btn-round">
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

                <form method="POST" action="{{ url('/lease') }}" accept-charset="UTF-8" class="form-horizontal"
                    enctype="multipart/form-data" id="formLease">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label class="control-label">{{ 'ห้อง' }}<span class="text-danger"> *</span></label>
                                <input class="form-control"
                                    value="{{ isset($lease->room->number) ? $lease->room->number : ''}}" disabled>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label class="control-label">{{ 'ตึก' }}<span class="text-danger"> *</span></label>
                                <input class="form-control"
                                    value="{{ isset($lease->room->building) ? $lease->room->building : ''}}" disabled>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label class="control-label">{{ 'ประเภทห้อง' }}<span class="text-danger"> *</span></label>
                                <input class="form-control"
                                    value="{{ isset($lease->room->type->name) ? $lease->room->type->name : ''}}" disabled>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('meter_ws') ? 'has-error' : ''}}">
                                <label for="meter_ws" class="control-label">{{ 'มิเตอร์น้ำเริ่มต้น' }}<span class="text-danger"> *</span></label>
                                <input class="form-control" name="meter_ws" type="number" id="meter_ws"
                                    value="{{ isset($lease->meter_ws) ? $lease->meter_ws : $lease->room->meter_wn}}" required>
                                {!! $errors->first('meter_ws', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('meter_ps') ? 'has-error' : ''}}">
                                <label for="meter_ps" class="control-label">{{ 'มิเตอร์ไฟเริ่มต้น' }}<span class="text-danger"> *</span></label>
                                <input class="form-control" name="meter_ps" type="number" id="meter_ps"
                                    value="{{ isset($lease->meter_ps) ? $lease->meter_ps : $lease->room->meter_pn}}"
                                    required>
                                {!! $errors->first('meter_ps', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('idcard') ? 'has-error' : ''}}">
                                <label for="idcard" class="control-label">{{ 'รหัสบัตรผู้เช่า' }}<span class="text-danger"> *</span></label>
                                <input class="form-control" name="idcard" type="text" id="idcard" autocomplete="off"
                                    pattern="([0-9]{1})-([0-9]{4})-([0-9]{5})-([0-9]{2})-([0-9]{1})"
                                    onkeyup="autoTab2(this,1)" value="{{ isset($lease->idcard) ? $lease->idcard : ''}}"
                                    required>
                                {!! $errors->first('idcard', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="control-label">{{ 'ชื่อผู้เช่า' }}<span class="text-danger"> *</span></label>
                                <input class="form-control" name="name" type="text" id="name"
                                    value="{{ isset($lease->user->name) ? $lease->user->name : ''}}" required>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                <label for="phone" class="control-label">{{ 'เบอร์โทร' }}<span class="text-danger"> *</span></label>
                                <input class="form-control" name="phone" type="text" id="phone"
                                    pattern="^0([8|9|6])([0-9]{1})-([0-9]{3})-([0-9]{4})" onkeyup="autoTab2(this,2)"
                                    autocomplete="off"
                                    value="{{ isset($lease->user->phone) ? $lease->user->phone : ''}}" required>
                                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
                                <label for="age" class="control-label">{{ 'อายุ' }}<span class="text-danger"> *</span></label>
                                <input class="form-control" name="age" type="number" id="age" min="18"
                                    pattern="([1-9]{1})([0-9]{1})"
                                    value="{{ isset($lease->user->age) ? $lease->user->age : ''}}" required>
                                {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-2">
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                                <label for="gender" class="control-label">{{ 'เพศ' }}<span class="text-danger"> *</span></label>
                                <select class="form-control" name="gender" id="gender" style="margin-top: -17px" required>
                                    @if (isset($lease->user->gender))
                                    <option value="{{ $lease->user->gender }}">{{ $lease->user->gender }}</option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                    @else
                                    <option value="">เลือกเพศ . . .</option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                    @endif
                                </select>
                                {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mt-2">
                            <div class="form-group {{ $errors->has('vehicle') ? 'has-error' : ''}}">
                                <label for="vehicle" class="control-label">{{ 'รถยนต์/รถจักรยานยนต์' }}<span class="text-danger"> *</span></label>
                                <select class="form-control" name="vehicle" id="vehicle" style="margin-top: -17px" required>
                                    @if (isset($lease->vehicle))
                                    <option value="{{ $lease->vehicle }}">{{ $lease->vehicle }}</option>
                                    <option value="รถยนต์">รถยนต์</option>
                                    <option value="รถจักรยานยนต์">รถจักรยานยนต์</option>
                                    <option value="รถยนต์/รถจักรยานยนต์">รถยนต์/รถจักรยานยนต์</option>
                                    <option value="ไม่มี">ไม่มี</option>
                                    @else
                                    <option value="">กรุณาเลือก . . .</option>
                                    <option value="รถยนต์">รถยนต์</option>
                                    <option value="รถจักรยานยนต์">รถจักรยานยนต์</option>
                                    <option value="รถยนต์/รถจักรยานยนต์">รถยนต์/รถจักรยานยนต์</option>
                                    <option value="ไม่มี">ไม่มี</option>
                                    @endif
                                </select>
                                {!! $errors->first('vehicle', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group {{ $errors->has('vehicle_reg') ? 'has-error' : ''}}">
                                <label for="vehicle_reg" class="control-label">{{ 'ทะเบียนรถ' }}<span class="text-danger"> *</span></label>
                                <input class="form-control" name="vehicle_reg" type="text" id="vehicle_reg"
                                    value="{{ isset($lease->vehicle_reg) ? $lease->vehicle_reg : ''}}" required>
                                {!! $errors->first('vehicle_reg', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-md mt-2">
                            <div class="form-group {{ $errors->has('typ_wifi') ? 'has-error' : ''}}">
                                <label for="typ_wifi" class="control-label">{{ 'WiFi' }}<span class="text-danger"> *</span></label>
                                <select class="form-control" name="typ_wifi" id="typ_wifi" style="margin-top: -17px" required>
                                    <option value="">กรุณาเลือก . . .</option>
                                    <option value="no">ไม่ต้องการ</option>
                                    <option value="yes">ต้องการ</option>
                                </select>

                                {!! $errors->first('typ_wifi', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-2">
                            <div class="form-group {{ $errors->has('typ_vehicle') ? 'has-error' : ''}}">
                                <label for="typ_vehicle" class="control-label">{{ 'ที่จอดรถ' }}<span class="text-danger"> *</span></label>
                                <select class="form-control" name="typ_vehicle" id="typ_vehicle" style="margin-top: -17px" required>
                                    <option value="">กรุณาเลือก . . .</option>
                                    <option value="no">ไม่ต้องการ</option>
                                    <option value="yes">ต้องการ</option>
                                </select>
                                {!! $errors->first('typ_vehicle', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-2">
                            <div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
                                <label for="number" class="control-label">{{ 'จำนวนผู้อาศัย' }}<span class="text-danger"> *</span></label>
                                <select class="form-control" name="number" id="number" style="margin-top: -17px" required>
                                    @if (isset($lease->number))
                                    <option value="{{ $lease->number }}">{{ $lease->number }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    @else
                                    <option value="">กรุณาเลือก . . .</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    @endif
                                </select>
                                {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row align-self-center">
                        <div class="col-md mt-4">
                            <div class="form-group form-file-upload form-file-multiple">
                                <label for="idcard_doc" class="control-label">{{ 'สำเนาบัตรผู้เช่า' }}<span
                                        class="text-danger"> * </span></label>
                                <input class="inputFileHidden" name="idcard_doc" type="file" id="idcard_doc" multiple="">
                                <div class="input-group">
                                    <input type="text" class="form-control inputFileVisible" id="idcard_doc_text"
                                        value="{{ isset($lease->idcard_doc) ? $lease->idcard_doc : ''}}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-fab btn-round btn-danger">
                                            <i class="material-icons">attach_file</i>
                                        </button>
                                    </span>
                                </div>
                                {!! $errors->first('idcard_doc', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group form-file-upload form-file-multiple {{ $errors->has('lease_doc') ? 'has-error' : ''}}">
                                <label for="lease_doc" class="">{{ 'สัญญาเช่าห้อง' }}
                                    <span class="text-danger"> *</span></label>
                                <input class="inputFileHidden" name="lease_doc" type="file" id="lease_doc" multiple="">
                                <div class="input-group">
                                    <input type="text" class="form-control inputFileVisible" id="lease_doc_text"
                                        value="{{ isset($lease->lease_doc) ? $lease->lease_doc : ''}}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-fab btn-round btn-danger">
                                            <i class="material-icons">attach_file</i>
                                        </button>
                                    </span>
                                </div>
                                {!! $errors->first('lease_doc', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mt-5">
                            <div class="form-group">
                                <input class="d-none" type="hidden" name="id" id="id" value="{{ isset($lease->id) ? $lease->id : ''}}" required>
                                <input class="btn btn-primary" type="submit" value="บันทึกข้อมูลทำสัญญา">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
