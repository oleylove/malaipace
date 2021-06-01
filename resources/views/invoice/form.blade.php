<div class="row">
    <div class="col-md-3 mt-4">
        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail img-raised">
                @if (!empty($invoice->slip))
                    @if(Storage::exists('public/'.$invoice->slip))
                        <img src="{{ url('/') }}/storage/{{ $invoice->slip }}" rel="nofollow" alt="...">
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
                    <input type="file" name="slip" id="slip" value="{{ isset($invoice->slip) ? $invoice->slip : ''}}" />
                    <input type="hidden" type="d-none" name="slip_old" id="slip_old"
                        value="{{ isset($invoice->slip) ? $invoice->slip : ''}}" />
                </span>
                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput" title="Remove" rel="tooltip">
                    <i class="fa fa-times"></i></a>
            </div>
            {!! $errors->first('slip', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">
                            {{ $formMode === 'edit' ? 'แก้ไขข้อมูลใบแจ้งหนี้' : 'เพิ่มข้อมูลใบแจ้งหนี้' }}</h4>
                        <p class="card-category">กรุณากรอกข้อมูลให้ครบ</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/invoice/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
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
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                            <label for="date" class="control-label">{{ 'วันที่ออกใบแจ้งหนี้' }}</label>
                            <input class="form-control" name="" type="text" id=""
                                value="{{ isset($invoice->date) ? $invoice->date : ''}}" disabled>
                            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('date_pay') ? 'has-error' : ''}}">
                            <label for="date_pay" class="control-label">{{ 'วันแจ้งชำระเงิน' }}</label>
                            <input class="form-control" name="" type="text" id=""
                                value="{{ isset($invoice->date_pay) ? $invoice->date_pay : 'ยังไม่ชำระ'}}" disabled>
                            {!! $errors->first('date_pay', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('pay_date') ? 'has-error' : ''}}">
                            <label for="pay_date" class="control-label">{{ 'วันกำหนดชำระเงิน' }}</label>
                            <input class="form-control" name="" type="text" id=""
                                value="{{ isset($invoice->pay_date) ? $invoice->pay_date : ''}}" disabled>
                            {!! $errors->first('pay_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('delay_date') ? 'has-error' : ''}}">
                            <label for="delay_date" class="control-label">{{ 'วันเกินกำหนด' }}</label>
                            <input class="form-control" name="delay_date" type="number" id="delay_date"
                                value="{{ isset($invoice->delay_date) ? $invoice->delay_date : ''}}">
                            {!! $errors->first('delay_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_ppu') ? 'has-error' : ''}}">
                            <label for="meter_ppu" class="control-label">{{ 'ค่าไฟต่อหน่วย' }}</label>
                            <input class="form-control" name="meter_ppu" type="number" id="meter_ppu"
                                value="{{ isset($invoice->meter_ppu) ? $invoice->meter_ppu : ''}}">
                            {!! $errors->first('meter_ppu', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_wpu') ? 'has-error' : ''}}">
                            <label for="meter_wpu" class="control-label">{{ 'ค่าน้ำต่อหน่วย' }}</label>
                            <input class="form-control" name="meter_wpu" type="number" id="meter_wpu"
                                value="{{ isset($invoice->meter_wpu) ? $invoice->meter_wpu : ''}}">
                            {!! $errors->first('meter_wpu', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('typ_centric') ? 'has-error' : ''}}">
                            <label for="typ_centric" class="control-label">{{ 'ค่าส่วนกลาง' }}</label>
                            <input class="form-control" name="typ_centric" type="number" id="typ_centric"
                                value="{{ isset($invoice->typ_centric) ? $invoice->typ_centric : ''}}">
                            {!! $errors->first('typ_centric', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('typ_wifi') ? 'has-error' : ''}}">
                            <label for="typ_wifi" class="control-label">{{ 'ค่าอินเทอร์เน็ต' }}</label>
                            <input class="form-control" name="typ_wifi" type="number" id="typ_wifi"
                                value="{{ isset($invoice->typ_wifi) ? $invoice->typ_wifi : ''}}">
                            {!! $errors->first('typ_wifi', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_wo') ? 'has-error' : ''}}">
                            <label for="meter_wo" class="control-label">{{ 'มิเตอร์น้ำเก่า' }}</label>
                            <input class="form-control" name="meter_wo" type="number" id="meter_wo"
                                value="{{ isset($invoice->meter_wo) ? $invoice->meter_wo : ''}}">
                            {!! $errors->first('meter_wo', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_wn') ? 'has-error' : ''}}">
                            <label for="meter_wn" class="control-label">{{ 'มิเตอร์น้ำใหม่' }}</label>
                            <input class="form-control" name="meter_wn" type="number" id="meter_wn"
                                value="{{ isset($invoice->meter_wn) ? $invoice->meter_wn : ''}}">
                            {!! $errors->first('meter_wn', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_wu') ? 'has-error' : ''}}">
                            <label for="meter_wu" class="control-label">{{ 'จำนวนหน่วย/น้ำ' }}</label>
                            <input class="form-control" name="meter_wu" type="number" id="meter_wu"
                                value="{{ isset($invoice->meter_wu) ? $invoice->meter_wu : ''}}">
                            {!! $errors->first('meter_wu', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_wtp') ? 'has-error' : ''}}">
                            <label for="meter_wtp" class="control-label">{{ 'รวมค่าน้ำ' }}</label>
                            <input class="form-control" name="meter_wtp" type="number" id="meter_wtp"
                                value="{{ isset($invoice->meter_wtp) ? $invoice->meter_wtp : ''}}">
                            {!! $errors->first('meter_wtp', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_po') ? 'has-error' : ''}}">
                            <label for="meter_po" class="control-label">{{ 'มิเตอร์ไฟเก่า' }}</label>
                            <input class="form-control" name="meter_po" type="number" id="meter_po"
                                value="{{ isset($invoice->meter_po) ? $invoice->meter_po : ''}}">
                            {!! $errors->first('meter_po', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_pn') ? 'has-error' : ''}}">
                            <label for="meter_pn" class="control-label">{{ 'มิเตอร์ไฟใหม่' }}</label>
                            <input class="form-control" name="meter_pn" type="number" id="meter_pn"
                                value="{{ isset($invoice->meter_pn) ? $invoice->meter_pn : ''}}">
                            {!! $errors->first('meter_pn', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_pu') ? 'has-error' : ''}}">
                            <label for="meter_pu" class="control-label">{{ 'จำนวนหน่วย/ไฟ' }}</label>
                            <input class="form-control" name="meter_pu" type="number" id="meter_pu"
                                value="{{ isset($invoice->meter_pu) ? $invoice->meter_pu : ''}}">
                            {!! $errors->first('meter_pu', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('meter_ptp') ? 'has-error' : ''}}">
                            <label for="meter_ptp" class="control-label">{{ 'รวมค่าไฟ' }}</label>
                            <input class="form-control" name="meter_ptp" type="number" id="meter_ptp"
                                value="{{ isset($invoice->meter_ptp) ? $invoice->meter_ptp : ''}}">
                            {!! $errors->first('meter_ptp', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('typ_vehicle') ? 'has-error' : ''}}">
                            <label for="typ_vehicle" class="control-label">{{ 'ค่าที่จอดรถ' }}</label>
                            <input class="form-control" name="typ_vehicle" type="number" id="typ_vehicle"
                                value="{{ isset($invoice->typ_vehicle) ? $invoice->typ_vehicle : ''}}">
                            {!! $errors->first('typ_vehicle', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('typ_mulct') ? 'has-error' : ''}}">
                            <label for="typ_mulct" class="control-label">{{ 'ค่าปรับล่าช้า' }}</label>
                            <input class="form-control" name="typ_mulct" type="number" id="typ_mulct"
                                value="{{ isset($invoice->typ_mulct) ? $invoice->typ_mulct : ''}}">
                            {!! $errors->first('typ_mulct', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('les_price') ? 'has-error' : ''}}">
                            <label for="les_price" class="control-label">{{ 'ค่าเช่าห้อง' }}</label>
                            <input class="form-control" name="les_price" type="number" id="les_price"
                                value="{{ isset($invoice->les_price) ? $invoice->les_price : ''}}">
                            {!! $errors->first('les_price', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group {{ $errors->has('net_pay') ? 'has-error' : ''}}">
                            <label for="net_pay" class="control-label">{{ 'จ่ายสุทธิ' }}</label>
                            <input class="form-control" name="net_pay" type="number" id="net_pay"
                                value="{{ isset($invoice->net_pay) ? $invoice->net_pay : ''}}">
                            {!! $errors->first('net_pay', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md mt-1">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                            <label for="status" class="control-label">{{ 'สถานะใบแจ้งหนี้' }}</label>
                            <select class="form-control" name="status" id="status" style="margin-top: -18xp" required>
                                @if (isset($invoice->status))
                                <option value="{{ $invoice->status }}">{{ $invoice->status }}</option>
                                @else
                                <option value="">กรุณาเลือกสถานะ . . .</option>
                                @endif
                                <option value="รอชำระเงิน">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รอชำระเงิน</option>
                                <option value="รอตรวจสอบ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รอตรวจสอบ</option>
                                <option value="ชำระเงินแล้ว">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชำระเงินแล้ว</option>
                                <option value="ยกเลิกการชำระเงิน">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ยกเลิกการชำระเงิน</option>
                            </select>
                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md mt-4">

                    </div>
                    <div class="col-md mt-4">
                        <div class="form-group pull-right">
                            <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" title="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" rel="tooltip">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
