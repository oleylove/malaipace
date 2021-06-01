@extends('admin.app')
@section('title','Malaiplace | ข้อมูลห้องเช่า')
@section('webconfig','active')

@section('content')
<div class="container-fluid" id="noticePage">
    <div class="col-lg-12 col-md-12">
        <div class="card">

            <div class="card-header card-header-tabs card-header-danger">
                <div class="row align-self-center">
                    <div class="col-md-10">
                        <h4 class="card-title ">ตารางข้อมูลประกาศ</h4>
                        <p class="card-category">{{ 'ทั้งหมด  ' .$noticeCount. ' รายการ' }}</p>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url('/notice/create') }}" title="Create Notice" rel="tooltip" class="btn btn-success btn-fab btn-round">
                            <i class="material-icons">queue</i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="tab-content">
                        {{-- table notice --}}
                        <div class="tab-pane active" id="notice">
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

                            <table class="table table-hover table-sm" id="dataTableType">
                                <thead class="text-info">
                                    <tr class="text-center">
                                        <th>ลำดับ</th>
                                        <th>วันที่</th>
                                        <th class="text-left">รายละเอียด</th>
                                        <th>Actions</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($notice as $item)
                                    <tr class="text-center">
                                        <td>
                                            {{ ($notice->currentpage()-1) * $notice->perpage() + $loop->index + 1 }}
                                        </td>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>{{ get_dmY($item->date) }}</td>
                                        <td class="text-left">{{ Str::substr($item->detail, 0, 100) ." . . . . ." }}</td>
                                        <td class="td-actions justify-content-center">
                                            <a href="{{ url('/notice/' .$item->id) }}" title="View" rel="tooltip" type="button"
                                                rel="tooltip" class="btn btn-info btn-round mr-2">
                                                <i class="material-icons">search</i>
                                            </a>
                                            <a href="{{ url('/notice/' .$item->id. '/edit') }}" title="Edit" rel="tooltip"
                                                type="button" rel="tooltip" class="btn btn-danger btn-round">
                                                <i class="material-icons">edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper pull-right">
                                {!! $notice->appends(['status' => Request::get('status')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.model-show-notice')
@endsection
