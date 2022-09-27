@if (session()->has('success'))
    <div 
        x-data="{ show:true }" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"
        class="fixed top-16 transform rounded-lg shadow-lg right-0 text-xl italic text-white border border-lime-600 font-bold px-1 py-2"
        style="background-color: rgba(0, 255, 0, 0.4)">
        <h1 class="border-b dark:bg-gray-100 dark:border-gray-200 capitalize">
            success
        </h1>
        {{ session('success') }}
    </div>
@elseif(session()->has('error'))
    <div 
        x-data="{ show:true }" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"
        class="fixed top-16 transform rounded-lg shadow-lg right-0 text-xl italic text-white border border-red-600 font-bold px-1 py-2" 
        style="background-color: rgba(255, 0, 0, 0.4)">
        <h1 class="border-b dark:bg-gray-100 dark:border-gray-200 capitalize">
           error
        </h1>
        {{ session('error') }}
    </div>
@endif