<div class="row">
    <div class="col-md">
        <div class="row text-center">
            <div class="col-md">
                {{-- photo1 'รูปในห้อง-1 --}}
                <label for="photo1" class="control-label">{{ 'รูปในห้อง-1 แนะนำขนาด 1920 x 960' }}</label>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-raised">
                        @if (!empty($room->photo1))
                            @if(Storage::exists('public/'.$room->photo1))
                                <img src="{{ url('/') }}/storage/{{ $room->photo1 }}" rel="nofollow" alt="...">
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
                            <input type="file" name="photo1" id="photo1"
                                value="{{ isset($room->photo1) ? $room->photo1 : ''}}" />
                            <input type="hidden" type="d-none" name="photo1_old" id="photo1_old"
                                value="{{ isset($room->photo1) ? $room->photo1 : ''}}" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput" title="Remove" rel="tooltip">
                            <i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                {{-- photo2 'รูปในห้อง-2 --}}
                <label for="photo2" class="control-label">{{ 'รูปในห้อง-2 แนะนำขนาด 1920 x 960' }}</label>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-raised">
                        @if (!empty($room->photo2))
                            @if(Storage::exists('public/'.$room->photo2))
                                <img src="{{ url('/') }}/storage/{{ $room->photo2 }}" rel="nofollow" alt="...">
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
                            <input type="file" name="photo2" id="photo2"
                                value="{{ isset($room->photo2) ? $room->photo2 : ''}}" />
                            <input type="hidden" type="d-none" name="photo2_old" id="photo2_old"
                                value="{{ isset($room->photo2) ? $room->photo2 : ''}}" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput" title="Remove" rel="tooltip">
                            <i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md">
                {{-- photo3 'รูปหลังห้อง --}}
                <label for="photo3" class="control-label">{{ 'รูปหลังห้อง แนะนำขนาด 1920 x 960' }}</label>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-raised">
                        @if (!empty($room->photo3))
                            @if(Storage::exists('public/'.$room->photo3))
                                <img src="{{ url('/') }}/storage/{{ $room->photo3 }}" rel="nofollow" alt="...">
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
                            <input type="file" name="photo3" id="photo3"
                                value="{{ isset($room->photo3) ? $room->photo3 : ''}}" />
                            <input type="hidden" type="d-none" name="photo3_old" id="photo3_old"
                                value="{{ isset($room->photo3) ? $room->photo3 : ''}}" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput" title="Remove" rel="tooltip">
                            <i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                {{-- photo4 'รูปห้องน้ำ --}}
                <label for="photo4" class="control-label">{{ 'รูปห้องน้ำ แนะนำขนาด 1920 x 960' }}</label>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-raised">
                        @if (!empty($room->photo4))
                            @if(Storage::exists('public/'.$room->photo4))
                                <img src="{{ url('/') }}/storage/{{ $room->photo4 }}" rel="nofollow" alt="...">
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
                            <input type="file" name="photo4" id="photo4"
                                value="{{ isset($room->photo4) ? $room->photo4 : ''}}" />
                            <input type="hidden" type="d-none" name="photo4_old" id="photo4_old"
                                value="{{ isset($room->photo4) ? $room->photo4 : ''}}" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput" title="Remove" rel="tooltip">
                            <i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">{{  $formMode === 'edit' ? 'แก้ไขข้อมูลห้องเช่า' : 'เพิ่มข้อมูลห้องเช่า' }}</h4>
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

                <div class="col-md">

                    <div class="row mt-3">
                        <div class="col-md">
                            <div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
                                <label for="number" class="control-label">
                                    {{ 'เลขห้อง' }} <span class="text-danger"> * </span>
                                </label>
                                <input class="form-control" name="number" type="text" id="number"
                                    value="{{ isset($room->number) ? $room->number : '' }}" required>
                                {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group {{ $errors->has('building') ? 'has-error' : ''}}">
                                <label for="building" class="control-label">
                                    {{ 'ตึก' }} <span class="text-danger"> * </span>
                                </label>
                                <input class="form-control" name="building" type="text" id="building"
                                    value="{{ isset($room->building) ? $room->building : '' }}" required>
                                {!! $errors->first('building', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                <label for="status" class="control-label">
                                    {{ 'สถานะห้อง' }} <span class="text-danger"> * </span>
                                </label>
                                <select class="form-control" name="status" id="status" required>
                                    @if(isset($room->status))
                                    <option value="{{ isset($room->status) ? $room->status : 'ว่าง' }}">{{ $room->status }}
                                    </option>
                                    <option value="{{ "ว่าง" }}">ว่าง</option>
                                    <option value="{{ "จอง" }}">จอง</option>
                                    <option value="{{ "เช่า" }}">เช่า</option>
                                    <option value="{{ "แจ้งย้าย" }}">แจ้งย้าย</option>
                                    <option value="{{ "ปรับปรุง" }}">ปรับปรุง</option>
                                    @else
                                    <option value="">เลือกสถานะห้อง....</option>
                                    <option value="{{ "ว่าง" }}">ว่าง</option>
                                    <option value="{{ "จอง" }}">จอง</option>
                                    <option value="{{ "เช่า" }}">เช่า</option>
                                    <option value="{{ "แจ้งย้าย" }}">แจ้งย้าย</option>
                                    <option value="{{ "ปรับปรุง" }}">ปรับปรุง</option>
                                    @endif
                                </select>
                                {!! $errors->first('typ_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group {{ $errors->has('typ_id') ? 'has-error' : ''}}">
                                <label for="typ_id" class="control-label">
                                    {{ 'ประเภทห้อง' }} <span class="text-danger"> * </span>
                                </label>
                                <select class="form-control" name="typ_id" id="typ_id" required>
                                    @if(isset($room->typ_id))
                                    <option value="{{ isset($room->typ_id) ? $room->typ_id : '' }}">{{ $room->type->name }}
                                    </option>
                                    @foreach($type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    @else
                                    <option value="">เลือกประเภทห้อง....</option>
                                    @foreach($type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                {!! $errors->first('typ_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md">
                            <div class="form-group {{ $errors->has('meter_wn') ? 'has-error' : ''}}">
                                <label for="meter_wn" class="control-label">
                                    {{ 'มิเตอร์น้ำ' }} <span class="text-danger"> * </span>
                                </label>
                                <input class="form-control" name="meter_wn" type="number" id="meter_wn"
                                    value="{{ isset($room->meter_wn) ? $room->meter_wn : 0 }}" required>
                                {!! $errors->first('meter_wn', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group {{ $errors->has('meter_pn') ? 'has-error' : ''}}">
                                <label for="meter_pn" class="control-label">
                                    {{ 'มิเตอร์ไฟ' }} <span class="text-danger"> * </span>
                                </label>
                                <input class="form-control" name="meter_pn" type="number" id="meter_pn"
                                    value="{{ isset($room->meter_pn) ? $room->meter_pn : 0 }}" required>
                                {!! $errors->first('meter_pn', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}"  title="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" rel="tooltip">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
