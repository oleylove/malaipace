
@auth
@if (Auth::user()->status != 'ผู้ดูแลหอพัก' && Auth::user()->status != 'สมาชิกใหม่' && Auth::user()->status != 'สมาชิกจอง' && Auth::user()->status != 'สมาชิกออกแล้ว')
    <div class="modal fade" id="userCheckpot" tabindex="-1" role="dialog" aria-labelledby="userCheckpotLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userCheckpotLabel">แจ้งย้ายออก ห้อง :
                        {{ Auth::user()->lease->room->number }} ตึก :
                        {{ Auth::user()->lease->room->building }}</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('/user-checkout') }}" accept-charset="UTF-8"
                    class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="card border-primary">
                            <div class="card-header text-center">{{ Auth::user()->name . ' โทร. ' . Auth::user()->phone }} </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">วันที่เข้าอยู่ : {{ Date::parse(Auth::user()->lease->date_start)->format('d F Y') }}</li>
                                <li class="list-group-item">วันครบสัญญา : {{ Date::parse(Auth::user()->lease->date_end)->format('d F Y') }}</li>

                                @if (Auth::user()->lease->status == 'แจ้งย้าย' || Auth::user()->lease->status == 'ยืนยันแจ้งย้าย' || Auth::user()->lease->status == 'ย้ายออก')
                                    <li class="list-group-item">วันที่แจ้งออก : {{ Date::parse(Auth::user()->lease->checkout)->format('d F Y') }} </li>
                                @endif

                                <li class="list-group-item">
                                    ระยะเวลาที่อยู่ :
                                    {{ get_timespan(Date::now()->format('Y-m-d'),Date::parse(Auth::user()->lease->date_start)->format('Y-m-d')) }}

                                    @if (get_Ymd(Auth::user()->lease->checkout) > get_Ymd(Auth::user()->lease->date_end))
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="text-success">{{ 'ครบสัญญา คืนเงินประกัน' }}</span>
                                    @endif

                                    @if (get_Ymd(Auth::user()->lease->checkout) <= get_Ymd(Auth::user()->lease->date_end))
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="text-danger">{{ 'ไม่ครบสัญญา ไม่คืนเงินประกัน' }}</span>
                                    @endif
                                </li>

                                <li class="list-group-item">สถานะเช่า :
                                    @switch(Auth::user()->lease->status )
                                    @case('เช่าอยู่')
                                    <button type="button" class="btn btn-outline-success btn-sm mr-2">
                                        {{'เช่าอยู่' }}
                                        <i class="fas fa-circle text-success ml-1"></i>
                                    </button>
                                    @break
                                    @case('แจ้งย้าย')
                                    <button type="button" class="btn btn-outline-danger btn-sm mr-2">
                                        {{'แจ้งย้าย' }}
                                        <div class="spinner-grow text-danger spinner-grow-sm" role="status"></div>
                                    </button>
                                    @break
                                    @case('สมาชิกออกแล้ว')
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-2">
                                        {{ 'ย้ายออกแล้ว' }}
                                        <i class="fas fa-circle text-primary ml-1"></i>
                                    </button>
                                    @break
                                    @default
                                    <button type="button" class="btn btn-outline-danger btn-sm mr-2">
                                        {{ 'ข้อมูลผิดพลาด' }}
                                        <i class="text-danger fas fa-exclamation-circle mr-1"></i>
                                    </button>
                                @endswitch
                                </li>
                                @if (Auth::user()->lease->status == 'เช่าอยู่')
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label for="checkout" class="control-label">วันที่ออก<span class="text-danger">*</span></label>
                                            <input class="form-control" name="checkout" type="date" id="checkout" min="{{ get_Ymd(Date::now()) }}" max="{{ get_Ymd(Date::now()->add('3 month')) }}" required>
                                            <input class="d-none" name="id" type="hidden" id="id" value="{{ Auth::user()->lease->id }}" required>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                            <button type="submit" class="btn btn-primary btn-block">บันทึกแจ้งย้าย</button>
                                    </li>
                                @endif
                                <li class="list-group-item text-center">
                                <span class="text-danger">***** หากต้องการยกเลิกกรุณาติดต่อที่สำนักงาน *****</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@endauth

