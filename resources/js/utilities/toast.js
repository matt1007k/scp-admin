export class Toast {
  static info(message) {
    Toastify({
      text: message,
      duration: 5000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
      style: {
        background: "#38bdf8",
        padding: '10px 20px',
        minWidth: '200px',
      }
    }).showToast();
  }
  static success(message) {
    Toastify({
      text: message,
      duration: 5000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
      style: {
        background: "#86efac",
        padding: '10px 20px',
        minWidth: '200px',
      }
    }).showToast();
  }
  static error(message) {
    Toastify({
      text: message,
      duration: 5000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
      style: {
        background: "#f87171",
        padding: '10px 20px',
        minWidth: '200px',
      }
    }).showToast();
  }
  static warning(message) {
    Toastify({
      text: message,
      duration: 5000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
      style: {
        background: "#facc15",
        padding: '10px 20px',
        minWidth: '200px',
      }
    }).showToast();
  }
}
