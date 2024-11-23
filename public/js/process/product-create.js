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
                    $("#submitForm").trigger("reset");
                    $('.alert-success').text(response.message);
                    $('.successHolder').show();

                    console.log('success');
                        setTimeout(function () {
                            location.reload(); // This refreshes the page
                        }, 2000);
                }else{
                    $.each( response.errors, function( key, value ) {
                        $("#"+key).after('<p class="errors text-danger" style="padding-top: 3px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '+value+'</p>');
                    });
                    console.log(response.errors);
                }
            },

            error: function(xhr, status, error) {
                $("button.fake_btn").hide();
                $("button#submit_btn").show();
                console.error("AJAX Error:", error);
                console.error("Status:", status);
                console.error("Response:", xhr.responseText);

                // Optionally display a generic error message on the page
                $('.alert-danger').text("An unexpected error occurred. Please try again.");
                $('.errorHolder').show();
            }
        });
    });
});
