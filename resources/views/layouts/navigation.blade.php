<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-10 w-auto text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:flex">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('admin.home')" :active="request()->routeIs('admin.home')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                                {{ __('Manage Users') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Store') }}
                            </x-nav-link>
                            <x-nav-link :href="route('buyer.cart.index')" :active="request()->routeIs('buyer.cart.index')">
                                {{ __('Cart') }}
                            </x-nav-link>
                            <x-nav-link :href="route('buyer.favorites.index')" :active="request()->routeIs('buyer.favorites.index')">
                                {{ __('Favorites') }}
                            </x-nav-link>
                            <x-nav-link :href="route('buyer.orders.index')" :active="request()->routeIs('buyer.orders.index')">
                                {{ __('Orders') }}
                            </x-nav-link>
                        </div>
                    @elseif(Auth::user()->role === 'seller')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('seller.stores.index')" :active="request()->routeIs('seller.stores.index')">
                            {{ __('Manage Stores') }}
                        </x-nav-link>
                        <x-nav-link :href="route('seller.products.index')" :active="request()->routeIs('seller.products.index')">
                            {{ __('Manage Products') }}
                        </x-nav-link>
                        <x-nav-link :href="route('seller.orders.index')" :active="request()->routeIs('seller.orders.index')">
                            {{ __('Manage Orders') }}
                        </x-nav-link>
                    </div>
                    @elseif(Auth::user()->role === 'buyer')
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Home') }}
                            </x-nav-link>
                            <x-nav-link :href="route('buyer.cart.index')" :active="request()->routeIs('buyer.cart.index')">
                                {{ __('Cart') }}
                            </x-nav-link>
                            <x-nav-link :href="route('buyer.favorites.index')" :active="request()->routeIs('buyer.favorites.index')">
                                {{ __('Favorites') }}
                            </x-nav-link>
                            <x-nav-link :href="route('buyer.orders.index')" :active="request()->routeIs('buyer.orders.index')">
                                {{ __('Orders') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- User Profile Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-800 hover:text-gray-600">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger Menu -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center p-2 text-gray-800 hover:bg-gray-100 focus:outline-none rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>

