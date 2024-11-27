@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
    <div class="row">
        <div class="col-sm-12 col-md-7"><h2>Inquiry</h2></div>
    </div>
</div>

<div class="contentpanel">
    <div class="row">
        <div class="panel white-bgcolor" style="box-shadow: 0 0px 0;">
            <div class="panel-body">
                <div class="col-sm-12 col-md-12 pt-20">
                    <label class="f-width">Website</label>
                    <b class="f-width-w-border-bottom">
                        <?php
                            if($data->is_display_on == 1){
                                echo 'Rfshop';
                            }elseif($data->is_display_on == 2){
                                echo 'Carsurplus';
                            }else{
                                echo 'Both Rfshop & Carsurplus';
                            }
                        ?>
                    </b>
                </div>
                @if ($data->product_id)
                    <div class="col-sm-4 col-md-4 pt-20">
                        <label class="f-width">Product Name</label>
                        <b class="f-width-w-border-bottom">
                            <a href="{{ url('/product/view/'.$data->product_id.'') }}">{{ $data->getProducts->product_name }}</a>
                        </b>
                    </div>
                @endif
                <div class="col-sm-4 col-md-4 pt-20">
                    <label class="f-width">Date Created</label>
                    <b class="f-width-w-border-bottom">{{ date("d M Y", strtotime($data->created_at)) }}</b>
                </div>
                <div class="col-sm-4 col-md-4 pt-20">
                    <label class="f-width">Name</label>
                    <b class="f-width-w-border-bottom">{{ $data->name }}</b>
                </div>
                <div class="col-sm-4 col-md-4 pt-20">
                    <label class="f-width">Email</label>
                    <b class="f-width-w-border-bottom">{{ $data->email }}</b>
                </div>
                <div class="col-sm-4 col-md-4 pt-20">
                    <label class="f-width">Mobile Number</label>
                    <b class="f-width-w-border-bottom">
                        @if($data->mobile_number)
                            {{ $data->mobile_number }}
                        @else
                            N/A
                        @endif
                    </b>
                </div>
                <div class="col-sm-12 col-md-12 pt-20">
                    <label class="f-width">Message</label>
                    <b class="f-width-w-border-bottom">{{ $data->message }}</b>
                </div>
            </div><!-- panel-body -->
        </div>
    </div>
</div><!-- contentpanel -->

@endsection
@section('javascript')
<script src="{{ URL::asset('js/process/change-status.js') }}"></script>
@stop
