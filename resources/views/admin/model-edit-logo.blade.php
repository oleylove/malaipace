<!-- Modal edit slide webconfig-->
<div class="modal fade" id="ModalEditLogo" tabindex="-1" role="dialog" aria-labelledby="ModalEditLogoLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="card">
            <div class="modal-content">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขข้อมูลบัญชีธนาคาร</h4>
                    <p class="category">แนะนำขนาดรูป 90 x 90 </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/webconfig/' . $webconfig->id) }}" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="col-md text-center">
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                <div class="fileinput-new thumbnail img-raised">
                                    <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                <div>
                                    <span class="btn btn-raised btn-round btn-warning btn-file btn-sm" title="Select logo" rel="tooltip">
                                        <span class="fileinput-new">Select logo</span>
                                        <span class="fileinput-exists material-icons">border_color</span>
                                        <input type="file" name="photo_logo" id="photo_logo"/>
                                    </span>
                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists btn-sm" data-dismiss="fileinput" title="Remove" rel="tooltip">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="bankname" class="control-label">
                                    {{ 'ข้อมูลบัญชี' }} <span class="text-danger"> * </span>
                                </label>
                                <input class="form-control" name="bankname" type="bankname" id="bankname"
                                placeholder="Ex.เลขบัญชี 123-5-64895-9 ชื่่อบัญชี Apartment สาขา มาลัยเพลส">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="status" class="control-label">{{ 'เลือกธนาคาร...' }}
                                    <span class="text-danger"> * </span>
                                </label>
                                <select class="form-control" name="bank_select" id="bank_select" style="margin-top: -15px" required>
                                    <option value="">Select....</option>
                                    <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ธนาคารกรุงเทพ</option>
                                    <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ธนาคารกสิกรไทย</option>
                                    <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ธนาคารไทยพาณิชย์</option>
                                    <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ธนาคารกรุงศรีอยุธยา</option>
                                </select>
                                {!! $errors->first('typ_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md text-center">
                            <input class="d-none" name="id" type="hidden" id="id" value="{{ $webconfig->id }}" required>
                            <input class="d-none" name="mode" type="hidden" id="mode" value="bank" required>
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
