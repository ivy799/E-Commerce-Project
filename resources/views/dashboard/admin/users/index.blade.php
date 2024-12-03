<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light-800 dark:text-light-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-light-50 to-light-200 dark:from-light-800 dark:to-light-900 overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-md hover:from-purple-500 hover:to-indigo-500 rounded-md">
                        Create User
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($users as $user)
                        <div class="bg-white dark:bg-light-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <div class="flex items-center mb-4">
                                <div class="h-10 w-10 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <h3 class="ml-4 font-bold text-lg text-light-900 dark:text-light-100">
                                    {{ $user->name }}
                                </h3>
                            </div>
                            <p class="text-light-700 dark:text-light-300 text-sm">
                                <strong>Email:</strong> {{ $user->email }}
                            </p>
                            <p class="text-light-700 dark:text-light-300 text-sm">
                                <strong>Address:</strong> {{ $user->address }}
                            </p>
                            <p class="text-light-700 dark:text-light-300 text-sm">
                                <strong>Phone:</strong> {{ $user->phone_number }}
                            </p>
                            <p class="text-light-700 dark:text-light-300 text-sm">
                                <strong>Role:</strong> {{ $user->role }}
                            </p>
                            <div class="flex items-center mt-4 space-x-4">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                        <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                                    </svg>
                                </a>
                                @if(auth()->user()->id !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-light-700 dark:text-light-300">
                            No users found
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
