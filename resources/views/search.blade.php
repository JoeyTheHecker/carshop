@extends('layouts.master')

@section('content')
    <div class="grid grid-cols-3 gap-4 px-4 mx-auto max-w-screen-xl py-8">
        <!-- Vehicle Listings Section -->
        <div class="grid grid-cols-2 gap-4 col-span-2" id="result">
            <img src="{{ URL::asset('images/loaders/loader10.gif') }}" alt="Loading..."  title="Loading..."> Loading...
        </div>
        
        <!-- Search and Recommendations Section -->
        <div class="col-span-1">
            <div class="bg-gray-100 p-4">
                <!-- Vehicle Search -->
                <form id="search" data-action="{{ url('api/products') }}">
                    <div class="bg-white shadow-md rounded-md p-4 mb-4">
                        <h2 class="text-xl font-bold mb-4">Vehicle Search</h2>
                        <div class="mb-4">
                            <label for="brands" class="block text-sm font-medium">All Brands</label>
                            <select id="brands" class="w-full mt-1 p-2 border rounded-md">
                                <option>Toyota</option>
                                <option>Honda</option>
                                <option>Ford</option>
                                <option>Hyundai</option>
                                <option>Audi</option>
                                <option>Kia</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="price-range" class="block text-sm font-medium">Price Range</label>
                            <select id="price-range" class="w-full mt-1 p-2 border rounded-md">
                                <option>₱0 - ₱100,000</option>
                                <option>₱101,000 - ₱200,000</option>
                                <option>₱201,000 - ₱300,000</option>
                                <option>₱301,000 - ₱400,000</option>
                                <option>₱401,000 - ₱500,000</option>
                                <option>₱501,000 - ₱1,000,000</option>
                                <option>₱1,001,000 and Above</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="keyword" class="block text-sm font-medium">Enter Keyword</label>
                            <input type="text" id="keyword" class="w-full p-2 border rounded-md" name="keyword" placeholder="Enter Keyword">
                        </div>
                        <button id="searchByKeywords" data-url="{{ url('/product/search/?keyword=') }}" class="w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Search</button>
                    </div>
                </form>
                

                <!-- Inquiry Form -->
                <div class="bg-white shadow-md rounded-md p-4">
                    <h3 class="text-md font-bold mb-2">Need Recommendations on Buying a Pre-Owned Vehicle?</h3>
                    <form class="space-y-4">
                        <input type="text" placeholder="Name" class="w-full p-2 border rounded-md">
                        <input type="email" placeholder="Email" class="w-full p-2 border rounded-md">
                        <input type="tel" placeholder="Number" class="w-full p-2 border rounded-md">
                        <textarea placeholder="Message" class="w-full p-2 border rounded-md"></textarea>
                        <button type="submit"
                            class="w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Send Inquiry</button>
                    </form>
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
</script>
@stop