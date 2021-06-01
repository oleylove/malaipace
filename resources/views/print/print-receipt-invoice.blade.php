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
            }
        }

        th,
        td {
            padding: initial;
        }

        th {
            text-align: left;
        }
    </style>

</head>

<body>
    <div class="container-fluid" style="font-family: THSarabunNew">
        <table style="width:100%">
            <tr>
                <th style="text-align: left;font-size: 18px;width:55%">มาลัยเพลส อพาร์ทเม้นท์ โทร.088-328-8235</th>
                <th style="text-align: center;font-size: 18px">ใบแจ้งค่าเช่า/ใบเสร็จรับเงิน</th>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ที่อยู่สำนักงาน : {{ $wfc->address }}</td>
                <td style="text-align: left;font-size: 16px">ที่อยู่ตึก : {{ $wfc->address }}</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">
                    ห้อง : {{ $invoice->lease->room->number }}
                    ตึก : {{ $invoice->lease->room->building }}
                    ประเภทห้อง : {{ $invoice->lease->room->type->name }}
                    เข้าอยู่เมื่อ : {{ Date::parse($invoice->lease->date_start)->format('d F Y') }}
                </td>
                <td style="text-align: left;font-size: 16px">
                    ค่าเช่าห้องประจำเดือน : {{ Date::parse($invoice->date)->format('F Y') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">
                    ผู้เช่า : {{ $invoice->lease->user->name }}
                    เบอร์โทร : {{ $invoice->lease->user->phone }}
                </td>
                <td style="text-align: left;font-size: 16px">
                    บิลเลขที่ : {{ $invoice->id }}
                    กำหนดวันจ่าย : {{ Date::parse($invoice->pay_date)->format('d F Y') }}
                </td>
            </tr>
        </table>
        <hr>
        <table style="width:90%">
            <tr>
                <td style="text-align: left;font-size: 16px;width:55%">ค่าเช่าห้อง</td>
                <td style="text-align: right;font-size: 16px;width:45%">{{ number_format($invoice->les_price,2) }} บาท
                </td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าไฟฟ้า :
                    {{ '( เลขมิเตอร์ไฟใหม่ = '. $invoice->meter_pn .' เลขมิเตอร์ไฟเก่า = '. $invoice->meter_po .' ) = '.$invoice->meter_pu.' หน่วย'}}</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->meter_ptp,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าน้ำประปา :
                    {{ '( เลขมิเตอร์น้ำใหม่ = '. $invoice->meter_wn .' เลขมิเตอร์นน้ำเก่า = '. $invoice->meter_wo .' ) = '.$invoice->meter_wu.' หน่วย'}}</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->meter_wtp,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าส่วนกลาง</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->typ_centric,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าบริการอินเตอร์เน็ต</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->typ_wifi,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าบริการที่จอดรถ</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->typ_vehicle,2) }} บาท</td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 16px">รวมจ่ายสุทธิทั้งหมด</th>
                <th style="text-align: right;font-size: 16px">{{ number_format($invoice->net_pay,2) }} บาท</th>
            </tr>
            <tr>
                <th style="text-align: right;font-size: 16px" colspan="2">
                    {{-- ({{ $invoice->net_pay > 0 ? Functions::baht_text($invoice->net_pay) : "-" }}) --}}
                    ({{ $invoice->net_pay > 0 ? Sawasdee::readThaiCurrency($invoice->net_pay) : "-" }})
                </th>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 16px">สถานะใบแจ้งหนี้</th>
                <th style="text-align: right;font-size: 16px">
                    @switch($invoice->status)
                    @case('รอชำระเงิน')
                    {{ 'รอชำระเงิน' }}
                    @break
                    @case('รอตรวจสอบ')
                    {{ 'รอตรวจสอบ' }}
                    @break
                    @case('ชำระเงินแล้ว')
                    {{ 'ชำระเงินแล้ว เมื่อ '.$invoice->date_pay	}}
                    @break
                    @case('ยกเลิกการชำระเงิน')
                    {{ 'ยกเลิกการชำระเงิน' }}
                    @break
                    @default
                    {{ 'ผิดพลาด' }}
                    @endswitch
                </th>
            </tr>
        </table>
        <hr>
    </div>
</body>
