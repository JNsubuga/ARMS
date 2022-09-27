<x-app-layout>
    <x-slot name="header" class="flex w-full">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff List') }}
        </h2>
        @include('layouts.partials._search')
    </x-slot>

    <div class="py-4">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route('staffmember.create')}}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow">
                        Register Staff
                    </a>
                    <table class="table-auto w-full mt-4">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Staff</th>
                            <th class="py-1 px-6">Section</th>
                            <th class="py-1 px-6">Action</th>
                        </tr>
                        @forelse ($toDetail->animalclass as $animalclasses)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                <td class="py-1 px-6">
                                    {{ $animalclasses->className }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $animalclasses->section }}
                                </td>
                                <td class="flex py-1 px-6">
                                    <a href="{{route('animalclass.edit', $animalclasses->id)}}" class="text-blue-600 italic pr-4">Edit</a>
                                    <form action="{{route('animalclass.destroy', $animalclasses->id)}}" method="post">
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
    </div>
</x-app-layout>