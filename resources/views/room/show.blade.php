@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลห้องเช่า')
@section('room','active')

@section('content')
<div class="container-fluid" id="roomPage">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ดูข้อมูลห้องเช่า</h4>
                        <p class="card-category">{{ 'รหัสห้องเช่า # ' .$room->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/room/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        <a href="{{ url('/room/' . $room->id . '/edit') }}" title="Edit" rel="tooltip"
                            class="btn btn-danger btn-fab btn-round">
                            <i class="material-icons">edit</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row no-gutters">
                    <div class="col-md-7">
                        <div class="col-md">
                            <div class="row">
                                <div class="col-md mt-4 text-center">
                                    <label for="photo1" class="control-label">{{ 'รูปในห้อง-1 แนะนำขนาด 1920 x 960' }}</label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-raised">
                                            @if (!empty($room->photo1))
                                                @if(Storage::exists('public/'.$room->photo1))
                                                    <img src="{{ url('/') }}/storage/{{ $room->photo1 }}" rel="nofollow" alt="...">
                                                @else
                                                    <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md mt-4 text-center">
                                    <label for="photo2" class="control-label">{{ 'รูปในห้อง-2 แนะนำขนาด 1920 x 960' }}</label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-raised">
                                            @if (!empty($room->photo2))
                                                @if(Storage::exists('public/'.$room->photo2))
                                                    <img src="{{ url('/') }}/storage/{{ $room->photo2 }}" rel="nofollow" alt="...">
                                                @else
                                                    <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="row">
                                <div class="col-md mt-4 text-center">
                                    <label for="photo3" class="control-label">{{ 'รูปหลังห้อง แนะนำขนาด 1920 x 960' }}</label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-raised">
                                            @if (!empty($room->photo3))
                                                @if(Storage::exists('public/'.$room->photo3))
                                                    <img src="{{ url('/') }}/storage/{{ $room->photo3 }}" rel="nofollow" alt="...">
                                                @else
                                                    <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md mt-4 text-center">
                                    <label for="photo4" class="control-label">{{ 'รูปห้องน้ำ แนะนำขนาด 1920 x 960' }}</label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-raised">
                                            @if (!empty($room->photo4))
                                                @if(Storage::exists('public/'.$room->photo4))
                                                    <img src="{{ url('/') }}/storage/{{ $room->photo4 }}" rel="nofollow" alt="...">
                                                @else
                                                    <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-md ml-3">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th width="150px"> เลขห้อง </th>
                                            <td> {{ $room->number }} </td>
                                        </tr>
                                        <tr>
                                            <th> ตึก </th>
                                            <td> {{ $room->building }} </td>
                                        </tr>
                                        <tr>
                                            <th> ประเภทห้อง</th>
                                            <td> {{ $room->type->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> ค่าเช่าห้อง </th>
                                            <td> {{ number_format($room->type->price,2). ' บาท/เดือน' }} </td>
                                        </tr>
                                        <tr>
                                            <th> มิเตอร์น้ำล่าสุด </th>
                                            <td> {{ $room->meter_wn }} </td>
                                        </tr>
                                        <tr>
                                            <th> มิเตอร์ไฟล่าสุด </th>
                                            <td> {{ $room->meter_pn }} </td>
                                        </tr>
                                        <tr>
                                            <th> สถานะห้อง </th>
                                            <td> {{ $room->status }} </td>
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
