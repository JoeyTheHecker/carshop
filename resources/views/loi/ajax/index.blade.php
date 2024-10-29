@if(count($data) == 0)
<div class="row">
    <div class="col-md-12">
        <p>There are currently {{ count($data) }} record found in the database.</p>
    </div>
</div>
@else
<div class="table-responsive pt-md-20">
    <div class="pull-right" style="padding: 5px 0px;">
        <button type="button" class="btn btn-danger delete-row" style="height: 39px; width: 100%;" data-action="{{ url('/web/loi/delete') }}">DELETE</button>
    </div>
    <table class="table dataTable headerDarkGrey">
        <thead>
            <tr role="row">
                <th><input type="checkbox" id="myCheckbox" /></th>
                <th>No.</th>
                <th>Product Name </th>
                <th>Unit Price</th>
                <th>Customer Name</th>
                <th>Email / Mobile</th>
                <th>Request Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if($data->currentPage() == 1){
                $i=1;
            }else{
                $currentPage = $data->currentPage() - 1;
                $i=$currentPage * 15 + 1;
            }
            ?>
            @foreach($data as $d)
            <tr>
                <td><input type="checkbox" name="rows[]" value="{{ $d->id }}" class="myCheckbox" /></td>
                <td>{{ $i++ }}</td>
                <td>
                    <b>{{ $d->getProduct($d->product_id) }}</b>
                </td>
                <td>PHP {{ $d->getProductSellingPrice($d->product_id) }}</td>
                <td>{{ $d->name }}</td>
                <td>
                    {{ $d->email }}<br/>
                    {{ $d->contact_number }}
                </td>
                <td>PHP {{ $d->bid_amount }}</td>
                <td>{{ date("d M Y", strtotime($d->created_at)) }}</td>
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
@endif
