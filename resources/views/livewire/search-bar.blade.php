<div class="relative flex justify-center items-center mx-auto mt-8 md:w-1/2 lg:w-1/3">
    <!-- Increased mt-8 for more space -->
    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
        <!-- Increased pl-4 for more space -->
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
    </div>
    <input type="text"
        class="form-input block w-full p-4 pl-12 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Search..." wire:model.debounce.500ms="query" />
    @empty($query)

    @else
        @if (!empty($users))
            <div class="absolute top-16 w-full">
                <div
                    class="relative text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 shadow-md">
                    <ul class="py-1">
                        @foreach ($users as $user)
                            <li class="px-4 py-3 hover:bg-gray-300 dark:hover:bg-gray-500 cursor-pointer"
                                wire:click="navigateToUserProfile({{ $user->id }})">
                                {{ $user->name }}
                            </li>
                        @endforeach
                    </ul>
                    {{ $users->links() }}
                </div>
            </div>
        @elseif(empty($users))
            <div class="absolute top-16 w-full">
                <div
                    class="relative px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 shadow-md">
                    No results found.
                </div>
            </div>
        @endif
    @endempty
</div>
