document.addEventListener("DOMContentLoaded", function () {
    function fetchNotifications() {
        // Check if notification elements exist
        let countBadge = document.getElementById("notification-count");
        let notificationDropdown = document.getElementById("notification-dropdown");

        if (!countBadge || !notificationDropdown) return;

        fetch("customer_fetch_notification_count.php")
            .then(response => response.json())
            .then(data => {
                if (data.count > 0) {
                    countBadge.style.display = "block";
                    countBadge.textContent = data.count;
                } else {
                    countBadge.style.display = "none";
                }
            });

        fetch("customer_fetch_notifications.php")
            .then(response => response.json())
            .then(data => {
                notificationDropdown.innerHTML = "";

                if (data.length > 0) {
                    data.forEach(notification => {
                        let listItem = document.createElement("li");
                        listItem.innerHTML = `
                            <a class="dropdown-item" href="${notification.link}">
                                <strong>Order #${notification.orderID} - ${notification.status}</strong><br>
                                Event Date: ${notification.eventDate}
                            </a>
                        `;
                        notificationDropdown.appendChild(listItem);
                    });
                } else {
                    notificationDropdown.innerHTML = '<li class="dropdown-item">No new notifications</li>';
                }
            });
    }

    setInterval(fetchNotifications, 5000); // Fetch every 5 seconds
    fetchNotifications();
});
