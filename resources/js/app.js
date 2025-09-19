import "./bootstrap";
import Alpine from "alpinejs";
import csp from "@alpinejs/csp";
import "./custom.js";

// Charger le plugin AVANT Alpine.start()
// Alpine.plugin(csp);

window.Alpine = Alpine;
Alpine.start();
