
<div class="modal fade" id="adminCheckout" tabindex="-1" role="dialog" aria-labelledby="adminCheckoutLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminCheckoutLabel">ทำเรื่องย้ายออก ห้อง :
                    {{ $lease->room->number }} ตึก :
                    {{ $lease->room->building }}</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/lease/checkout/'.$lease->id.'/done') }}" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="card border-primary">
                        <div class="card-header text-center">{{ $lease->user->name . ' โทร. ' . $lease->user->phone }} </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">วันที่เข้าอยู่ : {{ Date::parse($lease->date_start)->format('d F Y') }}</li>
                            <li class="list-group-item">วันครบสัญญา : {{ Date::parse($lease->date_end)->format('d F Y') }}</li>
                            <li class="list-group-item">วันที่แจ้งออก : {{ Date::parse($lease->checkout)->format('d F Y') }}</li>
                            <li class="list-group-item">
                                ระยะเวลาที่อยู่ :
                                {{ get_timespan(Date::now()->format('Y-m-d'),Date::parse($lease->date_start)->format('Y-m-d')) }}

                                @if (get_Ymd($lease->checkout) > get_Ymd($lease->date_end))
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="text-success">{{ 'ครบสัญญา คืนเงินประกัน' }}</span>
                                @endif

                                @if (get_Ymd($lease->checkout) <= get_Ymd($lease->date_end))
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="text-danger">{{ 'ไม่ครบสัญญา ไม่คืนเงินประกัน' }}</span>
                                @endif

                            </li>
                            <li class="list-group-item">
                                สถานะเช่า :
                                <button type="button" class="btn btn-outline-primary btn-sm mr-2">{{ $lease->status }}
                                    <i class="fas fa-circle text-primary ml-1"></i>
                                </button>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="meter_wn" class="control-label">มิเตอร์น้ำเก่า</label>
                                            <input class="form-control" name="meter_wo" type="number" id="meter_wo" value="{{ $lease->room->meter_wn }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="meter_wn" class="control-label">กรอกมิเตอร์น้ำล่าสุด <span class="text-danger"> *</span></label>
                                            <input class="form-control" name="meter_wn" type="number" id="meter_wn" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="meter_wn" class="control-label">มิเตอร์ไฟเก่า</label>
                                            <input class="form-control" name="meter_po" type="number" id="meter_po" value="{{ $lease->room->meter_pn }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="meter_pn" class="control-label">กรอกมิเตอร์ไฟล่าสุด <span class="text-danger"> *</span></label>
                                            <input class="form-control" name="meter_pn" type="number" id="meter_pn" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="typ_clean" class="control-label">ค่าทำความสะอาด <span class="text-danger"> *</span></label>
                                            <input class="form-control" name="typ_clean" type="number" id="typ_clean" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="doposit" class="control-label">เงินประกัน <span class="text-danger"> * </span></label>
                                            <select class="form-control" name="doposit" id="doposit" required>
                                                @if(get_Ymd($lease->checkout) > get_Ymd($lease->date_end))
                                                <option value="{{ "คืนเงินประกัน" }}">คืนเงินประกัน</option>
                                                <option value="{{ "ไม่คืนเงินประกัน" }}">ไม่คืนเงินประกัน</option>
                                                @else
                                                <option value="{{ "ไม่คืนเงินประกัน" }}">ไม่คืนเงินประกัน</option>
                                                <option value="{{ "คืนเงินประกัน" }}">คืนเงินประกัน</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <input class="d-none" name="id" type="hidden" id="id" value="{{ $lease->id }}" required>
                                <input class="d-none" name="rm_id" type="hidden" id="rm_id" value="{{ $lease->rm_id }}" required>
                                <button type="submit" class="btn btn-primary btn-block">บันทึกย้ายออก</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

