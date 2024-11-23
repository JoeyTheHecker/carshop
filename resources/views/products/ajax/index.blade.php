@if(count($data) == 0)
<div class="row">
    <div class="col-md-12">
        <p>There are currently {{ count($data) }} record found in the database.</p>
    </div>
</div>
@else
<div class="table-responsive pt-md-20">
    <table class="table dataTable headerDarkGrey">
        <thead>
            <tr role="row">
                <th>Status</th>
                <th>Product Name</th>
                <th>Inventory<br/>Price</th>
                <th>Selling<br/>Price</th>
                <th>Minimum<br/>Bidding<br/>Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr id="div_{{ $d->id }}">
               <!-- <td><img src="./qrcode/{{ $d->id }}.png" style="width: 75px; height: auto;"></td> -->
                <td>
                    <select class="form-control" onchange="changeStatus(this.value, <?php echo $d->id; ?>)">
                        <option value="<?php echo url('/product/change/status/'.$d->id.'/0'); ?>" @if($d->status == 0) selected="Selected" @endif>Active</option>
                        <option value="<?php echo url('/product/change/status/'.$d->id.'/1'); ?>" @if($d->status == 1) selected="Selected" @endif>Draft</option>
                        <option value="<?php echo url('/product/change/status/'.$d->id.'/2'); ?>" @if($d->status == 2) selected="Selected" @endif>Sold</option>
                        <option value="<?php echo url('/product/change/status/'.$d->id.'/3'); ?>" @if($d->status == 3) selected="Selected" @endif>Deleted</option>
                        <!--<option value="<?php echo url('/product/change/status/'.$d->id.'/4'); ?>" @if($d->status == 4) selected="Selected" @endif>For Bidding</option>-->
                    </select>
                </td>
                {{-- <td>
                    <?php if($d->status != 1) {?>
                    {{ optional($d->getGroup)->code }} /
                    <!-- {{ isset($d->getGroup->code) ? $d->getGroup->code : ''}} / -->
                    {{ $d->location_name }} /
                    {{ $d->region_name }}
                    <?php } ?>
                </td> --}}
                <td>
                    <b>{{ $d->product_name }}<br/>
                    {{-- <b>{{ $d->product_name }}</b> /<br/>
                    <?php
                        if($d->puo_number){
                            echo $d->puo_number;
                        }else{
                            echo '<small>PU No. is Not Available</small>';
                        }
                    ?> --}}
                </td>
                <td>{{ 'PHP'. number_format($d->inventory_price,2) }}</td>
                <td>{{ 'PHP'. number_format($d->selling_price,2) }}</td>
                <td>{{  intval($d->min_bid_price * 100)}}%</td>
                <td class="text-center">
                    {{-- <?php if($d->category_id == 1){ ?>
                        <a href="{{ url('/product/view/qrcode/'.$d->id.'') }}" class="text-info" target="_blank">QR CODE</a> |
                    <?php } ?> --}}
                    <?php if($d->status != 1){?>
                    <a href="{{ url('/product/view/'.$d->id.'') }}" class="text-info">VIEW</a> |
                    <?php } ?>
                    <a href="{{ url('/product/edit/'.$d->id.'') }}" class="text-info">EDIT</a> |
                    <a href="{{ url('/product/gallery/'.$d->id.'') }}" class="text-info">ADD GALLERY</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div><!-- table-responsive -->
<div class="row">
    <div class="col-md-12 text-right">
        <div id="pagination-wrapper-{{ $type }}">{{ $data->links() }}</div>
    </div>
</div>
@endif
