@extends('layouts.master')

@section('content')
<div class="bg-gray-50 text-gray-800">
    <!-- Contact Us Section -->
    <section class="bg-cover bg-center bg-no-repeat py-10 px-6 shadow-md h-60 md:h-80 relative"
        style="background-image: url('{{ asset('images/red-toyota-camry-xse-zp9qu4a3scmlefal.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div> <!-- Dark overlay for contrast -->
        <div class="relative max-w-6xl mx-auto p-6">
            <h2 class="text-4xl font-extrabold mb-6 text-white">Contact Us</h2>
            <div class="grid grid-cols-1 gap-4">
                <p class="text-lg text-white flex items-center">
                    <span class="mr-2">📞</span> 09123456789
                </p>
                <p class="text-lg text-white flex items-center">
                    <span class="mr-2">📧</span> toyotatacloban@gmail.com
                </p>
            </div>
        </div>
    </section>

    <!-- Head Office and Contact Form Section -->
    <section class="py-12 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Head Office Column -->
            <div>
                <h2 class="text-3xl font-extrabold mb-6 text-gray-900">Head Office</h2>
                <p class="text-gray-700 mb-6 text-lg leading-relaxed">
                    📍 Maharlika Highway, Brgy. 71 Naga-Naga, Tacloban City 6500, Leyte, Philippines
                </p>
                <div
                    class="bg-gray-300 h-64 flex items-center justify-center rounded-lg shadow-md text-gray-500 text-xl">
                    <span>Map Placeholder</span>
                </div>
            </div>

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
    </section>
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
<script>
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
