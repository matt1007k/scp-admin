// Load plugins
import axios from "axios";
import * as Popper from "@popperjs/core";
import dom from "@left4code/tw-starter/dist/js/dom";

// Set plugins globally
window.axios = axios;
window.Popper = Popper;
window.$ = dom;

import Toastify from "toastify-js";
window.Toastify = Toastify;



// CSRF token
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}
