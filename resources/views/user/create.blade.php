@extends('admin.app')
@section('title','Malaiplace | เพิ่มข้อมูลสมาชิก')
@section('user','active')

@section('content')
<div class="container-fluid" id="userPage">

    <form method="POST" action="{{ url('/user') }}" accept-charset="UTF-8" class="form-horizontal"
        enctype="multipart/form-data" id="formUser">>
        {{ csrf_field() }}

        @include ('user.form', ['formMode' => 'create'])

    </form>

</div>
@endsection
