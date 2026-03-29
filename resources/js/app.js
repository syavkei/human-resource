import "./bootstrap";

import Alpine from "alpinejs";
import jQuery from "jquery";
import JSZip from "jszip";

// Expose jQuery globally for DataTables
window.jQuery = jQuery;
window.$ = jQuery;
window.JSZip = JSZip;

import "laravel-datatables-vite";
import "datatables.net-buttons-bs5";
import "datatables.net-buttons/js/buttons.html5.mjs";
import "datatables.net-buttons/js/buttons.print.mjs";

window.Alpine = Alpine;

Alpine.start();
