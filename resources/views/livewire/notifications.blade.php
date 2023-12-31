<div>
    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
        class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
        type="button">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
            <path
                d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
        </svg>
        <div class="relative flex">
            <div id="notification-counter"
                class="absolute -top-2 -right-1/3 h-3 w-3 rounded-full bg-red-600 flex justify-center items-center items text-white dark:border-gray-900">
                <span class="text-xs">{{ count($notifications) }}</span>
            </div>
        </div>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdownNotification"
        class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-inherit dark:bg-gray-800 dark:divide-gray-700"
        aria-labelledby="dropdownNotificationButton">
        <div
            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
            Notifications
        </div>
        <div id="NotificationContainer" class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse ($notifications as $notification)
                <a href="#" wire:click="markAsRead('{{ $notification->id }}')"
                    class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex-shrink-0">
                        {{-- <img class="rounded-full w-11 h-11" src="/docs/images/people/profile-picture-2.jpg"
                        alt="Joseph image"> --}}
                        <div class="rounded-full w-11 h-11">
                            <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full pl-3">
                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">{{ $notification->title }}
                            "{{ $notification->body }}"</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">{{ $notification->time_ago }}</div>
                    </div>
                </a>
            @empty
                <span id="noNotificationsMessage" class="block px-4 py-2">No new notifications.</span>
            @endforelse
        </div>
        <a href="{{route('notification.list')}}"
            class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
            <div class="inline-flex items-center ">
                <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                    <path
                        d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                </svg>
                View all
            </div>
        </a>
    </div>
</div>
