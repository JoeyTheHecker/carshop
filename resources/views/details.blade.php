@extends('layouts.master')

@section('content')
<div class="grid grid-cols-3 gap-4 px-4 mx-auto max-w-screen-xl py-8">

    <!-- Vehicle Listings Section -->
    <div class="grid grid-cols-1 gap-4 col-span-2">
        <div
            class="bg-gray-300 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <h1 class="text-4xl font-extrabold mb-4">{{ $data->product_name }}</h1>
            <h1 class="text-xl font-bold mb-4">₱{{ $data->clearSellingPrice() }}</h1>
            <img src="{{ asset('storage/car_images/' . $data->image) }}" alt="Vehicle 1" class="w-full h-96 object-cover rounded">
            <div class="mt-2 flex gap-2">
                <a href="#">
                    <img src="images/samplevehicle.jpg" alt="Vehicle 1" class="w-32 h-20 object-cover rounded">
                </a>
                <a href="#">
                    <img src="images/samplevehicle.jpg" alt="Vehicle 1" class="w-32 h-20 object-cover rounded">
                </a>
                <a href="#">
                    <img src="images/samplevehicle.jpg" alt="Vehicle 1" class="w-32 h-20 object-cover rounded">
                </a>
                <a href="#">
                    <img src="images/samplevehicle.jpg" alt="Vehicle 1" class="w-32 h-20 object-cover rounded">
                </a>
            </div>
        </div>
        <div
            class="bg-gray-300 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <video src="https://youtu.be/yDzYiS1cWrE" class="w-full h-96 object-cover rounded" controls>
                Your browser does not support the video tag.
            </video>
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
                        <p>18,000+</p>
                    </div>
                </div>
                <!-- Transmission -->
                <div class="flex items-center space-x-2">
                    <div class="p-4 rounded-md"><img class="h-12" src="images/transmission.png" alt=""></div>
                    <div>
                        <h2 class="font-bold">Transmission</h2>
                        <p>Manual</p>
                    </div>
                </div>
                <!-- Fuel Type -->
                <div class="flex items-center space-x-2">
                    <div class="p-4 rounded-md"><img class="h-12" src="images/fuel-pump.png" alt=""></div>
                    <div>
                        <h2 class="font-bold">Fuel Type</h2>
                        <p>Diesel</p>
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
                            <span>Purplish Silver</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Seating Capacity:</span>
                            <span>8</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Unloaded Weight:</span>
                            <span>2480kg</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Maximum Weight:</span>
                            <span>2480kg</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Cubic Capacity:</span>
                            <span>2755cm³</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <span class="font-semibold">Number of Cylinders:</span>
                            <span>4</span>
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
                        910,000</div>
                </div>

                <!-- Buy Now Button with fixed width -->
                <div class="flex w-96">
                    <button data-modal-target="buy-modal" data-modal-toggle="buy-modal"
                        class="text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-1/2 rounded-l-lg">Buy
                        Now</button>
                    <div class="bg-gray-300 font-semibold text-center text-black px-4 py-2 rounded-r-lg w-1/2">PHP
                        1,300,000.00
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 p-4">
            <!-- Vehicle Search -->
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
                    <input type="text" id="keyword" class="w-full mt-1 p-2 border rounded-md"
                        placeholder="Enter Keyword">
                </div>
                <button
                    class="w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Search</button>
            </div>

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
@endsection

@section('javascript')

@stop
