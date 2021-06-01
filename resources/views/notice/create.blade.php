@extends('admin.app')
@section('title','Malaiplace | เพิ่มข้อมูลประกาศ')
@section('webconfig','active')

@section('content')
<div class="container-fluid" id="noticePage">

    <form method="POST" action="{{ url('/notice') }}" accept-charset="UTF-8" class="form-horizontal"
        enctype="multipart/form-data" id="formNotice">
        {{ csrf_field() }}

        @include ('notice.form', ['formMode' => 'create'])

    </form>

</div>
@endsection
