@extends('layouts.app')

@section('title','Malaiplace | Home')

@section('Home','active')

@section('content')
<main id="main">

    <div class="intro intro-carousel">
        <div id="carousel" class="owl-carousel owl-theme">
            @if(Storage::exists('public/'.$wcfg->photo1))
            <div class="carousel-item-a intro-item bg-image"
                style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo1}})">
                <div class="overlay overlay-a"></div>
            </div>
            @endif

            @if(Storage::exists('public/'.$wcfg->photo2))
            <div class="carousel-item-a intro-item bg-image"
                style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo2}})">
                <div class="overlay overlay-a"></div>

            </div>
            @endif

            @if(Storage::exists('public/'.$wcfg->photo3))
            <div class="carousel-item-a intro-item bg-image"
                style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo3}})">
                <div class="overlay overlay-a"></div>

            </div>
            @endif

            @if(Storage::exists('public/'.$wcfg->photo4))
            <div class="carousel-item-a intro-item bg-image"
                style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo4}})">
                <div class="overlay overlay-a"></div>
            </div>
            @endif

            @if(Storage::exists('public/'.$wcfg->photo5))
            <div class="carousel-item-a intro-item bg-image"
                style="background-image: url({{ url('/') }}/storage/{{$wcfg->photo5}})">
                <div class="overlay overlay-a"></div>
            </div>
            @endif
        </div>
    </div>
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main><!-- End #main -->

@endsection
