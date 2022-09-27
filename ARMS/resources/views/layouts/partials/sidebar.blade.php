<div 
    @click.away="open = false" 
    class="flex flex-col flex-shrink-0 w-full rounded-xl text-gray-700 md:w-64 dark-mode:text-gray-200 dark-mode:bg-gray-800" 
    x-data="{ open: false }"
    style="background-color: rgba(0, 255, 0, 0.2)">
    {{-- <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
        <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Flowtrail UI</a>
        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div> --}}
    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
        <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            Dashboard
        </x-sidebar-link>
        <x-sidebar-link href="{{ route('animalclass.index') }}" :active="request()->routeIs('animalclass.index')">
            Animal Type
        </x-sidebar-link>
        <x-sidebar-link href="{{ route('animal.index') }}" :active="request()->routeIs('animal.index')">
            Animal
        </x-sidebar-link>
        @role('SuperAdmin')
            <x-sidebar-link href="{{ route('gender.index') }}" :active="request()->routeIs('gender.index')">
                Genders
            </x-sidebar-link>
        @endrole
        <x-sidebar-link href="{{ route('healthyhistory.index') }}" :active="request()->routeIs('healhtyhistory.index')">
            Healthy History
        </x-sidebar-link>
        <x-sidebar-link href="{{ route('stock.index') }}" :active="request()->routeIs('stock.index')">
            Stock
        </x-sidebar-link>
        <x-sidebar-link href="{{ route('product.index') }}" :active="request()->routeIs('product.index')">
            Product List
        </x-sidebar-link>
        <x-sidebar-link href="{{ route('sale.index') }}" :active="request()->routeIs('sale.index')">
            Sales List
        </x-sidebar-link>
        <x-sidebar-link :href="route('staffmember.index')" :active="request()->routeIs('staffmember.index')">
            {{ __('Staff') }}
        </x-sidebar-link>
        @role('SuperAdmin')
            <x-sidebar-link href="{{ route('unit.index') }}" :active="request()->routeIs('unit.index')">
                Units
            </x-sidebar-link>
        @endrole
        <x-sidebar-link href="{{ route('vetdoctor.index') }}" :active="request()->routeIs('vetdoctor.index')">
            Vetinary Doctor
        </x-sidebar-link>

        <x-sidebar-link href="{{ route('bincard.index') }}" :active="request()->routeIs('bincard.index')">
            Bincard
        </x-sidebar-link>
        @role('SuperAdmin')
            <x-sidebar-link href="{{ route('superadmin.users.index') }}">
                Users
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('superadmin.roles.index') }}">
                Roles
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('superadmin.permissions.index') }}">
                Permissions
            </x-sidebar-link>
        @endrole
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <span>{{ Auth::user()->name }}</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-700">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>