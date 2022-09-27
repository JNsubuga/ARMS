@if(Auth::user())
    <x-app-layout>
        <x-slot name="header" class="flex w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Stock List') }}
            </h2>
            @include('layouts.partials._search')
        </x-slot>
        <div class="py-4 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-2">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative mb-8">
                        <a href="{{ route('bincard.downloadPDF') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-1 px-4 border border-gray-400 rounded-lg shadow absolute top-0 right-0">
                            Report
                        </a>
                    </div>
                    <table class="table-auto w-full mt-4">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Date</th>
                            <th class="py-1 px-6">Product</th>
                            <th class="py-1 px-6 text-right">Quantity Recieved</th>
                            <th class="py-1 px-6 text-right">Quantity Sold</th>
                            <th class="py-1 px-6 text-right">Quantity in Stock</th>
                            {{-- <th class="py-1 px-6">Action</th> --}}
                        </tr>
                        @forelse ($bincards as $bincard)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                <td class="py-1 px-6">
                                    {{ date('d/m/Y', strtotime($bincard->created_at)) }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $bincard->product->Name }}
                                </td>
                                <td class="py-1 px-6 text-right">
                                    {{ number_format($bincard->receivedQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                                </td>
                                <td class="py-1 px-6 text-right">
                                    {{ number_format($bincard->soldQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                                </td>
                                <td class="py-1 px-6 text-right">
                                    {{ number_format($bincard->stockQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                                </td>
                                {{-- <td class="flex py-1 px-6">
                                    <a href="{{route('bincard.edit', $bincard->id)}}" class="text-blue-600 italic pr-4">Edit</a> 
                                    <form action="{{route('bincard.destroy', $bincard->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-700 italic">Delete</button>
                                    </form>
                                </td>--}}
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
        <div class="py-4 w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-2">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="relative mb-8">
                            <a href="{{ route('bincard.downloadPDF') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-1 px-4 border border-gray-400 rounded-lg shadow absolute top-0 right-0">
                                Report
                            </a>
                        </div>
                        <table class="table-auto w-full mt-4">
                            <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                                <th class="py-1 px-6">Date</th>
                                <th class="py-1 px-6">Product</th>
                                <th class="py-1 px-6">Quantity Recieved</th>
                                <th class="py-1 px-6">Quantity Sold</th>
                                <th class="py-1 px-6">Quantity in Stock</th>
                                {{-- <th class="py-1 px-6">Action</th> --}}
                            </tr>
                            @forelse ($bincards as $bincard)
                                <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                    <td class="py-1 px-6">
                                        {{ date('d/m/Y', strtotime($bincard->created_at)) }}
                                    </td>
                                    <td class="py-1 px-6">
                                        {{ $bincard->product->Name }}
                                    </td>
                                    <td class="py-1 px-6">
                                        {{ number_format($bincard->receivedQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                                    </td>
                                    <td class="py-1 px-6">
                                        {{ number_format($bincard->soldQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                                    </td>
                                    <td class="py-1 px-6">
                                        {{ number_format($bincard->stockQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                                    </td>
                                    {{-- <td class="flex py-1 px-6">
                                        <a href="{{route('bincard.edit', $bincard->id)}}" class="text-blue-600 italic pr-4">Edit</a> 
                                        <form action="{{route('bincard.destroy', $bincard->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-700 italic">Delete</button>
                                        </form>
                                    </td>--}}
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
