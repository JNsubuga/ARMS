<x-superadmin-layout>
    <x-slot name="header" class="flex w-full">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grant Permission and Assign Role to User') }}
        </h2>
        {{-- @include('layouts.partials._search') --}}
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="relative rounded-lg border py-12  bg-slate-200 shadow-lg align-middle">
            <a href="{{route('superadmin.users.index')}}" class="top-4 m-2 align-middle absolute left-0 bg-blue-600 hover:bg-blue-500 text-white font-semibold py-1 px-4 border border-gray-400 rounded-lg shadow">
                &larr; Users List
            </a>
            <div class="absolute right-0 top-0 mt-5 mr-2">
                <div class="font-extrabold text-green-700">{{ $toDetail->name }}</div>
                <div>{{ $toDetail->email }}</div>
            </div>
        </div>

        {{-- Roles --}}
        <div class="border border-green-500 rounded-md shadow-lg p-1 mt-2">
            <h2 class="text-2xl font-semibold underline capitalize bg-slate-200 px-4 py-1 rounded-md">
                Roles
            </h2>
            <div class="mt-2 p-1">
                <h2 class="text-xl font-semibold">
                    Assigned Roles
                </h2>
                <div class="flex">
                    @forelse ($toDetail->roles as $user_role)
                        <div class="text-white italic bg-red-600 px-2 py-1 mx-1 rounded-md">
                            <form 
                            action="{{ route('superadmin.users.removeRole', [$toDetail->id, $user_role->id]) }}" 
                            method="post" 
                            onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ $user_role->name }}</button>
                            </form>
                        </div>
                    @empty
                    <p class="text-red-700">No Role Assigned to this User</p>
                    @endforelse
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('superadmin.users.assignRole', $toDetail->id) }}">
                        @csrf
                        {{-- @method('PUT') --}}
                        <!-- user -->
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <x-label for="role" :value="__('Role')" class="mr-4 mt-4 text-lg"/>
                            </div>
                            <div class="md:w-2/3">
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
                            <x-button class="ml-3 bg-green-600 hover:bg-green-500" type="submit">
                                {{ __('assign role') }}
                            </x-button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Permissions --}}
        <div class="border border-green-500 rounded-md shadow-lg p-1 mt-2">
            <h2 class="text-2xl font-semibold underline capitalize bg-slate-200 px-4 py-1 rounded-md">
                Permissions
            </h2>
            <div class="mt-2 p-1">
                <h2 class="text-xl font-semibold">
                    Granted Permissions
                </h2>
                <div class="flex">
                    @forelse ($toDetail->permissions as $user_permission)
                        <div class="text-white italic bg-red-600 px-2 py-1 mx-1 rounded-lg">
                            <form 
                            action="{{ route('superadmin.users.revokePermission', [$toDetail->id, $user_permission->id]) }}" 
                            method="post" 
                            onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ $user_permission->name }}</button>
                            </form>
                        </div>
                    @empty
                    <p class="text-red-700">No permission granted to this User</p>
                    @endforelse
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('superadmin.users.grantPermission', $toDetail->id) }}">
                        @csrf
                        {{-- @method('PUT') --}}
                        <!-- user -->
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <x-label for="permission" :value="__('Permission')" class="mr-4 mt-4 text-lg"/>
                            </div>
                            <div class="md:w-2/3">
                                <x-selectinput name="permission" id="permission" required>
                                    <option value="" disabled selected hidden>--Select Permission--</option>
                                    @foreach ($selectPermissions as $selectItem)
                                        <option value="{{$selectItem->name}}">{{$selectItem->name}}</option>
                                    @endforeach
                                </x-selectinput>
                                @error('permission')
                                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                            <x-button class="ml-3 bg-green-600 hover:bg-green-500" type="submit">
                                {{ __('grant permission') }}
                            </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-superadmin-layout>
