@extends('admin.app')
@section('report','active')

@section('content')
<div class="container-fluid" id="reportPage">
    <div class="row no-gutters">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-danger">
                    <div class="row">
                        <div class="col-md">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">รายงาน : </span>
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('report') == 'รายงานบัญชี' ? ' active' : '' }}"
                                                href="{{ url('/report/income?report=รายงานบัญชี') }}">
                                                <i class="material-icons">request_quote</i> รายงานบัญชี
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('report') == 'รายงานเช่า' ? ' active' : '' }}"
                                                href="{{ url('/report/lease?report=รายงานเช่า') }}">
                                                <i class="material-icons">contact_page</i>รายงานเช่า
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('report') == 'รายงานซ่อมบำรุง' ? ' active' : '' }}"
                                                href="{{ url('/report/maintenance?report=รายงานซ่อมบำรุง') }}">
                                                <i class="material-icons">engineering</i>รายงานซ่อมบำรุง
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('report') == 'รายงานใบแจ้งหนี้' ? ' active' : '' }}"
                                                href="{{ url('/report/invoice?report=รายงานใบแจ้งหนี้') }}">
                                                <i class="material-icons">receipt</i>รายงานใบแจ้งหนี้
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            @if ( request('report') == 'รายงานบัญชี')
                            <a href="javascript:void(0)" class="btn btn-success btn-fab btn-round"
                                rel="tooltip" title="เพิ่มบัญชี" data-toggle="modal" data-target="#modalIncome">
                                <i class="material-icons">library_add</i>
                            </a>
                            @endif
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

                    @if (request('report'))
                        @switch(request('report'))
                        @case('รายงานบัญชี')
                            @include('report.report-income')
                            @include('admin.model-store-income')
                            @include('admin.model-show-income')
                            @include('admin.model-update-income')
                            @section('title','Malaiplace | Income Report')
                        @break
                        @case('รายงานเช่า')
                            @include('report.report-lease')
                            @section('title','Malaiplace | Lease Report')
                        @break
                        @case('รายงานซ่อมบำรุง')
                            @include('report.report-maintenance')
                            @section('title','Malaiplace | Maintenance Report')
                        @break
                        @case('รายงานใบแจ้งหนี้')
                            @include('report.report-invoice')
                            @section('title','Malaiplace | Invoice Report')
                        @break
                        @endswitch
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
