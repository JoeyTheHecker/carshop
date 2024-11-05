@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
    <h2>New Products - Cars</h2>
    <h3>Product ID: {{ $product->generateUniqueID() }}</h3>
    <div class="breadcrumb-wrapper">
        <span class="label"><a href="{{ url('/product') }}">BACK</a></span>
    </div>

</div>

<form id="submitForm" method="post" action="{{ url('/product/store') }}" enctype="multipart/form-data">
<input type="hidden" id="category_id" name="category_id" value="1">
<input type="hidden" id="product_identification_number" name="product_identification_number" value="{{ $product->generateUniqueID() }}">
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
                    <div class="col-sm-12 col-md-12">
                        <input type="file" class="form-control-file" name="featured_image" id="featured_image">
                    </div>
                    <div class="col-sm-5 col-md-8" style="margin-top: 15px";>
                        <input type="text" class="form-control" id="featured_video" name="featured_video" placeholder="Paste YouTube URL here">
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
                <label for="min_bid_price">Select minimum bidding price: 50% or 70%.</label>
                    <select name="min_bid_price" id="min_bid_price" class="form-control" required>
                            <option value="">Select</option>
                            <option value="0.50">50%</option>
                            <option value="0.70">70%</option>
                    </select>
                </div>
            </div><!-- panel -->
        </div>
        {{-- <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>LOCATION</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-3 col-md-3">
                        <select name="group_id" id="group_id" class="form-control">
                            <option value="">Group *</option>
                            @foreach($groups as $g)
                                <option value="{{ $g->id }}">{{ $g->display }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <!-- <input type="text" class="form-control" id="region_name" name="region_name" placeholder="Region *"> -->
                        <select name="region_name" id="region_name" class="form-control">
                            <option value="">Select</option>
                            <option value="Region I - Ilocos Region">Region I - Ilocos Region</option>
                            <option value="Region II - Cagayan Valley">Region II - Cagayan Valley</option>
                            <option value="Region III - Central Luzon">Region III - Central Luzon</option>
                            <option value="Region IV-A CALABARZON">Region IV-A CALABARZON</option>
                            <option value="MIMAROPA Region">MIMAROPA Region</option>
                            <option value="Region V - Bicol Region">Region V - Bicol Region</option>
                            <option value="Region VI - Western Visayas">Region VI - Western Visayas</option>
                            <option value="Region VII - Central Visayas">Region VII - Central Visayas</option>
                            <option value="Region VIII - Eastern Visayas">Region VIII - Eastern Visayas</option>
                            <option value="Region IX - Zamboanga Penin sula">Region IX - Zamboanga Penin sula</option>
                            <option value="Region X - Northern Mindanao">Region X - Northern Mindanao</option>
                            <option value="Region XI - Davao Region">Region XI - Davao Region</option>
                            <option value="Region XII - SOCCSKSARGEN">Region XII - SOCCSKSARGEN</option>
                            <option value="Region XIII - Caraga">Region XIII - Caraga</option>
                            <option value="NCR - National Capital Region">NCR - National Capital Region</option>
                            <option value="CAR - Cordillera Administrative Region">CAR - Cordillera Administrative Region</option>
                            <option value="BARMM - Bangsamoro Autonomous Region in Muslim Mindanao">ARMM - Bangsamoro Autonomous Region in Muslim Mindanao</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Location *">
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <input type="text" class="form-control" id="origin_barangay" name="origin_barangay" placeholder="Barangay Origin *">
                    </div>
                </div>
            </div><!-- panel -->
        </div> --}}
        {{-- <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>PUO DETAILS</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-6 col-md-6">
                        <input type="text" class="form-control" id="puo_date" name="puo_date" autosave="off" autocomplete="off" placeholder="PUO Date *">
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <input type="text" class="form-control" id="puo_number" name="puo_number" placeholder="PUO Number *">
                    </div>
                </div>
            </div><!-- panel -->
        </div> --}}
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>PRODUCT DETAILS</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name *">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name *">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="year_model" name="year_model" placeholder="Year Model">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Plate Number">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="classification" name="classification" placeholder="Classification">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="is_sold" name="is_sold" placeholder="Is Sold">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="document_status" name="document_status" placeholder="Document Status *">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="latest_condition" name="latest_condition" placeholder="Latest Condition *">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Mileage">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Transmission">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <input type="text" class="form-control" id="fuel_type" name="fuel_type" placeholder="Fuel Type">
                    </div>
                    <div class="col-sm-3 col-md-3" style="padding-top: 5px; padding-bottom: 5px;">
                        <select name="product_status" id="product_status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="0">Active</option>
                            <option value="1">Draft</option>
                            <option value="2">Sold</option>
                            <option value="3">Deleted</option>
                            <!-- <option value="4">For Bidding</option> -->
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-12" style="padding-top: 5px; padding-bottom: 5px;">
                        <textarea class="form-control" rows="5" id="descriptions" name="descriptions" placeholder="Descriptions *"></textarea>
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
                        <input type="text" class="form-control" id="inventory_price" name="inventory_price" placeholder="Inventory Price *">
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price *">
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <input type="text" class="form-control" id="market_value" name="market_value" placeholder="Market Value *">
                    </div>
                </div>
            </div><!-- panel -->
        </div>
        {{-- <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>RATING DETAILS</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                        <select name="is_rating" id="is_rating" class="form-control">
                            <option value="">Select Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
            </div><!-- panel -->
        </div> --}}
        {{-- <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color: blue; margin: 0px;"><b>VISIBILITY DETAILS</b></h4>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-3 col-md-3">
                        <label class="f-width">Best Deal</label>
                        <select name="is_best_deal" id="is_best_deal" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <label class="f-width">Featured</label>
                        <select name="is_featured" id="is_featured" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <label class="f-width">Sale</label>
                        <select name="is_sale" id="is_sale" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <label class="f-width">New Repo</label>
                        <select name="is_new_repo" id="is_new_repo" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <label class="f-width">Premium</label>
                        <select name="is_premium" id="is_premium" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <label class="f-width">Website</label>
                        <select name="is_display_on" id="is_display_on" class="form-control">
                            <option value="0">SHOW TO ALL</option>
                            <option value="1">RFSHOP ONLY</option>
                            <option value="2">CARSURPLUS ONLY</option>
                        </select>
                    </div>
                </div>
            </div><!-- panel -->
        </div> --}}
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
