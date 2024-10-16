@extends('layouts.master')

@section('content')
<section class="bg-center bg-no-repeat bg-cover bg-gray-700 bg-blend-multiply"
style="background-image: url(images/banner.jpg);">
<div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
        Drive Your Dream, Discover Great Deals on Pre-Owned Cars!</h1>
    <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Explore our extensive
        selection of quality pre-owned vehicles. Whether you're looking for a budget-friendly ride or something
        special, start your journey with Toyota Tacloban today.
    </p>
    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
        <a href="#"
            class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
            Get started
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</div>
</section>

<section class="bg-gray-900 text-white py-12">
<div class="max-w-7xl mx-auto text-center space-y-4">
    <!-- Title Section -->
    <h1 class="text-4xl font-extrabold uppercase text-yellow-400">
        Online Bidding
    </h1>
    
    <!-- Subtext -->
    <p class="text-lg font-semibold text-white">ENDS IN</p>

    <!-- Countdown Timer -->
    <div class="flex justify-center space-x-4" id="countdown">
        <!-- Days -->
        <div class="bg-white text-gray-900 p-4 rounded-lg">
            <p class="text-3xl font-bold" id="days">0</p>
            <p class="text-lg font-semibold text-blue-700">Days</p>
        </div>

        <!-- Hours -->
        <div class="bg-white text-gray-900 p-4 rounded-lg">
            <p class="text-3xl font-bold" id="hours">0</p>
            <p class="text-lg font-semibold text-blue-700">Hours</p>
        </div>

        <!-- Minutes -->
        <div class="bg-white text-gray-900 p-4 rounded-lg">
            <p class="text-3xl font-bold" id="minutes">0</p>
            <p class="text-lg font-semibold text-blue-700">Mins</p>
        </div>

        <!-- Seconds -->
        <div class="bg-white text-gray-900 p-4 rounded-lg">
            <p class="text-3xl font-bold" id="seconds">0</p>
            <p class="text-lg font-semibold text-blue-700">Secs</p>
        </div>
    </div>
</div>
</section>


<!-- Download Section -->
<section class="container mx-auto px-4 py-12 bg-gray-200">
<div class="text-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Download our Complete Price List</h3>
    <p class="text-gray-700 dark:text-gray-300 mt-2">Click the button below to get the complete price list in
        PDF format.</p>
    <a href="/path-to-your-pdf-file.pdf" download
        class="mt-4 inline-block text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
        Download PDF
    </a>
</div>
</section>
@stop