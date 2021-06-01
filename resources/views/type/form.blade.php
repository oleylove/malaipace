<div class="row">
    <div class="col-md-3 mt-4 ml-5">
        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail img-raised">
                @if (!empty($type->photo))
                    @if(Storage::exists('public/'.$type->photo))
                        <img src="{{ url('/') }}/storage/{{ $type->photo }}" rel="nofollow" alt="...">
                    @else
                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                    @endif
                @else
                    <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                @endif
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
            <div class="">
                <span class="btn btn-raised btn-round btn-warning btn-file" title="Select image" rel="tooltip">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists material-icons">border_color</span>
                    <input type="file" name="photo" id="photo" value="{{ isset($type->photo) ? $type->photo : ''}}"/>
                    <input type="hidden" type="d-none" name="photo_old" id="photo_old" value="{{ isset($type->photo) ? $type->photo : ''}}" />
                </span>
                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput" title="Remove" rel="tooltip">
                    <i class="fa fa-times"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">{{  $formMode === 'edit' ? 'แก้ไขข้อมูลประเภทห้อง' : 'เพิ่มข้อมูลประเภทห้อง' }}</h4>
                        <p class="card-category">กรุณากรอกข้อมูลให้ครบ</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/room/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
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
                <div class="row mt-3">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="name" class="control-label">{{ 'ประเภทห้อง' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="name" type="text" id="name"
                                value="{{ isset($type->name) ? $type->name : ''}}" required>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                            <label for="price" class="control-label">{{ 'ค่าเช่าห้อง' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="price" type="number" id="price"
                                value="{{ isset($type->price) ? $type->price : ''}}" required>
                            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('water') ? 'has-error' : ''}}">
                            <label for="water" class="control-label">{{ 'ค่าน้ำ/หน่วย' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="water" type="number" id="water"
                                value="{{ isset($type->water) ? $type->water : ''}}" required>
                            {!! $errors->first('water', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('power') ? 'has-error' : ''}}">
                            <label for="power" class="control-label">{{ 'ค่าไฟ/หน่วย' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="power" type="number" id="power"
                                value="{{ isset($type->power) ? $type->power : ''}}" required>
                            {!! $errors->first('power', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('centric') ? 'has-error' : ''}}">
                            <label for="centric" class="control-label">{{ 'ค่าส่วนกลาง' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="centric" type="number" id="centric"
                                value="{{ isset($type->centric) ? $type->centric : ''}}" required>
                            {!! $errors->first('centric', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('wifi') ? 'has-error' : ''}}">
                            <label for="wifi" class="control-label">{{ 'ค่า Wifi' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="wifi" type="number" id="wifi"
                                value="{{ isset($type->wifi) ? $type->wifi : ''}}" required>
                            {!! $errors->first('wifi', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('vehicle') ? 'has-error' : ''}}">
                            <label for="vehicle" class="control-label">{{ 'ค่าเช่าที่จอดรถ' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="vehicle" type="number" id="vehicle"
                                value="{{ isset($type->vehicle) ? $type->vehicle : ''}}" required>
                            {!! $errors->first('vehicle', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('mulct') ? 'has-error' : ''}}">
                            <label for="mulct" class="control-label">{{ 'ค่าปรับล่าช้า/วัน' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="mulct" type="number" id="mulct"
                                value="{{ isset($type->mulct) ? $type->mulct : ''}}" required>
                            {!! $errors->first('mulct', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('booking') ? 'has-error' : ''}}">
                            <label for="booking" class="control-label">{{ 'ค่าจองห้อง' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="booking" type="number" id="booking"
                                value="{{ isset($type->booking) ? $type->booking : ''}}" required>
                            {!! $errors->first('booking', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('doposit') ? 'has-error' : ''}}">
                            <label for="doposit" class="control-label">{{ 'ค่ามัดจำ' }}<span class="text-danger"> *</span></label>
                            <input class="form-control" name="doposit" type="number" id="doposit"
                                value="{{ isset($type->doposit) ? $type->doposit : ''}}" required>
                            {!! $errors->first('doposit', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" title="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" rel="tooltip">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

