<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-24 mx-auto w-2/3 px-2">
        {{-- <div class="overflow-hidden shadow-xl sm:rounded-2xl bg-transparent grid grid-cols-3 gap-3 border-b-4 border-red-500 p-2"> --}}
        <div class="overflow-hidden shadow-lg rounded-xl mt-2 bg-green-600 bg-opacity-20 grid grid-cols-3 gap-3 border-b-4 border-red-500 p-2" style="background-color: rgba(0, 255, 0, 0.5)">
            <x-db-card>
                <a :href="{{ route('dashboard')}}">Dashboard</a>
            </x-db-card>
            <a href="{{ route('animalclass.index') }}">
                <x-db-card>
                        Animal Type
                </x-db-card>
            </a>
            <a href="{{ route('animal.index') }}">
                <x-db-card>
                    Animals List
                </x-db-card>
            </a>
            <a href="{{ route('gender.index') }}">
                <x-db-card>
                    Genders List
                </x-db-card>
            </a>
            <a href="{{ route('healthyhistory.index') }}">
                <x-db-card>
                    Healthy History
                </x-db-card>
            </a>
            <a href="{{ route('stock.index') }}">
                <x-db-card>
                    Stock List
                </x-db-card>
            </a>
            <a href="{{ route('product.index') }}">
                <x-db-card>
                    Products List
                </x-db-card>
            </a>
            <a href="{{ route('sale.index') }}">
                <x-db-card>
                    Sales List
                </x-db-card>
            </a>
            <a href="{{ route('bincard.index') }}">
                <x-db-card>
                    Bincard
                </x-db-card>
            </a>
            <a href="{{ route('staffmember.index') }}">
                <x-db-card>
                    Staff List
                </x-db-card>
            </a>
            <a href="{{ route('unit.index') }}">
                <x-db-card>
                    Units List
                </x-db-card>
            </a>
            <a href="{{ route('vetdoctor.index') }}">
                <x-db-card>
                    Veterinary Doctors
                </x-db-card>
            </a>
        </div>
        @role('SuperAdmin')
            <div class="overflow-hidden shadow-lg rounded-xl mt-2 bg-green-600 bg-opacity-20 grid grid-cols-3 gap-3 border-b-4 border-red-500 p-2" style="background-color: rgba(0, 255, 0, 0.5)">
                <a href="{{ route('superadmin.users.index') }}">
                    <x-db-card>
                        Users List
                    </x-db-card>
                </a>
                <a href="{{ route('superadmin.roles.index') }}">
                    <x-db-card>
                        Roles List
                    </x-db-card>
                </a>
                <a href="{{ route('superadmin.permissions.index') }}">
                    <x-db-card>
                        Permissions List
                    </x-db-card>
                </a>
            </div>
        @endrole
    </div>
</x-app-layout>
