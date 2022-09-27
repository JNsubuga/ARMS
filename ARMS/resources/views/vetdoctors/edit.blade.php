<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Staff') }}
        </h2>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('vetdoctor.update', $toUpdate->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Names -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Names" :value="__('Names')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="Names" class="block mt-1 w-full" type="text" name="Names" value="{{ $toUpdate->Names }}" autofocus />
                            @error('Names')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- speciality -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="speciality" :value="__('Speciality')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="speciality" class="block mt-1 w-full" type="text" name="speciality" value="{{ $toUpdate->speciality }}" />
                            @error('speciality')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- section -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="job_status" :value="__('Job Status')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="job_status" id="job_status">
                                <option value="{{ $toUpdate->job_status }}" disabled selected hidden>--Select--</option>
                                    <option value="1">Permanent</option>
                                    <option value="2">Out Sourced</option>
                            </x-selectinput>
                            @error('job_status')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Address -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Address" :value="__('Contact')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="Address" class="block mt-1 w-full" type="text" name="Address" value="{{ $toUpdate->Address }}" />
                            @error('Address')
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