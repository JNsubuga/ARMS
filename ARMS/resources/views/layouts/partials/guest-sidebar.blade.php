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
        <x-sidebar-link href="{{ route('healthyhistory.index') }}" :active="request()->routeIs('healthyhistory.index')">
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
    </nav>
</div>