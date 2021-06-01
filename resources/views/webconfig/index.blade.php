@extends('admin.app')
@section('title','Malaiplace | ดูข้อมูลอพาร์ทเมนท์')
@section('webconfig','active')

@section('content')
<div class="container-fluid" id="webconfigPage">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-info">
                <div class="row align-self-center">
                    <div class="col-md-8">
                        <h4 class="card-title ">ดูข้อมูลอพาร์ทเมนท์</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ url('/notice/') }}" title="ประกาศ" class="btn btn-primary btn-round" rel="tooltip">
                            <i class="material-icons">campaign</i>&nbsp;&nbsp; ประกาศอพาร์ทเม้นท์
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('fail') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row no-gutters">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6 mt-4 text-center">
                                <label for="photo1" class="control-label">{{ 'Slide-1 แนะนำขนาด 1920 x 960' }}</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        @if (!empty($webconfig->photo1))
                                        @if(Storage::exists('public/'.$webconfig->photo1))
                                                <img src="{{ url('/') }}/storage/{{ $webconfig->photo1 }}" rel="nofollow" alt="...">
                                            @else
                                                <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                            @endif
                                        @else
                                            <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 text-center">
                                <label for="photo2" class="control-label">{{ 'Slide-2 แนะนำขนาด 1920 x 960' }}</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        @if (!empty($webconfig->photo2))
                                        @if(Storage::exists('public/'.$webconfig->photo2))
                                                <img src="{{ url('/') }}/storage/{{ $webconfig->photo2 }}" rel="nofollow" alt="...">
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
                        <div class="row">
                            <div class="col-md-6 mt-4 text-center">
                                <label for="photo3" class="control-label">{{ 'Slide-3 แนะนำขนาด 1920 x 960' }}</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        @if (!empty($webconfig->photo3))
                                        @if(Storage::exists('public/'.$webconfig->photo3))
                                                <img src="{{ url('/') }}/storage/{{ $webconfig->photo3 }}" rel="nofollow" alt="...">
                                            @else
                                                <img src="{{ asset('assets/images/lostitem.png')  }}" rel="nofollow" alt="...">
                                            @endif
                                        @else
                                            <img src="{{ asset('assets/images/selectimage.png')  }}" rel="nofollow" alt="...">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 text-center">
                                <label for="photo4" class="control-label">{{ 'Slide-4 แนะนำขนาด 1920 x 960' }}</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        @if (!empty($webconfig->photo4))
                                        @if(Storage::exists('public/'.$webconfig->photo4))
                                                <img src="{{ url('/') }}/storage/{{ $webconfig->photo4 }}" rel="nofollow" alt="...">
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
                        <div class="row">
                            <div class="col-md-6 mt-4 text-center">
                                <label for="photo4" class="control-label">{{ 'Slide-5 แนะนำขนาด 1920 x 960' }}</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        @if (!empty($webconfig->photo5))
                                        @if(Storage::exists('public/'.$webconfig->photo5))
                                                <img src="{{ url('/') }}/storage/{{ $webconfig->photo5 }}" rel="nofollow" alt="...">
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

                    <div class="col-md-7">
                        <div class="col-md ml-3">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="dataTableConfig">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th> Title </th>
                                            <td>
                                                {{ $webconfig->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> URL เว็บ </th>
                                            <td> {{ $webconfig->website }} </td>
                                        </tr>
                                        <tr>
                                            <th> ที่อยู่หอพัก </th>
                                            <td> {{ $webconfig->address }} </td>
                                        </tr>
                                        <tr>
                                            <th>Logo เว็บ</th>
                                            <td>
                                                @if (!empty($webconfig->logo))
                                                @if(Storage::exists('public/'.$webconfig->logo))
                                                        <img src="{{ url('/') }}/storage/{{ $webconfig->logo }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @else
                                                        <img src="{{ asset('assets/images/lostitem.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/images/selectimage.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ธนาคารกรุงเทพ</th>
                                            <td>
                                                @if (!empty($webconfig->bbl_logo))
                                                @if(Storage::exists('public/'.$webconfig->bbl_logo))
                                                        <img src="{{ url('/') }}/storage/{{ $webconfig->bbl_logo }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @else
                                                        <img src="{{ asset('assets/images/lostitem.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/images/selectimage.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                @endif
                                                {{ $webconfig->bbl }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ธนาคารกสิกรไทย </th>
                                            <td>
                                                @if (!empty($webconfig->kbsnk_logo))
                                                @if(Storage::exists('public/'.$webconfig->kbsnk_logo))
                                                        <img src="{{ url('/') }}/storage/{{ $webconfig->kbsnk_logo }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @else
                                                        <img src="{{ asset('assets/images/lostitem.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/images/selectimage.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                @endif
                                                {{ $webconfig->kbsnk }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ธนาคารไทยพาณิชย์ </th>
                                            <td>
                                                @if (!empty($webconfig->scb_logo))
                                                @if(Storage::exists('public/'.$webconfig->scb_logo))
                                                        <img src="{{ url('/') }}/storage/{{ $webconfig->scb_logo }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @else
                                                        <img src="{{ asset('assets/images/lostitem.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/images/selectimage.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                @endif
                                                {{ $webconfig->scb	 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> ธนาคารกรุงศรีอยุธยา </th>
                                            <td>
                                                @if (!empty($webconfig->bay_logo))
                                                @if(Storage::exists('public/'.$webconfig->bay_logo))
                                                        <img src="{{ url('/') }}/storage/{{ $webconfig->bay_logo }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @else
                                                        <img src="{{ asset('assets/images/lostitem.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/images/selectimage.png')  }}" width="40px" height="40px" rel="nofollow" alt="...">
                                                @endif
                                                {{ $webconfig->bay }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row p-2 ml-2 d-flex align-items-start">
                            <div class="col-md">
                                <button type="button" class="btn btn-danger btn-round" data-toggle="modal"
                                    data-target="#ModalEditSlide" title="แก้ไขรูปสไลด์" rel="tooltip">
                                    แก้ไขรูปสไลด์
                                </button>
                                <button type="button" class="btn btn-primary btn-round" data-toggle="modal"
                                    data-target="#ModalEditLogo" title="แก้ไขข้อมูลธนาคาร" rel="tooltip">
                                    แก้ไขข้อมูลธนาคาร
                                </button>
                                <button type="button" class="btn btn-info btn-round" data-toggle="modal"
                                    data-target="#ModalEditConfig" title="แก้ไขข้อมูลอพาทเม้น" rel="tooltip">
                                    แก้ไขข้อมูลอพาทเม้น
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.model-edit-slide')
@include('admin.model-edit-logo')
@include('admin.model-edit-malaipace')
@endsection
