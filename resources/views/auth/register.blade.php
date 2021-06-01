@extends('layouts.app')

@section('title','Malaipace | Register')

@section('Register','active')

@section('content')
<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Register</h1>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Blog Single ======= -->
    <section class="news-single nav-arrow-b">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-10">
                    <div class="form-comments">

                        <div class="title-box-d">
                            <h3 class="title-d">กรุณากรอกข้อมูลจริง</h3>
                        </div>
                        <form class="form-horizontal form-a was-validated" method="POST"
                            action="{{ route('register') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-2 mb-1">
                                    <div class="form-group">
                                        <label for="name">{{ __('คำนำหน้า') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <select class="form-control" name="title_name" id="title_name" required>
                                            <option value="">เลือกคำนำหน้า....</option>
                                            <option value="{{ "นาย" }}">นาย</option>
                                            <option value="{{ "นาง" }}">นาง</option>
                                            <option value="{{ "นางสาว" }}">นางสาว</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก คำนำหน้า
                                        </div>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label for="name">{{ __('ชื่อ-สกุล') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input id="name" name="name" type="text" placeholder="Name"
                                            class="form-control is-invalids form-control-a @error('name') is-invalid @enderror"
                                            autocomplete="off" pattern="^[ก-๏\s]+$"
                                            title="กรุณากรอกชื่อ นามสกุล ภาษาไทย" required>
                                        <div class="invalid-feedback">
                                            กรุณากรอก ชื่อ-นามสกุล จริง
                                        </div>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <div class="form-group">
                                        <label for="age">{{ __('อายุ') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input id="age" name="age" type="text" placeholder="Age" autocomplete="off"
                                            class="form-control is-invalids form-control-a @error('age') is-invalid @enderror"
                                            pattern="([1-9]{1})([0-9]{1})" min="18" required>
                                        <div class="invalid-feedback">
                                            กรุณากรอกอายุ
                                        </div>
                                        @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <div class="form-group">
                                        <label for="gender">{{ __('เพศ') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <select name="gender" id="gender" required
                                            class="form-control is-invalids form-control-a @error('gender') is-invalid @enderror">
                                            <option value="">Gender . . .</option>
                                            <option value="ชาย">ชาย</option>
                                            <option value="หญิง">หญิง</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            กรุณาเลือกเพศ
                                        </div>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $gender }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label for="email">{{ __('อีเมลล์') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input id="email" name="email" type="email" placeholder="E-mail"
                                            class="form-control is-invalids form-control-a @error('email') is-invalid @enderror"
                                            autocomplete="off" required>
                                        <div class="invalid-feedback">
                                            กรุณากรอกอีเมล์ที่ใช้ได้จริง
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label for="phone">{{ __('เบอร์โทร') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input id="phone" name="phone" type="text" placeholder="Phone"
                                            class="form-control is-invalids form-control-a @error('phone') is-invalid @enderror"
                                            pattern="^0([8|9|6])([0-9]{1})-([0-9]{3})-([0-9]{4})"
                                            onkeyup="autoTab2(this,2)" autocomplete="off" required>
                                        <div class="invalid-feedback">
                                            กรุณากรอกเบอร์โทรศัพท์ 10 หลัก
                                        </div>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label for="password">{{ __('รหัสผ่าน') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input id="password" name="password" type="password" placeholder="Password"
                                            class="form-control is-invalids form-control-a @error('password') is-invalid @enderror"
                                            autocomplete="off" required>
                                        <div class="invalid-feedback">
                                            กรุณากรอกรหัสผ่านตัวเลขหรือตัวอักษร 8 ตัวขึ้นไป
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label for="password">{{ __('ยืนยันรหัสผ่าน') }}
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input id="password-confirm" type="password" placeholder="Confirm Password"
                                            class="form-control is-invalids form-control-a" name="password_confirmation"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-b">Register</button>
                                    <a href="{{ url('/') }}" class="btn btn-c">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<!-- End Blog Single-->

@endsection
