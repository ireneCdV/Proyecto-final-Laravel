<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('imagenes/logo.jpg') }}" class="block h-9 w-auto" alt="Logo de la tienda">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-between items-center w-full">
                    <div class="space-x-8 items-center">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Inicio') }}
                        </x-nav-link>

                        {{-- Productos --}}
                        <x-nav-link :href="route('products.list')" :active="request()->routeIs('products.list')">
                            {{ __('Productos') }}
                        </x-nav-link>

                        {{-- Facturas --}}
                        <x-nav-link :href="route('facturas')" :active="request()->routeIs('facturas')">
                            {{ __('Facturas') }}
                        </x-nav-link>

                        {{-- Citas --}}
                        <x-nav-link :href="route('citas.index')" :active="request()->routeIs('citas.index')">
                            {{ __('Citas') }}
                        </x-nav-link>

                        {{-- Contacto --}}
                        <x-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')">
                            {{ __('Contacto') }}
                        </x-nav-link>


                    </div>

                    <a href="{{ route('cart.list') }}" class="flex items-center space-x-1">
                        <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
                            <circle cx="13.5" cy="29.5" r="2.5" fill="currentColor"
                                class="clr-i-solid clr-i-solid-path-1" />
                            <circle cx="26.5" cy="29.5" r="2.5" fill="currentColor"
                                class="clr-i-solid clr-i-solid-path-2" />
                            <path fill="currentColor"
                                d="M33.1 6.39a1 1 0 0 0-.79-.39H9.21l-.45-1.43a1 1 0 0 0-.66-.65L4 2.66a1 1 0 1 0-.59 1.92L7 5.68l4.58 14.47l-1.63 1.34l-.13.13A2.66 2.66 0 0 0 9.74 25A2.75 2.75 0 0 0 12 26h16.69a1 1 0 0 0 0-2H11.84a.67.67 0 0 1-.56-1l2.41-2h15.43a1 1 0 0 0 1-.76l3.2-13a1 1 0 0 0-.22-.85Z"
                                class="clr-i-solid clr-i-solid-path-3" />
                            <path fill="none" d="M0 0h36v36H0z" />
                        </svg>
                        <span class="text-gray-700">{{ Cart::getTotalQuantity()}}</span>
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>

            {{-- Productos --}}
            <x-responsive-nav-link :href="route('products.list')" :active="request()->routeIs('products.list')">
                {{ __('Productos') }}
            </x-responsive-nav-link>

            {{-- Facturas --}}
            <x-responsive-nav-link :href="route('facturas')" :active="request()->routeIs('facturas')">
                {{ __('Facturas') }}
            </x-responsive-nav-link>

            {{-- Citas --}}
            <x-responsive-nav-link :href="route('citas.index')" :active="request()->routeIs('citas.index')">
                {{ __('Citas') }}
            </x-responsive-nav-link>

            {{-- Contacto --}}
            <x-responsive-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')">
                {{ __('Contacto') }}
            </x-responsive-nav-link>


            <a href="{{ route('cart.list') }}" class="flex items-center space-x-1">
                <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
                    <circle cx="13.5" cy="29.5" r="2.5" fill="currentColor"
                        class="clr-i-solid clr-i-solid-path-1" />
                    <circle cx="26.5" cy="29.5" r="2.5" fill="currentColor"
                        class="clr-i-solid clr-i-solid-path-2" />
                    <path fill="currentColor"
                        d="M33.1 6.39a1 1 0 0 0-.79-.39H9.21l-.45-1.43a1 1 0 0 0-.66-.65L4 2.66a1 1 0 1 0-.59 1.92L7 5.68l4.58 14.47l-1.63 1.34l-.13.13A2.66 2.66 0 0 0 9.74 25A2.75 2.75 0 0 0 12 26h16.69a1 1 0 0 0 0-2H11.84a.67.67 0 0 1-.56-1l2.41-2h15.43a1 1 0 0 0 1-.76l3.2-13a1 1 0 0 0-.22-.85Z"
                        class="clr-i-solid clr-i-solid-path-3" />
                    <path fill="none" d="M0 0h36v36H0z" />
                </svg>
                <span class="text-gray-700">{{ Cart::getTotalQuantity()}}</span>
            </a>
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

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar sesion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>