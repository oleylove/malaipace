<div class="row no-gutters align-items-center">
    <div class="col-md-8">
        <form method="GET" action="{{ url('/report/invoice') }}" accept-charset="UTF-8" class="was-validated">
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
                            <input class="d-none" type="hidden" id="report" name="report" value="รายงานใบแจ้งหนี้">
                            <button type="submit" class="btn btn-info btn-fab btn-round"  title="Search">
                                <i class="material-icons">search</i></a>
                            </button>
                        </div>
                    </div>
                 </div>
            </div>
        </form>
    </div>
    <div class="col-md-4 text-right float-right">
        <form method="GET" action="{{ url('admin-print/report/invoice') }}" accept-charset="UTF-8" target="_blank">
            <input class="d-none" type="hidden" id="begin" name="begin" value="{{ request('begin') }}">
            <input class="d-none" type="hidden" id="end" name="end" value="{{ request('end') }}">
            <input class="d-none" type="hidden" id="between" name="between" value="{{ empty(request('begin')) ? 'false' : 'true'}}">
            <input class="d-none" type="hidden" id="report" name="report" value="รายงานใบแจ้งหนี้">
            <button type="submit" class="btn btn-primary btn-fab btn-round"  title="Print">
                <span class="material-icons">print</span></a>
            </button>
        </form>
    </div>
</div>

<div class="row mt-1">
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="text-info">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>วันที่</th>
                        <th>ค่าน้ำ</th>
                        <th>ค่าไฟ</th>
                        <th>ส่วนกลาง</th>
                        <th>ที่จอดรถ</th>
                        <th>อินเตอร์เน็ต</th>
                        <th>ค่าเช่า</th>
                        <th>รวม</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->invoice as $item)
                    <tr class="text-center">
                        <td>{{ ($report->invoice->currentpage()-1) * $report->invoice->perpage() + $loop->index + 1 }}</td>
                        <td>{{ get_dmY($item->date) }}</td>
                        <td>{{ number_format($item->meter_wtp,2) }}</td>
                        <td>{{ number_format($item->meter_ptp,2) }}</td>
                        <td>{{ number_format($item->typ_centric,2) }}</td>
                        <td>{{ number_format($item->typ_vehicle,2) }}</td>
                        <td>{{ number_format($item->typ_wifi,2) }}</td>
                        <td>{{ number_format($item->les_price,2) }}</td>
                        <td>{{ number_format($item->net_pay,2) }}</td>
                        <td class="td-actions justify-content-center">
                            <a href="{{ url('/invoice/' . $item->id) }}" title="View lease" class="btn btn-info btn-round mr-2">
                                <i class="material-icons">search</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper pull-right">
                {!! $report->invoice->appends([
                    'between' => Request::get('between'),
                    'begin' => Request::get('begin'),'end' => Request::get('end'),
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
                        <th><u>"สรุปรายงานใบแจ้งหนี้"</u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> รวมค่าน้ำ </th>
                        <td class="text-right"> {{ number_format($report->meter_wtp,2) . ' บาท' }}
                        </td>
                    </tr>
                    <tr>
                        <th> รวมค่าไฟ</th>
                        <td class="text-right">
                            {{ number_format($report->meter_ptp,2) . ' บาท' }} </td>
                    </tr>
                    <tr>
                        <th> รวมค่าเช่า </th>
                        <td class="text-right">
                            {{ number_format($report->meter_wtp,2) . ' บาท' }} </td>
                    </tr>
                    <tr>
                        <th> รวมค่าส่วกลาง </th>
                        <td class="text-right">
                            {{ number_format($report->typ_centric,2) . ' บาท' }} </td>
                    </tr>
                    <tr>
                        <th> รวมค่าอินเทอร์เน็ต </th>
                        <td class="text-right">
                            {{ number_format($report->typ_wifi,2) . ' บาท' }}
                        </td>
                    </tr>
                    <tr>
                        <th> รวมค่าที่จอดรถ </th>
                        <td class="text-right">
                            {{ number_format($report->typ_vehicle,2) . ' บาท' }} </td>
                    </tr>
                    <tr>
                        <th> รวมค่าปรับ </th>
                        <td class="text-right">
                            {{ number_format($report->typ_mulct,2) . ' บาท' }}
                        </td>
                    </tr>
                    <tr>
                        <th> ค่าปรับ </th>
                        <td class="text-right">
                            {{ number_format($report->les_price,2) . ' บาท' }} </td>
                    </tr>
                    <tr>
                        <th> รวมทั้งหมด </th>
                        <th class="text-right"> {{ number_format($report->net_pay,2) . ' บาท' }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
