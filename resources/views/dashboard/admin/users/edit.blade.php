<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 light:text-gray-100">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full text-black" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full text-black" required>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Password (kosongkan jika tidak ingin mengubah)</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" class="mt-1 block w-full text-black pr-10">
                                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 px-3 py-2">
                                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2C5.58 2 1.73 4.61.29 8.5c-.1.26-.1.54 0 .8C1.73 15.39 5.58 18 10 18s8.27-2.61 9.71-6.5c.1-.26.1-.54 0-.8C18.27 4.61 14.42 2 10 2zm0 14c-3.31 0-6.31-2.01-7.59-5C3.69 6.01 6.69 4 10 4s6.31 2.01 7.59 5c-1.28 2.99-4.28 5-7.59 5zm0-9a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Address</label>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full text-black" required>
                                @error('address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Address</label>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full text-black" required>
                                @error('address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300">Phone number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="mt-1 block w-full text-black" required>
                                @error('phone_number')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-black text-white hover:bg-white hover:text-black rounded">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = '<path d="M10 2C5.58 2 1.73 4.61.29 8.5c-.1.26-.1.54 0 .8C1.73 15.39 5.58 18 10 18s8.27-2.61 9.71-6.5c.1-.26.1-.54 0-.8C18.27 4.61 14.42 2 10 2zm0 14c-3.31 0-6.31-2.01-7.59-5C3.69 6.01 6.69 4 10 4s6.31 2.01 7.59 5c-1.28 2.99-4.28 5-7.59 5zm0-9a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 110-4 2 2 0 010 4z"/>';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = '<path d="M10 2C5.58 2 1.73 4.61.29 8.5c-.1.26-.1.54 0 .8C1.73 15.39 5.58 18 10 18s8.27-2.61 9.71-6.5c.1-.26.1-.54 0-.8C18.27 4.61 14.42 2 10 2zm0 14c-3.31 0-6.31-2.01-7.59-5C3.69 6.01 6.69 4 10 4s6.31 2.01 7.59 5c-1.28 2.99-4.28 5-7.59 5zm0-9a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 110-4 2 2 0 010 4z"/>';
        }
    }
</script>