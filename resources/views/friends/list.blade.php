<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($friends)
            @foreach ($friends as $friend)
                <a href="#"
                    class="max-w-4xl mx-auto my-3 sm:px-6 lg:px-8 block hover:bg-gray-100 dark:hover:bg-gray-700 hover:shadow-sm rounded-lg profile-card-toggle-link"
                    data-user-id="{{ $friend->id }}">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="rounded-full overflow-hidden mr-2">
                                        <img src="{{ asset($friend->to_user->profile_picture) }}" alt="Profile Picture"
                                            class="h-8 w-8 object-cover">
                                    </div>
                                    <div>
                                        <span class="font-semibold">{{ $friend->to_user->name }}</span>
                                    </div>
                                </div>
                                <div class="mx-6 flex items-center">
                                    @if ($friend->to_user->status == 'online')
                                        <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="5" />
                                        </svg>
                                    @endif

                                    @if ($friend->to_user->status == 'offline')
                                        <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="5" />
                                        </svg>
                                    @endif
                                    <div class="mx-1">{{ $friend->to_user->status }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <div id="overlay"
                    class="fixed top-0 left-0 w-full h-full z-50 bg-black bg-opacity-50 backdrop-filter blur-lg hidden">
                </div>
                {{-- <a href="#" class="profile-card-hide" data-user-id="{{ $friend->user_id }}">
            <div id="profile-card-{{ $friend->user_id }}"
                class="profile-card hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 bg-white p-6 rounded-lg shadow-lg">
                @include('profile.partials.profile-card')
            </div>
        </a> --}}

                <div id="profile-card-{{ $friend->id }}"
                    class="profile-card-close hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-6 rounded-lg shadow-lg"
                    data-user-id="{{ $friend->id }}">
                    <button class="absolute top-0 right-0 m-8 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    
                    @include('profile.partials.profile-card', [
                    'name' => $friend->to_user->name,
                    'username' => $friend->to_user->username,
                    'profile_picture' => $friend->to_user->profile_picture,
                    'status' => $friend->to_user->status,
                    'email' => $friend->to_user->email,
                ])
                </div>
            @endforeach
        @endif

    </div>
</x-app-layout>

--Scritps--
<script>
    document.querySelectorAll('.profile-card-toggle-link').forEach(function(el) {
        el.addEventListener('click', function(event) {
            event.preventDefault();
            var userId = this.getAttribute('data-user-id');
            document.querySelector('#profile-card-' + userId).classList.remove('hidden');
            document.querySelector('#overlay').classList.remove('hidden');
        });
    });

    document.querySelectorAll('.profile-card-close').forEach(function(el) {
        el.addEventListener('click', function(event) {
            event.preventDefault();

            var userId = this.getAttribute('data-user-id');
            document.querySelector('#profile-card-' + userId).classList.add('hidden');
            document.querySelector('#overlay').classList.toggle('hidden');
        });
    });
</script>
