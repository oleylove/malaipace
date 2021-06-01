{{-- @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired')) --}}

@extends('layouts.app')

@section('title','Malaiplace | Type Room')

@section('Booking','active')
<main id="main">

    @section('content')
    <!-- 404 error section -->
    <section id="aa-error">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-error-area">
                        <h2>149</h2>
                        <span>Sorry! Page Expired</span>
                        <p>Sorry this content has been moved Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit.
                            Earum, amet perferendis, nemo facere excepturi quis.</p>
                        <a href="{{ url('/') }}"> Go to Homepage</a>
                        {{-- <p>{{ $exception->getMessage() }}</p> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / 404 error section -->
</main><!-- End #main -->

@endsection
