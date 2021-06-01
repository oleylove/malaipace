@extends('layouts.app')

@section('title','Malaiplace | Room')

@section('Booking','active')

@section('content')

<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">ประเภทห้อง : {{ $type->name }}</h1>
                        <span class="color-text-a">ทั้งหมด : {{ $rooms->count() }} ห้องที่ว่าง</span>
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
                            <li class="breadcrumb-item">
                                <a href="{{ route('type.grid') }}">
                                    ประเภทห้อง
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $type->name }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- =======  Blog Grid ======= -->
    <section class="news-grid grid">
        <div class="container">
            <div class="row">
                @foreach($rooms as $item)
                <div class="col-md-4">
                    <div class="card-box-b card-shadow news-box">
                        <div class="img-box-b">

                            @if(Storage::exists('public/'.$item->photo1))
                            <img src="{{ url('/') }}/storage/{{$item->photo1}}"
                                class="img-fluid rounded-lg border border-success">

                            @elseif(Storage::exists('public/'.$item->photo2))
                            <img src="{{ url('/') }}/storage/{{$item->photo2}}"
                                class="img-fluid rounded-lg border border-success">

                            @elseif(Storage::exists('public/'.$item->photo3))
                            <img src="{{ url('/') }}/storage/{{$item->photo3}}"
                                class="img-fluid rounded-lg border border-success">

                            @elseif(Storage::exists('public/'.$item->photo4))
                            <img src="{{ url('/') }}/storage/{{$item->photo4}}"
                                class="img-fluid rounded-lg border border-success">

                            @else
                            <img src="{{ url('/') }}/storage/rooms/404.png"
                                class="img-fluid rounded-lg border border-success">
                            @endif

                        </div>
                        <div class="card-overlay">
                            <div class="card-header-b">
                                <div class="card-title-b">
                                    <h2 class="title-2">
                                        <a href="{{ url('room-single/'.$item->id ) }}">
                                            ห้อง : {{ $item->number }} <br>
                                            ตึก : {{ $item->building }}
                                        </a>
                                    </h2>
                                </div>
                                <div class="card-date">
                                    <span class="date-b">
                                        {{ $item->updated_at->format('d M ,Y') }}
                                    </span>
                                </div>
                                <div class="card-category-b mt-2">
                                    <a href="{{ url('room-single/'.$item->id ) }}" class="category-b">
                                        View Room
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <nav class="pagination-a">
                        <ul class="pagination justify-content-end">
                            {{ $rooms->appends(['search'=>request('search')])->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Grid-->

    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main><!-- End #main -->
@endsection
