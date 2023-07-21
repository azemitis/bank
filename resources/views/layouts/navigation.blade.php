<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
{{--                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />--}}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex justify-between items-center bg-white px-6 py-4">
                    <div class="flex items-center space-x-8">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                    class="text-lg font-semibold text-gray-900 hover:text-gray-700">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.index')"
                                    class="text-lg font-semibold text-gray-900 hover:text-gray-700">
                            {{ __('Transactions') }}
                        </x-nav-link>
                        <x-nav-link :href="route('deposits.index')" :active="request()->routeIs('deposits.index')"
                                    class="text-lg font-semibold text-gray-900 hover:text-gray-700">
                            {{ __('Deposits') }}
                        </x-nav-link>
                        <x-nav-link :href="route('crypto.index')" :active="request()->routeIs('crypto.index')"
                                    class="text-lg font-semibold text-gray-900 hover:text-gray-700">
                            {{ __('Cryptocurrencies') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>

            <!-- Profile and Logout -->
            <div class="flex items-center space-x-8">
                <!-- Profile Link -->
                <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')"
                            class="text-lg font-semibold text-gray-900 hover:text-gray-700">
                    {{ __('Profile') }}
                </x-nav-link>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-semibold text-gray-600 hover:text-gray-800
                            focus:outline-none transition duration-150 ease-in-out">
                                {{ Auth::user()->name }}
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1
                                        0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
