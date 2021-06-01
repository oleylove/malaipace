@extends('layouts.app')

@section('title','Malaiplace | Room')

@section('Booking','active')

@section('content')

<main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="title-single-box">
                        <h1 class="title-single">ห้อง {{ $room->number }} ตึก {{ $room->building }}</h1>
                        <span class="color-text-a">ประเภทห้อง {{ $room->type->name }}</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('type.grid') }}">ประเภทห้อง</a>
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
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title-box-d section-t4">
                                            <h3 class="title-d">รายละเอียดห้องพัก</h3>
                                        </div>
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
                                            <span>ค่ามัดจำ :</span>
                                            <span>{{ number_format($room->type->doposit) }} บาท</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card border-primary mb-3">
                                    <div class="card-header">
                                        <h5>ชำระเงินเงินจองห้องได้ที่</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <img src="{{ url('/') }}/storage/{{$wcfg->bbl_logo}}" width="42px"
                                                    height="42px" class="rounded-lg">
                                            </div>
                                            <div class="col-md-10">
                                                {{ $wcfg->bbl }}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <img src="{{ url('/') }}/storage/{{$wcfg->kbsnk_logo}}" width="42px"
                                                    height="42px" class="rounded-lg">
                                            </div>
                                            <div class="col-md-10">
                                                {{ $wcfg->kbsnk }}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <img src="{{ url('/') }}/storage/{{$wcfg->scb_logo}}" width="42px"
                                                    height="42px" class="rounded-lg">
                                            </div>
                                            <div class="col-md-10">
                                                {{ $wcfg->scb }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ url('/') }}/storage/{{$wcfg->bay_logo}}" width="42px"
                                                    height="42px" class="rounded-lg">
                                            </div>
                                            <div class="col-md-10">
                                                {{ $wcfg->bay }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 section-md-t3">
                            <div class="row section-t4">
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
                                    เมื่อชำระเสร็จแล้ว กรุณาแจ้งชำระงินจองพร้อมแนบหลักฐานการโอนให้ครบ
                                    หรือสามามารถกับโทรแจ้งทางเจ้าของอพาร์ทเม้นท์เพื่อยืนยันสิทธ์การจองห้องพัก
                                </p>
                                <p class="description color-text-a text-danger">
                                    *** สามารถจองได้ที่ละห้อง หากต้องการเปลี่ยนให้ยกเลิกห้องเดิมก่อนแล้วค่อยจองห้องใหม่
                                    <br>
                                    *** หากไม่ชำระเงินภายในกำหนดการจองจะถูกยกเลิกในวันถัดไป <br>
                                    *** หากมีข้อสงสัยกรุณาสอบถามข้อมูลกับทางอพาร์ทเม้นท์
                                </p>
                            </div>
                            <div class="row section-t3">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        @auth
                                        @if($room->status == 'ว่าง')
                                            @if(Auth::user()->role == 'guest' && Auth::user()->status == 'สมาชิกใหม่')
                                            <form class="form-horizontal was-validated" method="POST"
                                                action="{{ route('user.booking') }}" accept-charset="UTF-8"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label>
                                                            รหัสบัตรประชาชน <span class="text-danger"> * </span>
                                                        </label>
                                                        <input type="text" id="idcard" name="idcard"
                                                            class="form-control is-invalids" autocomplete="off"
                                                            pattern="([0-9]{1})-([0-9]{4})-([0-9]{5})-([0-9]{2})-([0-9]{1})"
                                                            onkeyup="autoTab2(this,1)" required>
                                                        <div class="invalid-feedback">
                                                            กรุณากรอกรหัสบัตรประจำตัวประชาชน 13 หลักด้วยคะ
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>
                                                            วันย้ายเข้า<span class="text-danger"> * </span>
                                                        </label>
                                                        <input type="date" id="date_start" name="date_start" min="{{ get_Ymd(Date::now()) }}" max="{{ get_Ymd(Date::now()->add('1 month')) }}"
                                                            class="form-control is-invalids" autocomplete="off" required>
                                                        <div class="invalid-feedback">
                                                            กรุณาเลือกวันที่ย้ายเข้าด้วยคะ
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>
                                                            หลักฐานการชำระเงิน<span class="text-danger"> * </span>
                                                        </label>
                                                        <input type="file" id="bkg_slip" name="bkg_slip"
                                                            class="form-control is-invalids" required>
                                                        <div class="invalid-feedback">
                                                            กรุณาแบบหลักฐานการชำระเงินด้วยคะ
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="rm_id" id="rm_id" value="{{ $room->id }}">
                                                <button type="submit" class="title-d btn btn-success btn-block">
                                                    จองห้องนี้
                                                </button>
                                            </form>
                                            @elseif(Auth::user()->role == 'admin')
                                            <a href="{{ route('home') }}">
                                                <h3 type="button" class="title-d btn btn-danger btn-block">
                                                    ผู้ดูแลหอพักไม่สามารถจองห้องได้
                                                </h3>
                                            </a>
                                            @elseif((Auth::user()->role == 'guest' && Auth::user()->status == 'สมาชิกออกแล้ว'))
                                                <a class="title-d btn btn-success btn-block" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ 'คุณเคยเช่าและย้ายออกไปแล้วกรุณาออกจากระบบและลงทะเบียนใหม่' }}
                                                </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            @else
                                            <a href="{{ route('home') }}">
                                                <h3 type="button" class="title-d btn btn-danger btn-block">
                                                    คุณได้เช่าหรือจองห้องไปแล้ว
                                                </h3>
                                            </a>
                                            @endif
                                        @else
                                        <div class="alert alert-danger text-center" role="alert">
                                            <h1>ห้องนี้ไม่ว่าง กรุณาเลือกห้องอื่น</h1>
                                        </div>
                                        @endif
                                        @else
                                        <a href="{{ route('register') }}">
                                            <h3 type="button" class="title-d btn btn-success btn-block">
                                                หากต้องการจองห้องเช่า <br>
                                                กรุณาลงทะเบียนก่อนคะ
                                            </h3>
                                        </a>
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
