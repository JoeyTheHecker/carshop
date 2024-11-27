@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
  <h2>Dashboard</h2>
  <p>Here’s a glance of the what’s happening today.</p>
</div>

<div class="contentpanel">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading">
                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-9">
                                <small class="stat-label">New Inquiry (Today)</small>
                                <h1>{{ $data['newInquiry'] }}</h1>
                            </div>
                        </div><!-- row -->
                        <div class="mb15"></div>
                    </div><!-- stat -->
                </div>
            </div><!-- panel -->
        </div><!-- col-sm-3 -->
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading" style="background-color: #d9534f;">
                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-9">
                                <small class="stat-label">Total Active Cars</small>
                                <h1>{{ $data['totalActive'] }}</h1>
                            </div>
                        </div><!-- row -->
                        <div class="mb15"></div>
                    </div><!-- stat -->
                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-3 -->
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading" style="background-color: #428BCA;">
                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-9">
                                <small class="stat-label">Total Sold Cars</small>
                                <h1>{{ $data['totalSold'] }}</h1>
                            </div>
                        </div><!-- row -->
                        <div class="mb15"></div>
                    </div><!-- stat -->
                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-3 -->
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading" style="background-color: #1D2939;">
                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-9">
                                <small class="stat-label">Total Deleted Cars</small>
                                <h1>{{ $data['totalInactive'] }}</h1>
                            </div>
                        </div><!-- row -->
                        <div class="mb15"></div>
                    </div><!-- stat -->
                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-3 -->
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading" style="background-color: #6C757D;">
                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-9">
                                <small class="stat-label">Total Active bids</small>
                                <h1>{{ $data['totalActiveBids'] }}</h1>
                            </div>
                        </div><!-- row -->
                        <div class="mb15"></div>
                    </div><!-- stat -->
                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-3 -->
    </div>
</div><!-- contentpanel -->
@endsection
@section('javascript')
<script src="{{ URL::asset('js/chart/highcharts.js') }}"></script>
<script src="{{ URL::asset('js/chart/exporting.js') }}"></script>
<script src="{{ URL::asset('js/chart/export-data.js') }}"></script>
<script src="{{ URL::asset('js/dashboard/dashboard.js') }}"></script>

@stop
