<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatty') }}
        </h2>
    </x-slot>

    <div class="flex h-[calc(100vh-138px)] text-gray-800 shadow-md dark:shadow-gray-100 shadow-gray-600">
        <div class="flex flex-row w-full overflow-x-hidden">
            <!--Active Conversations Section-->
            <div class="flex flex-col pl-6 pr-2 w-64 bg-white dark:bg-gray-800 flex-shrink-0">
                <div class="flex flex-col mt-8">
                    <div class="flex flex-row items-center justify-between text-xs">
                        <span class="font-bold text-lg text-gray-900 dark:text-gray-100">Active Conversations</span>
                        {{-- <span class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full">4</span> --}}
                    </div>
                    <div class="flex flex-col space-y-1 mt-4 mx-2">
                        <button
                            class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl p-2">
                            <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">
                                H
                            </div>
                            <div class="ml-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Henry Boyd</div>
                        </button>
                        <button
                            class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl p-2">
                            <div class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full">
                                M
                            </div>
                            <div class="ml-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Marta Curtis</div>
                            <div
                                class="flex items-center justify-center ml-auto text-xs text-white bg-red-500 h-4 w-4 rounded leading-none">
                                2
                            </div>
                        </button>
                        <button
                            class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl p-2">
                            <div class="flex items-center justify-center h-8 w-8 bg-orange-200 rounded-full">
                                P
                            </div>
                            <div class="ml-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Philip Tucker</div>
                        </button>
                        <button
                            class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl p-2">
                            <div class="flex items-center justify-center h-8 w-8 bg-pink-200 rounded-full">
                                C
                            </div>
                            <div class="ml-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Christine Reid
                            </div>
                        </button>
                        <button
                            class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl p-2">
                            <div class="flex items-center justify-center h-8 w-8 bg-purple-200 rounded-full">
                                J
                            </div>
                            <div class="ml-2 text-sm font-semibold text-gray-900 dark:text-gray-100 ">Jerry Guzman</div>
                        </button>
                    </div>
                </div>
            </div>

            <!--Chat Section-->
            <div class="flex flex-col flex-auto h-full">
                <div
                    class="flex flex-col flex-auto flex-shrink-0 bg-gray-100 dark:bg-gray-700 h-full p-4  shadow-inner dark:shadow-gray-800 shadow-gray-200">
                    <!--Messages Section-->
                    <div class="flex flex-col h-full overflow-y-auto mb-4">
                        <div class="flex justify-end flex-col h-full">
                            <div class="grid grid-cols-12 gap-y-2 overflow-y-auto" id="message-container">
                                @if ($data)
                                    <!-- Loading spinner -->
                                    <!--Need Imporvments !! -->
                                    <div id="loading-spinner"
                                        class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 pb-2"
                                        style="display: none;">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                            <path
                                                d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                                opacity=".25" />
                                            <circle cx="12" cy="2.5" r="1.5">
                                                <animateTransform attributeName="transform" type="rotate"
                                                    dur="1s" values="0 12 12;360 12 12"
                                                    repeatCount="indefinite" />
                                            </circle>
                                        </svg>
                                    </div>
                                    <div id="no-messages" class="flex justify-between absolute left-1/2"
                                        style="display: none;">
                                        <div class="font-medium text-sm dark:text-gray-100 text-gray-700">
                                            No More Messages
                                        </div>
                                        <div>
                                            <hr class="h-px my-1 dark:bg-gray-200 border-0 bg-gray-700">
                                        </div>
                                    </div>

                                    @foreach ($data->messages->reverse() as $message)
                                        @if ($message->sender_id == auth()->user()->id)
                                            <!--Sender Section-->
                                            <div class="col-start-6 col-end-13 p-2 rounded-lg">
                                                <div class="flex items-center justify-start flex-row-reverse">
                                                    <!--Profile Picture-->
                                                    <a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
                                                        <div
                                                            class="flex items-center justify-center h-10 w-10 rounded-full overflow-hidden bg-indigo-500 flex-shrink-0">
                                                            <img src="{{ asset(auth()->user()->profile_picture) }}"
                                                                alt="Profile Picture" class="h-10 w-10 object-cover"
                                                                onerror="this.onerror=null; this.src='{{ asset('storage/profile-pictures/user.png') }}';">
                                                        </div>
                                                    </a>
                                                    <!--Message-->
                                                    <div
                                                        class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                        <div class="text-gray-900">
                                                            {{ $message->message }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <!--Receiver Section-->
                                            <div class="col-start-1 col-end-8 p-2 rounded-lg">
                                                <div class="flex flex-row items-center">
                                                    <!--Profile Picture-->
                                                    <a href="{{ route('user.profile', ['id' => $data->user->id]) }}">
                                                        <div
                                                            class="flex items-center justify-center h-10 w-10 rounded-full overflow-hidden bg-indigo-500 flex-shrink-0">
                                                            <img src="{{ asset($data->user->profile_picture) }}"
                                                                alt="Profile Picture" class="h-10 w-10 object-cover"
                                                                onerror="this.onerror=null; this.src='{{ asset('storage/profile-pictures/user.png') }}';">
                                                        </div>
                                                    </a>
                                                    <!--Message-->
                                                    <div
                                                        class="relative ml-3 text-sm bg-white dark:bg-gray-800 py-2 px-4 shadow rounded-xl">
                                                        <div class="text-gray-900 dark:text-gray-100">
                                                            {{ $message->message }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Input Section -->
                    <div class="flex flex-row items-center h-16 rounded-xl bg-white dark:bg-gray-800 w-full px-4">
                        {{-- <div>
                            <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                    </path>
                                </svg>
                            </button>
                        </div> --}}
                        <div class="flex-grow ml-4">
                            <div class="relative w-full">
                                <input type="text" id="message-input"
                                    class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />
                                {{-- <button
                                    class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </button> --}}
                            </div>
                        </div>
                        <div class="ml-4">
                            <button id="send-button"
                                class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                                <span>Send</span>
                                <span class="ml-2">
                                    <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    var scrollableElement = document.getElementById('message-container');
    // Set the scrollTop to the maximum value
    scrollableElement.scrollTop = scrollableElement.scrollHeight;

    let currentPage = 1;
    let isLoading = false; // Flag to prevent multiple simultaneous requests
    let lastPage = @json($data->messages->lastPage());
    var url = @json(route('room.show', ['room_id' => $data->messages[0]->room_id]));
    const messageContainer = document.getElementById('message-container');

    messageContainer.addEventListener('scroll', () => {
        if (
            messageContainer.scrollTop === 0 && // User has scrolled to the top
            !isLoading // No ongoing requests
        ) {
            console.log("INSIDE");
            // Increment the current page and set the loading flag
            currentPage++;
            isLoading = true;

            //Make request if current page is smaller than last page 
            if (lastPage >= currentPage) {
                // Make an AJAX request to load more messages
                // Send the `currentPage` as a parameter to your backend route
                $.ajax({
                    url: url + `?page=${currentPage}`,
                    type: 'GET',
                    beforeSend: function() {
                        console.log("HEY")
                        document.getElementById('loading-spinner').style.display = 'block';
                    },
                    success: function(data) {
                        document.getElementById('loading-spinner').style.display = 'none';
                        // Append the new messages to the container
                        insertMessage(data.data.messages.data)

                        isLoading = false; // Reset the loading flag
                        lastPage = data.data.messages.last_page; // Get the page numbers
                    },
                    error: function(error) {
                        console.error("An error: ", error);
                    }
                });
            } else {
                console.log("No More messages")
                document.getElementById('no-messages').style.display = 'block';
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');

        // Add an event listener to the send button
        sendButton.addEventListener('click', () => {
            const message = messageInput.value;
            if (message.trim() !== '') {
                // Send the message using an AJAX request to your Laravel backend
                sendMessage(message);
                // Clear the input field after sending
                messageInput.value = '';
            }
        });
    });


    function insertMessage(messages) {
        messages.forEach(message => {
            //Sender
            if (message.sender_id == userId) {
                const senderMessageHtml = `
                        <div class="col-start-6 col-end-13 p-2 rounded-lg">
                            <div class="flex items-center justify-start flex-row-reverse">
                            <!--Profile Picture-->
                                <a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
                                <div
                                class="flex items-center justify-centers h-10 w-10 rounded-full overflow-hidden bg-indigo-500 flex-shrink-0">
                                <img src="{{ asset(auth()->user()->profile_picture) }}"
                                alt="Profile Picture" class="h-10 w-10 object-cover"
                                onerror="this.onerror=null; this.src='{{ asset('storage/profile-pictures/user.png') }}';">
                                </div>
                                </a>
                                <!--Message-->
                                    <div
                                    class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                    <div class="text-gray-900">
                                        '${message.message}'
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                messageContainer.insertAdjacentHTML('afterbegin', senderMessageHtml)
            }

            //Receiver
            else {
                const receiverMessageHtml = `
                <!--Receiver Section-->
                <div class="col-start-1 col-end-8 p-2 rounded-lg">
                    <div class="flex flex-row items-center">
                        <!--Profile Picture-->
                        <a href="{{ route('user.profile', ['id' => $data->user->id]) }}">
                            <div
                                class="flex items-center justify-center h-10 w-10 rounded-full overflow-hidden bg-indigo-500 flex-shrink-0">
                                <img src="{{ asset($data->user->profile_picture) }}"
                                    alt="Profile Picture" class="h-10 w-10 object-cover"
                                    onerror="this.onerror=null; this.src='{{ asset('storage/profile-pictures/user.png') }}';">
                            </div>
                        </a>
                        <!--Message-->
                        <div
                            class="relative ml-3 text-sm bg-white dark:bg-gray-800 py-2 px-4 shadow rounded-xl">
                            <div class="text-gray-900 dark:text-gray-100">
                                '${message.message}'
                            </div>
                        </div>
                    </div>
                </div>
                `;
                messageContainer.insertAdjacentHTML('afterbegin', receiverMessageHtml)
            }
        });
    }
    // Function to send a message to the server
    function sendMessage() {
        url = 'url for sending a message';
        // Make an AJAX request to your Laravel backend
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                user_id: userId,
                _token: '{{ csrf_token() }}'
                message: message
            },
            success: function(response) {
                console.log("success");
                //should be inserted for the sender and reciver
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseText;
                // $('.error-container').text('Error: ' +
                //     errorMessage); // Display the error
                //console.log(errorMessage);
            }
        });
    }

    function receiveMessage() {
        ;
    }
</script>
