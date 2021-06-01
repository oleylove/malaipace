@extends('layouts.app')

@section('title','Malaiplace | Status Booking')

@section('Status','active')

@section('content')

<main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="title-single-box">
                        <h1 class="title-single">ห้อง {{ $room->number }} ตึก {{ $room->building }}</h1>
                        <span class="color-text-a">ปรถเภทห้อง {{ $room->type->name }}</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('type-grid') }}">ประเภทห้อง</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('room-grid/'.$room->type->id) }}">{{ $room->type->name }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $room->building }} {{ $room->number }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Single-->

    <!-- ======= Property Single ======= -->
    <section class="property-single nav-arrow-b">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">

                        @if(Storage::exists('public/'.$room->photo1))
                        <div class="carousel-item-b">
                            <img src="{{ url('/') }}/storage/{{$room->photo1}}" class="rounded-lg border border-success"
                                alt="">
                        </div>
                        @endif

                        @if(Storage::exists('public/'.$room->photo2))
                        <div class="carousel-item-b">
                            <img src="{{ url('/') }}/storage/{{$room->photo2}}" class="rounded-lg border border-success"
                                alt="">
                        </div>
                        @endif

                        @if(Storage::exists('public/'.$room->photo3))
                        <div class="carousel-item-b">
                            <img src="{{ url('/') }}/storage/{{$room->photo3}}" class="rounded-lg border border-success"
                                alt="">
                        </div>
                        @endif

                        @if(Storage::exists('public/'.$room->photo4))
                        <div class="carousel-item-b">
                            <img src="{{ url('/') }}/storage/{{$room->photo4}}" class="rounded-lg border border-success"
                                alt="">
                        </div>
                        @endif

                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-5 col-lg-4">
                            {{-- <div class="property-price d-flex justify-content-center foo">
                                <div class="card-header-c d-flex">
                                    <div class="card-box-ico">
                                        <span class="ion-money">$</span>
                                    </div>
                                    <div class="card-title-c align-self-center">
                                        <h5 class="title-c">{{ number_format($room->type->price) }}</h5>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="property-summary">
                                <div class="col-sm-12">
                                    <div class="title-box-d section-t4">
                                        <h3 class="title-d">รายละเอียดห้องพัก</h3>
                                    </div>
                                </div>
                                <div class="summary-list">
                                    <ul class="list">
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าเช่า :</span>
                                            <span>{{ number_format($room->type->price) }} บาท/เดือน</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าน้ำ :</span>
                                            <span>{{ $room->type->water }} บาท/หน่วย</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าไฟ :</span>
                                            <span>{{ $room->type->power }} บาท/หน่วย</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าส่วนกลาง :</span>
                                            <span>{{ $room->type->centric }} บาท/เดือน</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าอินเตอร์เน็ต :</span>
                                            <span>{{ $room->type->wifi }} บาท/เดือน</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าเช่าที่จอดรถ :</span>
                                            <span>{{ $room->type->vehicle }} บาท/เดือน</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าปรับล้าช้า :</span>
                                            <span>{{ $room->type->mulct }} บาท/วัน</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่าจองห้อง :</span>
                                            <span>{{ number_format($room->type->booking) }} บาท</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>ค่ามัดจำ :</span>
                                            <span>{{ number_format($room->type->doposit) }} บาท</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 section-md-t3">
                            {{-- <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        <h3 class="title-d">เงื่อนไขการจองห้องพัก</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="property-description">
                                <p class="description color-text-a">
                                    เลือกห้องที่ต้องการจอง แล้วคลิก "จองห้องนี้" กรอกข้อมูลจริงให้ครบทุกช่อง
                                    ชำระเงินจอง {{ number_format($room->type->booking) }} บาท ภายในวันที่จอง
                                    เมื่อชำระเจร็จแล้ว กรุณาแจ้งชำระงินจองพร้อมแนบหลักฐานการโอนให้ครบ
                                    หรือสามามารถกับโทรแจ้งทางเจ้าของอพาร์ทเม้นท์เพื่อยืนยันสิทธ์การจองห้องพัก
                                </p>
                                <p class="description color-text-a text-danger">
                                    *** สามารถจองได้ที่ละห้อง
                                    หากต้องการเปลี่ยนให้ยกเลิกห้องเดิมก่อนแล้วค่อยจองห้องใหม่<br>
                                    *** หากไม่ชำระเงินภายในกำหนดการจองจะถูกยกเลิกในวันถัดไป <br>
                                    *** หากมีข้อสงสัยกรุณาสอบถามข้อมูลกับทางอพาร์ทเม้นท์
                                </p>
                            </div> --}}
                            <div class="row section-t4">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        @auth
                                        @switch($bkg->status)
                                        @case('จอง')
                                        <div class="title-box-d">
                                            <h3 class="title-d">จองโดย : {{ $bkg->user->name }}</h3>
                                        </div>
                                        <div class="title-box-d">
                                            <h3 class="title-d">สถานะ : {{ 'รอตรวจสอบ' }}</h3>
                                        </div>
                                        <div class="title-box-d">
                                            <h3 class="title-d">จำนวน : {{ $bkg->typ_booking}} บาท</h3>
                                        </div>
                                        @break
                                        @case('ยืนยันจอง')
                                        <div class="col-sm-12">
                                            <div class="title-box-d">
                                                <h3 class="title-d">จองโดย : {{ $bkg->user->name }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">วันทำสัญญา :
                                                    {{ get_jFY($bkg->date_start) }}
                                                </h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">สถานะ : {{ 'รอทำสัญญาเช่า' }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">ค่าใช้จ่ายขั้นต่ำ :
                                                    {{ number_format(($room->type->price + $room->type->doposit) - $room->type->booking ) }}
                                                    บาท
                                                </h3>
                                            </div>
                                            <div class="property-description">
                                                <p class="description color-text-a text-danger">
                                                    หมายเหตู : หากไม่มาทำสัญญาเช่าตามกำหนดเกิน 3 วัน
                                                    จะถือว่าสละสิทธิ์การจองและจะไม่คืนเงินจอง
                                                    <br>
                                                    หากมีข้อผิดพลาด
                                                    <br>
                                                    *****กรุณาติดต่อทางอพาร์ทเม้นท์*****
                                                </p>
                                            </div>
                                        </div>
                                        @break
                                        @case('ยกเลิกจอง')
                                        <div class="col-sm-12">
                                            <div class="title-box-d">
                                                <h3 class="title-d">เช่าโดย : {{ $bkg->user->name }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">วันทำสัญญา :
                                                    {{ get_jFY($bkg->date_start) }}
                                                </h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">สถานะ : {{ 'เกินกำหนด หรือ มีข้อผิดพลาด' }}</h3>
                                            </div>
                                            <div class="property-description">
                                                <p class="description color-text-a text-danger">
                                                    หมายเหตู : หากไม่มาทำสัญญาเช่าตามกำหนดเกิน 3 วัน
                                                    จะถือว่าสละสิทธิ์การจองและจะไม่คืนเงินจอง หรือมีข้อผิดพลาด  <br>
                                                    *****กรุณาติดต่อทางอพาร์ทเม้นท์*****
                                                </p>
                                            </div>
                                        </div>
                                        @break
                                        @case('เช่าอยู่')
                                        <div class="col-sm-12">
                                            <div class="title-box-d">
                                                <h3 class="title-d">เช่าโดย : {{ $bkg->user->name }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">สถานะ : {{ 'เช่าอยู่' }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">ครบสัญญา : {{ get_jFY($bkg->date_end) }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">{{ get_timespan($bkg->date_start,Date::now()) }}</h3>
                                            </div>
                                        </div>
                                        @break
                                        @case('แจ้งย้าย')
                                        <div class="col-sm-12">
                                            <div class="title-box-d">
                                                <h3 class="title-d">เช่าโดย : {{ $bkg->user->name}}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">สถานะ : {{ 'แจ้งย้าย' }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">วันย้าย : {{ get_jFY($bkg->checkout) }}</h3>
                                            </div>
                                        </div>
                                        @break
                                        @case('ย้ายออก')
                                        <div class="col-sm-12">
                                            <div class="title-box-d">
                                                <h3 class="title-d">เช่าโดย : {{ $bkg->user->name}}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">สถานะ : {{ 'ย้ายออก' }}</h3>
                                            </div>
                                            <div class="title-box-d">
                                                <h3 class="title-d">วันย้าย : {{ get_jFY($bkg->checkout) }}</h3>
                                            </div>
                                        </div>
                                        @break
                                        @endswitch
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Property Single-->
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main>
<!-- End #main -->

@endsection
