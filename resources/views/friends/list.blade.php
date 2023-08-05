<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($friends)
            @foreach ($friends as $friend)
                <a href="{{ route('user.profile', ['id' => $friend->to_user->id]) }}"
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
            @endforeach
        @endif

    </div>
</x-app-layout>

{{-- --Scritps--
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
</script> --}}
