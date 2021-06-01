<div class="row no-gutters align-items-center">
    <div class="col-md-7">

        <form method="GET" action="{{ url('/report/maintenance') }}" accept-charset="UTF-8" class="was-validated">
            <div class="row">
                <div class="col-md text-right align-self-center">
                    <div class="row no-gutters">
                        <div class="col-md-4 text-center">
                            <input class="form-control form-control-sm" type="date" id="begin" name="begin"
                                value="{{ request('begin') }}" required>
                        </div>
                        <div class="col-md ml-2 mr-2 text-center">
                            <button type="button" class="btn btn-primary btn-sm">
                                &nbsp;&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;&nbsp;
                            </button>
                        </div>
                        <div class="col-md-4 text-center">
                            <input class="form-control form-control-sm" type="date" id="end" name="end"
                                value="{{ request('end') }}" required>
                        </div>
                        <div class="col-md text-center">
                            <input class="d-none" type="hidden" id="between" name="between" value="true">
                            <input class="d-none" type="hidden" id="report" name="report" value="รายงานซ่อมบำรุง">
                            <button type="submit" class="btn btn-info btn-fab btn-round" title="Search">
                                <i class="material-icons">search</i></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <div class="col-md-5 text-right float-right">
        <form method="GET" action="{{ url('admin-print/report/maintenances') }}" accept-charset="UTF-8" target="_blank">
            <input class="d-none" type="hidden" id="between" name="between"
                value="{{ empty(request('begin')) ? 'false' : 'true'}}">
            <input class="d-none" type="hidden" id="begin" name="begin" value="{{ request('begin') }}">
            <input class="d-none" type="hidden" id="end" name="end" value="{{ request('end') }}">
            <button type="submit" class="btn btn-primary btn-fab btn-round" title="Print">
                <span class="material-icons">print</span></a>
            </button>
        </form>
    </div>
</div>

<div class="row mt-1">
    <div class="col-md-7">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="dataTableIncome">
                <thead class=" text-info">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>วันที่</th>
                        <th>รายละเอียด</th>
                        <th class="text-right pr-3">ค่าซ่อม</th>
                        <th>ดูข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->maintenance as $item)
                    <tr class="text-center">
                        <td>{{ ($report->maintenance->currentpage()-1) * $report->maintenance->perpage() + $loop->index + 1 }}
                        </td>
                        <td>{{ get_jFY($item->date) }}</td>
                        <td class="text-left">
                            {{ Str::length($item->detail) < 30 ? $item->detail : Str::substr($item->detail, 0, 30) ." ...." }}
                        </td>
                        <td class="text-right pr-3">{{ $item->price > 0 ? number_format($item->price,2) : ''}}</td>
                        <td class="td-actions justify-content-center">
                            <a href="{{ url('/maintenance/' . $item->id) }}" title="View"
                                class="btn btn-info btn-round mr-2">
                                <i class="material-icons">search</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper pull-right">
                {!! $report->maintenance->appends([
                'between' => Request::get('between'),
                'begin' => Request::get('begin'),
                'end' => Request::get('end'),
                'report' => Request::get('report')
                ])->render() !!}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th class="text-center"><u>"สรุปรายงานการซ่อมบำรุง"</u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> รายการซ่อมบำรุงทั้งหมด </th>
                        <td class="text-right"> {{ $report->Count }}&nbsp;&nbsp;&nbsp;รายการ
                        </td>
                    </tr>
                    <tr>
                        <th> รายการแจ้งซ่อม</th>
                        <td class="text-right"> {{ $report->mnt_st1 }}&nbsp;&nbsp;&nbsp;รายการ
                    </tr>
                    <tr>
                        <th> รายการกำลังซ่อม </th>
                        <td class="text-right"> {{ $report->mnt_st2 }}&nbsp;&nbsp;&nbsp;รายการ
                    </tr>
                    <tr>
                        <th> รายการยกเลิกแจ้งซ่อม </th>
                        <td class="text-right"> {{ $report->mnt_st3 }}&nbsp;&nbsp;&nbsp;รายการ
                    </tr>
                    <tr>
                        <th> รายการซ่อมเสร็จแล้ว </th>
                        <td class="text-right"> {{ $report->mnt_st4 }}&nbsp;&nbsp;&nbsp;รายการ
                    </tr>
                    <tr>
                        <th> รวมค่าซ่อมบำรุงทั้งหมด </th>
                        <td class="text-right"> {{ number_format($report->mtn_sumPrice,2) }}&nbsp;&nbsp;&nbsp;บาท
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right">
                            {{'( ' .Sawasdee::readThaiCurrency($report->mtn_sumPrice). ' )'}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
