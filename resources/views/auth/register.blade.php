@extends('layouts.master')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-6">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
            class="w-full max-w-xl bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-4xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="p-4 sm:p-6 md:p-8 space-y-4 md:space-y-6">
                <h1
                    class="text-xl sm:text-2xl font-bold leading-tight tracking-tight text-center text-gray-900 dark:text-white">
                    Create an Account
                </h1>
                <form id="emailForm" method="POST" action="{{ route('user-store') }}"
                      class="space-y-4 md:space-y-6" enctype="multipart/form-data">
                    @csrf
                    <!-- Two-column grid for larger screens, stack on small screens -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label for="fname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                Name</label>
                            <input type="text" name="firstname" id="firstname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="">
                        </div>
                        <div>
                            <label for="fname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                                Name</label>
                            <input type="text" name="middlename" id="middlename"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="">
                        </div>
                        <div>
                            <label for="fname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                Name</label>
                            <input type="text" name="lastname" id="lastname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="">
                        </div>
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com">
                            <div class="result" id="result"></div>
                        </div>
                        <div>
                            <label for="mobile"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile
                                Number</label>
                            <input type="number" name="mobile_number" id="mobile_number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="09123456789">
                        </div>
                        <div>
                            <label for="birthdate"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Brgy. 84 San Jose, Tacloban City">
                        </div>
                        <div>
                            <label for="income"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Source of
                                Income</label>
                            <input type="text" name="source_of_income" id="source_of_income"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <!-- Select Government ID Type -->
                            <label for="govt_id_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Select Government ID Type
                            </label>
                            <select
                                id="govt_id_type"
                                name="govt_id_type"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                onchange="toggleFileUpload()"
                            >
                                <option value="" selected disabled>Select an ID type</option>
                                <option value="passport">Passport</option>
                                <option value="driver_license">Driver's License</option>
                                <option value="national_id">National ID</option>
                            </select>
                        </div>

                        <!-- File Upload Section -->
                        <div id="file-upload-section" class="hidden mt-4">
                            <label for="govt_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Upload Government ID
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="govt_id"
                                name="govt_id"
                                type="file"
                                capture="user"
                            >
                        </div>

                        <div>
                            <label for="selfId"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Selfie
                                (with ID)</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="selfie_with_id" name="selfie_with_id" type="file" capture="user">
                        </div>
                        <div>
                            <label for="esig"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-Signature</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="e_signature" name="e_signature" type="file">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex items-start mt-4">
                        <input id="terms" aria-describedby="terms" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                        <label for="terms" class="ml-2 text-sm font-light text-gray-500 dark:text-gray-300">
                            I accept the <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Terms and Conditions</a>
                        </label>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mt-6">
                        Create an account
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                        Already have an account? <a href="login.html"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
                            here</a>
                    </p>

        </div>
    </div>
</section>

<script>
    const form = document.getElementById('emailForm');
    const resultDiv = document.getElementById('result');

    // Fetch API call to Abstract Email Validation API
    const fetchEmailValidation = async (email) => {
      const apiKey = "7c3436b1a01b44bb8bcc7a5ae730cf19"; // Replace with your actual Abstract API key
      const apiUrl = `https://emailvalidation.abstractapi.com/v1/?api_key=${apiKey}&email=${encodeURIComponent(email)}`;

      try {
        const response = await fetch(apiUrl, { method: 'GET' });
        if (!response.ok) {
          throw new Error('Failed to fetch data from the email validation API.');
        }
        return await response.json();
      } catch (error) {
        console.error('Error:', error);
        return null;
      }
    };

    // Check email existence based on API response
    const checkEmailExistence = (response) => {
      if (!response) {
        return { status: "error", message: "Unable to check email. Please try again later." };
      }

      if (response.deliverability === "DELIVERABLE") {
        return { status: "success", message: "Email exists and is deliverable." };
      }

      if (response.deliverability === "UNDELIVERABLE") {
        return { status: "error", message: "Email does not exist or is undeliverable." };
      }

      return { status: "warning", message: "Unable to determine email validity." };
    };

    // Form submission event handler
    form.addEventListener('submit', async (event) => {
      event.preventDefault(); // Prevent default form submission

      const emailInput = document.getElementById('email').value.trim();
      const submitButton = form.querySelector('button[type="submit"]');

      if (!emailInput) {
        resultDiv.innerHTML = `<span class="error">Please enter a valid email address.</span>`;
        return;
      }

        // Disable the button and change its text to "Loading..."
        submitButton.disabled = true;
        submitButton.textContent = "Loading...";

      resultDiv.innerHTML = "Checking email..."; // Display loading message

      // Fetch API response
      const apiResponse = await fetchEmailValidation(emailInput);
      const result = checkEmailExistence(apiResponse);

      // Display result
      if (result.status === "success") {
        resultDiv.innerHTML = `<span style="color:green">${result.message}</span>`;
            setTimeout(() => {
        form.submit(); // Automatically submit the form after success
        }, 2000); // Optional delay for user to see the message
      } else if (result.status === "error") {
        resultDiv.innerHTML = `<span style="color:red">${result.message}</span>`;
        submitButton.disabled = false; // Re-enable the button
        submitButton.textContent = "Create an account"; // Reset button text
      } else {
        resultDiv.innerHTML = `<span style="color:red">${result.message}</span>`;
        submitButton.disabled = false; // Re-enable the button
        submitButton.textContent = "Create an account"; // Reset button text
      }
    });

    function toggleFileUpload() {
        const selectElement = document.getElementById('govt_id_type');
        const fileUploadSection = document.getElementById('file-upload-section');

        // Show file upload section if a valid ID type is selected
        if (selectElement.value) {
            fileUploadSection.classList.remove('hidden');
        } else {
            fileUploadSection.classList.add('hidden');
        }
    }
  </script>
@endsection

