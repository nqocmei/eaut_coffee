let page = 1;
let hasMoreData = true;

const countUnreadNotifications = async (path) => {
    const resp = await fetch(path, {
        method: "GET",
        headers: {
            Authorization: `Bearer ${api_token}`,
        },
    });
    if (resp.status === 200) {
        const total = await resp.json();
        const badge = document.getElementById("total-unread-notification");
        if (total <= 0) {
            badge.style.display = "none";
        } else if (total > 9) {
            badge.textContent = "9+";
        } else {
            badge.textContent = total;
        }
    } else {
        showToast("error", "Thông báo", "Có lỗi xảy ra vui lòng thử lại!");
    }
};

const getListNotification = async (path) => {
    if (!hasMoreData) return;
    const resp = await fetch(`${path}?page=${page}`, {
        method: "GET",
        headers: {
            Authorization: `Bearer ${api_token}`,
        },
    });
    if (resp.status === 200) {
        const notificationJson = await resp.json();
        if (notificationJson.data.length === 0) {
            appendNotifications(notificationJson.data);
            hasMoreData = false;
        } else {
            appendNotifications(notificationJson.data);
            page++;
        }
    } else {
        showToast("error", "Thông báo", "Có lỗi xảy ra vui lòng thử lại!");
    }
};

const appendNotifications = (notifications, type = false) => {
    const ul = document.getElementById("notifications-list");
    notifications = Array.isArray(notifications)
        ? notifications
        : [notifications];
    if (notifications.length > 0) {
        notifications.forEach((notification) => {
            const isRead = notification.read === 1;
            const existingNotification = ul.querySelector(
                `#notification-${notification.id}`
            );

            if (existingNotification) {
                existingNotification.remove();
            }

            const notificationHTML = `
                <a data-id="${
                    notification.id
                }" class="text-reset text-decoration-none d-flex justify-content-start align-items-center notification-items mb-1 ${
                !isRead ? "read-notification" : ""
            }" id="notification-${notification.id}">
                    <img src="${
                        notification.image_path
                    }" alt="" class="img-fluid notification-image object-fit-cover" />
                    <div class="d-flex flex-column align-items-start ms-2">
                        <p class="m-0 content-wrap">${notification.content}</p>
                        <p class="mt-1 neutral-300" style="font-size: 12px">
                            ${new Date(notification.created_at).toLocaleString(
                                "vi-VN",
                                { timeZone: "Asia/Ho_Chi_Minh" }
                            )}
                        </p>
                    </div>
                </a>
            `;

            if (type) {
                ul.insertAdjacentHTML("afterbegin", notificationHTML);
            } else {
                ul.insertAdjacentHTML("beforeend", notificationHTML);
            }

            const notificationElement = ul.querySelector(
                `#notification-${notification.id}`
            );
            notificationElement.addEventListener("click", function (event) {
                event.preventDefault();
                readNotification(notification.id, notification.link, isRead);
            });
        });
    } else {
        ul.innerHTML = `
        <p class="text-center neutral-300 mt-2">Không có thông báo nào!</p>
        `;
    }
};

const readNotification = async (id, link, isRead) => {
    if (isRead) {
        window.location.href = link;
    } else {
        const resp = await fetch(apiNotificationReadUrl, {
            method: "POST",
            headers: {
                Authorization: `Bearer ${api_token}`,
            },
            body: JSON.stringify({ read: 1, id: id }),
        });
        if (resp.status === 200) {
            const notificationElement = document.getElementById(
                `notification-${id}`
            );
            notificationElement.classList.remove("read-notification");
            window.location.href = link;
        }
        countUnreadNotifications();
    }
};
