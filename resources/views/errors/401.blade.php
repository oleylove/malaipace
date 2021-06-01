{{-- @extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized')) --}}


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
                        <h2>401</h2>
                        <span>Sorry! Unauthorized</span>
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
