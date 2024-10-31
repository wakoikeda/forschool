<nav x-data="{ open: false }" class="bg-primary-subtle border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
            


                <!-- Navigation Links -->
                <div class="float-end">
                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')" class="btn btn-secondary">
                        {{ __('TOPPAGE') }}
                    </x-nav-link>
                    <x-nav-link :href="route('groups.index')" :active="request()->routeIs('groups.index')" class="btn btn-secondary">
                        {{ __('GROUP') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Authentication Links -->
            @guest
                <div class="hidden space-x-4 sm:flex">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-white">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-white">
                        {{ __('Register') }}
                    </x-nav-link>
                </div>
            @else
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            
                                <div>{{ Auth::user()->name }}</div>
                                
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-900">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-gray-900" 
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endguest
        </div>
    </div>
</nav>
