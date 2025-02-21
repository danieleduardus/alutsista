<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Master Data Dropdown -->
                    @php
                        $isMasterDataActive = request()->routeIs('jenis-kebutuhan.*') || request()->routeIs('prioritas-kebutuhan.*') || request()->routeIs('pengguna.*') || request()->routeIs('hak-akses.*');
                    @endphp

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out h-full
                                {{ $isMasterDataActive ? 'border-indigo-500 text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }}">
                            {{ __('Master Data') }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50 py-2">
                            <a href="{{ route('jenis-kebutuhan.index') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('jenis-kebutuhan.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Jenis Kebutuhan
                            </a>
                            <a href="{{ route('prioritas-kebutuhan.index') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('prioritas-kebutuhan.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Prioritas Kebutuhan
                            </a>
                            <a href="{{ route('pengguna.index') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('pengguna.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Pengguna
                            </a>
                            <a href="{{ route('hak-akses.index') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('hak-akses.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Hak Akses
                            </a>
                        </div>
                    </div>

                    <!-- Rencana Kebutuhan -->
                    <x-nav-link :href="route('rencana-kebutuhan.index')" :active="request()->routeIs('rencana-kebutuhan.*')">
                        {{ __('Rencana Kebutuhan') }}
                    </x-nav-link>

                    <!-- Usulan Anggaran -->
                    <x-nav-link :href="route('usulan-anggaran.index')" :active="request()->routeIs('usulan-anggaran.*')">
                        {{ __('Usulan Anggaran') }}
                    </x-nav-link>

                    <x-nav-link :href="route('rfq.index')" :active="request()->routeIs('rfq.*')">
                        {{ __('RFQ') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown & Toggle Theme -->
            <div class="hidden sm:flex sm:items-center space-x-3">
                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

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

                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" class="p-2 rounded-md focus:outline-none">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-gray-500 dark:text-gray-200 text-md"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-gray-500 dark:text-gray-200 text-md"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
