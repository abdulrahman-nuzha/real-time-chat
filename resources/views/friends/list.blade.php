<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($friends)
            @foreach ($friends as $friend)
                <div class="max-w-4xl mx-auto my-3 sm:px-6 lg:px-8 rounded-lg shadow-xl">
                    <div class="bg-white dark:bg-gray-800 ove rflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center">
                                <a href="{{ route('user.profile', ['id' => $friend->id]) }}">
                                    <div class="flex items-center">
                                        <div class="rounded-full overflow-hidden mr-2">
                                            <img src="{{ asset($friend->profile_picture) }}" alt="Profile Picture"
                                                class="h-8 w-8 object-cover">
                                        </div>
                                        <div>
                                            <span class="font-semibold">{{ $friend->name }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="mx-6 flex items-center">
                                    @if ($friend->status == 'online')
                                        <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="5" />
                                        </svg>
                                    @elseif ($friend->status == 'offline')
                                        <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="5" />
                                        </svg>
                                    @endif
                                    <div class="mx-1">{{ $friend->status }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $friends->links() }}
        @endif

    </div>
</x-app-layout>