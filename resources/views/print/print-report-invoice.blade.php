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
            <b> รายงานใบแจ้งหนี้
                {{ request('between') == 'true' ? get_dmY(request('begin')). ' ถึง ' . get_dmY(request('end')) : 'ทั้งหมด'}}
            <br>
            หอพักมาลัยเพลส คลองหลวง ปทุมธานี
            </b>
        </p>
        <table width="100%">
            <thead>
                <tr style="text-align: center;">
                    <th>No.</th>
                    <th>วันที่</th>
                    <th>ห้อง - ตึก</th>
                    <th>ค่าน้ำ</th>
                    <th>ค่าไฟ</th>
                    <th>ส่วนกลาง</th>
                    <th>เช่าจอดรถ</th>
                    <th>ไวไฟ</th>
                    <th>ค่าปรับ</th>
                    <th>ค่าเช่า</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->invoice as $item)
                <tr style="text-align: center;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ get_dmY($item->date) }}</td>
                    <td>{{ $item->lease->room->number . ' - '. $item->lease->room->building}}</td>
                    <td>{{ number_format($item->meter_wtp,2) }}</td>
                    <td>{{ number_format($item->meter_ptp,2) }}</td>
                    <td>{{ number_format($item->typ_centric,2) }}</td>
                    <td>{{ number_format($item->typ_vehicle,2) }}</td>
                    <td>{{ number_format($item->typ_wifi,2) }}</td>
                    <td>{{ number_format($item->typ_mulct,2) }}</td>
                    <td>{{ number_format($item->les_price,2) }}</td>
                    <td>{{ number_format($item->net_pay,2) }}</td>
                </tr>
                @endforeach
                <tr style="text-align: center;">
                    <th>No.</th>
                    <th>วันที่</th>
                    <th>ห้อง - ตึก</th>
                    <th>ค่าน้ำ</th>
                    <th>ค่าไฟ</th>
                    <th>ส่วนกลาง</th>
                    <th>เช่าจอดรถ</th>
                    <th>ไวไฟ</th>
                    <th>ค่าปรับ</th>
                    <th>ค่าเช่า</th>
                    <th>รวม</th>
                </tr>
                <tr style="text-align: center;">
                    <th colspan="3">สรุปยอด</th>
                    <th>{{ number_format($report->invoice->sum('meter_wtp'),2) }}</th>
                    <th>{{ number_format($report->invoice->sum('meter_ptp'),2) }}</th>
                    <th>{{ number_format($report->invoice->sum('typ_centric'),2) }}</th>
                    <th>{{ number_format($report->invoice->sum('typ_vehicle'),2) }}</th>
                    <th>{{ number_format($report->invoice->sum('typ_wifi'),2) }}</th>
                    <th>{{ number_format($report->invoice->sum('typ_mulct'),2) }}</th>
                    <th>{{ number_format($report->invoice->sum('les_price'),2) }}</th>
                    <th>{{ number_format($report->invoice->sum('net_pay'),2) }}</th>
                </tr>
            </tbody>
        </table>

    </div>
</body>
