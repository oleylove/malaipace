@extends('admin.app')

@section('title','Dashboard')

@section('dashboard','active')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">volunteer_activism</i>
                    </div>
                    <p class="card-category">Revenue</p>
                    <h3 class="card-title">{{ number_format($dashboard->revSum). ' ฿' }}</h3>
                </div> <br>
                {{-- <div class="card-footer">
                    <div class="stats"><br>
                        <i class="material-icons">date_range</i> Last 24 Hours
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">payments</i>
                    </div>
                    <p class="card-category">Expenditure</p>
                    <h3 class="card-title">{{ number_format($dashboard->expSum). ' ฿' }}</h3>
                </div> <br>
                {{-- <div class="card-footer">
                    <div class="stats"><br>
                        <i class="material-icons text-danger">warning</i>
                        <a href="javascript:;">Get More Space...</a>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            account_balance_wallet
                        </i>
                    </div>
                    <p class="card-category">Rent</p>
                    <h3 class="card-title">
                        {{ $dashboard->leaseCount }}
                        <span class="material-icons">person_pin</span>
                    </h3>
                </div> <br>
                {{-- <div class="card-footer">
                    <div class="stats"><br>
                        <i class="material-icons">local_offer</i> Tracked from Github
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <p class="card-category">Users</p>
                    <h3 class="card-title">
                        {{ $dashboard->user }}
                        <span class="material-icons">person</span>
                    </h3>
                </div> <br>
                {{-- <div class="card-footer">
                    <div class="stats"><br>
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="row">

        {{-- <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-danger"><br>
                    <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Completed Tasks</h4>
                    <p class="card-category">Last Campaign Performance</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-success"><br>
                    <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Account Summary</h4>
                    <p class="card-category">
                        <i class="material-icons text-white">radio_button_checked</i>
                        Revenue
                        <i class="material-icons text-danger">radio_button_checked</i>
                        Expenditure
                    </p>
                </div>
            </div>
        </div> --}}

        <div class="col-md-6">
            <div class="card card-chart ">
                <div class="card-header"><br>
                    <div>
                        {{ $chartMonth->container() }}
                    </div>
                    {{ $chartMonth->script() }}
                </div>
                <div class="card-body card-success">
                    <h4 class="card-title">Account Summary By Month</h4>
                    <p class="card-category">
                        <i class="material-icons text-success">radio_button_checked</i>
                        Revenue
                        <i class="material-icons text-danger">radio_button_checked</i>
                        Expenditure
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-chart ">
                <div class="card-header"><br>
                    <div>
                        {{ $chartYear->container() }}
                    </div>
                    {{ $chartYear->script() }}
                </div>

                <div class="card-body">
                    <h4 class="card-title">Account Summary By Year</h4>
                    <p class="card-category">
                        <i class="material-icons text-success">radio_button_checked</i>
                        Revenue
                        <i class="material-icons text-danger">radio_button_checked</i>
                        Expenditure
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

@endsection
