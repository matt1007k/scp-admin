import Toastify from "toastify-js";

const alertSuccess = document.querySelector('#success-toast')
if (alertSuccess && alertSuccess !== undefined) {
    Toastify({
        node: $("#success-toast")
            .clone()
            .removeClass("hidden")[0],
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
    }).showToast();
}

const alertDanger = document.querySelector('#danger-toast')
if (alertDanger && alertDanger !== undefined) {
    Toastify({
        node: $("#danger-toast")
            .clone()
            .removeClass("hidden")[0],
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
    }).showToast();
}

const alertWarning = document.querySelector('#warning-toast')
if (alertWarning && alertWarning !== undefined) {
    Toastify({
        node: $("#warning-toast")
            .clone()
            .removeClass("hidden")[0],
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
    }).showToast();
}

const alertInfor = document.querySelector('#info-toast')
if (alertInfor && alertInfor !== undefined) {
    Toastify({
        node: $("#info-toast")
            .clone()
            .removeClass("hidden")[0],
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
    }).showToast();
}

//livewire toasts

window.addEventListener('showNotification', event => {
    const message = event.detail.message;
    let node = null;
  
    switch (event.detail.type) {
      case 'success':
        node = $("#success-notification-livewire").clone().removeClass("hidden")[0];
        break;
      case 'info':
        node = $("#info-notification-livewire").clone().removeClass("hidden")[0];
        break;
    case 'danger':
        node = $("#danger-notification-livewire").clone().removeClass("hidden")[0];
        break;
      default:
        return;
    }

    Toastify({
      node,
      duration: 5000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
    }).showToast();
  
    const toastMessage = node.querySelector(".toastify-content__text");
    if (toastMessage) {
      toastMessage.textContent = message;
    }
  });

//livewire toasts end

(function () {
    "use strict";

    // Basic non sticky notification
    $("#basic-non-sticky-notification-toggle").on("click", function () {
        Toastify({
            node: $("#basic-non-sticky-notification-content")
                .clone()
                .removeClass("hidden")[0],
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();
    });

    // Basic sticky notification
    $("#basic-sticky-notification-toggle").on("click", function () {
        Toastify({
            node: $("#basic-non-sticky-notification-content")
                .clone()
                .removeClass("hidden")[0],
            duration: -1,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();
    });

    // Success notification
    $("#success-notification-toggle").on("click", function () {
        Toastify({
            node: $("#success-notification-content")
                .clone()
                .removeClass("hidden")[0],
            duration: -1,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();
    });

    // Notification with actions
    $("#notification-with-actions-toggle").on("click", function () {
        Toastify({
            node: $("#notification-with-actions-content")
                .clone()
                .removeClass("hidden")[0],
            duration: -1,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();
    });

    // Notification with avatar
    $("#notification-with-avatar-toggle").on("click", function () {
        // Init toastify
        let avatarNotification = Toastify({
            node: $("#notification-with-avatar-content")
                .clone()
                .removeClass("hidden")[0],
            duration: -1,
            newWindow: true,
            close: false,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();

        // Close notification event
        $(avatarNotification.toastElement)
            .find('[data-dismiss="notification"]')
            .on("click", function () {
                avatarNotification.hideToast();
            });
    });

    // Notification with split buttons
    $("#notification-with-split-buttons-toggle").on("click", function () {
        // Init toastify
        let splitButtonsNotification = Toastify({
            node: $("#notification-with-split-buttons-content")
                .clone()
                .removeClass("hidden")[0],
            duration: -1,
            newWindow: true,
            close: false,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();

        // Close notification event
        $(splitButtonsNotification.toastElement)
            .find('[data-dismiss="notification"]')
            .on("click", function () {
                splitButtonsNotification.hideToast();
            });
    });

    // Notification with buttons below
    $("#notification-with-buttons-below-toggle").on("click", function () {
        // Init toastify
        Toastify({
            node: $("#notification-with-buttons-below-content")
                .clone()
                .removeClass("hidden")[0],
            duration: -1,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
        }).showToast();
    });
})();
