@extends('admin.app')
@section('title','Malaiplace | แก้ไขข้อมูลห้องเช่า')
@section('room','active')

@section('content')
<div class="container-fluid" id="roomPage">


    <form method="POST" action="{{ url('/room/' . $room->id) }}" accept-charset="UTF-8"
        class="form-horizontal" enctype="multipart/form-data" id="formRoom">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @include ('room.form', ['formMode' => 'edit'])

    </form>

</div>
@endsection
