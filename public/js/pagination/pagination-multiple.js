$(document).ready(function(){

    var hash = window.location.hash;

    if(hash){
        if(hash == '#tab1'){
            $("#isActiveTab a").trigger("click");
        }else if(hash == '#tab2'){
            $("#isSoldTab a").trigger("click");
        }else if(hash == '#tab3'){
            $("#isInactiveTab a").trigger("click");
        }else if(hash == '#tab4'){
            $("#isDeletedTab a").trigger("click");
        }else if(hash == '#tab5'){
            $("#isBiddingTab a").trigger("click");
        }else{
            $("#isActiveTab a").trigger("click");
        }
    }else{
        $("#isActiveTab a").trigger("click");
    }

    $(document).on('click', 'ul.children li a', function(e){
        var link_hash = $(this).data("hash");
        $("#"+link_hash+"Tab a").trigger("click");
    });

    /* ajax RESULT */
    var result = function(wrapper) {
        var data = $("form#search"+wrapper+"").serialize();
        var url = $("form#search"+wrapper+"").data("action");
        $.ajax({
            url: url,
            type: "GET",
            data: data,
            success: function(data){
                $('#result'+wrapper+'').html(data);
            }   
        });
    };

    /* show RESULT by page LOAD */
    result(1);
    result(2);
    result(3);
    result(4);
    result(5);

    var result_paging = function(url, wrapper) {
        var data = $("form#search"+wrapper+"").serialize();
        var url = url;
        $.ajax({
            url: url,
            type: "GET",
            data: data,
            success: function(data){
                $('#result'+wrapper+'').html(data);    
            }   
        });
    };

    /* click pagination LINK */ 
    $(document).on('click', '#pagination-wrapper-0 a', function(e){
        e.preventDefault();
        var ahref = $(this).attr('href');
        result_paging(ahref, 1);
        $('html,body').animate({
        scrollTop: $("#result1").offset().top},
        'slow');
    });

    $(document).on('click', '#pagination-wrapper-1 a', function(e){
        e.preventDefault();
        var ahref = $(this).attr('href');
        result_paging(ahref, 3);
        $('html,body').animate({
        scrollTop: $("#result3").offset().top},
        'slow');
    });

    $(document).on('click', '#pagination-wrapper-2 a', function(e){
        e.preventDefault();
        var ahref = $(this).attr('href');
        result_paging(ahref, 2);
        $('html,body').animate({
        scrollTop: $("#result2").offset().top},
        'slow');
    });

    $(document).on('click', '#pagination-wrapper-3 a', function(e){
        e.preventDefault();
        var ahref = $(this).attr('href');
        result_paging(ahref, 4);
        $('html,body').animate({
        scrollTop: $("#result4").offset().top},
        'slow');
    });

    $(document).on('click', '#pagination-wrapper-4 a', function(e){
        e.preventDefault();
        var ahref = $(this).attr('href');
        result_paging(ahref, 5);
        $('html,body').animate({
        scrollTop: $("#result5").offset().top},
        'slow');
    });

    $(document).on('click', 'form button.search-btn', function(e){
        var id = $(this).data('id');
        result(id);
        e.preventDefault();
    });

    /* click ENTER KEY */
    $(document).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($('#isActive.active').length > 0){
                result(1);
            }
            if($('#isSold.active').length > 0){
                result(2);
            }
            if($('#isInactive.active').length > 0){
                result(3);
            }
            if($('#isDeleted.active').length > 0){
                result(4);
            }
            if($('#isBidding.active').length > 0){
                result(5);
            }
            event.preventDefault();
        }
    });

    $(document).on('click', 'button.download-btn1', function(e){
        var url_download = $(this).data("action");
        var data = $("form#search1").serialize();
        window.open(url_download+"?"+data, "_blank"); 
        e.preventDefault();
    });


    $(document).on('click', 'button.download-btn-pdf1', function(e){
        var url_download = $(this).data("action");
        var data = $("form#search1").serialize();
        window.open(url_download+"?"+data, "_blank");
        e.preventDefault();
    });


    $(document).on('click', 'button.download-btn2', function(e){
        var url_download = $(this).data("action");
        var data = $("form#search2").serialize();
        window.open(url_download+"?"+data, "_blank"); 
        e.preventDefault();
    });

    $(document).on('click', 'button.download-btn3', function(e){
        var url_download = $(this).data("action");
        var data = $("form#search3").serialize();
        window.open(url_download+"?"+data, "_blank"); 
        e.preventDefault();
    });

    $(document).on('click', 'button.download-btn4', function(e){
        var url_download = $(this).data("action");
        var data = $("form#search4").serialize();
        window.open(url_download+"?"+data, "_blank"); 
        e.preventDefault();
    });

    $(document).on('click', 'button.download-btn5', function(e){
        var url_download = $(this).data("action");
        var data = $("form#search5").serialize();
        window.open(url_download+"?"+data, "_blank"); 
        e.preventDefault();
    });
});
