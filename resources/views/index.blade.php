@extends('layouts.master')

@section('content')


<div id="default-carousel" class="relative w-full" data-carousel="slide" interval: 9000>
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden md:h-96">
         <!-- Item 1 -->
        <div class="hidden duration-200 ease-linear" data-carousel-item>
            <section class="bg-center bg-no-repeat bg-cover bg-gray-700 bg-blend-multiply"
                style="background-image: url(images/banner.jpg);">
                <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-40">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    Drive Your Dream, Discover Great Deals on Pre-Owned Cars!</h1>
                <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Explore our extensive
                    selection of quality pre-owned vehicles. Whether you're looking for a budget-friendly ride or something
                    special, start your journey with Toyota Tacloban today.
                </p>
                {{-- <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="#"
                        class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Get started
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div> --}}
            </div>
            </section>
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-200 ease-linear" data-carousel-item>
            @if (isset($data['bidding_cycles']))
                <section class="bg-gray-900 text-white h-full flex justify-center items-center">
                    <div class="max-w-7xl mx-auto text-center space-y-4">
                        <!-- Title Section -->
                        <h1 class="text-4xl font-extrabold uppercase text-yellow-400">
                            Online Bidding
                        </h1>


                        @if ($data['bidding_cycles']->is_open == 1)
                            <!-- Subtext -->
                            <p class="text-lg font-semibold text-white">ENDS IN</p>
                        @else
                            <!-- Subtext -->
                            <p class="text-lg font-semibold text-white">STARTS IN</p>
                        @endif
                        <!-- Countdown Timer -->
                        <div class="flex justify-center space-x-4" id="countdown">
                            <!-- Days -->
                            <div class="bg-white text-gray-900 p-4 rounded-lg">
                                <p class="text-3xl font-bold" id="days">{{ $data['bidding_cycles']->end_timer->format("%a") }}</p>
                                <p class="text-lg font-semibold text-blue-700">Days</p>
                            </div>

                            <!-- Hours -->
                            <div class="bg-white text-gray-900 p-4 rounded-lg">
                                <p class="text-3xl font-bold" id="hours">{{ $data['bidding_cycles']->end_timer->format("%h") }}</p>
                                <p class="text-lg font-semibold text-blue-700">Hours</p>
                            </div>

                            <!-- Minutes -->
                            <div class="bg-white text-gray-900 p-4 rounded-lg">
                                <p class="text-3xl font-bold" id="minutes">{{ $data['bidding_cycles']->end_timer->format("%i") }}</p>
                                <p class="text-lg font-semibold text-blue-700">Mins</p>
                            </div>

                            <!-- Seconds -->
                            <div class="bg-white text-gray-900 p-4 rounded-lg">
                                <p class="text-3xl font-bold" id="seconds">{{ $data['bidding_cycles']->end_timer->format("%s") }}</p>
                                <p class="text-lg font-semibold text-blue-700">Secs</p>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
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
<script>
// Initialize the carousel with a longer duration
// const carousel = new Carousel(document.getElementById('default-carousel'), {
//     interval: 9000, // Set interval duration to 3000ms (3 seconds)
//     transitionDuration: 3000 // Set transition duration to 1000ms (1 second)
// });
</script>
