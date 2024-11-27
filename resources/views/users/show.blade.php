@extends('layouts.master')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="min-h-screen flex items-center justify-center p-4">
    <div
        class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 text-center mb-8 md:mb-0">
                <img src="{{ asset('storage/selfie_id/' . $user->selfie_with_id) }}" alt="Profile Picture"
                    class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-indigo-800 dark:border-blue-900 transition-transform duration-300 hover:scale-105">
                <h1 class="text-2xl font-bold text-indigo-800 dark:text-white mb-2">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</h1>
                {{-- <button
                    class="mt-4 bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors duration-300">Edit
                    Profile</button> --}}
            </div>
            <div class="md:w-2/3 md:pl-8">
                <h2 class="text-xl font-semibold text-indigo-800 dark:text-white mb-4">Personal Information</h2>
                <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800 dark:text-blue-900"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 011 1v1h10V3a1 1 0 112 0v1h1a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 011-1zm11 4H7V5H5v14h14V5h-2v1zm-5 6a1 1 0 10-2 0 1 1 0 002 0z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $user->date_of_birth }}
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800 dark:text-blue-900"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $user->address }}
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800 dark:text-blue-900"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        {{ $user->mobile_number }}
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800 dark:text-blue-900"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        {{ $user->email }}
                    </li>
                </ul>
                <div class="flex flex-wrap gap-2 my-6">
                    <a class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm" href="{{ asset('storage/govt_id/' . $user->govt_id) }}" target="_blank">Government ID</a>
                    <a class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm" href="{{ asset('storage/selfie_id/' . $user->selfie_with_id) }}" target="_blank">Selfie with ID</a>
                    <a class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm" href="{{ asset('storage/e_signature/' . $user->e_signature) }}" target="_blank">E-Signature</a>
                </div>
                @if (isset($data['is_bidding_open']) && $data['is_bidding_open']->is_open == 1)
                    @if (count($data['hot_bids']) > 0)
                    <h2 class="text-xl font-semibold text-indigo-800 dark:text-white mb-4">Active Bids</h2>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
                        @foreach ($data['hot_bids'] as $hotBids)
                            <li class="flex items-center">
                                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a href="{{ url('product/details/' . $hotBids->id . '') }}">
                                        <img class="rounded-t-lg" src="{{ asset('storage/car_images/' . $hotBids->image) }}" alt="" />
                                    </a>
                                    <div class="p-5">
                                        <a href="{{ url('product/details/' . $hotBids->id . '') }}">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $hotBids->product_name }}</h5>
                                        </a>
                                        <a href="{{ url('product/details/' . $hotBids->id . '') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            View Bid
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @endif

                @endif

            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>

    <script>
        // Toggle dark mode based on system preference
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        // Add hover effect to skill tags
        const skillTags = document.querySelectorAll('.bg-indigo-100');
        skillTags.forEach(tag => {
            tag.addEventListener('mouseover', () => {
                tag.classList.remove('bg-indigo-100', 'text-indigo-800');
                tag.classList.add('bg-blue-900', 'text-white');
            });
            tag.addEventListener('mouseout', () => {
                tag.classList.remove('bg-blue-900', 'text-white');
                tag.classList.add('bg-indigo-100', 'text-indigo-800');
            });
        });
    </script>
</div>

@stop
<script>
// Initialize the carousel with a longer duration
// const carousel = new Carousel(document.getElementById('default-carousel'), {
//     interval: 9000, // Set interval duration to 3000ms (3 seconds)
//     transitionDuration: 3000 // Set transition duration to 1000ms (1 second)
// });
</script>
