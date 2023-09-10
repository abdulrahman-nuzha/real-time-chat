<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="py-6">
        @if ($notifications)
            @foreach ($notifications as $notification)
                <div class="max-w-4xl mx-auto my-2 sm:px-6 lg:px-8 rounded-lg shadow-xl">
                    <div
                        class="overflow-hidden shadow-sm sm:rounded-lg
                        @if (!$notification->isRead) bg-gray-100 dark:bg-gray-700 
                        @else bg-white dark:bg-gray-800 @endif
                    ">
                        <div class="p-6 text-gray-900 dark:text-gray-100 ">
                            <div class="flex justify-between items-center">
                                <button @if ($notification->isRead) disabled @endif class="w-full markAsRead"
                                    data-notification-id="{{ $notification->id }}">
                                    <div class="flex items-start">
                                        <div class="rounded-full overflow-hidden mr-2">
                                            <img src="{{ asset($notification->user->profile_picture) }}"
                                                alt="Profile Picture" class="h-8 w-8 object-cover">
                                        </div>
                                        <div>
                                            <span class="flex items-start ml-2 font-semibold text-base">{{ $notification->title }}</span>
                                            <p class="text-sm">{{ $notification->body }}</p>
                                        </div>
                                        <div class="ml-auto text-xs text-blue-600 dark:text-blue-500">
                                            {{ $notification->time_ago }}
                                        </div>
                                    </div>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex items-center justify-center my-3">
                {{ $notifications->links() }}
            </div>
        @endif

    </div>
</x-app-layout>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //Accept Friend Request Ajax
    $(document).ready(function() {
        $('.markAsRead').on('click', function() {
            var id = $(this).data('notification-id');

            var url = "{{ route('notification.markAsRead') }}"

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    notification_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    console.log("success");
                    $('.error-container').empty();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    var errorMessage = xhr.responseText;
                    $('.error-container').text('Error: ' +
                        errorMessage); // Display the error
                    console.log(errorMessage);
                }
            });
        });
    });
</script>
