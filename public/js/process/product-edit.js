$(document).ready(function(e){
    var url = $("form#submitForm").prop("action");
    var method = $("form#submitForm").attr("method");

    $("#submitForm").on('submit', function(e){

        $("p.errors").remove();

        $("button.fake_btn").hide();
        $("button#submit_btn").show();

        e.preventDefault();
        $.ajax({
            type: method,
            url: url,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $("button.fake_btn").show();
                $("button#submit_btn").hide();
            },
            success: function(response){
                $("button.fake_btn").hide();
                $("button#submit_btn").show();
                if(response.success == true){
                    $("#featuredImg").attr("src", response.image);
                    $("#removeFeatureImage").show();
                    $("#submitForm").trigger("reset");
                    $('.alert-success').text(response.message);
                    $('.successHolder').show();
                }else{
                    $.each( response.errors, function( key, value ) {
                        $("#"+key).after('<p class="errors text-danger" style="padding-top: 3px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '+value+'</p>');
                    });
                }
            }
        });
    });

    $(document).on('click', 'label#removeFeatureImage', function(e){
        e.preventDefault();

        var url = $("label#removeFeatureImage").data("url");
        var noPhoto = $("label#removeFeatureImage").data("photo");

        $.ajax({
            type: "GET",
            url: url,
            success: function(response){
                $("#featuredImg").attr("src",""+noPhoto+"");
            }
        });
    });
});