<div class="row">
    <div class="col-md-3 text-center">
        <div class="col-md">
            <label for="photo" class="control-label">{{ 'รูปภาพประกาศ (ถ้ามี)' }}</label>
        </div>
    <div class="col-md">
        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail img-raised">
                @if (!empty($notice->photo))
                    @if(Storage::exists('public/'.$notice->photo))
                        <img src="{{ url('/') }}/storage/{{ $notice->photo }}" class="img-fluid" rel="nofollow" alt="...">
                    @else
                        <img src="{{ asset('assets/images/lostitem.png')  }}" class="img-fluid" rel="nofollow" alt="...">
                    @endif
                @else
                    <img src="{{ asset('assets/images/selectimage.png')  }}" class="img-fluid" rel="nofollow" alt="...">
                @endif
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
            <div class="">
                <span class="btn btn-raised btn-round btn-warning btn-file" title="Select image" rel="tooltip">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists material-icons">border_color</span>
                    <input type="file" name="photo" id="photo" value="{{ isset($notice->photo) ? $notice->photo : ''}}"/>
                    <input type="hidden" type="d-none" name="photo_old" id="photo_old" value="{{ isset($notice->photo) ? $notice->photo : ''}}" />
                </span>
                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput" title="Remove image" rel="tooltip">
                    <i class="fa fa-times"></i></a>
            </div>
        </div>
    </div>
</div>

    <div class="col-md">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">{{  $formMode === 'edit' ? 'แก้ไขข้อมูลประกาศ' : 'เพิ่มข้อมูลประกาศ' }}</h4>
                        <p class="card-category">กรุณากรอกข้อมูลให้ครบ</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/notice/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
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

                <div class="row">
                    <div class="col-md mt-4">
                        <div class="form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
                            <label for="detail" class="control-label">{{ 'รายละเอียดประกาศ' }}<span class="text-danger"> *</span></label>
                            <textarea class="form-control" rows="3" name="detail" type="textarea"
                                id="detail">{{ isset($notice->detail) ? $notice->detail : ''}}</textarea>
                            {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-10 mt-4">
                        <div class="form-group form-file-upload form-file-multiple">
                            <label for="file" class="control-label">{{ 'เอกสารประกาศ (ถ้ามี)' }}</label>
                            <input class="inputFileHidden" name="file" type="file" id="file" multiple="">
                            <input class="d-none" name="file_old" type="hidden" id="file_old"
                                value="{{ isset($notice->file) ? $notice->file : ''}}" multiple="">
                            <div class="input-group">
                                <input type="text" class="form-control inputFileVisible"
                                    value="{{ isset($notice->file) ? $notice->file : ''}}">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-fab btn-round btn-primary" title="Upload" rel="tooltip">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </span>
                            </div>
                            {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md float-left">
                        @if (!empty($notice->file))
                            @if(Storage::exists('public/'.$notice->file))
                                <a href="{{ url('/') }}/storage/{{ $notice->file }}" target="_blank" title="View PDF" rel="tooltip">
                                    <img src="{{ asset('assets/images/pdf.png')  }}" class="img-fluid" rel="nofollow" alt="...">
                                </a>
                                @else
                                <img src="{{ asset('assets/images/lostitem.png')  }}" class="img-fluid" rel="nofollow" alt="...">
                            @endif
                        @else
                            <img src="{{ asset('assets/images/nopdf.png')  }}" class="img-fluid" rel="nofollow" alt="...">
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}"
                            title="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" rel="tooltip">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

