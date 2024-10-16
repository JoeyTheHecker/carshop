$(document).ready(function() {
    $(document).on('submit', '#editForm', function(){

        $("button.fake_btn").hide();
        $("button#submit_btn").show();

        var url = $("form#editForm").prop("action");
        var data = $("form#editForm").serialize();
        var method = $("form#editForm").attr("method");

        $.ajax({
            type: method,
            url: url,
            data : data,
            dataType : 'json',
            success :  function(data) {
    
                $("p.errors").remove();

                $("button.fake_btn").hide();
                $("button#submit_btn").show();

                if(data.success == true){
                    $("#editForm").trigger("reset");
                    $('.alert-success').text(data.message);
                    $('.successHolder').show();
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