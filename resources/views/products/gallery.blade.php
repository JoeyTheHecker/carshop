@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
    <h2>Gallery</h2>
    <div class="breadcrumb-wrapper">
        <span class="label"><a href="javascript: history.back(1)">BACK</a></span>
    </div>
</div>

<div class="contentpanel">
    <div class="row">
        <div class="panel white-bgcolor">
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ url('/product/gallery/'.$data->id.'') }}" class="dropzone">
                            {{ csrf_field() }}
                            <div class="fallback"><input name="file" type="file" multiple /></div>
                        </form>
                    </div>
                </div>
            </div><!-- panel-body -->
        </div>
    </div>
    <div class="row">
        <div class="panel white-bgcolor">
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($product_gallery as $pg)
                        <div id="wrapper_{{ $pg->id }}" class="col-sm-3 col-md-3 pt-20">
                            <img id="featuredImg_{{ $pg->id }}" class="img-responsive" src="{{ asset('storage/car_images/' . $pg->image_full) }}"><br/>
                            <label class="btn btn-primary removeFeatureImage" data-url="{{ url('/web/product/gallery/remove/'.$pg->id.'') }}" data-photo="{{ URL::asset('images/no-image.png') }}" data-id="{{ $pg->id }}">DELETE</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- panel-body -->
        </div>
    </div>
</div><!-- contentpanel -->

@endsection
@section('javascript')
<style type="text/css">
.img-responsive {
    object-fit: cover;
    object-position: center;
    width: 100%;
    max-height: 180px;
    margin-bottom: 1rem;
}
</style>
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-fileupload.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/dropzone.css') }}" />
<script src="{{ URL::asset('js/bootstrap-fileupload.min.js') }}"></script>
<script src="{{ URL::asset('js/dropzone.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(e){
    $(document).on('click', 'label.removeFeatureImage', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var url = $(this).data("url");
        var noPhoto = $(this).data("photo");

        $.ajax({
            type: "GET",
            url: url,
            success: function(response){
                $("#wrapper_"+id+"").remove();
            }
        });
    });
});
</script>
@stop
