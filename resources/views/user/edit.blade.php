@extends('admin.app')
@section('title','Malaiplace | แก้ไขข้อมูลสมาชิก')
@section('user','active')

@section('content')
<div class="container-fluid" id="userPage">

        <form method="POST" action="{{ url('/user/' . $user->id) }}" accept-charset="UTF-8"
            class="form-horizontal" enctype="multipart/form-data" id="formUser">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @include ('user.form', ['formMode' => 'edit'])

        </form>

</div>
@endsection
