@extends('layouts.master')

@section('content')
  <!-- Alert Container (initially hidden) -->
  <div id="floating-alert" class="hidden fixed top-4 left-4 z-50 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 shadow-lg" role="alert">
    <span class="font-medium">Intent has successfuly been send.</span>
  </div>

  @if(session('status'))
    <div class="alert" role="alert" style="background-color: #86efac">
    <p class="mb-0 text-center">{{session('status')}}</p>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <p class="mb-0 text-center">{{ucfirst($error)}}</p>
        @endforeach
    </div>
@endif
<div class="grid grid-cols-3 gap-4 px-4 mx-auto max-w-screen-xl py-8">

    <!-- Vehicle Listings Section -->
    <div class="grid grid-cols-1 gap-4 col-span-2">
        <div
            class="bg-gray-300 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <h1 class="text-4xl font-extrabold mb-4">{{ $data->product_name }}</h1>
            <h1 class="text-xl font-bold mb-4">₱{{ $data->clearSellingPrice() }}</h1>

            <div id="indicators-carousel" class="relative w-full" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <img src="{{ asset('storage/car_images/' . $data->image) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>

                    @foreach ($product_gallery as $pg)
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/car_images/' . $pg->image_full) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    @endforeach
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                        <!-- First Indicator -->
                        <button type="button" id="0" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>

                        <!-- Other Indicators -->
                        @foreach ($product_gallery as $index => $pg)
                            <button type="button" id="{{ $index + 1 }}" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $index + 2 }}" data-carousel-slide-to="{{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                </div>

                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>

        {{-- THUMBNAIL --}}
        <div class="mt-2 flex gap-2">
            <!-- First Thumbnail -->
            <button type="button" onclick="slideTo(0)">
                <img src="{{ asset('storage/car_images/' . $data->image) }}" alt="Thumbnail 1" class="w-32 h-20 object-cover rounded">
            </button>

            <!-- Other Thumbnails -->
            @foreach ($product_gallery as $index => $pg)
                <button type="button" onclick="slideTo({{ $index + 1 }})">
                    <img src="{{ asset('storage/car_images/' . $pg->image_full) }}" alt="Thumbnail {{ $index + 2 }}" class="w-32 h-20 object-cover rounded">
                </button>
            @endforeach
        </div>
        <div
            class="bg-gray-300 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <video src="{{ asset('storage/featured_videos/' . $data->featured_video) }}" class="w-full h-96 object-cover rounded" controls type="video/mp4">
                Your browser does not support the video tag.
            </video>
            {{-- <iframe
                src="https://www.youtube.com/embed/{{ $data->featured_video }}?autoplay=1&mute=1&loop=1&playlist={{ $data->featured_video }}"
                title="{{ $data->product_name }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
                width="100%"
                height="400px">
            </iframe> --}}
        </div>

        <div
            class="bg-gray-300 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <!-- Top Section with Icons and Text -->
            <div class="flex justify-between items-center mb-4">
                <!-- Mileage -->
                <div class="flex items-center space-x-2">
                    <div class="p-4 rounded-md"><img class="h-12" src="images/mileage.png" alt=""></div>
                    <div>
                        <h2 class="font-bold">Mileage</h2>

                        <p>{{ $data->mileage }}</p>
                    </div>
                </div>
                <!-- Transmission -->
                <div class="flex items-center space-x-2">
                    <div class="p-4 rounded-md"><img class="h-12" src="images/transmission.png" alt=""></div>
                    <div>
                        <h2 class="font-bold">Transmission</h2>
                        <p>{{ $data->transmission }}</p>
                    </div>
                </div>
                <!-- Fuel Type -->
                <div class="flex items-center space-x-2">
                    <div class="p-4 rounded-md"><img class="h-12" src="images/fuel-pump.png" alt=""></div>
                    <div>
                        <h2 class="font-bold">Fuel Type</h2>
                        <p>{{ $data->fuel_type }}</p>
                    </div>
                </div>
            </div>

            <!-- Horizontal Line -->
            <hr class="border-gray-400 mb-4">

            <!-- Car Details Section -->
            <div>
                <h3 class="font-bold text-xl mb-2 px-4">Car Details</h3>
                <div class="space-y-2">
                    <!-- Checkbox and Text Items -->
                    <div class="grid grid-cols-2 px-4">
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Color:</span>
                            <span>{{ $data->color }}</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Seating Capacity:</span>
                            <span>{{ $data->seating_capacity }}</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Product ID:</span>
                            <span>{{ $data->product_identification_number }}</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Year Model:</span>
                            <span>{{ $data->year_model }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Search and Recommendations Section -->
    <div class="col-span-1 bg-gray-100 rounded">
        <div class="p-4 flex justify-center">
            <div class="space-y-4">
                <!-- Bid Now Button with fixed width -->
                <div class="flex w-96">
                    <button data-modal-target="bid-modal" data-modal-toggle="bid-modal"
                        class="text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-1/2 rounded-l-lg">Bid
                        Now</button>
                    <div class="bg-gray-300 font-semibold text-center text-black px-4 py-2 rounded-r-lg w-1/2">PHP
                        {{ number_format($bidding_data->max_amount) }}</div>
                </div>

                <!-- Buy Now Button with fixed width -->
                <div class="flex w-96">
                    <button data-modal-target="formLoi" data-modal-toggle="formLoi" id="showLoiFOrm"
                        class="text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-1/2 rounded-l-lg">Buy
                        Now</button>
                    <div class="bg-gray-300 font-semibold text-center text-black px-4 py-2 rounded-r-lg w-1/2">PHP
                        {{ $data->clearSellingPrice() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 p-4">
            <!-- Inquiry Form -->
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-md font-bold mb-2">Need Recommendations on Buying a Pre-Owned Vehicle?</h3>
                <form class="space-y-4">
                    <input type="text" placeholder="Name" class="w-full p-2 border rounded-md">
                    <input type="email" placeholder="Email" class="w-full p-2 border rounded-md">
                    <input type="tel" placeholder="Number" class="w-full p-2 border rounded-md">
                    <textarea placeholder="Message" class="w-full p-2 border rounded-md"></textarea>
                    <button type="submit"
                        class="w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Send
                        Inquiry</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Buy Main modal -->
    <div id="formLoi" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-1/2 max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <div class="flex justify-start flex-col">
                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">
                            LETTER OF INTENT
                        </h3>
                        <h3 class="text-2xl text-gray-900 dark:text-white" >
                            {{ $data->product_name }}
                        </h3>
                        <h3 class="text-2xl text-gray-900 dark:text-white" >
                            ₱{{ $data->clearSellingPrice() }}
                        </h3>
                    </div>
                    <button type="button" id="closeModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="formLoi">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="loiForm" method="post" action="{{ url('/api/customer_loi') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="customer_product_id" name="customer_product_id" value="{{ $data->id }}">
                    <input type="hidden" id="agent_name" name="agent_name">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-1">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name/Company
                                Name</label>
                            <input type="text" name="customer_name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Juan Dela Cruz" required="">
                        </div>
                        <div class="col-span-1">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                Address</label>
                            <input type="email" name="customer_email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="name@company.com" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="customer_address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Brgy. 84 San Jose, Tacloban City" required="">
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile
                                Number</label>
                            <input type="text" name="customer_mobile" id="mobilenumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="09123456789" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request
                                Price</label>
                            <input type="number" name="bid_amount" id="reqprice"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="PHP 999,9999" required="">
                        </div>
                        <button
                            class="col-span-2 text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Submit Intent
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bid Main modal -->
<div id="bid-modal" tabindex="-1" aria-hidden="true"
class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
<div class="relative p-4 w-1/2 max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <div class="flex flex-col">
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    Innova 2.8 G Diesel M/T
                </h3>
                <span class="text-sm">Current Highest Bid Price</span>
                <span class="text-xl font-bold">{{ number_format($bidding_data->max_amount) }}</span>
            </div>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="bid-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <form class="p-4 md:p-5" method="post" action="{{ route('place-bid', ['id' => $data->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" id="product_id" name="product_id" value="{{ $data->id }}">
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-1">
                    <label for="productId"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                        Identification Number</label>
                    <input type="number" name="product_identification_number" id="product_identification_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $data->product_identification_number }}" readonly>
                </div>
                <div class="col-span-1">
                    <label for="bidamount"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bid Amount</label>
                    <input type="text" name="bid_amount" id="bid_amount"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $bidding_data->max_amount + 5000 }}">
                </div>
            </div>

            <div class="mt-10">
                <div class="border-b border-gray-300 pb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Bidding Mechanics</h2>
                </div>

                <!-- Bidding Process Section -->
                <div class="mt-4">
                    <h3 class="text-lg font-semibold text-gray-900">Bidding Process</h3>
                    <ol class="list-decimal px-8 mt-2 space-y-1 text-gray-700">
                        <li>Each guest can submit only one bid per vehicle.</li>
                        <li>Bids must be in increments of Php 5,000.00.</li>
                        <li>Guests can bid again if their offer has been outbid.</li>
                    </ol>
                </div>

                <!-- Winning Bid and Non-Purchase Section -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-900">Winning Bid and Non-Purchase</h3>
                    <ol class="list-decimal px-8 mt-2 space-y-1 text-gray-700">
                        <li>
                            If a guest wins the bid but does not purchase the vehicle, the guest will be
                            reviewed, and if the reason given is unacceptable, said guest will be
                            <span class="font-semibold">banned for six months.</span>
                        </li>
                        <li>Outbid notification will be sent out via email.</li>
                        <li>The admin will contact the winning bidder to confirm and assist with the purchase.
                        </li>
                    </ol>
                </div>

                <!-- Agreement Checkbox -->
                {{-- <div class="my-6 flex items-start">
                    <input id="agreement" type="checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="agreement" class="ml-2 text-sm text-gray-700">
                        By placing a bid, I agree to the Toyota Tacloban Online Bidding Terms and Conditions.
                    </label>
                </div> --}}
            </div>


            <button type="submit"
                class="w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Submit Bid
            </button>
        </form>
    </div>
</div>
</div>
@endsection

@section('javascript')
<script>
    function slideTo(index) {
    // Get the button by its ID and simulate a click
    document.getElementById(index).click();
}
</script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    $(document).ready(function() {
    $(document).on('submit', '#loiForm', function(event){
        event.preventDefault(); // Prevent default form submission (page refresh)
        var url = $("form#loiForm").prop("action");
        var data = $("form#loiForm").serialize();
        var method = $("form#loiForm").attr("method");

        $.ajax({
            type: method,
            url: url,
            data : data,
            dataType : 'json',
            success :  function(data) {

                $("form#loiForm p.errors").remove();

                if(data.success == true){
                    $("#loiForm").trigger("reset");
                    closeModal()
                    showFloatingAlert()
                }else{
                    $.each( data.errors, function( key, value ) {
                        $("#"+key).after('<p class="errors text-danger" style="padding-top: 3px; font-size: 10px;">'+value+'</p>');
                    });
                }
            }
        });
        return false;
    });

    function showFloatingAlert() {
      // Show the floating alert by removing the 'hidden' class
      const alert = document.getElementById('floating-alert');
      alert.classList.remove('hidden');
    console.log('showFloatingAlert');
      // Automatically hide the alert after 5 seconds
      setTimeout(() => {
        alert.classList.add('hidden');
      }, 7000); // Alert disappears after 5 seconds
    }

    function closeModal() {
    // Get the button by its ID and simulate a click
    document.getElementById('closeModal').click();
    }
});
</script>
@stop
