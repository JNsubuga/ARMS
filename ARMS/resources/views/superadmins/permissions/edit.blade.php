<x-superadmin-layout>
    <x-slot name="header" class="flex w-full">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Role') }}
        </h2>
        {{-- @include('layouts.partials._search') --}}
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
     <x-auth-validation-errors class="mb-4" :errors="$errors" /> 
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="flex mb-4">
            <a href="{{route('superadmin.permissions.index')}}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow">
               &larr; Permissions
            </a>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-slate-200 border-b border-gray-200">
                <form method="POST" action="{{ route('superadmin.permissions.update', $toUpdate->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- permission -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <x-label for="name" :value="__('Permission')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3">
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $toUpdate->name }}" autofocus />
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3 bg-gray-600 hover:bg-gray-500" type="reset">
                            {{ __('Cancel') }}
                        </x-button>

                        <x-button class="ml-3 bg-green-600 hover:bg-green-500" type="submit">
                            {{ __('Commit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="border border-green-500 rounded-md shadow-lg p-1 mt-2">
            <h2 class="text-2xl font-semibold underline capitalize bg-slate-200 px-20 py-1 rounded-md">
                Assign Role to this Permission
            </h2>
            <div class="mt-2 p-1">
                <h2 class="text-xl font-semibold">
                    Assigned Roles to this Permission
                </h2>
                <div class="flex">
                    @forelse ($toUpdate->roles as $permission_role)
                        <div class="text-white italic bg-red-600 px-1 py-1 mx-1 rounded-lg">
                            <form 
                            action="{{ route('superadmin.permissions.removeRole', [$toUpdate->id, $permission_role]) }}" 
                            method="post" 
                            onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ $permission_role->name }}</button>
                            </form>
                        </div>
                    @empty
                    <p class="text-red-700">No permission granted to this Role</p>
                    @endforelse
                </div>
            </div>
            <div class="max-w-xl">
                <form method="POST" action="{{ route('superadmin.permissions.assignRole', $toUpdate->id) }}">
                    @csrf
                    <!-- role -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="role" :value="__('Role')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="role" id="role" required>
                                <option value="" disabled selected hidden>--Select Role--</option>
                                @foreach ($selectRoles as $selectItem)
                                    <option value="{{$selectItem->name}}">{{$selectItem->name}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('role')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3 bg-green-600 hover:bg-green-500" type="submit">
                            {{ __('Assign Permission') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-superadmin-layout>
