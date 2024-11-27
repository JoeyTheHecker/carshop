@extends('layouts.master')

@section('content')
<div class="bg-gray-100">
    <!-- Header Section -->
    <div class="relative bg-cover bg-center h-60 md:h-96" style="background-image: url('{{ asset('images/fq.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center">
            <h2 class="text-4xl font-bold text-white tracking-wide">Frequently Asked Questions</h2>
            <p class="text-white md:text-lg mt-2 text-center px-4 md:px-0">
                Find answers to your questions about our vehicles and services.
            </p>
        </div>
    </div>

    <div class="p-6 md:p-12">
        <div class="max-w-4xl mx-auto">
            <!-- FAQ Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Left Column -->
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">Are documents for a secondhand car complete?</span>
                            <span class="text-white text-xl">&#x2b;<!-- Plus icon --></span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            Yes. We provide the original Certificate of Vehicle Registration (CR), Original Receipt of
                            Registration (OR), Original LTO plate number, and a Notarized Deed of Sale.
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">Are prices negotiable?</span>
                            <span class="text-white text-xl">&#x2b;</span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            Yes, all our car prices are negotiable.
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">How do I create an account?</span>
                            <span class="text-white text-xl">&#x2b;</span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            Click the "Sign Up" button on the homepage, fill out the necessary details, and submit your
                            registration form. An email confirmation will follow once your account is verified.
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">What happens after I win a bid?</span>
                            <span class="text-white text-xl">&#x2b;</span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            If you win a bid, our team will contact you to complete the transaction and assist with the purchase process.
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">What is a Letter of Intent (LOI)?</span>
                            <span class="text-white text-xl">&#x2b;</span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            A Letter of Intent (LOI) is a formal document used by users who wish to purchase a car directly, without going through the bidding process.
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">How does the bidding process work?</span>
                            <span class="text-white text-xl">&#x2b;</span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            To place a bid, simply log in to your account, view the vehicle you're interested in, and submit your bid. You will be notified if you are outbid.
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">Can I bid on multiple vehicles at the same time?</span>
                            <span class="text-white text-xl">&#x2b;</span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            Yes, you can place bids on as many vehicles as you like.
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                        <button
                            class="w-full p-3 flex justify-between items-center text-left text-gray-900 font-semibold bg-red-800 hover:bg-red-700 focus:outline-none"
                            onclick="toggleFAQ(this)">
                            <span class="text-white">What happens if I get outbid?</span>
                            <span class="text-white text-xl">&#x2b;</span>
                        </button>
                        <div class="hidden p-5 bg-gray-50 text-gray-700">
                            If you are outbid, you will receive an email notification with the details of the new highest bid. You can then log into your account to place a higher bid if desired.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFAQ(button) {
        const content = button.nextElementSibling;
        const isOpen = !content.classList.contains("hidden");
        button.querySelector("span:last-child").innerHTML = isOpen ? "&#x2b;" : "&#x2212;"; // Switch between plus and minus icons
        content.classList.toggle("hidden");
        content.classList.toggle("transition-all");
    }
</script>
@endsection

@section('javascript')
@stop
