@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลประเภทห้อง')
@section('room','active')

@section('content')
<div class="container-fluid">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ดูข้อมูลประเภทห้อง</h4>
                        <p class="card-category">{{ 'รหัสประเภทห้อง # ' .$type->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/room/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        <a href="{{ url('/type/' . $type->id . '/edit') }}" title="Edit" rel="tooltip"
                            class="btn btn-danger btn-fab btn-round">
                            <i class="material-icons">edit</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row no-gutters">
                    <div class="col-md-4 mt-4 text-center">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised">
                                @if (!empty($type->photo))
                                    @if(Storage::exists('public/'.$type->photo))
                                        <img src="{{ url('/') }}/storage/{{ $type->photo }}" rel="nofollow" alt="...">
                                    @else
                                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                    <div class="row no-gutters">
                        <div class="col-md ml-3">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th width="100px"> ประเภท </th>
                                            <td> {{ $type->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าเช่า </th>
                                            <td> {{ number_format($type->price,2) . ' บาท/เดือน'}} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าน้ำ </th>
                                            <td> {{ number_format($type->water,2) . ' บาท/หน่วย'}} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าไฟ </th>
                                            <td> {{ number_format($type->power,2) . ' บาท/หน่วย'}} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าส่วนกลาง </th>
                                            <td> {{ number_format($type->centric,2) . ' บาท/เดือน'}} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th width="100px"> ค่า Wifi </th>
                                            <td> {{ number_format($type->wifi,2) . ' บาท/เดือน'}} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าที่จอดรถ </th>
                                            <td> {{ number_format($type->vehicle,2) . ' บาท/เดือน'}} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าปรับ </th>
                                            <td> {{ number_format($type->mulct,2) . ' บาท/วัน'}} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าจอง </th>
                                            <td> {{ number_format($type->booking,2) . ' บาท'}} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่ามัดจำ </th>
                                            <td> {{ number_format($type->doposit,2) . ' บาท'}} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
