<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 light:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 light:text-gray-100">Statistik Pengguna</h3>
                    <div class="mt-4">
                        <p class="text-xl">Jumlah Pengguna: {{ $userCount-1 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>