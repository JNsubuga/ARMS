<div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-full bg-green-700">
    <div class="flex justify-between h-16">
        <div class="flex">
            <div class="shrink-0 flex items-center">
                <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('animalclass.index')" :active="request()->routeIs('animalclass.index')">
                    {{ __('Animal Type') }}
                </x-nav-link>
                <x-nav-link :href="route('animal.index')" :active="request()->routeIs('animal.index')">
                    {{ __('Animals List') }}
                </x-nav-link>
                @role('SuperAdmin')
                    <x-nav-link :href="route('gender.index')" :active="request()->routeIs('gender.index')">
                        {{ __('Gender') }}
                    </x-nav-link>
                @endrole
                <x-nav-link :href="route('healthyhistory.index')" :active="request()->routeIs('healthyhistory.index')">
                    {{ __('Healthy History') }}
                </x-nav-link>
                <x-nav-link :href="route('stock.index')" :active="request()->routeIs('stock.index')">
                    {{ __('Stock') }}
                </x-nav-link>
                <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                    {{ __('Product List') }}
                </x-nav-link>
                <x-nav-link :href="route('sale.index')" :active="request()->routeIs('sale.index')">
                    {{ __('Sales List') }}
                </x-nav-link>
                <x-nav-link :href="route('bincard.index')" :active="request()->routeIs('bincard.index')">
                    {{ __('Bincard') }}
                </x-nav-link>
                <x-nav-link :href="route('staffmember.index')" :active="request()->routeIs('staffmember.index')">
                    {{ __('Staff') }}
                </x-nav-link>
                @role('SuperAdmin')
                    <x-nav-link :href="route('unit.index')" :active="request()->routeIs('unit.index')">
                        {{ __('Units') }}
                    </x-nav-link>
                @endrole
                <x-nav-link :href="route('vetdoctor.index')" :active="request()->routeIs('vetdoctor.index')">
                    {{ __('Vetenary Doctors') }}
                </x-nav-link>
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="bg-white bg-opacity-60 text-red-600 px-2 rounded">
                        {{ __('Log in') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
</div>