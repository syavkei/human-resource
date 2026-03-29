import "./bootstrap";

import Alpine from "alpinejs";
import jQuery from "jquery";

// Expose jQuery globally for DataTables
window.jQuery = jQuery;
window.$ = jQuery;

import "laravel-datatables-vite";

window.Alpine = Alpine;

Alpine.start();
