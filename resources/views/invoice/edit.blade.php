@extends('admin.app')
@section('title','Malaiplace | แก้ไขข้อมูลใบแจ้งหนี้')
@section('invoice','active')

@section('content')
<div class="container-fluid" id="invoicePage">


    <form method="POST" action="{{ url('/invoice/' . $invoice->id) }}" accept-charset="UTF-8"
        class="form-horizontal" enctype="multipart/form-data" id="formInvoice">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @include ('invoice.form', ['formMode' => 'edit'])

    </form>

</div>
@endsection
