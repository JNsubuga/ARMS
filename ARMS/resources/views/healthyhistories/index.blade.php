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
                    <div class="relative mb-4">
                        <a href="{{route('healthyhistory.create')}}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow absolute">
                            Register Healthy History
                        </a>
                        {{-- <a href="{{ route('healthyhistory.downloadPDF') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow absolute top-0 right-0">
                            Report
                        </a> --}}
                    </div>
                    <table class="table-auto w-full mt-10">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Date</th>
                            <th class="py-1 px-6">Animal Tag</th>
                            <th class="py-1 px-6">Vetinary Doctor</th>
                            <th class="py-1 px-6">Diagnosis</th>
                            <th class="py-1 px-6">Treatment</th>
                            <th class="py-1 px-6">Action</th>
                        </tr>
                        @forelse ($healthyhistories as $healthyhistory)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                
                                <td class="py-1 px-6">
                                    {{ date('d/m/Y', strtotime($healthyhistory->created_at)) }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ date('Ymd', strtotime($healthyhistory->animal->DoJ)).'-'.$healthyhistory->animal->id }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $healthyhistory->vetdoctor->Names }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $healthyhistory->Daignosis }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $healthyhistory->Treatment }}
                                </td>
                                <td class="flex py-1 px-6">
                                    {{-- <a href="{{route('healthyhistory.downloadPDF', $healthyhistory->id)}}" class="text-blue-600 italic pr-4">Healthy Report</a> --}}
                                    <a href="{{route('healthyhistory.edit', $healthyhistory->id)}}" class="text-blue-600 italic pr-4">Edit</a>
                                    <form action="{{route('healthyhistory.destroy', $healthyhistory->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
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
                <div class="mt-4 p-4">
                    {{ $healthyhistories->links() }}
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
                        <a href="{{ route('healthyhistory.downloadPDF') }}">Generte Report</a>
                    </div>
                    <table class="table-auto w-full mt-10">
                        <tr class="text-left border-b-2 border-gray-200 font-bold uppercase">
                            <th class="py-1 px-6">Date</th>
                            <th class="py-1 px-6">Animal Tag</th>
                            <th class="py-1 px-6">Vetinary Doctor</th>
                            <th class="py-1 px-6">Diagnosis</th>
                            <th class="py-1 px-6">Treatment</th>
                            <th class="py-1 px-6">Action</th>
                        </tr>
                        @forelse ($healthyhistories as $healthyhistory)
                            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-200">
                                <td class="py-1 px-6">
                                    {{ date('d/m/Y', strtotime($healthyhistory->created_at)) }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ date('Ymd', strtotime($healthyhistory->animal->DoJ)).'-'.$healthyhistory->animal->id }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $healthyhistory->vetdoctor->Names }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $healthyhistory->Daignosis }}
                                </td>
                                <td class="py-1 px-6">
                                    {{ $healthyhistory->Treatment }}
                                </td>
                                <td class="flex py-1 px-6">
                                    {{-- <a href="{{route('healthyhistory.downloadPDF', $healthyhistory->id)}}" class="text-blue-600 italic pr-4">Healthy Report</a> --}}
                                    @if (Auth::user())
                                        <a href="{{route('healthyhistory.edit', $healthyhistory->id)}}" class="text-blue-600 italic pr-4">Edit</a>
                                        <form action="{{route('healthyhistory.destroy', $healthyhistory->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-700 italic">Delete</button>
                                        </form>
                                    @endif
                                    
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
