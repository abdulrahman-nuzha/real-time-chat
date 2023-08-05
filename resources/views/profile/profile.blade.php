<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center">
        <div
            class="p-8 w-3/4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 rounded-lg shadow-2xl mt-20">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                    <div>
                        <p class="font-bold text-gray-900 dark:text-gray-100 text-xl">22</p>
                        <p class="text-gray-400">Friends</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-gray-100 text-xl">10</p>
                        <p class="text-gray-400">Photos</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-gray-100 text-xl">89</p>
                        <p class="text-gray-400">Comments</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative">
                        <div
                            class="w-32 h-32 md:w-44 md:h-44 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-12 md:-mt-24">
                            <img src="{{ asset($user->profile_picture) }}" alt="Profile Image"
                                class="h-32 w-32 md:h-44 md:w-44 object-cover rounded-full"
                                onerror="this.onerror=null; this.src='{{ asset('storage/profile-pictures/user.png') }}';">
                        </div>
                    </div>

                </div>

                @if ($isOwnProfile)
                    <!-- Display additional information for logged-in user's own profile -->
                    <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                        <a href="{{ route('profile.edit') }}">
                            <x-primary-button>
                                {{ __('Edit Profile') }}
                            </x-primary-button>
                        </a>
                    </div>
                @else
                    <!-- Display different information for viewing another user's profile -->
                    <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                        <x-primary-button>{{ __('Send request') }}</x-primary-button>

                        <x-primary-button>{{ __('Message') }}</x-primary-button>
                    </div>
                @endif

            </div>

            <div class="mt-20 text-center border-b pb-12">
                <h1 class="text-4xl font-medium text-gray-800 dark:text-gray-200">{{ $user->name }}</h1>
                <p class="font-light text-gray-800 dark:text-gray-200">{{ '@' . $user->username }}</p>

                <p class="mt-8 text-gray-800 dark:text-gray-200">{{ $user->email }}</p>
                <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $user->status }}</p>
            </div>
        </div>
    </div>


</x-app-layout>
