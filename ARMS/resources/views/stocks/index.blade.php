
@if (Auth::user())
    <x-app-layout>
        <x-slot name="header" class="w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight absolute left-0">
                {{ __('Stock List') }}
            </h2>
            @include('layouts.partials._search')
        </x-slot>

        <div class="py-4 w-full px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route('stock.create')}}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow">
                        Register Stock
                    </a>
                    <table class="table-auto w-full mt-4">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Product</th>
                            <th class="py-1 px-6">Quantity</th>
                            <th class="py-1 px-6">Action</th>
                        </tr>
                        @forelse ($stocks as $stock)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                <td class="py-1 px-6 underline font-extrabold text-xl">
                                    {{-- <a href="{{ route('stock.show', $stock->id) }}"> --}}
                                        {{ $stock->product->Name }}
                                    {{-- </a> --}}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $stock->Quantity }} {{ $stock->unit->Abbriviation }}
                                </td>
                                <td class="flex py-1 px-6">
                                    <a href="{{route('stock.edit', $stock->id)}}" class="text-blue-600 italic pr-4">Edit</a>
                                    <form action="{{route('stock.destroy', $stock->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
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
    </x-app-layout>
@else
    <x-guest-layout>
        <x-slot name="header" class="flex w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Stock List') }}
            </h2>
            @include('layouts.partials._search')
        </x-slot>

        <div class="py-4 w-full px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full mt-4">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Product</th>
                            <th class="py-1 px-6">Quantity</th>
                        </tr>
                        @forelse ($stocks as $stock)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                
                                <td class="py-1 px-6">
                                    {{ $stock->product->Name }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $stock->Quantity }} {{ $stock->unit->Abbriviation }}
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
    </x-guest-layout>
@endif