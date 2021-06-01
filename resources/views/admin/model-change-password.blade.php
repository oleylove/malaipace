<!-- Modal Change Password-->
<div class="modal fade" id="ModalChangePassword" tabindex="-1" role="dialog" aria-labelledby="ModalChangePasswordLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="card">
            <div class="modal-content">
                <div class="card-header card-header-primary">
                    <div class="row">
                        <div class="col-md">
                            <h4 class="card-title">เปลี่ยนรหัสผ่าน</h4>
                            <p class="category"></p>
                        </div>
                        <div class="col-md">
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="material-icons">cancel</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}"
                        accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label for="password">Password Old<span class="text-danger"> * </span>
                                </label>
                                <input id="password" type="password" class="form-control" name="current_password"
                                    required>
                            </div>
                        </div>
                        <div class="col-md mt-4">
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
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label for="new_confirm_password">Confirm Password<span class="text-danger"> * </span>
                                </label>
                                <input id="new_confirm_password" type="password" class="form-control"
                                    name="new_confirm_password" required>
                            </div>
                        </div>

                        <div class="col-md text-center mt-4">
                            <button type="submit" class="btn btn-success btn-round">ยืนยัน</button>
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
