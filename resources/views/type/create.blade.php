@extends('admin.app')
@section('title','Malaiplace | เพิ่มข้อมูลประเภทห้อง')
@section('room','active')

@section('content')
<div class="container-fluid" id="typePage">

    <form method="POST" action="{{ url('/type') }}" accept-charset="UTF-8" class="form-horizontal"
        enctype="multipart/form-data" id="formType">
        {{ csrf_field() }}

        @include ('type.form', ['formMode' => 'create'])

    </form>

</div>
@endsection
