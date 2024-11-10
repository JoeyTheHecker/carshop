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
                    <th><input type="checkbox" id="myCheckbox" /></th>
                    <th>No.</th>
                    <th>Product Name / Product ID</th>
                    <th>Unit Price</th>
                    <th>Max Bid Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($data->currentPage() == 1) {
                    $i = 1;
                } else {
                    $currentPage = $data->currentPage() - 1;
                    $i = $currentPage * 15 + 1;
                }
                ?>
                @foreach($data as $d)
                    <tr style="cursor: pointer" >
                        <td><input type="checkbox" name="rows[]" value="{{ $d->product_id }}" class="myCheckbox" /></td>
                        <td class="clickable-row" data-href="{{route('bidding.info', ['id' => $d->product_id, 'cycle_id' => $d->bidding_cycle_id])}}">{{ $i++ }}</td>

                        <td class="clickable-row" data-href="{{route('bidding.info', ['id' => $d->product_id, 'cycle_id' => $d->bidding_cycle_id])}}">
                            <b>{{ $d->product_name }}</b> /<br />
                            {{ $d->product_identification_number }} /<br />
                        </td>
                        {{-- <td class="clickable-row" data-href="{{route('bidding.info', ['id' => $d->product_id, 'cycle_id' => $d->bidding_cycle_id])}}">{{ $d->bidding_cycle_id }}</td> --}}
                        <td class="clickable-row" data-href="{{route('bidding.info', ['id' => $d->product_id, 'cycle_id' => $d->bidding_cycle_id])}}">PHP {{ number_format($d->selling_price, 2) }}</td>
                        <td class="clickable-row" data-href="{{route('bidding.info', ['id' => $d->product_id, 'cycle_id' => $d->bidding_cycle_id])}}">PHP {{ number_format($d->max_amount, 2) }}</td>
                        <td class="clickable-row" data-href="{{route('bidding.info', ['id' => $d->product_id, 'cycle_id' => $d->bidding_cycle_id])}}">{{ date("d M Y", strtotime($d->created_at)) }}</td>
                        <td class="clickable-row" data-href="{{route('bidding.info', ['id' => $d->product_id, 'cycle_id' => $d->bidding_cycle_id])}}">

                            @switch($d->bid_status)
                                @case('sold')
                                    <span class="badge badge-info">Sold</span>
                                    @break
                                @case('backed_out')
                                    <span class="badge badge-dark">Backed Out</span>
                                    @break
                                @default
                                    @if($d->is_open == 1)
                                    <span class="badge badge-warning">Pending</span>
                                    @else
                                    <span class="badge badge-secondary">Under review</span>
                                    @endif
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- table-responsive -->
    <div class="row">
        <div class="col-md-12 text-right">
            <div id="pagination-wrapper">{{ $data->links() }}</div>
        </div>
    </div>
    <script>
        jQuery(document).ready(() => {
            $('.clickable-row').on(`click`, function(){
                const href = $(this).attr('data-href')
                window.location = href
            })
        })
    </script>
@endif
