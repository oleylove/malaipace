<div class="row no-gutters align-items-center">
    <div class="col-md-7">
        <form method="GET" action="{{ url('/report/lease') }}" accept-charset="UTF-8" class="was-validated">
            <div class="row no-gutters align-self-center">
                <div class="col-md">
                    <input class="form-control" type="date" id="begin" name="begin"
                        value="{{ request('begin') }}" required>
                </div>
                <div class="col-md-2 ml-1 mr-1 text-center">
                    <button type="button" class="btn btn-primary btn-sm">ถึง</button>
                </div>
                <div class="col-md">
                    <input class="form-control" type="date" id="end" name="end"
                        value="{{ request('end') }}" onchange="onChangeDate()" required>
                </div>
                <div class="col-md-2 text-center td-action">
                    <input class="d-none" type="hidden" id="between" name="between" value="true">
                    <input class="d-none" type="hidden" id="report" name="report" value="รายงานเช่า">
                    <button type="submit" class="btn btn-info btn-fab btn-round"  title="Search">
                        <i class="material-icons">search</i></a>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-5 text-right float-right">
        <form method="GET" action="{{ url('admin-print/report/lease') }}" accept-charset="UTF-8" target="_blank">
            <input class="d-none" type="hidden" id="between" name="between"
                value="{{ empty(request('begin')) ? 'false' : 'true'}}">
            <input class="d-none" type="hidden" id="begin" name="begin" value="{{ request('begin') }}">
            <input class="d-none" type="hidden" id="end" name="end" value="{{ request('end') }}">
            <button type="submit" class="btn btn-primary btn-fab btn-round"  title="Print">
                <span class="material-icons">print</span></a>
            </button>
        </form>
    </div>
</div>

<div class="row mt-1">
    <div class="col-md-7">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class=" text-info">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>วันที่</th>
                        <th>ห้อง</th>
                        <th>ตึก</th>
                        <th class="text-left">ชื่อ-สกุล</th>
                        <th class="text-right pr-4">สถานะ</th>
                        <th>ดูข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->lease as $item)
                    <tr class="text-center">
                        <td>{{ ($report->lease->currentpage()-1) * $report->lease->perpage() + $loop->index + 1 }}</td>
                        <td>{{ get_dmY($item->date_start) }}</td>
                        <td>{{ $item->room->number }}</td>
                        <td>{{ $item->room->building }}</td>
                        <td class="text-left">{{ $item->user->name }}</td>
                        <td class="text-right pr-3"> {{ $item->status }}</td>
                        <td class="td-actions justify-content-center">
                            <a href="{{ url('/lease/' . $item->id) }}" title="View lease" class="btn btn-info btn-round mr-2">
                                <i class="material-icons">search</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper pull-right">
                {!! $report->lease->appends([
                    'between' => Request::get('between'),
                    'begin' => Request::get('begin'),'end' => Request::get('end'),
                    'report' => Request::get('report')
                ])->render() !!}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="table-responsive">
            <table class="table table-borderless table-sm">
                <thead>
                    <tr>
                        <th class="text-center"><u>"สรุปรายงานเช่า"</u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> รายการเช่าทั้งหมด </th>
                        <td class="text-right"> {{ $report->Count }}&nbsp;&nbsp;&nbsp;รายการ
                        </td>
                    </tr>
                    <tr>
                        <th> ปัจจุบันเช่าอยู่</th>
                        <td class="text-right">{{ $report->les_st1 }}&nbsp;&nbsp;&nbsp;รายการ
                    </tr>
                    <tr>
                        <th> ปัจจุบันแจ้งย้าย </th>
                        <td class="text-right"> {{ $report->les_st2 }}&nbsp;&nbsp;&nbsp;รายการ
                    </tr>
                    <tr>
                        <th> ปัจจุบันย้ายออกแล้ว </th>
                        <td class="text-right"> {{ $report->les_st3 }}&nbsp;&nbsp;&nbsp;รายการ
                    </tr>
                    <tr>
                        <th> ห้องเช่าทั้งหมด </th>
                        <td class="text-right"> {{ $report->rm_count }}&nbsp;&nbsp;&nbsp;ห้อง
                    </tr>
                    <tr>
                        <th> ห้องที่ว่างอยู่ </th>
                        <td class="text-right"> {{ $report->rm_st1 }}&nbsp;&nbsp;&nbsp;ห้อง
                    </tr>
                    <tr>
                        <th> ห้องที่ถูกจอง </th>
                        <td class="text-right"> {{ $report->rm_st2 }}&nbsp;&nbsp;&nbsp;ห้อง
                    </tr>
                    <tr>
                        <th> ห้องที่เช่าอยู่ </th>
                        <td class="text-right"> {{ $report->rm_st3 }}&nbsp;&nbsp;&nbsp;ห้อง
                    </tr>
                    <tr>
                        <th> ห้องที่ปิดปรับปรุง </th>
                        <td class="text-right"> {{ $report->rm_st4 }}&nbsp;&nbsp;&nbsp;ห้อง
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
