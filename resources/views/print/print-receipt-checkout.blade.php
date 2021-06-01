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
                <th style="text-align: center;font-size: 18px">ใบแจ้งค่าย้ายออก/ใบเสร็จรับเงิน</th>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ที่อยู่สำนักงาน : {{ $wcfg->address }}</td>
                <td style="text-align: left;font-size: 16px">ที่อยู่ตึก : {{ $wcfg->address }}</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">
                    ห้อง : {{ $invoice->lease->room->number }}
                    ตึก : {{ $invoice->lease->room->building }}
                    ประเภทห้อง : {{ $invoice->lease->room->type->name }}
                    เข้าอยู่เมื่อ : {{ get_jFY($invoice->lease->date_start) }}
                </td>
                <td style="text-align: left;font-size: 16px">
                    วันครบสัญญา : {{ get_jFY($invoice->lease->date_end) }}
                    {{ get_Ymd($invoice->lease->date_end) <= get_Ymd($invoice->lease->checkout) ? ' (ครบสัญญา)' : ' (ไม่ครบสัญญา)' }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">
                    ผู้เช่า : {{ $invoice->lease->user->name }}
                    เบอร์โทร : {{ $invoice->lease->user->phone }}
                </td>
                <td style="text-align: left;font-size: 16px">
                    บิลเลขที่ : {{ $invoice->id .' / '.$invoice->date}}
                </td>
            </tr>
        </table>
        <hr>
        <table style="width:90%">
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าไฟฟ้า :
                    {{ '(มิเตอร์ไฟใหม่ = '. $invoice->meter_pn .') - (มิเตอร์ไฟเก่า = '. $invoice->meter_po .') = '.$invoice->meter_pu.' หน่วย'}}
                </td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->meter_ptp,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าน้ำประปา :
                    {{ '(มิเตอร์น้ำใหม่ = '. $invoice->meter_wn .') - (มิเตอร์น้ำเก่า = '. $invoice->meter_wo .') = '.$invoice->meter_wu.' หน่วย'}}
                </td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->meter_wtp,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าส่วนกลาง + ค่าทำความสะอาด</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->typ_centric,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">คืนเงินประกัน</th>
                <td style="text-align: right;font-size: 16px">{{ number_format($invoice->lease->typ_doposit,2) }} บาท</th>
            </tr>
            <tr>
                @if ($invoice->net_pay > 0)
                    <th style="text-align: left;font-size: 16px">รวมจ่ายสุทธิทั้งหมด</th>
                    <th style="text-align: right;font-size: 16px">
                        {{ number_format($invoice->net_pay,2) }} บาท
                    </th>
                @else
                <th style="text-align: left;font-size: 16px">คืนเงินทั้งหมด</th>
                <th style="text-align: right;font-size: 16px">
                    {{ number_format($invoice->net_pay * (-1),2) }} บาท
                </th>
                @endif
            </tr>
            <tr>
                <th style="text-align: right;font-size: 16px" colspan="2">
                    {{-- ({{ $invoice->net_pay > 0 ? Functions::baht_text($invoice->net_pay) : "-" }}) --}}
                    ({{ $invoice->net_pay > 0 ? Sawasdee::readThaiCurrency($invoice->net_pay) : Sawasdee::readThaiCurrency($invoice->net_pay*(-1)) }})
                </th>
            </tr>
            <tr class="mt-5 pt-5">
                <th style="text-align: left;font-size: 16px" class="mt-5 pt-5"><br><br>ผู้รับเงิน/ผู้คืนเงิน</th>
                <th style="text-align: right;font-size: 16px"><br><br>...........................................................</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: right;font-size: 16px">({{ Auth::user()->name }})</th>
            </tr>
        </table>
        <hr>
    </div>
</body>
