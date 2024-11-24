@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
  <h2>Bidder Accounts</h2>
</div>

<div class="contentpanel">
    <div class="row">
        <div class="panel" style="box-shadow: 0 0px 0;">
            <div class="panel-body grey-bgcolor">
                <ul class="nav nav-tabs nav-justified">
                    <li id="isActiveTab">
                        <a data-toggle="tab" href="#isActive"><strong class="titleActive">Pending - {{ $data['pending'] }}</strong></a>
                    </li>
                    <li id="isSoldTab" class="">
                        <a data-toggle="tab" href="#isSold"><strong class="titleSold">Approved - {{ $data['approved']}}</strong></a>
                    </li>
                </ul>
                <div class="tab-content white-bgcolor">
                <div id="isActive" class="tab-pane active">
                    <form id="search1" data-id="1" class="form-inline" data-action="{{ url('/bidder/summary/pending') }}">
                        <div class="panel-body" style="padding: 10px 0px;">
                            <h3 class="panel-title">Search Parameter</h3><br/>
                            <div class="row row-pad-5">
                                <div class="col-md-3 col-lg-3">
                                    <input type="text" class="form-control" id="search_name" name="search_name" placeholder="Name" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3">
                                    <input type="email" class="form-control" id="search_email" name="search_email" placeholder="Email" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success search-btn" style="height: 39px;"> <i class="glyphicon glyphicon-zoom-in"></i> Search</button>
                                    </div>
                                </div><!-- col-md-3 col-lg-3 -->
                            </div>
                        </div>

                        <input type="hidden" name="type" value="0">
                        <div id="result1"><img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."></div>
                    </form>
                </div><!-- tab-pane -->
                <div id="isSold" class="tab-pane">
                    <form id="search2" data-id="2" class="form-inline" data-action="{{ url('/bidder/summary/approved') }}">
                        <div class="panel-body" style="padding: 10px 0px;">
                            <h3 class="panel-title">Search Parameter</h3><br/>
                            <div class="row row-pad-5">
                                <div class="col-md-3 col-lg-3">
                                    <input type="text" class="form-control" id="search_name" name="search_name" placeholder="Name" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3">
                                    <input type="email" class="form-control" id="search_email" name="search_email" placeholder="Email" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success search-btn" style="height: 39px;"> <i class="glyphicon glyphicon-zoom-in"></i> Search</button>
                                    </div>
                                </div><!-- col-md-3 col-lg-3 -->
                            </div>
                        </div>

                        <input type="hidden" name="type" value="2">
                        <div id="result2"><img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."></div>
                    </form>
                </div><!-- tab-pane -->
            </div><!-- panel-body -->
        </div>
    </div>
</div><!-- contentpanel -->

@endsection
@section('javascript')
<script src="{{ URL::asset('js/pagination/pagination-multiple.js?v=1.1') }}"></script>
@stop
