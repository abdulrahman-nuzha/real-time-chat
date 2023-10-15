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
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                                    <button
                                        class="inline-block mr-2 text-green-500 shadow-lg sm:rounded-xl accept-friendship-request"
                                        title="Accept Friend Request" data-user-id="{{ $friend->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 25 25">
                                            <path
                                                d="M25 12.5a12.5 12.5 0 1 1-25 0 12.5 12.5 0 0 1 25 0zm-6.203-4.734a1.172 1.172 0 0 0-1.688.034l-5.426 6.914-3.27-3.272a1.172 1.172 0 0 0-1.656 1.656l4.134 4.136a1.172 1.172 0 0 0 1.686-.031l6.237-7.797a1.172 1.172 0 0 0-.016-1.641z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="inline-block mr-2 text-red-500 shadow-lg sm:rounded-xl reject-friendship-request"
                                        title="Reject Friend Request" data-user-id="{{ $friend->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 25 25">
                                            <path
                                                d="M25 12.5A12.5 12.5 0 1 1 0 12.5a12.5 12.5 0 0 1 25 0zM8.366 7.259a0.781 0.781 0 1 0 -1.106 1.106L11.395 12.5l-4.136 4.134a0.781 0.781 0 0 0 1.106 1.106L12.5 13.605l4.134 4.136a0.781 0.781 0 0 0 1.106 -1.106L13.605 12.5l4.136 -4.134a0.781 0.781 0 0 0 -1.106 -1.106L12.5 11.395 8.366 7.259z" />
                                        </svg>
                                    </a>
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

<script>
    //Accept Friend Request Ajax
    $(document).ready(function() {
        $('.accept-friendship-request').on('click', function() {
            var userId = $(this).data('user-id');
            var url = "{{ route('friend.accept') }}";
            
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    user_id: userId,
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
        //Reject Friend Request Ajax
        $('.reject-friendship-request').on('click', function() {
            var userId = $(this).data('user-id');
            var url = "{{ route('friend.reject') }}";
            
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    user_id: userId,
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
