<div class="modal fade" id="ModalChangePassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">เปลี่ยนรหัสผ่าน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-a was-validated" method="POST" action="{{ route('change.password') }}"
                    accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="col-md mb-1">
                        <div class="form-group">
                            <label for="password">Password Old<span class="text-danger"> * </span>
                            </label>
                            <input id="password" type="password" class="form-control" name="current_password"
                                required>
                        </div>
                    </div>
                    <div class="col-md mb-1">
                        <div class="form-group">
                            <label for="new_password">Password New<span class="text-danger"> * </span>
                            </label>
                            <input id="new_password" type="password" class="form-control" name="new_password"
                                required>
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md mb-3">
                        <div class="form-group">
                            <label for="new_confirm_password">Confirm Password<span class="text-danger"> * </span>
                            </label>
                            <input id="new_confirm_password" type="password" class="form-control"
                                name="new_confirm_password" required>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-b">ยืนยัน</button>
                        <button type="button" class="btn btn-c" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
