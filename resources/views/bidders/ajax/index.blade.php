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
                <th>No.</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Date</th>
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
                <td>{{ $i++ }}</td>
                <td>{{ $d->firstname }} {{ $d->middlename }} {{ $d->lastname }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ date("d M Y", strtotime($d->created_at)) }}</td>
                <td class="text-center">
                    <a href="{{ url('/bidder/view/'.$d->id.'') }}" class="text-info">VIEW</a>
                    <!-- <a href="{{ url('/user/edit/'.$d->id.'') }}" class="text-info">EDIT</a> -->
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
@endif
