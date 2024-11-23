@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
    <h2>Cars</h2>
    <h3>Product ID: {{ $data->product_identification_number }}</h3>
    <div class="breadcrumb-wrapper">
        <span class="label"><a href="{{ url('/product') }}">BACK</a></span>
    </div>
</div>

<div class="contentpanel">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>FEATURED IMAGE & VIDEO</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                        @if($data->image)
                            <img class="img-responsive" src="{{ asset('storage/car_images/' . $data->image) }}" alt="{{ $data->product_name }}" title="{{ $data->product_name }}" style="width: 250px;">
                        @else
                            <img class="img-responsive" src="{{ URL::asset('images/no-image.png') }}" alt="{{ $data->product_name }}" title="{{ $data->product_name }}">
                        @endif
                    </div>
                    <div class="col-md-12 mt-2 mb-2" style="margin-top: 20px;">
                        <video src="{{ asset('storage/featured_videos/' . $data->featured_video) }}" class="w-full h-96 object-cover rounded" style="height:500px; width:500px;" controls type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div><!-- panel -->
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>PRODUCT DETAILS</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Product Name</label>
                        <b class="f-width-wt-border-bottom">{{ $data->product_name }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Year Model</label>
                        <b class="f-width-wt-border-bottom">{{ $data->year_model }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Plate Number</label>
                        <b class="f-width-wt-border-bottom">{{ $data->plate_number }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Document Status</label>
                        <b class="f-width-wt-border-bottom">{{ $data->document_status }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Latest Condition</label>
                        <b class="f-width-wt-border-bottom">{{ $data->latest_condition }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Mileage</label>
                        <b class="f-width-wt-border-bottom">{{ $data->mileage }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Transmission</label>
                        <b class="f-width-wt-border-bottom">{{ $data->transmission }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Fuel Type</label>
                        <b class="f-width-wt-border-bottom">{{ $data->fuel_type }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <b class="f-width-wt-border-bottom">{{ $data->color }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <b class="f-width-wt-border-bottom">{{ $data->seating_capacity }}</b>
                    </div>
                    <div class="col-sm-3 col-md-3 pt-20">
                        <label class="f-width">Status</label>
                        <b class="f-width-wt-border-bottom">{{ $data->isStatus() }}</b>
                    </div>
                    <div class="col-sm-12 col-md-12 pt-20">
                        <label class="f-width">Descriptions</label>
                        <b class="f-width-wt-border-bottom">{{ $data->descriptions }}</b>
                    </div>
                </div>
            </div><!-- panel -->
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>PRICING DETAILS</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-4 col-md-4">
                        <label class="f-width">Inventory Price</label>
                        <b class="f-width-wt-border-bottom">PHP {{ number_format($data->inventory_price, 2) }}</b>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <label class="f-width">Selling Price</label>
                        <b class="f-width-wt-border-bottom">PHP {{ number_format($data->selling_price, 2) }}</b>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <label class="f-width">Market Value</label>
                        <b class="f-width-wt-border-bottom">PHP {{ number_format($data->market_value, 2) }}</b>
                    </div>
                </div>
            </div><!-- panel -->
        </div>
        <div class="col-md-4">
            <div class="panel panel-default" style="height: 165px;">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>MININUM BIDDING PRICE</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <b class="f-width-wt-border-bottom"> {{ intval($data->min_bid_price * 100)}}%</b>
                </div>
            </div><!-- panel -->
        </div>
    </div>
</div><!-- contentpanel -->
@endsection
