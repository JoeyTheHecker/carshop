@extends('layouts.master')

@section('content')
<div class="grid grid-cols-1 gap-4 px-4 mx-auto max-w-screen-xl py-8 md:grid-cols-2 lg:grid-cols-3">
    <!-- Vehicle Listings Section -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 col-span-2" id="result">
        <img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..." title="Loading..."> Loading...
    </div>

    <!-- Search and Recommendations Section -->
    <div class="col-span-1">
        <div class="bg-gray-100 p-4 rounded-md shadow-md">
            <!-- Vehicle Search -->
            <form id="search" data-action="{{ url('api/products') }}" method="GET">
                <div class="bg-white shadow-md rounded-md p-4 mb-4">
                    <h2 class="text-xl font-bold mb-4">Vehicle Search</h2>
                    <div class="mb-4">
                        <label for="price-range" class="block text-sm font-medium">Price Range</label   >
                        <select id="price-range" class="w-full mt-1 p-2 border rounded-md" name="price" id="price">
                            <option value="">Price Range</option>
                            <option value="1">0 - 100,000</option>
                            <option value="2">100,001 - 200,000</option>
                            <option value="3">200,001 - 300,000</option>
                            <option value="4">300,001 - 400,000</option>
                            <option value="5">400,001 - 500,000</option>
                            <option value="6">500,001 - 1,000,000</option>
                            <option value="7">1M and Above</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="keyword" class="block text-sm font-medium">Enter Keyword</label>
                        <input type="text" id="keyword" class="w-full p-2 border rounded-md" name="keyword" placeholder="Enter Keyword" value="">
                    </div>
                    <button id="searchByKeywords" data-url="{{ url('/product/search/?keyword=') }}"
                        class="search-btn w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Search</button>
                </div>
            </form>

            <!-- Inquiry Form -->
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-md font-bold mb-2">Need Recommendations on Buying a Pre-Owned Vehicle?</h3>
                <form class="space-y-4" id="inquiryForm" method="post" action="{{ url('api/inquiry') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="product_id" name="product_id" value="0">
                    <input type="text" class="w-full p-2 border rounded-md" id="name" name="name" placeholder="Please enter your name">
                    <input type="email" class="w-full p-2 border rounded-md" id="email" name="email" placeholder="Example: juandelacruz@rfc.com">
                    <input type="text" class="w-full p-2 border rounded-md" id="mobile_number" name="mobile_number" placeholder="Example: 095151***">
                    <textarea
                        id="message"
                        name="message"
                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        cols="30"
                        rows="5"
                        placeholder="Write your message here..."
                        aria-label="Message"></textarea>

                    <button type="submit"
                        class="w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Send
                        Inquiry</button>
                </form>
            </div>
        </div>


    </div>
</div>



<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4 rtl:space-x-reverse">
    <!-- Modal toggle -->
    <button id="trigger-button" data-modal-target="small-modal" data-modal-toggle="small-modal" class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" style="display: none">
    Small modal
    </button>
</div>
<div id="small-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-1/4 max-w-xsm max-h-1/4">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header with close button -->
            <div class="flex items-center justify-end p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="small-modal">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body with image -->
            <div class="p-4 md:p-5">
                <img src="{{ asset('images\inquiry-sent-adjusted.png') }}" alt="Inquiry Sent" class="w-full rounded-lg">
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
 <!-- <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}"></script> -->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"
 integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
{{-- <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script> --}}

<script>
$(document).ready(function(){

    /* action URL */
    var url = $("form#search").data("action");

    /* ajax RESULT */
    var result = function(url, data = false) {
        var data = $("form#search").serialize();
        // Gather form values
    var keyword = $("#keyword").val();
    console.log("Keyword: ", keyword); // Log keyword value to console
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

$(document).ready(function() {
    $(document).on('submit', '#inquiryForm', function(){

        var url = $("form#inquiryForm").prop("action");
        var data = $("form#inquiryForm").serialize();
        var method = $("form#inquiryForm").attr("method");

        $.ajax({
            type: method,
            url: url,
            data : data,
            dataType : 'json',
            success :  function(data) {

                $("p.errors").remove();

                if(data.success == true){
                    $("#inquiryForm").trigger("reset");
                    const triggerButton = document.getElementById('trigger-button');
                        if (triggerButton) {
                            triggerButton.click();
                        }
                    // $('#myInquiry').modal('show');
                }else{
                    $.each( data.errors, function( key, value ) {
                        console.log(data.errors)
                        $("#"+key).after('<p class="errors text-danger" style="padding-top: 3px;">'+value+'</p>');
                    });
                }
            }
        });
        return false;
    });
});
</script>
@stop
