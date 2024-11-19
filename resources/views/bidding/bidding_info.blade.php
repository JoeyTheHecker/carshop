@extends('layouts.app')

@section('header')
@parent
@stop

@section('content')
@php
    $rowNumber = 0;
@endphp
<div class="pageheader" style="display:flex; justify-content: space-between;">
    <h4>Bidding Information</h4>
    <a style="height:fit-content;" href="{{ url('/web/bidding') }}" class="btn btn-default">Back</a>
</div>
<div class="container-fluid" style="margin-top: 1rem;">

    <div class="row">
        <div class="col-12 col-md-5">
            <div class="panel mb-3 bg-body ">
                <div class="panel-body">
                    <label class="panel-title" style="margin-bottom: 1rem;">
                        Product Details
                    </label>
                    <div class="">
                        <img src="{{ asset('storage/car_images/' . $data->product->image) }}" alt="product-image" width="100%">
                        <h4><b>Product Name:</b> {{$data->product->product_name}}</h4>
                        <span><b>Unit Price: </b>PHP {{number_format($data->product->selling_price, 2)}}</span>
                        <br>
                        <span><b>Product ID No.: </b> {{ $data->product->product_identification_number }}</span>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-7">
            <div class="panel mb-3 bg-body">
                <div class="panel-body ">
                    <div class="table-responsive">
                        <label class="panel-title" style="margin-bottom: 1rem;">
                            Bidders
                        </label>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Bid Amount</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data->bids as $bid)
                                    @php
                                    $rowNumber++
                                    @endphp
                                    <tr style="cursor: pointer">
                                        <th scope="row">{{$rowNumber}}</th>
                                        <td class="clickable-row" data-id="{{$bid->bidder_id}}">{{ date("d M Y", strtotime($bid->bid_created_at)) }}</td>
                                        <td class="clickable-row" data-id="{{$bid->bidder_id}}">{{$bid->firstname}}</td>
                                        <td class="clickable-row" data-id="{{$bid->bidder_id}}">PHP {{ number_format($bid->amount, 2) }}</td>
                                        <td class="clickable-row" data-id="{{$bid->bidder_id}}">
                                            @switch($bid->bid_status)
                                                @case('approved')
                                                    <span class="badge badge-success">Approved</span>
                                                    @break
                                                @case('sold')
                                                    <span class="badge badge-info">Sold</span>
                                                    @break
                                                @case('defaulted')
                                                    <span class="badge badge-secondary">Defaulted</span>
                                                    @break
                                                @case('backed_out')
                                                    <span class="badge badge-dark">Backed Out</span>
                                                    @break
                                                @case('rejected')
                                                    <span class="badge badge-danger">Rejected</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-warning">Pending</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="biddingInfoModal" tabindex="-1" role="dialog" aria-labelledby="biddingInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    </div>
  </div>
</div>
@section('javascript')
<script type="text/javascript">
    jQuery(() => {
        $(`.clickable-row`).on(`click`, async e => {
            $(`#biddingInfoModal .modal-content`).html(`<div style="padding: 3rem;"><p style="text-align:center;">Loading data</p></div>`)
            $(`#biddingInfoModal`).modal('show')
            const value = $(e.target).attr(`data-id`)
            try{
                const response = await fetch(`{{url("/bidding/info/$bid->id/cycle/$bid->bidding_cycle_id")}}/bidder/${value}`)
                if(response.ok){
                    $(`#biddingInfoModal .modal-content`).html(await response.text())
                }
            }catch(error){
                console.log(error);
            }
        })
    })
</script>
@endsection
@endsection
