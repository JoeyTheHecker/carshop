

@if (count($data) == 0)
    <div class="col-md-12">
        <p>There are currently {{ count($data) }} record found in the database.</p>
    </div>
@else
    {{-- <div class="grid grid-cols-2 gap-4 col-span-2"> --}}
        @foreach ($data as $r)
            <a href="vehicledetails.html"
            class="bg-gray-300 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <img src="{{ asset('images/samplevehicle.jpg') }}" alt="Vehicle 1" class="w-full h-72 object-cover rounded-t-lg">
            <div class="mt-2">
                <h2 class="text-2xl font-bold">{{ $r->product_name }}</h2>
                <p class="text-gray-600 font-semibold">PHP {{ $r->clearSellingPrice() }}</p>
            </div>
            </a>
        @endforeach
    {{-- </div> --}}

    <!-- Pagination Section -->
    <div class="col-span-2 flex justify-center py-4">
        <nav aria-label="Page navigation">
            <ul class="inline-flex -space-x-px">
                <li>
                    <a href="#"
                        class="py-2 px-3 mx-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100">Previous</a>
                </li>
                <li>
                    <a href="#"
                        class="py-2 px-3 mx-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">1</a>
                </li>
                <li>
                    <a href="#"
                        class="py-2 px-3 mx-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">2</a>
                </li>
                <li>
                    <a href="#"
                        class="py-2 px-3 mx-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 text-right mt-2 mb-2">
            <div id="pagination-wrapper">{{ $data->links() }}</div>
        </div>
    </div>
@endif