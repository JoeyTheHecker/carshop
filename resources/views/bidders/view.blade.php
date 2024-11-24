@extends('layouts.app')

@section('header')
    @parent
@stop

@section('content')
<div class="pageheader">
    <div class="row">
        <div class="col-sm-12 col-md-7"><h2>Bidder</h2></div>
        <div class="breadcrumb-wrapper">
            <span class="label"><a href="{{ url('/bidder-accounts') }}">BACK</a></span>
        </div>
    </div>
</div>

<form id="submitForm" method="post" action="{{ url('/bidder/put') }}">
<input type="hidden" name="id" id="id" value="{{ $data->id }}">
<input type="hidden" name="email" id="email" value="{{ $data->email }}">
<input type="hidden" name="firstname" id="firstname" value="{{ $data->firstname }}">
<input type="hidden" name="middlename" id="middlename" value="{{ $data->middlename }}">
<input type="hidden" name="lastname" id="lastname" value="{{ $data->lastname }}">
    {{ csrf_field() }}
    <div class="contentpanel">
        <div class="row">
            <div class="panel white-bgcolor" style="box-shadow: 0 0px 0;">
                <div class="panel-body">
                    <div id="successHolder" class="col-sm-12 col-md-12 pt-20" style="display: none;">
                        <div class="alert alert-success"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Full Name</label>
                        <b class="f-width-w-border-bottom">{{ $data->name }} {{ $data->middlename }} {{ $data->lastname }}</b>
                    </div>
                    <!-- <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Email  <a href="{{ url('/profile/email/edit') }}">[Change Email]</a></label>
                        <b class="f-width-w-border-bottom">{{ $data->email }}</b>
                    </div> -->
                    <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Email </label>
                        <b class="f-width-w-border-bottom">{{ $data->email }}</b>
                    </div>
                    <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Mobile Number</label>
                        <b class="f-width-w-border-bottom">{{ $data->mobile_number }}</b>
                    </div>
                    <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Date of Birth</label>
                        <b class="f-width-w-border-bottom">{{ date("d M Y", strtotime($data->date_of_birth)) }}</b>
                    </div>
                    <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Address</label>
                        <b class="f-width-w-border-bottom">{{ $data->address }}</b>
                    </div>
                    <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Source of Income</label>
                        <b class="f-width-w-border-bottom">{{ $data->source_of_income }}</b>
                    </div>
                    {{-- <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Company Name</label>
                        <b class="f-width-w-border-bottom">{{ $data->company_name }}</b>
                    </div> --}}
                    <!-- <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Date Created</label>
                        <b class="f-width-w-border-bottom">{{ date("d M Y", strtotime($data->created_at)) }}</b>
                    </div> -->
                    <!-- <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Password  <a href="{{ url('/profile/password/edit') }}">[Change Password]</a></label>
                        <b class="f-width-w-border-bottom">******</b>
                    </div> -->
                    <div class="col-sm-6 col-md-6 pt-20">
                            <div style="display:flex; justify-content: start;  gap: 5px;" class="mt-3 f-width-w-border-bottom">
                                <a class="btn btn-default" href="{{ asset('storage/govt_id/' . $data->govt_id) }}" target="_blank">View Govt. ID</a>
                                <a class="btn btn-default" href="{{ asset('storage/selfie_id/' . $data->selfie_with_id) }}" target="_blank">View selfie with ID</a>
                                <a class="btn btn-default" href="{{ asset('storage/e_signature/' . $data->e_signature) }}" target="_blank">View E-signature</a>
                            </div>
                    </div>
                    <div class="col-sm-6 col-md-6 pt-20">
                        <label class="f-width">Status</label>
                        <b class="f-width-w-border-bottom" id="status-bidder">{{ $data->isStatusBidder() }}</b>
                    </div>

                    {{-- @if($data->customer_status == 0)
                        <div class="col-sm-12 col-md-12 pt-20">
                            <button id="submit_btn" class="btn btn-primary c-btn">Approved</button>
                            <button type="button" class="btn btn-primary c-btn fake_btn" style="background-color: #6c757d; border: 1px solid #6c757d; display: none;" >Processing...</button>
                        </div>
                    @else
                        <div class="col-sm-12 col-md-12 pt-20">
                            <label class="f-width"><a href="{{ url('bidder/profile/edit/'.$data->id.'') }}">Edit Profile</a></label>
                        </div>
                    @endif --}}
                    <div class="col-sm-12 col-md-12 pt-20">
                        <button id="submit_btn" class="btn btn-primary c-btn">Approved</button>
                        <button type="button" class="btn btn-primary c-btn fake_btn" style="background-color: #6c757d; border: 1px solid #6c757d; display: none;" >Processing...</button>
                    </div>

            </div>
        </div>
    </div><!-- contentpanel -->
</form>

@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
    $(document).on('submit', '#submitForm', function(){

            var url = $("form#submitForm").prop("action");
            var data = $("form#submitForm").serialize();
            var method = $("form#submitForm").attr("method");

            $("button.fake_btn").show();
            $("button#submit_btn").hide();

            $.ajax({
                type: method,
                url: url,
                data : data,
                dataType : 'json',
                success :  function(data) {
                    console.log(data);
                    $("p.errors").remove();

                    $("button.fake_btn").hide();
                    $("button#submit_btn").show();

                    if(data.success == true){
                        $("#submitForm").trigger("reset");
                        $('.alert-success').text(data.message);
                        $('#successHolder').show();
                        document.getElementById("status-bidder").innerHTML = "Approved";
                    }else{
                        $.each( data.errors, function( key, value ) {
                            $("#"+key).after('<p class="errors text-danger" style="padding-top: 3px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '+value+'</p>');
                        });
                    }
                }
            });
            return false;
        });
    });
</script>
@stop
