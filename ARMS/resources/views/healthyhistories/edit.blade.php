<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Animal') }}
        </h2>
    </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('healthyhistory.update', $toUpdate->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- animal_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="animal_id" :value="__('Animal Tag')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="animal_id" id="animal_id">
                                <option value="{{ $defaultAnimal->id }}" disabled selected hidden>{{date('Ymd', strtotime($defaultAnimal->DoJ)).'-'.$defaultAnimal->id}}</option>
                                @foreach ($selectAnimals as $selectItem)
                                    <option value="{{$selectItem->id}}">{{date('Ymd', strtotime($selectItem->DoJ)).'-'.$selectItem->id}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('animal_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- vetdoctor_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="vetdoctor_id" :value="__('Vetinary Doctor')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="vetdoctor_id" id="vetdoctor_id">
                                <option value="{{ $defaultVetdoctor->id }}" disabled selected hidden>{{$defaultVetdoctor->Names}}</option>
                                @foreach ($selectVetdoctors as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->Names}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('vetdoctor_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Diagnosis -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Daignosis" :value="__('Diagnosis')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="Daignosis" class="block mt-1 w-full" type="text" name="Daignosis" value="{{ $toUpdate->Daignosis }}" />
                            @error('Daignosis')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Treatment -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Treatment" :value="__('Treatment')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="Treatment" class="block mt-1 w-full" type="text" name="Treatment" value="{{ $toUpdate->Treatment }}" />
                            @error('Treatment')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Recommendation -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Recommendation" :value="__('Recommedation')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-textareaInput name="Recommendation" id="Recommendation" cols="30" rows="10">
                                {{ $toUpdate->Recommendation }}
                            </x-textareaInput >
                            @error('Recommendation')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- DoR -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="DoR" :value="__('Date of Review')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="DoR" class="block mt-1 w-full" type="date" name="DoR" value="{{ $toUpdate->DoR }}" />
                            @error('DoR')
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
