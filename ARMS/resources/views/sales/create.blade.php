<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Sales Transaction') }}
        </h2>
    </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('sale.store') }}">
                    @csrf
                    <!-- product_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="product_id" :value="__('Product')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="product_id" id="product_id">
                                <option value="" disabled selected hidden>--Select--</option>
                                @foreach ($selectProducts as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->Name}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('product_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Quantity -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Quantity" :value="__('Quantity')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 flex">
                            <div class="md:w-1/2 mr-1">
                                <x-input id="Quantity" class="block mt-1 w-full" type="text" name="Quantity" :value="old('Quantity')" />
                                @error('Quantity')
                                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                            </div>
                            
                            <div class="md:w-1/2 mt-1">
                                <x-selectinput name="unit_id" id="unit_id">
                                    <option value="" disabled selected hidden>--Select--</option>
                                    @foreach ($selectUnits as $selectItem)
                                        <option value="{{$selectItem->id}}">{{$selectItem->Abbriviation}}</option>
                                    @endforeach
                                </x-selectinput>
                                @error('unit_id')
                                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                            </div>
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
    </div>
</x-app-layout>