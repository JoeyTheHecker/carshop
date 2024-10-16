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
                
                $("p.errors").remove();

                $("button.fake_btn").hide();
                $("button#submit_btn").show();

                if(data.success == true){
                    $("#submitForm").trigger("reset");
                    $('.alert-success').text(data.message);
                    $('#successHolder').show();
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