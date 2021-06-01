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

        /* table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        } */
    </style>

</head>

<body>
    <div class="container-fluid" style="font-family: THSarabunNew">
        <table style="width:100%">
            <tr>
                <th style="text-align: left;font-size: 18px;width:55%">มาลัยเพลส อพาร์ทเม้นท์ โทร.088-328-8235</th>
                <th style="text-align: center;font-size: 18px"> ทำสัญญาเช่า/ใบเสร็จรับเงิน</th>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ที่อยู่สำนักงาน : {{ $wcfg->address }}</td>
                <td style="text-align: left;font-size: 16px">ที่อยู่ตึก : {{ $wcfg->address }}</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">
                    ห้อง : {{ $receipt->room->number }}
                    ตึก : {{ $receipt->room->building }}
                    ประเภทห้อง : {{ $receipt->room->type->name }}
                </td>
                <td style="text-align: left;font-size: 16px">
                    ทำสัญญาเมื่อวันที่ : {{ Date::parse($receipt->date_start)->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">
                    ผู้ทำสัญญา : {{ $receipt->user->name }}
                    เบอร์โทร : {{ $receipt->user->phone }}
                </td>
                <td style="text-align: left;font-size: 16px">
                    บิลเลขที่ : {{ $receipt->id }}
                    ออกวันที่ : {{ Date::now()->format('d F Y') }}
                </td>
            </tr>
        </table>
        <hr>
        <table style="width:80%">
            <tr>
                <td style="text-align: left;font-size: 16px;width:55%">ค่าเช่าห้องล่วงหน้า</td>
                <td style="text-align: right;font-size: 16px;width:45%">{{ number_format($receipt->typ_price,2) }} บาท
                </td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่ามัดจำ</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($receipt->typ_doposit,2) }} บาท</td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าบริการอินเตอร์เน็ต</td>
                <td style="text-align: right;font-size: 16px">
                    @if ($receipt->typ_wifi == 'yes')
                        {{ number_format($receipt->room->type->wifi,2) }} บาท
                    @else
                        {{ number_format(0,2) }} บาท
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">ค่าบริการที่จอดรถ</td>
                <td style="text-align: right;font-size: 16px">
                    @if ($receipt->typ_vehicle == 'yes')
                        {{ number_format($receipt->room->type->vehicle,2) }} บาท
                    @else
                        {{ number_format(0,2) }} บาท
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: left;font-size: 16px">หักค่าจอง</td>
                <td style="text-align: right;font-size: 16px">{{ number_format($receipt->typ_booking,2) }} บาท</td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 16px">รวมจ่ายสุทธิทั้งหมด</th>
                <th style="text-align: right;font-size: 16px">{{ number_format($receipt->net_pay,2) }} บาท</th>
            </tr>
            <tr>
                <th style="text-align: right;font-size: 16px" colspan="2">
                    {{-- ({{ $receipt->net_pay > 0 ? Functions::baht_text($receipt->net_pay) : "-" }}) --}}
                    ({{ $receipt->net_pay > 0 ? Sawasdee::readThaiCurrency($receipt->net_pay) : "-" }})

                </th>
            </tr>
        </table>
            <br>
        <table style="width:80%">
            <tr style="margin-top: 50px">
                <th style="text-align: left;font-size: 16px;margin-top: 20px">ผู้รับเงิน</th>
                <th style="text-align: right;font-size: 16px">...................................................</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: right;font-size: 16px">({{ Auth::user()->name }})</th>
            </tr>
        </table>

        <hr>

    </div>
</body>
