import "./bootstrap";
import Alpine from "alpinejs";
import csp from "@alpinejs/csp";

// Activer CSP
Alpine.plugin(csp);

// Importer ton custom.js
import "./custom.js";

window.Alpine = Alpine;
Alpine.start();

