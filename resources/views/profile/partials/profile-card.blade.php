{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<section
    class="w-80 mx-auto bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 rounded-2xl px-10 py-8">
    {{-- <div class="flex items-center justify-between">
            <span class="text-emerald-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
              </svg>
            </span>
        </div> --}}
    <div class="mt-6 w-fit mx-auto">
        <img src="{{ asset($profile_picture) }}" class="rounded-full w-28 " alt="profile picture" srcset="">
    </div>

    <div class="mt-8 text-gray-900 dark:text-gray-100">
        <h2 class="font-bold text-2xl tracking-wide">{{ $name }}</h2>
    </div>

    <div class="mt-2 text-gray-900 dark:text-gray-100">
        <h2 class="font-bold text-2xl tracking-wide">{{ $username }}</h2>
    </div>

    <div class="mt-2 text-gray-900 dark:text-gray-100">
        <h2 class="font-bold tracking-wide">{{ $email }}</h2>
    </div>

    <div class="mt-2 flex">
        <div>
            @if ($status == 'online')
                <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="5" />
                </svg>
            @endif

            @if ($status == 'offline')
                <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="5" />
                </svg>
            @endif
        </div>
        <div class="text-gray-900 dark:text-gray-100 font-bold tracking-wide">
            {{ $status }}
        </div>
    </div>


</section>
