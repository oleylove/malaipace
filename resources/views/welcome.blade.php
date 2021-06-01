@extends('layouts.app')

@section('title','Malaiplace | Welcome')

@section('Home','active')

@section('content')
<div class="intro intro-carousel">
    <div id="carousel" class="owl-carousel owl-theme">
        @if(Storage::exists('public/'.$wcfg->photo1))
        <div class="carousel-item-a intro-item bg-image"
            style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo1}})">
            <div class="overlay overlay-a"></div>

            {{-- <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <h1 class="intro-title mb-4">
                                        <span class="color-b">{{ 'มีห้องว่างให้เช่า' }}</span>
                                        <br> {{ 'มีห้องว่างให้เช่า' }}</h1>
                                    <p class="intro-subtitle intro-price">
                                        <a href="#"><span class="price-a">มีห้องว่างให้เช่า</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        @endif

        @if(Storage::exists('public/'.$wcfg->photo2))
        <div class="carousel-item-a intro-item bg-image"
            style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo2}})">
            <div class="overlay overlay-a"></div>

            {{-- <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <h1 class="intro-title mb-4">
                                        <span class="color-b">ห้อง </span>
                                        <br> {{ '$wcfg->typ_name' }}</h1>
                                    <p class="intro-subtitle intro-price">
                                        <a href="#"><span class="price-a">Rent | $ {{ '$wcfg->typ_price' }}</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        @endif

        @if(Storage::exists('public/'.$wcfg->photo3))
        <div class="carousel-item-a intro-item bg-image"
            style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo3}})">
            <div class="overlay overlay-a"></div>

            {{-- <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <h1 class="intro-title mb-4">
                                        <span class="color-b">ห้อง </span>
                                        <br> {{ '$wcfg->typ_name' }}</h1>
                                    <p class="intro-subtitle intro-price">
                                        <a href="#"><span class="price-a">Rent | $ {{ '$wcfg->typ_price' }}</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        @endif

        @if(Storage::exists('public/'.$wcfg->photo4))
        <div class="carousel-item-a intro-item bg-image"
            style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo4}})">
            <div class="overlay overlay-a"></div>

            {{-- <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <h1 class="intro-title mb-4">
                                        <span class="color-b">ห้อง </span>
                                        <br> {{ '$wcfg->typ_name' }}</h1>
                                    <p class="intro-subtitle intro-price">
                                        <a href="#"><span class="price-a">Rent | $ {{ '$wcfg->typ_price' }}</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        @endif

        @if(Storage::exists('public/'.$wcfg->photo5))
        <div class="carousel-item-a intro-item bg-image"
            style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo5}})">
            <div class="overlay overlay-a"></div>

            {{-- <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <h1 class="intro-title mb-4">
                                        <span class="color-b">ห้อง </span>
                                        <br> {{ '$wcfg->typ_name' }}</h1>
                                    <p class="intro-subtitle intro-price">
                                        <a href="#"><span class="price-a">Rent | $ {{ '$wcfg->typ_price' }}</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        @endif
    </div>
</div>

@endsection
