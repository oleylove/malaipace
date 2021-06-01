<!-- Modal Store Income-->
<div class="modal fade bd-example-modal-lg" id="ModalDetailIncome" tabindex="-1" role="dialog"
    aria-labelledby="ModalDetailIncomeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="card">
            <div class="modal-content">
                <div class="card-header card-header-info">
                    <div class="row">
                        <div class="col-md">
                            <h4 class="card-title">รายงานสรุปบัญชี</h4>
                            <p class="category">รายรับ - รายจ่าย</p>
                        </div>
                        <div class="col-md">
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="material-icons">cancel</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th><u>"สรุปรายรับทั้งหมด"</u></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th> เข้าอยู่ใหม่ </th>
                                            <td class="text-right"> {{ number_format($report->les_sum,2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าเช่า</th>
                                            <td class="text-right">
                                                {{ number_format($report->invoices->sum('les_price'),2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าน้ำ </th>
                                            <td class="text-right">
                                                {{ number_format($report->invoices->sum('meter_wtp'),2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าไฟ </th>
                                            <td class="text-right">
                                                {{ number_format($report->invoices->sum('meter_ptp'),2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าส่วนกลาง </th>
                                            <td class="text-right">
                                                {{ number_format($report->invoices->sum('typ_centric'),2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าอินเตอร์เน็ต </th>
                                            <td class="text-right">
                                                {{ number_format($report->invoices->sum('typ_wifi'),2) . ' บาท' }} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าที่จอดรถ </th>
                                            <td class="text-right">
                                                {{ number_format($report->invoices->sum('typ_vehicle'),2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าปรับ </th>
                                            <td class="text-right">
                                                {{ number_format($report->invoices->sum('typ_mulct'),2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        @foreach ($report->inc_remark_exp as $item)
                                        <tr>
                                            <th> {{ $item->remark }} </th>
                                            <td class="text-right"> {{ number_format($item->income,2) . ' บาท' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th> รวมรายรับ </th>
                                            <th class="text-right">
                                                {{ number_format($report->les_sum + $report->inv_rev + $report->inc_revSum,2) . ' บาท' }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right">
                                                (
                                                {{ $report->les_sum + $report->inv_rev + $report->inc_revSum > 0 ? Sawasdee::readThaiCurrency($report->les_sum + $report->inv_rev + $report->inc_revSum) : Sawasdee::readThaiCurrency($report->les_sum + $report->inv_rev + $report->inc_revSum * (-1)) }}
                                                )
                                            </th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <tr>
                                            <th><u>"สรุปรายจ่ายทั้งหมด"</u></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($report->inc_remark_rev as $item)
                                        <tr>
                                            <th> {{ $item->remark }} </th>
                                            <td class="text-right"> {{ number_format($item->income,2). ' บาท' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th> รวมรายจ่าย </th>
                                            <th class="text-right">
                                                {{ number_format($report->inc_expSum + $report->mtn_sum,2). ' บาท' }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right">
                                                (
                                                {{ $report->inc_expSum + $report->mtn_sum > 0 ? Sawasdee::readThaiCurrency($report->inc_expSum + $report->mtn_sum) : Sawasdee::readThaiCurrency($report->inc_expSum + $report->mtn_sum * (-1)) }})
                                            </th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md text-right">
                        <button type="button" class="btn ntn-md btn-danger btn-round"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
