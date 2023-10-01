<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($friends)
            @foreach ($friends as $friend)
                <div class="max-w-4xl mx-auto my-3 sm:px-6 lg:px-8 rounded-lg">
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-[rgba(0,0,15,0.2)_5px_3px_4px_0px] sm:rounded-md">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center">
                                <a href="{{ route('user.profile', ['id' => $friend->id]) }}">
                                    <div class="flex items-center">
                                        <div class="relative mr-4">
                                            <div class="rounded-full overflow-hidden">
                                                <img src="{{ asset($friend->profile_picture) }}" alt="Profile Picture"
                                                    class="h-8 w-8 object-cover"
                                                    onerror="this.onerror=null; this.src='{{ asset('storage/profile-pictures/user.png') }}';">
                                            </div>
                                            @if (Auth::user()->status == 'online')
                                                <div
                                                    class="absolute bottom-0 right-0 h-2 w-2 rounded-full bg-green-500 transform translate-x-1/4 translate-y-1/4">
                                                </div>
                                            @endif

                                            @if (Auth::user()->status == 'offline')
                                                <div
                                                    class="absolute bottom-0 right-0 h-2 w-2 rounded-full bg-red-500 transform translate-x-1/4 translate-y-1/4">
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-semibold">{{ $friend->name }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $friends->links() }}
        @endif
    </div>
</x-app-layout>
