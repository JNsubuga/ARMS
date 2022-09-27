<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit '.date('Ymd', strtotime($toUpdate->DoJ)).'-'.$toUpdate->id.' Record') }}
        </h2>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('animal.update', $toUpdate->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- animalclass_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="animalclass_id" :value="__('Animal Type')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="animalclass_id" id="animalclass_id">
                                <option value="{{ $defaultAnimalclass[0]->id }}" disabled selected hidden>{{ $defaultAnimalclass[0]->className }}</option>
                                @foreach ($selectAnimalclasses as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->className}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('animalclass_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- staffmember_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="staffmember_id" :value="__('Staff InCharge')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="staffmember_id" id="staffmember_id">
                                <option value="{{ $defaultStaffmember[0]->id }}" disabled selected hidden>{{ $defaultStaffmember[0]->Names }}</option>
                                @foreach ($selectStaffmembers as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->Names}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('staffmember_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- maleParent -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="maleParent" :value="__('Father')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="maleParent" class="block mt-1 w-full" type="text" name="maleParent" value="{{ $toUpdate->maleParent }}" />
                            @error('maleParent')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- femaleParent -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="femaleParent" :value="__('Mother')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="femaleParent" class="block mt-1 w-full" type="text" name="femaleParent" value="{{ $toUpdate->femaleParent }}" />
                            @error('femaleParent')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- gender_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="gender_id" :value="__('Gender')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="gender_id" id="gender_id">
                                <option value="{{ $defaultGender[0]->id }}" disabled selected hidden>{{$defaultGender[0]->Gender}}</option>
                                @foreach ($selectGenders as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->Gender}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('gender_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- breed -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="breed" :value="__('Breed')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="breed" class="block mt-1 w-full" type="text" name="breed" value="{{ $toUpdate->breed }}" />
                            @error('breed')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- DoJ -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="DoJ" :value="__('Date of Joining')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="DoJ" class="block mt-1 w-full" type="date" name="DoJ" value="{{ $toUpdate->DoJ }}" />
                            @error('DoJ')
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
    </div>
</x-app-layout>