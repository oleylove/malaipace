<div class="row no-gutters align-items-center">
    <div class="col-md-6">
        <form method="GET" action="{{ url('/report/income') }}" accept-charset="UTF-8" class="was-validated">
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
                    <input class="d-none" type="hidden" id="report" name="report" value="รายงานบัญชี">
                    <button type="submit" class="btn btn-info btn-fab btn-round"  title="Search">
                        <i class="material-icons">search</i></a>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="row no-gutters align-items-center">
            <div class="col-md text-center">
                {{ empty(request('begin')) ? 'รายงานบัญชีทั้งหมด' : 'ตั้งแต่วันที่ '.get_jFY(request('begin')).' ถึง '.get_jFY(request('end')) }} {{ $report->Count.' รายการ' }}
            </div>
            <div class="col-md-3 text-right td-action">
                <form method="GET" action="{{ url('admin-print/report/income') }}" accept-charset="UTF-8" target="_blank">
                    <input class="d-none" type="hidden" id="between" name="between"
                        value="{{ empty(request('begin')) ? 'false' : 'true'}}">
                    <input class="d-none" type="hidden" id="begin" name="begin" value="{{ request('begin') }}">
                    <input class="d-none" type="hidden" id="end" name="end" value="{{ request('end') }}">

                    <button type="button" class="btn btn-info btn-fab btn-round" title="Summary report"
                        data-toggle="modal" data-target="#ModalDetailIncome">
                        <span class="material-icons">summarize</span></a>
                    </button>

                    <button type="submit" class="btn btn-primary btn-fab btn-round"  title="Print">
                        <span class="material-icons">print</span></a>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="dataTableIncome">
                <thead class=" text-info">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>วันที่</th>
                        <th class="text-right">จำนวนเงิน</th>
                        <th class="text-left">หมายเหตุ</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report->income as $item)
                    <tr class="text-center">
                        <td>
                            {{ ($report->income->currentpage()-1) * $report->income->perpage() + $loop->index + 1 }}
                        </td>
                        <td>{{ get_dmY($item->date) }}</td>
                        <td class="text-right">
                            {{ ($item->income > 0 ? number_format($item->income,2)  : number_format($item->income * (-1),2)) }}
                        </td>
                        <td class="text-left">{{ Str::length($item->remark) < 20 ? $item->remark : Str::substr($item->remark, 0, 20) ." ...." }}</td>
                        <td class="td-actions justify-content-center">
                            <a href="javascript:void(0)" class="btn btn-info btn-round mr-2" title="View Income" id="ShowModalIncome"
                                data-id="{{ $item->id }}" data-income="{{  $item->income }}"
                                data-date="{{ get_jFY($item->date) }}" data-remark="{{ $item->remark }}">
                                <i class="material-icons">search</i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-round mr-2" title="Edit Income" id="ShowModalUpdateIncome"
                                data-id="{{ $item->id }}" data-income="{{  $item->income }}"
                                data-date="{{ get_jFY($item->date) }}" data-remark="{{ $item->remark }}">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper pull-right">
                {!! $report->income->appends([
                'between' => Request::get('between'),
                'begin' => Request::get('begin'),'end' => Request::get('end'),
                'report' => Request::get('report')
                ])->render() !!}

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div>
            {{ $chart->container() }}
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        {{ $chart->script() }}
    </div>
</div>
@include('report.model-detail-income')
