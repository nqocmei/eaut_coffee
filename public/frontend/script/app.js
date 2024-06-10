const showToast = (type, title, msg, options) => {
    let toastOptions = {
        title,
        message: msg,
        ...options,
    };
    switch (type) {
        case "info":
            iziToast.info(toastOptions);
            break;
        case "success":
            iziToast.success(toastOptions);
            break;
        case "warning":
            iziToast.warning(toastOptions);
            break;
        case "error":
            iziToast.error(toastOptions);
            break;
        default:
            iziToast.show(toastOptions);
    }
};
