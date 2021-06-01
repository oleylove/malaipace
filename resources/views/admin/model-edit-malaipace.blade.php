<!-- Modal edit config webconfig-->
<div class="modal fade bd-example-modal-lg" id="ModalEditConfig" tabindex="-1" role="dialog" aria-labelledby="ModalEditConfigLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="card">
            <div class="modal-content">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขข้อมูลอพาร์ทเม้นท์</h4>
                    <p class="category">กรุณากรอกข้อมูลให้ครบ</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/webconfig/' . $webconfig->id) }}" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        @if (!empty($webconfig->logo))
                                        @if(Storage::exists('public/'.$webconfig->logo))
                                                <img src="{{ url('/') }}/storage/{{ $webconfig->logo }}" rel="nofollow" alt="...">
                                            @else
                                                <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                            @endif
                                        @else
                                            <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                        @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    <div>
                                        <span class="btn btn-raised btn-round btn-warning btn-file btn-sm" title="Select image" rel="tooltip">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists material-icons">border_color</span>
                                            <input type="file" name="logo" id="logo"/>
                                            <input type="hidden" type="d-none" name="logo_old" id="logo_old"
                                                value="{{ isset($webconfig->logo) ? $webconfig->logo : '' }}"/>
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists btn-sm" data-dismiss="fileinput" title="Remove" rel="tooltip">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md mt-4">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="title" class="">Title <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" id="title" name="title" value="{{ isset($webconfig->title) ? $webconfig->title : '' }}" required />
                                    </div>
                                </div>
                                <div class="col-md mt-4">
                                    <div class="form-group">
                                        <label for="website" class="">URL เว็บ <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" id="website" name="website" value="{{ isset($webconfig->website) ? $webconfig->website : '' }}" required />
                                    </div>
                                </div>
                                <div class="col-md mt-4">
                                    <div class="form-group">
                                        <label for="address" class="">ที่อยู่หอพัก <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" id="address" name="address" value="{{ isset($webconfig->address) ? $webconfig->address : '' }}" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md mt-2 text-center">
                            <input class="d-none" name="id" type="hidden" id="id" value="{{ $webconfig->id }}" required>
                            <input class="d-none" name="mode" type="hidden" id="mode" value="config" required>
                            <button type="submit" class="btn btn-success btn-round" title="Update" rel="tooltip">
                                Update
                            </button>
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal" title="Close" rel="tooltip">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
