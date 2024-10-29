@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
  <h2>Customer with Intent</h2>
</div>

<div class="contentpanel">
    <div class="row">
        <div class="panel" style="box-shadow: 0 0px 0;">
            <div class="panel-body grey-bgcolor">
                <div class="tab-content white-bgcolor">
                <div id="newSubmissions" class="tab-pane active">
                    <form id="search" data-id="1" class="form-inline" data-action="{{ url('/loi/summary') }}">
                        <div class="panel-body" style="padding: 10px 0px;">
                            <h3 class="panel-title">Search Parameter</h3><br/>
                            <div class="row row-pad-5">
                                <div class="col-md-3 col-lg-2">
                                    <input type="text" class="form-control" id="search_name" name="search_name" placeholder="Email" style="width: 100%;">
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Start Date" style="width: 100%;" autocomplete="off" autosave="off">
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="End Date" style="width: 100%;" autocomplete="off" autosave="off">
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <button type="button" class="btn btn-success search-btn" style="height: 39px; width: 100%;"> <i class="glyphicon glyphicon-zoom-in"></i> Search</button>
                                </div>
                                {{-- <div class="col-md-2 col-lg-2">
                                    <button type="button" class="btn btn-primary download-btn1" style="height: 39px; width: 100%;" data-action="{{ url('/web/loi/download') }}">Download Excel</button>
                                </div> --}}
                            </div>
                        </div>

                        <div id="result"><img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."></div>
                    </form>
                </div><!-- tab-pane -->
            </div><!-- panel-body -->
        </div>
    </div>
</div><!-- contentpanel -->
@endsection
@section('javascript')
<script type="text/javascript">
jQuery('#start_date, #end_date').datepicker({
    dateFormat: 'yy-mm-dd'
});
$(document).ready(function() {
    $(document).on('click', '#myCheckbox', function(){
        if($('#myCheckbox').is(":checked") == true){
            $( ".myCheckbox" ).prop( "checked", true );
        }else{
            $( ".myCheckbox" ).prop( "checked", false );
        }
    });

    $(document).on('click', 'button.delete-row', function(e){
        var url_delete = $(this).data("action");
        var data = $('.myCheckbox:checked').serialize();
        $.ajax({
            url: url_delete,
            data : data,
            dataType : 'json',
            beforeSend: function(){
                $("button.fake_btn").show();
                $("button#submit_btn").hide();
            },
            success: function(response){
                alert('Delete has been successful. This page will reload.');
                location.reload();
            }
        });
        e.preventDefault();
    });
});
</script>
<script src="{{ URL::asset('js/pagination/pagination.js?v=2') }}"></script>
@stop
