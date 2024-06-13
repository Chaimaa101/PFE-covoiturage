function fetchNotifications() {
    fetch('get_notifications.php')
        .then(response => response.json())
        .then(notifications => {
            const notificationContainer = document.getElementById('notification-container');
            notificationContainer.innerHTML = ''; // Clear existing notifications

            if (notifications.length > 0) {
                notifications.forEach(notification => {
                    const notificationElement = document.createElement('div');
                    notificationElement.className = 'alert alert-info';
                    notificationElement.innerText = notification.message;
                    notificationContainer.appendChild(notificationElement);
                });

                // Mark notifications as read
                fetch('mark_notifications_read.php', { method: 'POST' });
            }
        });
}

// Fetch notifications every 30 seconds
setInterval(fetchNotifications, 30000);

// Initial fetch
fetchNotifications();
