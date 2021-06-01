@extends('layouts.app')

@section('title','Malaiplace | Type Room')

@section('Booking','active')

@section('content')

<main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">ประเภทห้องพัก</h1>
                        <span class="color-text-a">
                            ทั้งหมด : {{ $types->count() }} ประเภท
                        </span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                ประเภทห้องพัก
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single -->

    <!-- ======= Agent Single ======= -->
    <section class="agent-single">
        <div class="container">
            <div class="row">
                <div class="row property-grid grid">

                    @foreach($types as $item)
                    <div class="col-md-4">
                        <div class="card-box-a card-shadow">
                            <div class="img-box-a">
                                @if(Storage::exists('public/'.$item->photo))
                                <img src="{{ url('/') }}/storage/{{$item->photo}}"
                                    class="img-a img-fluid rounded-lg border border-success">
                                @else
                                <img src="{{ url('/') }}/storage/types/404.jpg"
                                    class="img-a img-fluid rounded-lg border border-success">
                                @endif
                            </div>
                            <div class="card-overlay">
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="{{ url('room-grid/'.$item->id ) }}">
                                                ห้อง{{ $item->name }}
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            <span class="price-a">
                                                Rent | $ {{ number_format($item->price) }}
                                            </span>
                                        </div>
                                        <a href="{{ url('room-grid/'.$item->id ) }}" class="link-a">
                                            Click here to view
                                            <span class="ion-ios-arrow-forward"></span>
                                        </a>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">ค่าน้ำ</h4>
                                                <span>{{ $item->water }}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">ค่าไฟ</h4>
                                                <span>{{ $item->power }}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">ค่าส่วนกลาง</h4>
                                                <span>{{ $item->centric }}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">ค่าอินเตอร์เน็ต</h4>
                                                <span>{{ $item->wifi }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- End Agent Single -->
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main>
<!-- End #main -->
@endsection
