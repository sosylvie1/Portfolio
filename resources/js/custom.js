/**
 * ✅ custom.js
 * Tous les scripts inline déplacés pour respecter la CSP PlanetHoster
 */

// ----------------------------
// 🌍 Variables globales depuis <meta>
// ----------------------------
const baseUrl = document.querySelector("meta[name=base-url]")?.content || "";
const aproposUrl =
    document.querySelector("meta[name=apropos-url]")?.content || "";
const cvUrl = document.querySelector("meta[name=cv-url]")?.content || "";
const contactUrl =
    document.querySelector("meta[name=contact-url]")?.content || "";
const voyagesUrl =
    document.querySelector("meta[name=voyages-url]")?.content || "";
const projetsUrl =
    document.querySelector("meta[name=projets-url]")?.content || "";
const planUrl = document.querySelector("meta[name=plan-url]")?.content || "";

// ----------------------------
// 🚫 Protection des images
// ----------------------------
document.addEventListener("contextmenu", function (e) {
    if (e.target.classList.contains("protected-image")) {
        e.preventDefault();
        alert("🚫 Copie interdite !");
    }
});

// ----------------------------
// 🖼️ Gallery (Lightbox / Zoom)
// ----------------------------
window.gallery = function (images) {
    return {
        images,
        index: 0,
        zoom: false,
        isPanning: false,
        startX: 0,
        startY: 0,
        offsetX: 0,
        offsetY: 0,

        next() {
            this.index = (this.index + 1) % this.images.length;
            this.resetZoom();
        },
        prev() {
            this.index =
                (this.index - 1 + this.images.length) % this.images.length;
            this.resetZoom();
        },
        go(i) {
            this.index = i;
            this.resetZoom();
        },
        close(dlg) {
            dlg?.close();
            this.resetZoom();
        },
        resetZoom() {
            this.zoom = false;
            this.offsetX = 0;
            this.offsetY = 0;
        },
    };
};

// ----------------------------
// 📄 JSON-LD SEO (Accueil)
// ----------------------------
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("home-page")) {
        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "WebPage",
                name: "Accueil - Portfolio de Sylvie Seguinaud",
                description:
                    "Bienvenue sur le portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mes compétences et mon parcours international.",
                url: baseUrl,
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: baseUrl,
                },
                about: {
                    "@type": "Person",
                    name: "Sylvie Seguinaud",
                    jobTitle: "Développeuse Web & Web Mobile",
                    url: aproposUrl,
                    sameAs: [
                        "https://www.linkedin.com/in/sylvie-seguinaud",
                        "https://github.com/sosylvie1",
                    ],
                },
            },
            null,
            2
        );
        document.head.appendChild(ldJsonScript);
    }
});

// ----------------------------
// 🍪 Synchro Cookie Consent
// ----------------------------
(async () => {
    try {
        const meta = document.querySelector("meta[name=csrf-token]");
        const csrf = meta ? meta.content : null;

        const cookieConsent = document.cookie
            .split("; ")
            .find((row) => row.startsWith("cookie_consent="));

        if (cookieConsent) {
            const status = cookieConsent.split("=")[1];
            const userMeta = document.querySelector("meta[name=user-auth]");
            if (userMeta && csrf) {
                await fetch("/cookie-consent", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        Accept: "application/json",
                    },
                    body: JSON.stringify({ status }),
                    credentials: "same-origin",
                });
            }
        }
    } catch (e) {
        console.warn("Cookie consent sync failed", e);
    }
})();

// 🌍 JSON-LD SEO (Voyages)
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("voyages-page")) {
        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "CollectionPage",
                name: "Voyages - Portfolio de Sylvie Seguinaud",
                description:
                    "Découvrez une sélection de mes voyages à travers le monde en images : Dubaï, Vietnam, Mexique, Liban, et bien plus.",
                url: voyagesUrl,
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: baseUrl,
                },
            },
            null,
            2
        );
        document.head.appendChild(ldJsonScript);
    }
});

// 🗺️ JSON-LD SEO (Voyage individuel)
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("voyage-show-page")) {
        const voyageTitle = document.querySelector("h1")?.innerText || "Voyage";
        const voyageDescription =
            document.querySelector("p.text-gray-600")?.innerText || "";
        const mainImage =
            document.querySelector("img")?.getAttribute("src") || "";

        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "TouristDestination",
                name: voyageTitle,
                description: voyageDescription,
                image: mainImage,
                url: window.location.href,
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: baseUrl,
                },
            },
            null,
            2
        );
        document.head.appendChild(ldJsonScript);
    }
});

// 📑 JSON-LD SEO (Page Projets)
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("projects-page")) {
        const projects = [
            ...document.querySelectorAll("#projectsGrid [data-date]"),
        ].map((el, index) => {
            const title =
                el.querySelector("h3, h2, h1")?.innerText ||
                `Projet ${index + 1}`;
            const description =
                el.querySelector("p")?.innerText ||
                "Projet issu du portfolio de Sylvie Seguinaud";
            const image =
                el.querySelector("img")?.getAttribute("src") ||
                "/images/placeholder.webp";
            const date = el.getAttribute("data-date") || null;

            return {
                "@type": "CreativeWork",
                position: index + 1,
                name: title,
                description: description,
                image: image,
                dateCreated: date,
                inLanguage: "fr",
            };
        });

        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "CollectionPage",
                name: "Mes Projets - Portfolio de Sylvie Seguinaud",
                description:
                    "Découvrez une sélection de projets réalisés par Sylvie Seguinaud pendant sa formation en développement web.",
                url: projetsUrl,
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: baseUrl,
                },
                mainEntity: {
                    "@type": "ItemList",
                    itemListElement: projects,
                },
            },
            null,
            2
        );

        document.head.appendChild(ldJsonScript);
    }
});

// 👤 JSON-LD SEO pour la page "À propos"
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("a-propos-page")) {
        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "AboutPage",
                name: "À propos - Portfolio de Sylvie Seguinaud",
                description:
                    "Découvrez le parcours professionnel et personnel de Sylvie Seguinaud, développeuse web reconvertie, passionnée de numérique et de voyages.",
                url: aproposUrl,
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: baseUrl,
                },
                mainEntity: {
                    "@type": "Person",
                    name: "Sylvie Seguinaud",
                    jobTitle: "Développeuse Web & Web Mobile",
                    url: aproposUrl,
                    sameAs: [
                        "https://www.linkedin.com/in/sylvie-seguinaud",
                        "https://github.com/sosylvie1",
                    ],
                },
            },
            null,
            2
        );
        document.head.appendChild(ldJsonScript);
    }
});

// 📄 JSON-LD CV
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("cv-page")) {
        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "Person",
                name: "Sylvie Seguinaud",
                jobTitle: "Développeuse Web & Web Mobile",
                description:
                    "CV complet de Sylvie Seguinaud : parcours professionnel, expériences internationales, compétences et formations.",
                url: cvUrl,
                image: baseUrl + "/images/sylviecv.webp",
                address: {
                    "@type": "PostalAddress",
                    addressLocality: "Le Cannet",
                    addressCountry: "France",
                },
                email: "mailto:sosylvie1@gmail.com",
                sameAs: [
                    "https://www.linkedin.com/in/sylvie-seguinaud",
                    "https://github.com/sosylvie1",
                ],
            },
            null,
            2
        );
        document.head.appendChild(ldJsonScript);
    }
});

// 📩 JSON-LD pour la page Contact
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("contact-page")) {
        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "ContactPage",
                name: "Contact - Portfolio de Sylvie Seguinaud",
                description:
                    "Page de contact pour joindre Sylvie Seguinaud, développeuse web. Envoyez un message ou retrouvez mes coordonnées.",
                url: contactUrl,
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: baseUrl,
                },
                mainEntityOfPage: contactUrl,
                about: {
                    "@type": "Person",
                    name: "Sylvie Seguinaud",
                    jobTitle: "Développeuse Web & Web Mobile",
                    sameAs: [
                        "https://www.linkedin.com/in/sylvie-seguinaud",
                        "https://github.com/sosylvie1",
                    ],
                },
            },
            null,
            2
        );
        document.head.appendChild(ldJsonScript);
    }
});

// 📑 JSON-LD pour la page "Plan du site"
document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("plan-du-site-page")) {
        const ldJsonScript = document.createElement("script");
        ldJsonScript.type = "application/ld+json";
        ldJsonScript.textContent = JSON.stringify(
            {
                "@context": "https://schema.org",
                "@type": "WebPage",
                name: "Plan du site - Portfolio de Sylvie Seguinaud",
                description:
                    "Plan du site portfolio de Sylvie Seguinaud pour naviguer facilement entre les pages principales.",
                url: planUrl,
                inLanguage: "fr",
                mainEntity: {
                    "@type": "SiteNavigationElement",
                    name: "Navigation principale",
                    hasPart: [
                        { "@type": "WebPage", name: "Accueil", url: baseUrl },
                        {
                            "@type": "WebPage",
                            name: "À propos",
                            url: aproposUrl,
                        },
                        {
                            "@type": "WebPage",
                            name: "Projets",
                            url: projetsUrl,
                        },
                        { "@type": "WebPage", name: "CV", url: cvUrl },
                        {
                            "@type": "WebPage",
                            name: "Contact",
                            url: contactUrl,
                        },
                        {
                            "@type": "WebPage",
                            name: "Politique de confidentialité",
                            url: baseUrl + "/confidentialite",
                        },
                        {
                            "@type": "WebPage",
                            name: "Conditions générales d’utilisation",
                            url: baseUrl + "/cgu",
                        },
                        {
                            "@type": "WebPage",
                            name: "Plan du site",
                            url: planUrl,
                        },
                    ],
                },
            },
            null,
            2
        );
        document.head.appendChild(ldJsonScript);
    }
});
// ----------------------------
// 🍪 Gestion ouverture/fermeture du bandeau cookies
// ----------------------------
document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.getElementById("open-cookie-modal");
    const closeBtn = document.getElementById("close-cookie-modal");
    const modal = document.getElementById("cookie-modal");

    if (openBtn && modal) {
        openBtn.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });
    }

    if (closeBtn && modal) {
        closeBtn.addEventListener("click", () => {
            modal.classList.add("hidden");
        });
    }
});

// ----------------------------
// 📱 Menu burger
// ----------------------------
document.addEventListener("DOMContentLoaded", () => {
    const burgerBtn = document.getElementById("burger-button");
    const navMenu = document.getElementById("mobile-menu");

    if (burgerBtn && navMenu) {
        burgerBtn.addEventListener("click", () => {
            navMenu.classList.toggle("hidden");
        });
    }
});

// ----------------------------
// 👤 Dropdown utilisateur
// ----------------------------
document.addEventListener("DOMContentLoaded", () => {
    const userBtn = document.getElementById("user-menu-button");
    const userMenu = document.getElementById("user-menu");

    if (userBtn && userMenu) {
        userBtn.addEventListener("click", () => {
            userMenu.classList.toggle("hidden");
        });
    }
});

// ----------------------------
// 🎥 Modale vidéo projets
// ----------------------------
document.addEventListener("DOMContentLoaded", () => {
    const openBtns = document.querySelectorAll("[data-video-open]");
    const closeBtns = document.querySelectorAll("[data-video-close]");

    openBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = document.getElementById(btn.dataset.videoOpen);
            if (target) target.classList.remove("hidden");
        });
    });

    closeBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = document.getElementById(btn.dataset.videoClose);
            if (target) target.classList.add("hidden");
        });
    });
});

// ----------------------------
// 🖼️ Lightbox voyages
// ----------------------------
document.addEventListener("DOMContentLoaded", () => {
    const openBtns = document.querySelectorAll("[data-lightbox-open]");
    const closeBtns = document.querySelectorAll("[data-lightbox-close]");

    openBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = document.getElementById(btn.dataset.lightboxOpen);
            if (target) target.classList.remove("hidden");
        });
    });

    closeBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = document.getElementById(btn.dataset.lightboxClose);
            if (target) target.classList.add("hidden");
        });
    });
});
/**
 * ✅ custom.js
 * Gestion du menu mobile + dropdown utilisateur
 */
document.addEventListener("DOMContentLoaded", () => {
    // --- Burger Menu ---
    const burgerButton = document.getElementById("burger-button");
    const mobileMenu = document.getElementById("mobile-menu");

    if (burgerButton && mobileMenu) {
        burgerButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    }

    // --- Dropdown utilisateur ---
    const userMenuButton = document.getElementById("user-menu-button");
    const userDropdown = document.getElementById("user-dropdown");

    if (userMenuButton && userDropdown) {
        userMenuButton.addEventListener("click", (e) => {
            e.stopPropagation(); // évite fermeture immédiate
            userDropdown.classList.toggle("hidden");
        });

        // Fermer si clic en dehors
        document.addEventListener("click", (e) => {
            if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add("hidden");
            }
        });
    }
});
// // === Mot de passe visible / masqué ===
// document.addEventListener("DOMContentLoaded", () => {
//     const input = document.getElementById('password');
//     const eyeOpen = document.getElementById('eyeOpen');
//     const eyeClosed = document.getElementById('eyeClosed');
//     const btn = document.querySelector('[data-toggle-password]');

//     if (btn && input && eyeOpen && eyeClosed) {
//         btn.addEventListener("click", () => {
//             if (input.type === "password") {
//                 input.type = "text";
//                 eyeOpen.classList.add("hidden");
//                 eyeClosed.classList.remove("hidden");
//             } else {
//                 input.type = "password";
//                 eyeOpen.classList.remove("hidden");
//                 eyeClosed.classList.add("hidden");
//             }
//         });
//     }
// });

// === Mot de passe visible / masqué ===
document.addEventListener("DOMContentLoaded", () => {
    // Sélectionne tous les boutons avec l'attribut data-toggle-password
    const toggleButtons = document.querySelectorAll('[data-toggle-password]');

    toggleButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            // Trouve l'input lié (le champ juste avant le bouton)
            const input = btn.parentElement.querySelector('input[type="password"], input[type="text"]');

            // Trouve les icônes à l'intérieur du bouton
            const eyeOpen = btn.querySelector("svg#eyeOpen, svg#eyeOpen_confirmation");
            const eyeClosed = btn.querySelector("svg#eyeClosed, svg#eyeClosed_confirmation");

            if (input && eyeOpen && eyeClosed) {
                if (input.type === "password") {
                    input.type = "text";
                    eyeOpen.classList.add("hidden");
                    eyeClosed.classList.remove("hidden");
                } else {
                    input.type = "password";
                    eyeOpen.classList.remove("hidden");
                    eyeClosed.classList.add("hidden");
                }
            }
        });
    });
});


