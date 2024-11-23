@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
    <h2>Edit Products - Cars</h2>
    <div class="breadcrumb-wrapper">
        <span class="label"><a href="{{ url('/product') }}">BACK</a></span>
    </div>
</div>

<form id="submitForm" method="post" action="{{ url('/product/put') }}" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="{{ $products->id }}">
<input type="hidden" name="orig_image" id="orig_image" value="{{ $products->image }}">
{{ csrf_field() }}
<div class="contentpanel">
    <div class="row">
        <div class="col-sm-12 col-md-12 pt-20 successHolder" style="display: none;">
            <div class="alert alert-success"></div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>FEATURED IMAGE & VIDEO</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-3 col-md-3">
                        @if($products->image)
                            <img id="featuredImg" class="img-responsive" src="{{ asset('storage/car_images/' . $products->image) }}" alt="{{ $products->product_name }}" title="{{ $products->product_name }}"><br/>
                            <label id="removeFeatureImage" class="btn btn-primary" data-url="{{ url('/web/product/remove/featured/'.$products->id.'') }}" data-photo="{{ URL::asset('images/no-image.png') }}">DELETE</label>
                        @else
                            <img id="featuredImg" class="img-responsive" src="{{ URL::asset('images/no-image.png') }}" alt="{{ $products->product_name }}" title="{{ $products->product_name }}">
                            <label id="removeFeatureImage" class="btn btn-primary" data-url="{{ url('/web/product/remove/featured/'.$products->id.'') }}" data-photo="{{ URL::asset('images/no-image.png') }}" style="display: none;">DELETE</label>
                        @endif
                    </div>
                    <div class="col-sm-9 col-md-9">
                        <input type="file" class="form-control-file" name="featured_image" id="featured_image">
                    </div>
                    @if ($products->featured_video)
                        <div class="col-md-12 mt-2 mb-2">
                            <video src="{{ asset('storage/featured_videos/' . $products->featured_video) }}" class="w-full h-96 object-cover rounded" style="height:500px; width:500px;" controls type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                    <div class="col-sm-5 col-md-8" style="margin-top: 15px";>
                        {{-- <input type="text" class="form-control" id="featured_video" name="featured_video" placeholder="Paste YouTube URL here"> --}}
                        <label for="featured_video">Upload Video:</label>
                        <input type="file" name="featured_video" id="featured_video" accept="video/*">
                    </div>

                </div>
            </div><!-- panel -->
        </div>
        <div class="col-md-4">
            <div class="panel panel-default" style="height: 183px;">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>MININUM BIDDING PRICE</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                <label for="min_bid_price">Edit minimum bidding price: 50% or 70%.</label>
                    <select name="min_bid_price" id="min_bid_price" class="form-control">
                            <option value="">Select</option>
                           <option value="0.50" @if($products->min_bid_price == 0.50) selected="Selected" @endif>50%</option>
                           <option value="0.70" @if($products->min_bid_price == 0.70) selected="Selected" @endif>70%</option>
                    </select>
                </div>
            </div><!-- panel -->
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>PRODUCT DETAILS</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">

                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name *" value="{{ $products->product_name }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="year_model" name="year_model" placeholder="Year Model" value="{{ $products->year_model }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Plate Number" value="{{ $products->plate_number }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="document_status" name="document_status" placeholder="Document Status *" value="{{ $products->document_status }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="latest_condition" name="latest_condition" placeholder="Latest Condition *" value="{{ $products->latest_condition }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Mileage" value="{{ $products->mileage }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Transmission" value="{{ $products->transmission }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="fuel_type" name="fuel_type" placeholder="Fuel Type" value="{{ $products->fuel_type }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="color" name="color" placeholder="Color" value="{{ $products->color }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="seating_capacity" name="seating_capacity" placeholder="Seating Capacity" value="{{ $products->seating_capacity }}">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <select name="product_status" id="product_status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="0" @if($products->status == 0) selected="Selected" @endif>Active</option>
                            <option value="1" @if($products->status == 1) selected="Selected" @endif>Draft</option>
                            <option value="2" @if($products->status == 2) selected="Selected" @endif>Sold</option>
                            <option value="3" @if($products->status == 3) selected="Selected" @endif>Deleted</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-12" style="padding-top: 5px; padding-bottom: 5px;">
                        <textarea class="form-control" rows="5" id="descriptions" name="descriptions" placeholder="Descriptions *">{{ $products->descriptions }}</textarea>
                    </div>
                </div>
            </div><!-- panel -->
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>PRICING DETAILS</b> - <lable style="color: #222; font-size: 14px;">Enter amount without 'Comma'</lable></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-4 col-md-4">
                        <input type="text" class="form-control" id="inventory_price" name="inventory_price" placeholder="Inventory Price *" value="{{ $products->inventory_price }}">
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price *" value="{{ $products->selling_price }}">
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <input type="text" class="form-control" id="market_value" name="market_value" placeholder="Market Value *" value="{{ $products->market_value }}">
                    </div>
                </div>
            </div><!-- panel -->
        </div>
        <div class="col-sm-12 col-md-12">
            <button id="submit_btn" class="btn btn-primary c-btn">SUBMIT</button>
            <button type="button" class="btn btn-primary c-btn fake_btn" style="background-color: #6c757d; border: 1px solid #6c757d; display: none;" >Processing...</button>
        </div>
        <div class="col-sm-12 col-md-12 pt-20 successHolder" style="display: none;">
            <div class="alert alert-success"></div>
        </div>
    </div>
</div><!-- contentpanel -->
</form>

@endsection
@section('javascript')
<script type="text/javascript">
jQuery('#puo_date').datepicker({
    dateFormat: 'yy-mm-dd'
});
</script>
<script src="{{ URL::asset('js/process/product-create.js') }}"></script>
@stop
