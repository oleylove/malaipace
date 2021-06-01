@extends('admin.app')
@section('title','Malaiplace | แจ้งซ่อมบำรุง')
@section('maintenance','active')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title">{{ 'แจ้งซ่อมบำรุง' }}</h4>
                        <p class="card-category">กรุณากรอกข้อมูลให้ครบ</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/maintenance/') }}" title="Back" class="btn btn-warning btn-fab btn-round">
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

                <form method="POST" action="{{ url('/maintenance') }}" accept-charset="UTF-8" class="form-horizontal"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label for="number" class="control-label">{{ 'เลขห้อง (ถ้ามี)' }}</label>
                                <input class="form-control" name="number" type="number" id="number">
                            </div>
                        </div>
                        <div class="col-md mt-2">
                            <div class="form-group">
                                <label for="building" class="control-label">{{ 'ตึก (ถ้ามี)' }}</label>
                                <select class="form-control" name="building" id="building" style="margin-top: -17px">
                                    <option value="">เลือกตึก....</option>
                                    <option value="A">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A</option>
                                    <option value="B">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mt-2">
                            <div class="form-group">
                                <label for="status" class="control-label">{{ 'สถานะซ่อม' }}
                                    <span class="text-danger"> *</span>
                                    </label>
                                <select class="form-control" name="status" id="status" style="margin-top: -17px"
                                    required>
                                    <option value="">เลือกสถานะ</option>
                                    <option value="แจ้งซ่อม"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; แจ้งซ่อม</option>
                                    <option value="กำลังซ่อม">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กำลังซ่อม</option>
                                    <option value="ยกเลิกแจ้งซ่อม">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยกเลิกแจ้งซ่อม</option>
                                    <option value="ซ่อมเสร็จแล้ว">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ซ่อมเสร็จแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label for="ready_date" class="control-label">{{ 'วันที่ต้องการซ่อม' }}
                                    <span class="text-danger"> *</span>
                                    </label>
                                <input class="form-control" name="ready_date" type="datetime-local" id="ready_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mt-4">
                            <div class="form-group">
                                <label for="detail" class="control-label">{{ 'รายละเอียดการซ่อม' }}
                                    <span class="text-danger"> *</span>
                                </label>
                                <textarea class="form-control" rows="3" name="detail" type="text" id="detail" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mt-4 text-right">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="บันทึกข้อมูล">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
