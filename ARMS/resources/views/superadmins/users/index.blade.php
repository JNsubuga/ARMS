<x-superadmin-layout>
    <x-slot name="header" class="flex w-full">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
        {{-- @include('layouts.partials._search') --}}
    </x-slot>
    <div class="py-4 w-full px-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="table-auto w-full mt-2">
                    <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                        <th class="py-1 px-6">Name</th>
                        <th class="py-1 px-6">E-mail</th>
                        <th class="py-1 px-6">Action</th>
                    </tr>
                    @forelse ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                            <td class="py-1 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-black">
                                <a href="{{ route('superadmin.users.roles', $user->id) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="py-1 px-6">
                                {{ $user->email }}
                            </td>
                            <td class="flex py-1 px-6">
                                <a href="{{route('superadmin.users.roles', $user->id)}}" class="text-blue-600 italic pr-4">Roles & Permissions</a>
                                <form action="{{route('superadmin.users.destroy', $user->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 italic">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"><p class="text-red-700">No record in the Database</p></td> 
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-superadmin-layout>