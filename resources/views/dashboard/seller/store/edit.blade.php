<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="mr-4">
                @if ($store->image)
                    <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="h-32 w-32 object-cover rounded-full border-solid border-white border-2 shadow-md">
                @else
                    <div class="h-32 w-32 flex items-center justify-center bg-gray-200 rounded-full">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
            </div>
            <div>
                <h1 class="text-2xl font-semibold">{{ $store->name }}</h1>
                <p class="text-gray-500">{{ 'untitledui.com/' . strtolower(str_replace(' ', '', $store->name)) }}</p>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 light:text-gray-100">
                    <h1 class="text-2xl font-bold">STORE PROFILE</h1>
                    <p class="block text-sm font-medium text-gray-700 light:text-gray-300">edit your store profile here</p>
                    <form method="POST" action="{{ route('seller.stores.update', $store->id) }}" enctype="multipart/form-data" class="mt-6">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Public Profile</label>
                                <input type="text" name="name" value="{{ old('name', $store->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-black" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Address</label>
                                <input type="text" name="address" value="{{ old('address', $store->address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-black">
                                @error('address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Email</label>
                                <input type="email" name="email" value="{{ old('email', $store->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-black">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Description</label>
                                <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-black" rows="4">{{ old('description', $store->description) }}</textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Company Logo</label>
                                <div class="flex items-center">
                                    <div class="mt-1 w-full flex">
                                        <div class="mr-4">
                                            @if ($store->image)
                                                <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="h-20 w-20 object-cover rounded-full border-solid border-white border-2 shadow-md">
                                            @else
                                                <div class="h-20 w-20 flex items-center justify-center bg-gray-200 rounded-full">
                                                    <span class="text-gray-500">No Image</span>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" name="image" id="image" class="hidden">
                                        <label for="image" class="w-60 cursor-pointer bg-white text-center border border-gray-300 rounded-md py-4 text-gray-700 hover:bg-gray-100 flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000" class="mb-2">
                                                <path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
                                            </svg>
                                            Click to upload
                                        </label>
                                        @error('image')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-black text-white rounded-md shadow-sm hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Changes</button>                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
