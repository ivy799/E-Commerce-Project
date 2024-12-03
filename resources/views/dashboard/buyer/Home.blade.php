<x-app-layout>
    <div class="relative bg-light-100 light:bg-gray-900 py-10">
        <div class="container mx-auto flex flex-col-reverse lg:flex-row items-center justify-between py-16 px-4 lg:px-20">
            <!-- Left Section -->
            <div class="lg:w-1/2">
                <h1 class="text-5xl font-bold text-black light:text-white mb-4">HERMES</h1>
                <p class="text-gray-600 light:text-gray-300 text-lg mb-6" id="text">
                    Discover the new shoes collections. available on the official Hermès online store.
                </p>
                <div class="flex space-x-4">
                    <a href="#productlist" class="rounded-md bg-black">
                      <span class="block -translate-x-2 -translate-y-2 rounded-md border-2 border-black bg-white text-black p-2 text-2xl hover:-translate-y-3 
                        active:translate-x-0 active:translate-y-0
                        transition-all">
                        Shop Now
                      </span>
                    </a>
                </div>                                  
            </div>
            <!-- Right Section -->
            <div class="lg:w-1/2">
                <img src="{{asset('heroImg.png')}}" style="transform: rotate(340deg); transition: transform 0.5s;">
              </div>
                                          
        </div>
    </div>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-light-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-light-900 light:text-light-100">
                    <!-- Recommended Products Section -->
                    <section class="mt-12 p-10 bg-black rounded-xl mb-10" id="product">
                        <h2 class="text-2xl font-bold text-left mb-6 text-white">See What's New!!</h2>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($recommendedProducts as $product)
                                <div class="flex flex-col items-left rounded-lg bg-white p-4 shadow-md ring-1 ring-gray-200 hover:ring-gray-400 transition duration-300">
                                    <a href="{{ route('product.show', $product->id) }}" class="w-full h-60 mb-4">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
                                    </a>
                                    <h2 class="text-lg font-semibold text-black text-left">{{ $product->name }}</h2>
                                    <p class="inline-block bg-gray-800 text-white text-xs font-semibold py-1 px-3 rounded-full mt-2 w-fit">
                                        {{ $product->category }}
                                    </p>
                                    <p class="mt-2 text-lg font-bold text-black text-left">$ {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>


                    <!-- Search Form -->
                    <form action="{{ route('search') }}" method="GET" class="mb-6">
                        @foreach (request('categories', []) as $category)
                            <input type="hidden" name="categories[]" value="{{ $category }}">
                        @endforeach
                        <div class="relative">
                            <input type="text" name="query" placeholder="Search by..." class="w-full p-2 rounded-xl border border-light-300" value="{{ request('query') }}">
                            <button type="submit" class="absolute right-0 top-0 h-full bg-white text-light-500 p-2 rounded-r border-l border-light-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.9 14.32a7.5 7.5 0 111.414-1.414l3.712 3.712a1 1 0 01-1.414 1.414l-3.712-3.712zM8.5 13a4.5 4.5 0 100-9 4.5 4.5 0 000 9z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>


                    <form action="{{ route('filter') }}" method="GET" class="p-6 bg-white shadow-lg rounded-lg mb-6" id="filterForm">
                        <div class="mb-4">
                            <h4 class="text-xl font-semibold text-light-800 mb-4 border-b pb-2">Categories</h4>
                            <div class="flex flex-wrap gap-4">
                                @foreach ($categories as $category)
                                    <div class="flex items-left space-x-2">
                                        <input
                                            type="checkbox" 
                                            name="categories[]"  
                                            value="{{ $category }}" 
                                            id="category-{{ $category }}" 
                                            {{ in_array($category, request('categories', [])) ? 'checked' : '' }} 
                                            class="form-checkbox h-5 w-5 text-gray-500 border-light-300 rounded focus:ring-gray-500"
                                            onchange="toggleFilterButton()"
                                        >
                                        <label 
                                            for="category-{{ $category }}" 
                                            class="text-light-700 text-sm font-medium"
                                        >
                                            {{ $category }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button 
                            type="submit" 
                            class="w-fit bg-black hover:bg-white hover:text-black text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition duration-200 ease-in-out"
                            id="filterButton"
                        >
                            Filter
                        </button>
                    </form>
                    
                    <main class="mt-6 py-5 bg-gray-50 text-black/50 light:bg-black dark:text-white/50">
                        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                                <!-- Header -->
                                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                                    <div class="flex lg:justify-center lg:col-start-2">
                                        <!-- Animasi fade-in -->
                                        <h1 data-aos="fade-up" class="text-4xl text-black font-bold">See All Products</h1>
                                    </div>
                                </header>
                                
                                <!-- Section Product -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10" id="productlist">
                                    @foreach($products as $product)
                                        <div data-aos="fade-up" class="flex flex-col items-start rounded-lg bg-white p-4 shadow-md ring-1 ring-gray-200 hover:ring-gray-400 transition duration-300 light:bg-gray-800 light:ring-gray-700">
                                            <!-- Gambar Produk -->
                                            <a href="{{ route('product.show', $product->id) }}" class="w-full h-60 mb-4">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
                                            </a>
                                            
                                            <!-- Detail Produk -->
                                            <h2 class="text-lg font-semibold text-gray-900 light:text-gray-100 text-left">{{ $product->name }}</h2>
                                            <p class="inline-block bg-gray-800 text-white text-xs font-semibold py-1 px-3 rounded-full mt-2 w-fit">
                                                {{ $product->category }}
                                            </p>
                                            <p class="mt-2 text-lg font-bold text-gray-900 light:text-gray-100 text-left">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </main>     

                    

                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>

<script>
    function toggleFilterButton() {
        const checkboxes = document.querySelectorAll('input[name="categories[]"]');
        const filterButton = document.getElementById('filterButton');
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        filterButton.disabled = !anyChecked;
    }
    
    document.addEventListener('DOMContentLoaded', toggleFilterButton);

    AOS.init({
        duration: 1000, // Durasi animasi (dalam milidetik)
        easing: 'ease-in-out', // Gaya animasi
        once: true // Animasi hanya diputar sekali
    });
</script>


