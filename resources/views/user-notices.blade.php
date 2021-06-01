@extends('layouts.app')

@section('title','Malaiplace | Notice')

@section('Notice','active')

@section('content')
<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single mb-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="title-single-box">
                        <h1 class="title-single">
                            ประกาศจากทางอพาร์ทเม้นท์
                        </h1>
                        <span class="color-text-a">ทั้งหมด : {{ $noticeCount }} รายการ</span>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Blog Single ======= -->
    <section class="news-single nav-arrow-b">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataNotice" style="font-family: Kanit">
                            <thead>
                                <tr>
                                    <th class="text-right">วันที่ลงประกาศ</th>
                                    <th class="text-left">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notice as $item)
                                <tr>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td class="text-right">{{ get_jFY($item->date) }}</td>
                                    <td class="text-left">
                                        <a href="javascript:void(0)" id="photoNotice" data-img="{{ $item->photo }}" data-detail="{{ $item->detail }}">
                                            {{ Str::substr($item->detail, 0, 110) ." . . . . ." }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper">
                            {!! $notice->appends(['search' => Request::get('search')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @include('layouts.model-show-notice')
    @include('layouts.model-change-password')
    @include('layouts.model-checkout')
</main><!-- End #main -->
<!-- End Blog Single-->
@endsection
