<!-- Modal Store Income-->
<div class="modal fade" id="ModalUpdateIncome" tabindex="-1" role="dialog" aria-labelledby="ModalUpdateIncomeLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="card">
            <div class="modal-content">
                <div class="card-header card-header-info">
                    <h4 class="card-title">แก้ไขบัญชี รายรับ-รายจ่าย</h4>
                    {{-- <p class="category">Category subtitle</p> --}}
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/income/update') }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="col-md">
                            <div class="form-group">
                                <label>รายรับ-รายจ่าย
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" name="type" id="type" style="margin-top: -15px" required>
                                    <option value="รายรับ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายรับ</option>
                                    <option value="รายจ่าย">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายจ่าย</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label>จำนวนเงิน <span class="text-danger">*</span></label>
                                <input class="form-control" id="income" name="income" value="" required>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>หมายเหตุ<span class="text-danger">*</span></label>
                                <select class="form-control" name="remark_item" id="remark_item">
                                    @foreach ($report->inc_remark as $item)
                                    <option value="{{ $item->remark}}">&nbsp;&nbsp;{{ $item->remark}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label>หมายเหตุ อื่นๆ <span class="text-danger">*</span></label>
                                <input class="form-control" id="remark_new" name="remark_new"
                                    placeholder="ถ้าไม่มีในรายการ กรุณาพิมพ์">
                            </div>
                        </div>

                        <div class="col-md text-center mt-4">
                            <input class="d-none" type="hidden" id="id" name="id" value="">
                            <button type="submit" class="btn btn-success btn-round">บันทึกข้อมูล</button>
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
