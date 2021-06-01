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
            <b> รายงานการซ่อมบำรุง
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
                    <th>รายละเอียด</th>
                    <th>ค่าซ่อม</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->maintenances as $item)
                <tr style="text-align: center;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ get_dmY($item->date) }}</td>
                    <td>{{ $item->detail }}</td>
                    <td>{{ $item->price > 0 ? number_format($item->price,2) : ''}}</td>
                    <td>{{ $item->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
