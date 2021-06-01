<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: bold;
        src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: normal;
        src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: bold;
        src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
    }

    @page {
        size: A4;
        padding: 15px;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
            font-family: "THSarabunNew";
        }
    }

    body {
    font-family: "THSarabunNew";
    font-size: 16px;
    justify-content: center;
    background-color: white;

}


    th,
    td {
        padding: initial;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;

    }

</style>

<body>
    <div style="font-family: THSarabunNew;">
        <p style="text-align: center;font-size: 20px;">
            <b> รายงานบัญชี {{ request('between') == 'true' ? get_dmY(request('begin')). ' ถึง ' . get_dmY(request('end')) : 'ทั้งหมด'}}
            <br>
            หอพักมาลัยเพลส คลองหลวง ปทุมธานี
            </b>
        </p>
        <table width="100%">
            <thead>
                <tr style="text-align: center;">
                    <th>No.</th>
                    <th>วันที่</th>
                    <th>รายการ</th>
                    <th>จำนวนเงิน</th>
                    <th>หมายเหตุ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->incomes as $item)
                <tr style="text-align: center;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ get_dmY($item->date) }}</td>
                    <td>{{ $item->income > 0 ? 'รายรับ' : 'รายจ่าย'}}</td>
                    <td>{{ $item->income > 0 ? number_format($item->income,2) : number_format($item->income * (-1),2) }}</td>
                    <td>{{ $item->remark }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
<br>
<br>

        <table width="100%" style="text-align: center;">
            <thead>
                <tr>
                    <th colspan="2" width="50%"><u>"สรุปรายรับทั้งหมด"</u></th>
                    <th colspan="2" width="50%"><u>"สรุปรายจ่ายทั้งหมด"</u></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th> เข้าอยู่ใหม่ </th>
                    <td> {{ number_format($report->les_sum,2) . ' บาท' }}</td>
                    <th> จ่ายค่าไฟ </th>
                    <td> {{ number_format($report->inc_exp1,2). ' บาท' }}</td>
                </tr>
                <tr>
                    <th> ค่าเช่า</th>
                    <td>{{ number_format($report->invoices->sum('les_price'),2) . ' บาท' }} </td>
                    <th> จ่ายค่าน้ำ </th>
                    <td> {{ number_format($report->inc_exp2,2). ' บาท' }}</td>
                </tr>
                <tr>
                    <th> ค่าน้ำ </th>
                    <td>{{ number_format($report->invoices->sum('meter_wtp'),2) . ' บาท' }} </td>
                    <th> จ่ายค่าอินเตอร์เน็ต </th>
                    <td> {{ number_format($report->inc_exp3,2). ' บาท' }}</td>
                </tr>
                <tr>
                    <th> ค่าไฟ </th>
                    <td>{{ number_format($report->invoices->sum('meter_ptp'),2) . ' บาท' }} </td>
                    <th> จ่ายค่าซ่อมบำรุง </th>
                    <td> {{ number_format($report->mtn_sum,2). ' บาท' }} </td>
                </tr>
                <tr>
                    <th> ค่าส่วนกลาง </th>
                    <td>{{ number_format($report->invoices->sum('typ_centric'),2) . ' บาท' }}</td>
                    <th> จ่ายค่าคนงาน </th>
                    <td> {{ number_format($report->inc_exp4,2). ' บาท' }}</td>
                </tr>
                <tr>
                    <th> ค่าอินเตอร์เน็ต </th>
                    <td>{{ number_format($report->invoices->sum('typ_wifi'),2) . ' บาท' }} </td>
                    <th> คืนเงินมัดจำ </th>
                    <td> {{ number_format($report->typ_doposit,2). ' บาท' }} </td>
                </tr>
                <tr>
                    <th> ค่าที่จอดรถ </th>
                    <td>{{ number_format($report->invoices->sum('typ_vehicle'),2) . ' บาท' }}</td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th> ค่าปรับ </th>
                    <td>{{ number_format($report->invoices->sum('typ_mulct'),2) . ' บาท' }} </td>
                    <th> </th>
                    <th></th>
                </tr>
                <tr>
                    <th> อื่นๆ </th>
                    <td> {{ number_format($report->inc_revSum,2) . ' บาท' }}</td>
                    <th> อื่นๆ </th>
                    <td> {{ number_format($report->inc_exp5,2). ' บาท' }}</td>

                </tr>
                <tr>
                    <th> รวมรายรับ </th>
                    <th>{{ number_format($report->les_sum + $report->invoices->sum('net_pay') + $report->inc_revSum,2) . ' บาท' }}</th>
                    <th> รวมรายจ่าย </th>
                    <th>{{ number_format($report->inc_expSum + $report->mtn_sum,2). ' บาท' }}  </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
