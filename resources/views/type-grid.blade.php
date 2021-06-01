@extends('layouts.app')

@section('title','Malaiplace | Type Room')

@section('Booking','active')

@section('content')

<main id="main">
    <!-- ======= Latest Properties Section ======= -->
    <section class="section-property section-t8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="title-a">
                                รายละเอียดประเภทห้อง
                            </h2>
                        </div>
                        <div class="title-link">
                            <a href="{{ route('type.all') }}">
                                ประเภทห้องทั้งหมด
                                <span class="ion-ios-arrow-forward"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="property-carousel" class="owl-carousel owl-theme">

                @foreach($types as $item)
                <div class="carousel-item-b">
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
                                            ห้อง {{ $item->name }}
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
                                            <h4 class="card-info-title">ส่วนกลาง</h4>
                                            <span>{{ $item->centric }}</span>
                                        </li>
                                        <li>
                                            <h4 class="card-info-title">WiFi</h4>
                                            <span>{{ $item->wifi }}</span>
                                        </li>
                                        <li>
                                            <h4 class="card-info-title">ค่าจอง</h4>
                                            <span>{{ $item->booking }}</span>
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
    </section>
    <!-- End Latest Properties Section -->
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main>
<!-- End #main -->

@endsection
