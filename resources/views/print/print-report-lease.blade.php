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
            <b> รายงานการเช่า
                {{ request('between') == 'true' ? get_dmY(request('begin')). ' ถึง ' . get_dmY(request('end')) : 'ทั้งหมด'}}
                <br>
                หอพักมาลัยเพลส คลองหลวง ปทุมธานี
            </b>
        </p>

        <table width="100%">
            <thead>
                <tr style="text-align: center;">
                    <th>No.</th>
                    <th>วันที่เช่า</th>
                    <th>ห้อง - ตึก</th>
                    <th>ชื่อ-สกุล</th>
                    <th>เบอร์โทร</th>
                    <th>อาศัย</th>
                    <th>ระยะเวลาเช่า</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->leases as $item)
                <tr style="text-align: center;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ get_dmY($item->date_start) }}</td>
                    <td>{{ $item->room->number.' - '.$item->room->building }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->user->phone }}</td>
                    <td>{{ $item->number }}</td>
                    <td>
                        @if (isset($item->checkout))
                        {{ get_timespan(get_Ymd($item->checkout),get_Ymd($item->date_start)) }}
                        @else
                        {{ get_timespan(get_Ymd(Date::now()),get_Ymd($item->date_start)) }}
                        @endif
                    </td>
                    <td>{{ $item->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
