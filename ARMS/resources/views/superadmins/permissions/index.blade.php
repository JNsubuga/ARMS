<x-superadmin-layout>
    <x-slot name="header" class="flex w-full">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
        {{-- @include('layouts.partials._search') --}}
    </x-slot>
    <div class="py-4 w-full px-2">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-2 border-b border-gray-200">
                <div class="flex justify-end">
                    <a href="{{route('superadmin.permissions.create')}}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow">
                        Add New Permission
                    </a>
                </div>
                
                <table class="table-auto w-full mt-2">
                    <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                        <th class="py-1 px-6">Name </th>
                        <th class="py-1 px-6">Action</th>
                    </tr>
                    @forelse ($permissions as $permission)
                        <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                            <td class="py-1 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-black">
                                {{-- <a href="{{ route('permission.show', $permission->id) }}">
                                    
                                </a> --}}
                                {{ $permission->name }}
                            </td>
                            <td class="flex py-1 px-6">
                                {{-- Actions to do --}}
                                <a href="{{route('superadmin.permissions.edit', $permission->id)}}" class="text-blue-600 italic pr-4">Edit</a>
                                <form action="{{route('superadmin.permissions.destroy', $permission->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
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
