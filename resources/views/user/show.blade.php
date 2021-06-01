@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลสมาชิก')
@section('user','active')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ดูข้อมูลสมาชิก</h4>
                        <p class="card-category">{{ 'รหัสสมาชิก # ' .$user->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/user/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        <a href="{{ url('/user/' . $user->id . '/edit') }}" title="Edit" rel="tooltip"
                            class="btn btn-danger btn-fab btn-round">
                            <i class="material-icons">edit</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row no-gutters">
                    <div class="col-md-3 mt-4 text-center">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised">
                                @if (!empty($user->photo))
                                    @if(Storage::exists('public/'.$user->photo))
                                        <img src="{{ url('/') }}/storage/{{ $user->photo }}" rel="nofollow" alt="...">
                                    @else
                                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/selectuser.png')  }}" rel="nofollow" alt="...">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md ml-3">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <th width="120px"> ขื่อ-สกุล </th>
                                        <td> {{ $user->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> อายุ </th>
                                        <td> {{ $user->age }} </td>
                                    </tr>
                                    <tr>
                                        <th> เบอร์โทร </th>
                                        <td> {{ $user->phone }} </td>
                                    </tr>
                                    <tr>
                                        <th> อีเมล </th>
                                        <td> {{ $user->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> ตำแหน่ง </th>
                                        <td>
                                            @switch($user->role)
                                            @case('guest')
                                            {{ 'ผู้เช่าห้องพัก' }}
                                            @break
                                            @case('admin')
                                            {{ 'ผู้ดูแลหอพัก' }}
                                            @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> สถานะ </th>
                                        <td> {{ $user->status }} </td>
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
@endsection
