<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if($users)
            @foreach($users as $user)
            <a href="{{ route('profile.edit') }}" class="max-w-4xl mx-auto my-3 sm:px-6 lg:px-8 block hover:bg-gray-100 dark:hover:bg-gray-700 hover:shadow-sm rounded-lg">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold">{{ $user['name'] }}</span>
                                <div class="mx-6 flex items-center">
                                    @if ($user['status'] == 'online')
                                    <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <circle cx="10" cy="10" r="5" />
                                    </svg>
                                    @endif
    
                                    @if ($user['status'] == 'offline')
                                    <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <circle cx="10" cy="10" r="5" />
                                    </svg>
                                    @endif
    
                                    <div class="mx-1">{{$user['status']}}</div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</x-app-layout>
