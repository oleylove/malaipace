@extends('admin.app')
@section('title','Malaiplace | แก้ไขข้อมูลประเภทห้อง')
@section('room','active')

@section('content')
<div class="container-fluid" id="typePage">

        <form method="POST" action="{{ url('/type/' . $type->id) }}" accept-charset="UTF-8"
            class="form-horizontal" enctype="multipart/form-data" id="formType">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @include ('type.form', ['formMode' => 'edit'])

        </form>

</div>
@endsection
