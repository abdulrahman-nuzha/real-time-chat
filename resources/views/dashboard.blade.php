<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($rooms)
            @foreach ($rooms as $room)
                {{-- <a href="{{ route('profile.edit') }}"class="max-w-4xl mx-auto my-3 sm:px-6 lg:px-8 block hover:bg-gray-100 dark:hover:bg-gray-700 hover:shadow-sm rounded-lg"> --}}
                <div class="max-w-4xl mx-auto my-3 sm:px-6 lg:px-8 rounded-lg shadow-xl">
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center">
                                <a href="{{ route('profile.edit') }}">
                                    <div class="flex items-center">
                                        <div class="relative mr-4">
                                            <div class="rounded-full overflow-hidden">
                                                <img src="{{ asset(Auth::user()->profile_picture) }}"
                                                    alt="Profile Picture" class="h-8 w-8 object-cover"
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
                                            <span class="font-semibold">{{ $room->name }}</span>
                                        </div>
                                    </div>
                                </a>

                                {{-- <div class="mx-6 flex items-center">
                                    @if ($room->status == 'online')
                                        <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="5" />
                                        </svg>
                                    @endif

                                    @if ($room->status == 'offline')
                                        <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="5" />
                                        </svg>
                                    @endif
                                    <div class="mx-1">{{ $room->status }}</div>
                                </div> --}}
                                <div class="mx-6 flex items-center">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button id="dropdownMenuIconHorizontalButton"
                                                data-dropdown-toggle="dropdownDotsHorizontal"
                                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-1 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 16 3">
                                                    <path
                                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                </svg>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('user.profile', ['id' => Auth::user()->id])" style="color: red;">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>

                                            <!-- delete confirmation then ajax request to delete the chat-->
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </a> --}}
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
