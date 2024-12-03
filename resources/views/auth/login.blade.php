<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">{{ __('Login') }}</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf
    
        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    
        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="current-password" />
                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 px-3 py-2">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2C5.58 2 1.73 4.61.29 8.5c-.1.26-.1.54 0 .8C1.73 15.39 5.58 18 10 18s8.27-2.61 9.71-6.5c.1-.26.1-.54 0-.8C18.27 4.61 14.42 2 10 2zm0 14c-3.31 0-6.31-2.01-7.59-5C3.69 6.01 6.69 4 10 4s6.31 2.01 7.59 5c-1.28 2.99-4.28 5-7.59 5zm0-9a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 110-4 2 2 0 010 4z"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
    
        <!-- Remember Me -->
        <div class="flex items-center mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
    
        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
    
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
</x-guest-layout>
