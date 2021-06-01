<div class="row">
    <div class="col-md-3 mt-4 ml-5">
        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail img-raised">
                @if (!empty($user->photo))
                    @if(Storage::exists('public/'.$user->photo))
                        <img src="{{ url('/') }}/storage/{{ $user->photo }}" rel="nofollow" alt="...">
                    @else
                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                    @endif
                @else
                    <img src="{{ asset('assets/images/selectuser.png')  }}" rel="nofollow" alt="...">
                @endif
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
            <div class="">
                <span class="btn btn-raised btn-round btn-warning btn-file" title="Select image" rel="tooltip">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists material-icons">border_color</span>
                    <input type="file" name="photo" id="photo" value="{{ isset($user->photo) ? $user->photo : ''}}"/>
                    <input type="hidden" type="d-none" name="photo_old" id="photo_old" value="{{ isset($user->photo) ? $user->photo : ''}}" />
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
                        <h4 class="card-title">{{  $formMode === 'edit' ? 'แก้ไขข้อมูลสมาชิกใหม่' : 'เพิ่มข้อมูลสมาชิกใหม่' }}</h4>
                        <p class="card-category">กรุณากรอกข้อมูลให้ครบ</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/user/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
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
                <div class="row mt-4">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="name" class="">{{ 'ชื่อ-สกุล' }}<span class="text-danger"> *
                                </span></label>
                            <input class="form-control" name="name" type="text" id="name"
                                value="{{ isset($user->name) ? $user->name : ''}}" required>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                            <label for="phone" class="">{{ 'เบอร์โทร' }}<span class="text-danger"> *
                                </span></label>
                            <input class="form-control" name="phone" type="text" id="phone"
                                value="{{ isset($user->phone) ? $user->phone : ''}}"
                                pattern="^0([8|9|6])([0-9]{1})-([0-9]{3})-([0-9]{4})" onkeyup="autoTab2(this,2)"
                                required>
                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="">{{ 'อีเมล' }}<span class="text-danger"> *
                                </span></label>
                            <input class="form-control" name="email" type="email" id="email"
                                value="{{ isset($user->email) ? $user->email : ''}}" required>
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
                            <label for="age" class="">{{ 'อายุ' }}<span class="text-danger"> * </span></label>
                            <input class="form-control" name="age" type="number" id="age"
                                value="{{ isset($user->age) ? $user->age : ''}}" pattern="([1-9]{1})([0-9]{1})"
                                min="9" max="99" required>
                            {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password" class="">{{ 'รหัสผ่าน' }}<span class="text-danger"> *
                                </span></label>
                            <input class="form-control" name="password" type="password" id="password"
                                value="{{ isset($user->password) ? $user->password : ''}}" min="8" max="99"
                                required>
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="password_confirmation" class="">{{ 'ยืนยันรหัสผ่าน' }}<span
                                    class="text-danger"> * </span></label>
                            <input class="form-control" name="password_confirmation" type="password"
                                id="password_confirmation" value="{{ isset($user->password) ? $user->password : ''}}"
                                min="9" max="99" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md align-self-center">
                        <div class="form-group  {{ $errors->has('role') ? 'has-error' : ''}}">
                            <label class="">{{ 'ตำแหน่ง' }}<span class="text-danger"> * </span></label>
                            <select class="form-control" id="role" name="role" required>
                                @if (isset($user->role))
                                <option value="{{ $user->role }}">{{ $user->role == 'admin' ? 'ผู้ดูแลหอพัก' : 'สมาชิก' }}</option>
                                <option value="admin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ดูแลหอพัก</option>
                                <option value="guest">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้เช่า</option>
                                @else
                                <option value="">select</option>
                                <option value="admin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;admin</option>
                                <option value="guest">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;employee</option>
                                @endif
                            </select>
                            {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md align-self-center">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                            <label class="">{{ 'สถานะ' }}<span class="text-danger"> * </span></label>
                            <select class="form-control" id="status" name="status" required>
                                @if (isset($user->status))
                                <option value="{{ $user->status }}">{{ $user->status }}</option>
                                <option value="สมาชิกใหม่">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สมาชิกใหม่</option>
                                <option value="ผู้ดูแลหอพัก">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ดูแลหอพัก</option>
                                @else
                                <option value="">select</option>
                                <option value="สมาชิกใหม่">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สมาชิกใหม่</option>
                                <option value="ผู้ดูแลหอพัก">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ดูแลหอพัก</option>
                                @endif
                            </select>
                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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

