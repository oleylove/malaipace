@extends('admin.app')
@section('title','Malaiplace | แก้ไขข้อมูลประกาศ')
@section('webconfig','active')

@section('content')
<div class="container-fluid" id="noticePage">


    <form method="POST" action="{{ url('/notice/' . $notice->id) }}" accept-charset="UTF-8"
        class="form-horizontal" enctype="multipart/form-data" id="formNotice">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @include ('notice.form', ['formMode' => 'edit'])

    </form>

</div>
@endsection
