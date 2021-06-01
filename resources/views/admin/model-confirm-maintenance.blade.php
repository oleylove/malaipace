
    <!-- Modal Show Confirm Maintenance-->
    <div class="modal fade" id="ModalConfirmMaintenance" tabindex="-1" role="dialog"
        aria-labelledby="ModalConfirmMaintenanceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="card">
                <div class="modal-content">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">ยืนยันการซ่อมบำรุง</h4>
                        <p class="category">Category subtitle</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mtn.confirm') }}" accept-charset="UTF-8"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="row mt-3">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="name" class="">{{ 'รายละเอียดการซ่อม : ' }}</label>
                                        <textarea class="form-control" name="detail" id="detail" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="name" class="">{{ 'ค่าซ่อมบำรุง : ' }} <span class="text-danger"> *
                                            </span> </label>
                                        <input class="form-control" name="price" type="number" id="price" min="1"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md text-center mnt-id">
                                    <input class="d-none" name="id" type="hidden" id="id" value="" required>
                                    <button type="submit" class="btn btn-success btn-round">ยืนยันการซ่อมบำรุง</button>
                                    <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
