@if (Auth::user())
    <x-app-layout>
        <x-slot name="header" class="flex w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales List') }}
            </h2>
            @include('layouts.partials._search')
        </x-slot>

        <div class="py-4 w-full px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- <div class="relative mb-4"> --}}
                    <div class="relative mb-4">
                        <a href="{{route('sale.create')}}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-1 px-4 border border-gray-400 rounded-lg shadow absolute">
                            Register Sales Transaction
                        </a>
                        <a href="{{ route('sale.downloadPDF') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-1 px-4 border border-gray-400 rounded-lg shadow absolute top-0 right-0">
                            Report
                        </a>
                    </div>
                    <table class="table-auto w-full mt-10">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Date</th>
                            <th class="py-1 px-6">Product</th>
                            <th class="py-1 px-6">Quantity</th>
                            <th class="py-1 px-6">Price</th>
                            <th class="py-1 px-6">Amount</th>
                            <th class="py-1 px-6">Action</th>
                        </tr>
                        @forelse ($sales as $sale)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                
                                <td class="py-1 px-6">
                                    {{ date('d/m/Y', strtotime($sale->created_at)) }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $sale->product->Name }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $sale->Quantity }} {{ $sale->unit->Abbriviation }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ number_format($sale->product->unitPrice, 2, ".", ",")."/=" }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ number_format($sale->Quantity * $sale->product->unitPrice, 2, ".", ",").'/=' }}
                                </td>
                                <td class="flex py-1 px-6">
                                    {{-- <a href="{{route('sale.downloadPDF', $sale->id)}}" class="text-blue-600 italic pr-4">PDF</a> --}}
                                    <a href="{{route('sale.edit', $sale->id)}}" class="text-blue-600 italic pr-4">Edit</a>
                                    <form action="{{route('sale.destroy', $sale->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
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
                {{ __('Sales List') }}
            </h2>
            @include('layouts.partials._search')
        </x-slot>

        <div class="py-4 w-full px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative mb-4">
                        {{-- <a href="{{ route('sale.downloadPDF', $sales) }}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow absolute top-0 right-0"> --}}
                        <a href="{{ route('sale.downloadPDF') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow absolute top-0 right-0">
                            Report
                        </a>
                    </div>
                    <table class="table-auto w-full mt-10">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Date</th>
                            <th class="py-1 px-6">Product</th>
                            <th class="py-1 px-6">Quantity</th>
                            <th class="py-1 px-6">Price</th>
                            <th class="py-1 px-6">Amount</th>
                            <th class="py-1 px-6">Action</th>
                        </tr>
                        @forelse ($sales as $sale)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                <td class="py-1 px-6">
                                    {{ date('d/m/Y', strtotime($sale->created_at)) }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $sale->product->Name }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $sale->Quantity }} {{ $sale->unit->Abbriviation }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ number_format($sale->product->unitPrice, 2, ".", ",").'/=' }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ number_format($sale->Quantity * $sale->product->unitPrice, 2, ".", ",").'/=' }} 
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
