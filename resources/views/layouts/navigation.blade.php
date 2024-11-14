<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-500 to-green-500 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="shrink-0 flex items-center">
                    <x-application-logo class="block h-10 w-auto fill-current text-white" />
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex sm:ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-l font-semibold text-white flex items-center space-x-2">
                        <i class="fas fa-home"></i> <span>{{ __('Home') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('anime')" :active="request()->routeIs('anime')" class="text-l font-semibold text-white flex items-center space-x-2">
                        <i class="fas fa-film"></i> <span>{{ __('Anime') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('marketdash')" :active="request()->routeIs('marketdash')" class="text-l font-semibold text-white flex items-center space-x-2">
                        <i class="fas fa-store"></i> <span>{{ __('Marketplace') }}</span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                            <i class="fas fa-user-tie mr-2"></i>{{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('marketplace.create')" :active="request()->routeIs('marketplace.create')">
                            <i class="fas fa-plus mr-2"></i>{{ __('Sell Item') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('marketplace.dashboard')" :active="request()->routeIs('marketplace.dashboard')">
                            <i class="fas fa-edit mr-2"></i>{{ __('Edit Sell Items') }}
                        </x-dropdown-link>

                        <!-- Admin Access Link (Only visible to admin) -->
                        @if(Auth::check() && Auth::user()->is_admin)
                            <x-dropdown-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                <i class="fas fa-user-shield mr-2"></i>{{ __('Admin Dashboard') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for Mobile View -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="text-white p-2 focus:outline-none">
                    <i :class="{'hidden': open, 'block': ! open }" class="fas fa-bars text-2xl"></i>
                    <i :class="{'block': open, 'hidden': ! open }" class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-lg font-semibold text-white flex items-center space-x-2">
                <i class="fas fa-home"></i><span>{{ __('Home') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('anime')" :active="request()->routeIs('anime')" class="text-lg font-semibold text-white flex items-center space-x-2">
                <i class="fas fa-film"></i><span>{{ __('Anime') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('marketdash')" :active="request()->routeIs('marketdash')" class="text-lg font-semibold text-white flex items-center space-x-2">
                <i class="fas fa-store"></i><span>{{ __('Marketplace') }}</span>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Profile & Logout -->
                <x-responsive-nav-link :href="route('profile.edit')" class="text-lg font-semibold text-white flex items-center space-x-2">
                    <i class="fas fa-user-edit"></i><span>{{ __('Profile') }}</span>
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-lg font-semibold text-white flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt"></i><span>{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
