@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลประกาศ')
@section('webconfig','active')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ดูข้อมูลประกาศ</h4>
                        <p class="card-category">{{ 'รหัสประกาศ # ' .$notice->id }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/notice/') }}" title="Back" rel="tooltip" class="btn btn-warning btn-fab btn-round">
                            <i class="material-icons">undo</i>
                        </a>
                        <a href="{{ url('/notice/' . $notice->id . '/edit') }}" title="Edit" rel="tooltip"
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
                                @if (!empty($notice->photo))
                                    @if(Storage::exists('public/'.$notice->photo))
                                        <img src="{{ url('/') }}/storage/{{ $notice->photo }}" rel="nofollow" alt="...">
                                    @else
                                        <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
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
                                        <th width="130px"> วันที่ลงประกาศ :</th>
                                        <td> {{ $notice->date }} </td>
                                    </tr>
                                    <tr>
                                        <th> รายละเอียด :</th>
                                        <td> {{ $notice->detail }} </td>
                                    </tr>
                                    <tr>
                                        <th> เอกสารประกาศ :</th>
                                        <td>{{ isset($notice->file) ? $notice->file : 'ไม่มีเอกสาร' }}
                                            @if (!empty($notice->file))
                                                @if(Storage::exists('public/'.$notice->file))
                                                <a href="{{ url('/') }}/storage/{{ $notice->file }}" class="pl-2" target="_blank" title="View" rel="tooltip">
                                                    <img src="{{ asset('assets/images/pdf.png')  }}" width="50px" rel="nofollow" alt="...">
                                                </a>
                                                @else
                                                    <img src="{{ asset('assets/images/lostitem.png')  }}" width="50px" rel="nofollow" alt="...">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/images/nopdf.png')  }}" width="50px" rel="nofollow" alt="...">
                                            @endif
                                        </td>
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
