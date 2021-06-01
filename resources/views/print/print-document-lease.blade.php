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

    }

    th,
    td {
        padding: initial;
    }

    th {}

    table,
    th,
    td {
        border: 1px solid transparent;
        border-collapse: collapse;

    }

    tab1 {
        padding-left: 5em;
    }

</style>

<body>
    <div style="font-family: THSarabunNew; padding: 2.5em;">
        <p style="text-align: center;font-size: 20px;">
            <b>สัญญา เช่าห้องพัก <br>
            หอพักมาลัยเพลส คลองหลวง ปทุมธานี</b>
        </p>
        <p style="font-family: THSarabunNew;font-size: 16px;">
            ทำที่ : หอพักมาลัยเพลส คลองหลวง ปทุมธานี<br>
            วันที่ : {{ get_jFY($lease->date_start) }} <br>
            รหัสเช่า : {{ $lease->id }}
        </p>
        <table width="100%">
            <tbody style="font-size: 18px;" align="justify">
                <tr>
                    <td><tab1>
                        สัญญานี้ทำขึ้นระหว่าง {{ $lease->user->name }} รหัสบัตรประชาชน {{ $lease->idcard }} อายุ {{ $lease->user->age }} ปี
                        โทร.{{ $lease->user->phone }} ซึ่งต่อไปในสัญญานี้ จะเรียกว่า “ผู้เช่า” ฝ่ายหนึ่ง กับ{{ $wcfg->address }} ซึ่งต่อไปในสัญญานี้จะเรียกว่า “ผู้ให้เช่า”
                        อีกฝ่ายหนึ่งคู่สัญญาทั้งสองฝ่ายได้ตกลง ทำสัญญาเช่ากัน มีข้อความดังจะกล่าวต่อไปนี้
                    </td>
                </tr>
                <tr>
                    <th>
                        ข้อ 1. ทรัพย์ที่เช่า
                    </th>
                </tr>
                <tr>
                    <td><tab1>
                        ผู้ให้เช่าตกลงให้เช่า และผู้เช่าตกลงเช่าห้องพักเลขที่ {{ $lease->room->number }} ตึก {{ $lease->room->building }} ประเภท {{ $lease->room->type->name }}
                        ชื่อหอพัก {{ $wcfg->address }}
                    </td>
                </tr>
                <tr>
                    <th>
                        ข้อ 2. วัตถุประสงค์ของการเช่า
                    </th>
                </tr>
                <tr>
                    <td><tab1>
                        เช่าตกลงเช่าทรัพย์ตามข้อ 1. เพื่อวัตถุประสงค์ในการพักอาศัยเท่านั้น
                    </td>
                </tr>
                <tr>
                    <th>
                        ข้อ 3. อัตราค่าเช่าและระยะเวลาการเช่า
                    </th>
                </tr>
                <tr>
                    <td><tab1>
                        คู่สัญญาตกลงให้เช่าทรัพย์ตามข้อ 1. มีกำหนดเวลา 6 เดือน นับตั้งแต่วันที่ {{get_jFY($lease->date_start)}} ถึงวันที่ {{get_jFY($lease->date_end)}}
                        โดยจะชำระค่าเช่าล่วงหน้าเป็นรายเดือน เดือนละ {{number_format($lease->typ_price,2)}} บาท ซึ่งผู้ให้เช่าได้รับเงินดังกล่าวไว้เรียบร้อยแล้ว
                        สำหรับค่าเช่าในเดือนถัดไปผู้เช่าตกลงชำระให้แก่ผู้ให้เช่าตามประกาศของหอพักหอพักมาลัยเพลส
                    </td>
                </tr>
                <tr>
                    <th>
                        ข้อ 4. เงินประกันการเช่า
                    </th>
                </tr>
                <tr>
                    <td><tab1>
                        ในวันทำสัญญานี้ผู้เช่าได้วางเงินประกันจำนวน {{number_format($lease->typ_doposit,2)}} บาท ให้แก่ผู้ให้เช่าเงินประกันดังกล่าว
                        เมื่อสัญญาสิ้นสุดลงไปไม่ว่ากรณีใด ๆ หากผู้เช่าไม่ได้ติดค้างชำระค่าเช่าหรือก่อความเสียหายใด ๆ แก่ทรัพย์ที่เช่า ตามข้อ 1.
                        ผู้ให้เช่าจะต้องคืนเงินจำนวนดังกล่าวให้แก่ผู้เช่า แต่หากผู้เช่ายังค้างชำระค่าเช่าหรือก่อความเสียหายใด ๆ ให้แก่แก่ทรัพย์ที่เช่า
                        ตามข้อ 1. ผู้เช่ายินยอมให้ผู้ให้เช่านำค่าเช่าที่ค้างชำระ หรือค่าเสียหายมาหักจากเงินประกันดังกล่าว ได้และหากเงินดังกล่าวไม่พอ
                        ผู้เช่ายังจะต้องรับผิดชดใช้แก่ผู้ให้เช่าจนครบ
                    </td>
                </tr>

            </tbody>
        </table>

        <table width="100%" style="margin-top: 3em">
            <tbody style="font-size: 18px;" align="justify">
                <tr>
                    <th colspan="2">
                        ข้อ 5. ค่าน้ำประปา ค่ากระแสไฟฟ้า ค่าส่วนกลาง
                    </th>
                </tr>
                <tr>
                    <td colspan="2"><tab1>
                        ผู้เช่าจะต้องชำระค่าน้ำประปา(ถ้ามี) และค่ากระแสไฟฟ้าให้แก่ผู้ให้เช่าตามจำนวนที่ใช้ในแต่ละเดือนตามมาตรวัดที่
                        ได้ติดตั้งไว้หน้าห้องของผู้เช่าโดยมีอัตราดังนี้
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <tab1>1 ) ค่าน้ำประปา ยูนิตละ {{ number_format($lease->room->type->water,2) }} บาท<br>
                        <tab1>2 ) ค่ากระแสไฟฟ้า ยูนิตละ {{ number_format($lease->room->type->power,2) }} บาท<br>
                        <tab1>3 ) ค่าส่วนกลาง เดือนละ {{ number_format($lease->room->type->centric,2) }} บาท<br>
                        <tab1>4 ) ค่าอินเตอร์เน็ต เดือนละ {{ number_format($lease->room->type->wifi,2) }} บาท<br>
                        <tab1>5 ) ค่าเช่าที่จอดรถ เดือนละ {{ number_format($lease->room->type->vehicle,2) }} บาท
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><tab1>
                        ค่าน้ำประปาและค่ากระแสไฟฟ้านี้ผู้ให้เช่าจะแจ้งให้ผู้เช่าทราบภายในทุกวันที่ 25 ของทุกเดือนและให้ผู้เช่าต้อง
                        ชำระเงินดังกล่าวภายในวันที่ 5 ของเดือนถัดไปมิฉะนั้นจะมีค่าปรับ วันละ 50 บาท อนึ่งอัตราค่าน้ำประปาและค่ากระแสไฟฟ้านี้
                        อาจขึ้นลง ได้ตามส่วนการการขึ้นลงของอัตราค่าน้ำประปาของการประปานครหลวง และค่ากระแสไฟฟ้าของการไฟฟ้านครหลวง
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        ข้อ 6. การพักอาศัย
                    </th>
                </tr>
                <tr>
                    <td colspan="2"><tab1>
                        การเช่าห้องพักตามข้อ 1. ก็เพื่อววัตถุประสงค์เฉพาะให้ผู้เช่าพักอาศัยเท่านั้นผู้เช่าจะนำบุคคล ภายนอกเข้ามาพัก
                        อาศัยไม่ได้โดยเด็ดขาด
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <br>
                        *****ค่าใช้จ่ายในการทำสัญญาเช่าห้องพัก*****
                    </th>
                </tr>
                <tr>
                    <td>
                        <tab1>ค่าเช่าห้อง
                    </td>
                    <td>
                        {{ number_format($lease->typ_price,2) }} บาท
                    </td>
                </tr>
                <tr>
                    <td>
                        <tab1>ค่าอินเตอร์เน็ต
                    </td>
                    <td>
                        {{ $lease->typ_wifi = ($lease->typ_wifi == "no" ? "0.00" : number_format($lease->room->type->wifi,2)) }} บาท
                    </td>
                </tr>
                <tr>
                    <td>
                        <tab1>ค่าเช่าที่จอดรถ
                    </td>
                    <td>
                        {{ $lease->typ_vehicle = ($lease->typ_vehicle == "no" ? "0.00" : number_format($lease->room->type->vehicle,2)) }} บาท
                    </td>
                </tr>
                <tr>
                    <td>
                        <tab1>ค่าประกัน
                    </td>
                    <td>
                        {{ number_format($lease->typ_doposit,2) }} บาท
                    </td>
                </tr>
                <tr>
                    <td>
                        <tab1>หักค่าจอง
                    </td>
                    <td>
                        {{ number_format($lease->typ_booking,2) }} บาท
                    </td>
                </tr>
                <tr>
                    <th>
                        <tab1>รวมทั้งหมด
                    </th>
                    <th>
                        {{-- {{ number_format($lease->net_pay,2) }} บาท ({{ $lease->net_pay > 0 ? Functions::baht_text($lease->net_pay) : "-" }}) --}}
                        {{ number_format($lease->net_pay,2) }} บาท  ({{ $lease->net_pay > 0 ? Sawasdee::readThaiCurrency($lease->net_pay) : "-" }})
                    </th>
                </tr>
                <tr>
                    <td colspan="2"><br>
                        <tab1>สัญญานี้ทำขึ้น 2 ฉบับ มีข้อความถูกต้องตรงกัน คู่สัญญาได้อ่านและเข้าใจข้อความดีแล้วเห็นว่าสัญญาถูกต้อง
                        ดีแล้วจึงได้ลงลายมือชื่อไว้เป็นหลักฐานและพยาย
                    </td>
                </tr>

            </tbody>
        </table>


        <table width="100%" style="margin-top: 2.5em">
            <tbody style="font-size: 18px; text-align: center;">
                <tr>
                    <td>ลงชื่อ........................................................ผู้ให้เช่า</td>
                    <td>ลงชื่อ........................................................ผู้เช่า</td>
                </tr>
                <tr>
                    <td>{{"(".Auth::user()->name.")"}}</td>
                    <td>{{"(".$lease->user->name.")"}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
