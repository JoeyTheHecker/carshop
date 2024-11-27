@if(count($data) == 0)
<div class="row">
    <div class="col-md-12">
        <p>There are currently {{ count($data) }} record found in the database.</p>
    </div>
</div>
@else
<div class="table-responsive pt-md-20">
    {{-- <div class="pull-right" style="padding: 5px 0px;">
        <button type="button" class="btn btn-danger delete-row" style="height: 39px; width: 100%;" data-action="{{ url('/web/inquiry/delete') }}">DELETE</button>
    </div> --}}
    <table class="table dataTable headerDarkGrey">
        <thead>
            <tr role="row">
                <th><input type="checkbox" id="myCheckbox" /></th>
                <th>No.</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Name</th>
                <th>Mobile</th>
                <th></th>
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
                    <?php if($d->getProducts){ ?>
                        <a href="{{ url('/product/view/'.$d->product_id.'') }}">{{ $d->getProducts->product_name ?? '(Source) Contact Us Form' }}</a>
                    <?php }else{ ?>
                        (Source) Contact Us Form
                    <?php } ?>
                </td>
                <td>{{ date("d M Y", strtotime($d->created_at)) }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->mobile_number }}</td>
                <td class="text-center"><a href="{{ url('/inquiry/view/'.$d->id.'') }}" target="_blank" class="text-info">VIEW</a></td>
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
