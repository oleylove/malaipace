@extends('layouts.app')

@section('title','Malaiplace | Please reserve the room first')

@section('Status','active')

@section('content')
<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 offset-md-6 col-lg-8 offset-lg-6">
                    <div class="title-single-box">
                        <h1 class="title-single">{{ $title_single }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Blog Single ======= -->
    <section class="news-single nav-arrow-b">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 offset-md-6 offset-lg-6">
                    <div class="form-comments">
                        <div class="title-box-d">
                            <h3 class="title-d">{{ $title_d }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main><!-- End #main -->
<!-- End Blog Single-->
@endsection
