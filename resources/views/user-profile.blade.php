@extends('layouts.app')

@section('title','Malaiplace | Profile')

@section('Profile','active')

@section('content')

<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Profile</h1>
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Profile
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Property Single ======= -->
    <section class="property-single nav-arrow-b">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (session('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('fail') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-5 mb-5">
                            @if (!empty($user->photo))
                                @if(Storage::exists('public/'.$user->photo))
                                    <img src="{{ url('/') }}/storage/{{ $user->photo }}" class="img-fluid" rel="nofollow" alt="...">
                                @else
                                    <img src="{{ asset('assets/images/lostitem.png')  }}" class="img-fluid" rel="nofollow" alt="...">
                                @endif
                                @else
                                    <img src="{{ asset('assets/images/selectuser.png')  }}" class="img-fluid" rel="nofollow" alt="...">
                            @endif
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="property-agent">
                                <h4 class="title-agent">ข้อมูลส่วนตัวจากสัญญาเช่า</h4>
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">รหัสบัตร :</span>
                                        <span class="color-text-a">
                                            {{ $user->lease->idcard }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">ชื่อ :</span>
                                        <span class="color-text-a">
                                            {{ $user->name }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">เพศ/อายุ :</span>
                                        <span class="color-text-a">
                                            {{ $user->gender .' / ' .$user->age . 'ปี'}}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">เบอร์โทร :</span>

                                        <span class="color-text-a">
                                            {{ $user->phone }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">E-mail :</span>
                                        <span class="color-text-a">
                                            {{ $user->email }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">ห้อง :</span>
                                        <span class="color-text-a">
                                            {{ $user->lease->room->number .' ตึก ' .$user->lease->room->building }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">ประเภท :</span>
                                        <span class="color-text-a">
                                            {{ $user->lease->room->type->name }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">พาหนะ :</span>
                                        <span class="color-text-a">
                                            {{ $user->lease->vehicle }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">ทะเบียน :</span>
                                        <span class="color-text-a">
                                            {{ $user->lease->vehicle_reg }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">วันเริ่มเช่า :</span>
                                        <span class="color-text-a">
                                            {{ Date::parse($user->lease->date_start)->format('d F Y') }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">วันครบสัญญา :</span>
                                        <span class="color-text-a">
                                            {{ Date::parse($user->lease->date_end)->format('d F Y') }}
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">ระยะเวลาเช่า :</span>
                                        <span class="color-text-a">
                                            @if (isset($user->lease->checkout))
                                                {{ get_timespan(get_Ymd($user->lease->checkout),get_Ymd($user->lease->date_start)) }}
                                            @else
                                                {{ get_timespan(get_Ymd(Date::now()),get_Ymd($user->lease->date_start)) }}
                                            @endif
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="font-weight-bolder">สถานะเช่า :</span>
                                        <span class="float-right">
                                            @switch($user->lease->status )
                                                @case('เช่าอยู่')
                                                <button type="button" class="btn btn-outline-success btn-sm mr-2">
                                                    {{ $user->lease->status }}
                                                    <i class="fas fa-circle text-success ml-1"></i>
                                                </button>
                                                @break
                                                @case('แจ้งย้าย')
                                                <button type="button" class="btn btn-outline-danger btn-sm mr-2" data-toggle="modal" data-target="#userCheckpot">
                                                    {{ $user->lease->status }}
                                                    <div class="spinner-grow text-danger spinner-grow-sm" role="status"></div>
                                                </button>
                                                @break
                                                @case('ยืนยันแจ้งย้าย')
                                                <button type="button" class="btn btn-outline-primary btn-sm mr-2">
                                                    {{ $user->lease->status }}
                                                    <i class="fas fa-circle text-primary ml-1"></i>
                                                </button>
                                                @break
                                                @default
                                                <button type="button" class="btn btn-outline-danger btn-sm mr-2">
                                                    {{ 'ข้อมูลผิดพลาด' }}
                                                    <i class="text-danger fas fa-exclamation-circle mr-1"></i>
                                                </button>
                                            @endswitch
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <form class="form-a was-validated" method="POST" action="{{ url('change-photo') }}"
                                accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <div class="row mt-2">
                                    <div class="col-md-9">
                                        <div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
                                            <label for="photo"
                                                class="control-label font-weight-bold">{{ 'เปลี่ยนรูปโปรไฟล์' }}</label>
                                            <input class="form-control" name="photo" type="file" id="photo"
                                                value="{{ isset($user->photo) ? $user->photo : ''}}" required>
                                            {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
                                            <input type="hidden" name="photo_old" id="photo_old"
                                                value="{{ isset($user->photo) ? $user->photo : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4 text-right">
                                        <button type="submit" class="btn btn-primary mt-1">แก้ไข</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.model-change-password')
        @include('layouts.model-checkout')
    </section>
    <!-- End Property Single-->
</main><!-- End #main -->

@endsection
