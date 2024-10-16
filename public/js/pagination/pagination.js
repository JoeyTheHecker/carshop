$(document).ready(function(){

    /* action URL */
    var url = $("form#search").data("action");

    /* ajax RESULT */
    var result = function(url, data = false) {
        var data = $("form#search").serialize();
        $.ajax({
            url: url,
            type: "GET",
            data: data,
            success: function(data){
                $('#result').html(data);    
            }   
        });
    };

    /* show RESULT by page LOAD */
    result(url);

    /* click pagination LINK */
    $(document).on('click', '#pagination-wrapper a', function(e){
        e.preventDefault();
        var ahref = $(this).attr('href');
        var data = $("form#search").serialize();
       
        result(ahref, data);
        $('html,body').animate({
        scrollTop: $("#result").offset().top},
        'slow');
    });

    /* click SEARCH */
    $(document).on('click', 'form#search button.search-btn', function(e){
        var data = $("form#search").serialize();
        result(url, data);
        e.preventDefault();
    });

    /* click ENTER KEY */
    $(document).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var data = $("form#search").serialize();
            result(url, data);  
            event.preventDefault();
        }
    });

    $(document).on('click', 'button.download-btn1', function(e){
        var url_download = $(this).data("action");
        var data = $("form#search").serialize();
        window.open(url_download+"?"+data, "_blank"); 
        e.preventDefault();
    });
});