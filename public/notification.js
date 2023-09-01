Pusher.logToConsole = true;
window.addEventListener("DOMContentLoaded", function () {
    // Echo.connector.pusher.connection.bind("connected", () => {
    //     console.log("Connected to Pusher");
    // });

    try {
        console.log(userId);
        const channelName = `notification.${userId}`;

        Echo.private(channelName)
            .listen(".NewNotification", (notification) => {
                //Adding New notification to the notification bell
                NewNotification(notification);
                //Add New Toast alert
                NewToast(notification);
            })
            .error((error) => {
                console.log(error);
            });
    } catch (error) {
        console.log(error);
    }
});

function NewNotification(notification) {
    var container = document.getElementById("NotificationContainer");

    const noNotificationsMessage = document.getElementById(
        "noNotificationsMessage"
    );

    const newNotificationHtml = `
            <a href="#" wire:click="markAsRead('${notification.id}')" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                <div class="flex-shrink-0">
                    <div class="rounded-full w-11 h-11">
                        <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
                        </svg>
                    </div>
                </div>
                <div class="w-full pl-3">
                    <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">${notification.title}
                        "${notification.body}"</div>
                    <div class="text-xs text-blue-600 dark:text-blue-500">${notification.time_ago}</div>
                </div>
            </a>
        `;

    //adding new notification to the notification bell
    container.insertAdjacentHTML("afterbegin", newNotificationHtml);

    // Make the "No new notifications" message hidden if it is visible
    if (noNotificationsMessage) {
        noNotificationsMessage.classList.add("hidden");
    }
}

function NewToast(notification) {
    var toast = document.getElementById("toastNotification");
    //Adding New Toast
    const newToasHtml = `
    <div id="alert-border-1" class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800"
    role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
    </svg>

    <div class="ml-3 text-sm font-medium">
        "${notification.body}"
    </div>
    <button type="button"
        class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
        data-dismiss-target="#alert-border-1" aria-label="Close">
        <span class="sr-only">Dismiss</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
    </div>
    `;

    //inert new toast
    toast.insertAdjacentHTML("afterbegin", newToasHtml);
    //increase the number of notifications
    receiveNewNotification();
    //dissmiss the toast on click
    document.addEventListener("click", function (event) {
        // Check if the clicked element has the data-dismiss-target attribute
        const dismissTarget = event.target.getAttribute("data-dismiss-target");

        // If it does, dismiss the corresponding alert
        if (dismissTarget) {
            const alertElement = document.querySelector(dismissTarget);
            if (alertElement) {
                alertElement.style.display = "none";
            }
        }
    });
}

function receiveNewNotification() {
    // Increment the notification counter
    const notificationCounter = document.getElementById("notification-counter");
    const currentCount = parseInt(notificationCounter.innerText, 10);
    console.log(currentCount);
    notificationCounter.innerText = currentCount + 1;
}
