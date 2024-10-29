@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
  <h2>Products</h2>
  <div class="breadcrumb-wrapper">
    <span class="label">
        <div class="btn-group mr5">
            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" style="font-size: 12px;">
              + NEW PRODUCTS <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/product/create') }}" style="font-size: 12px;">Cars</a></li>
            </ul>
        </div>
  </div>
</div>

<div class="contentpanel">
    <div class="row">
        <div class="panel" style="box-shadow: 0 0px 0;">
            <div class="panel-body grey-bgcolor">
                <ul class="nav nav-tabs nav-justified">
                    <li id="isActiveTab">
                        <a data-toggle="tab" href="#isActive"><strong class="titleActive">Active - {{ $data['active'] }}</strong></a>
                    </li>
                    <li id="isSoldTab" class="">
                        <a data-toggle="tab" href="#isSold"><strong class="titleSold">Sold - {{ $data['sold'] }}</strong></a>
                    </li>
                    <li id="isInactiveTab" class="">
                        <a data-toggle="tab" href="#isInactive"><strong class="titleInactive">Draft - {{ $data['inactive'] }}</strong></a>
                    </li>
                    <li id="isDeletedTab" class="">
                        <a data-toggle="tab" href="#isDeleted"><strong class="titleDeleted">Deleted - {{ $data['deleted'] }}</strong></a>
                    </li>
                    <!--
                    <li id="isBiddingTab" class="">
                        <a data-toggle="tab" href="#isBidding"><strong class="titleBidding">Bidding - {{ $data['bidding'] }}</strong></a>
                    </li>
                    -->
                </ul>
                <div class="tab-content white-bgcolor">
                <div id="isActive" class="tab-pane active">
                    <form id="search1" data-id="1" class="form-inline" data-action="{{ url('/product/summary/active') }}">
                        <div class="panel-body" style="padding: 10px 0px;">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <input type="text" class="form-control end_date" name="product_name" placeholder="Product Name" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <select name="min_bid_price" id="min_bid_price" class="form-control" style="width: 100%;">
                                        <option value="">Select min. bidding price</option>
                                        <option value="0.50">50%</option>
                                        <option value="0.70">70%</option>
                                    </select>
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-6 col-lg-6 ptb-5">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success search-btn" style="height: 39px;" data-id="1"> <i class="glyphicon glyphicon-zoom-in"></i> Search</button>
                                        {{-- <button type="button" class="btn btn-primary download-btn1" style="height: 39px;" data-action="{{ url('/web/product/download') }}">Download Excel</button> --}}
                                    </div>
                                </div><!-- col-md-6 col-lg-6 -->
                            </div>
                        </div>

                        <input type="hidden" name="type" value="0">
                        <div id="result1"><img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."></div>
                    </form>
                </div><!-- tab-pane -->
                <div id="isSold" class="tab-pane">
                    <form id="search2" data-id="2" class="form-inline" data-action="{{ url('/product/summary/sold') }}">
                        <div class="panel-body" style="padding: 10px 0px;">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <input type="text" class="form-control end_date" name="product_name" placeholder="Product Name" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <select name="min_bid_price" id="min_bid_price" class="form-control" style="width: 100%;">
                                        <option value="">Select min. bidding price</option>
                                        <option value="0.50">50%</option>
                                        <option value="0.70">70%</option>
                                    </select>
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-6 col-lg-6 ptb-5">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success search-btn" style="height: 39px;" data-id="2"> <i class="glyphicon glyphicon-zoom-in"></i> Search</button>
                                        {{-- <button type="button" class="btn btn-primary download-btn2" style="height: 39px;" data-action="{{ url('/web/product/download') }}">Download Excel</button> --}}
                                    </div>
                                </div><!-- col-md-6 col-lg-6 -->
                            </div>
                        </div>

                        <input type="hidden" name="type" value="2">
                        <div id="result2"><img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."></div>
                    </form>
                </div><!-- tab-pane -->
                <div id="isInactive" class="tab-pane">
                    <form id="search3" data-id="3" class="form-inline" data-action="{{ url('/product/summary/inactive') }}">
                        <div class="panel-body" style="padding: 10px 0px;">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <input type="text" class="form-control end_date" name="product_name" placeholder="Product Name" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <select name="min_bid_price" id="min_bid_price" class="form-control" style="width: 100%;">
                                        <option value="">Select min. bidding price</option>
                                        <option value="0.50">50%</option>
                                        <option value="0.70">70%</option>
                                    </select>
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-6 col-lg-6 ptb-5">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success search-btn" style="height: 39px;" data-id="3"> <i class="glyphicon glyphicon-zoom-in"></i> Search</button>
                                        {{-- <button type="button" class="btn btn-primary download-btn3" style="height: 39px;" data-action="{{ url('/web/product/download') }}">Download Excel</button> --}}
                                    </div>
                                </div><!-- col-md-6 col-lg-6 -->
                            </div>
                        </div>

                        <input type="hidden" name="type" value="1">
                        <div id="result3"><img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."></div>
                    </form>
                </div><!-- tab-pane -->
                <div id="isDeleted" class="tab-pane">
                    <form id="search4" data-id="4" class="form-inline" data-action="{{ url('/product/summary/deleted') }}">
                        <div class="panel-body" style="padding: 10px 0px;">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <input type="text" class="form-control end_date" name="product_name" placeholder="Product Name" style="width: 100%;">
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-3 col-lg-3 ptb-5">
                                    <select name="min_bid_price" id="min_bid_price" class="form-control" style="width: 100%;">
                                        <option value="">Select min. bidding price</option>
                                        <option value="0.50">50%</option>
                                        <option value="0.70">70%</option>
                                    </select>
                                </div><!-- col-md-3 col-lg-3 -->
                                <div class="col-md-6 col-lg-6 ptb-5">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success search-btn" style="height: 39px;" data-id="4"> <i class="glyphicon glyphicon-zoom-in"></i> Search</button>
                                        {{-- <button type="button" class="btn btn-primary download-btn4" style="height: 39px;" data-action="{{ url('/web/product/download') }}">Download Excel</button> --}}
                                    </div>
                                </div><!-- col-md-6 col-lg-6 -->
                            </div>
                        </div>

                        <input type="hidden" name="type" value="3">
                        <div id="result4"><img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."></div>
                    </form>
                </div><!-- tab-pane -->
            </div><!-- panel-body -->
        </div>
    </div>
</div><!-- contentpanel -->

<div id="statusModal" class="modal fade bd-example-modal-md" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: #000;">×</button>
                <h4 class="modal-title" id="myModalLabel" style="color: #000;">Change Status!</h4>
            </div>
            <div class="modal-body text-center">
                <div class="row" style="min-height: 120px;">
                    <h4 class="headerText">Product has successfully been updated.<br/>The product you updated has been moved to its designated status tab. <br/><br/>This page will refresh after a few seconds.</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script src="{{ URL::asset('js/pagination/pagination-multiple.js?v=1.1') }}"></script>
<script>
function changeStatus(status, id) {
    var data = "";
    $.ajax({
        url: status,
        type: "GET",
        data: data,
        success: function(data){
            $('#statusModal').modal('show');
            $("tr#div_"+id+"").remove();

            var delay = 3500;
            setTimeout(function(){ location.reload(true); }, delay);
        }
    });
}
</script>
@stop
