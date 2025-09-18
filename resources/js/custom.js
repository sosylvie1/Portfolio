/**
 * ✅ custom.js
 * Tous les scripts inline déplacés pour respecter la CSP PlanetHoster
 */

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
                url: "{{ url('/') }}",
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: "{{ url('/') }}",
                },
                about: {
                    "@type": "Person",
                    name: "Sylvie Seguinaud",
                    jobTitle: "Développeuse Web & Web Mobile",
                    url: "{{ url('/a-propos') }}",
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
                url: "{{ url('/voyages') }}",
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: "{{ url('/') }}",
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
                url: "{{ url()->current() }}",
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: "{{ url('/') }}",
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
                url: "{{ url('/projets') }}",
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: "{{ url('/') }}",
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
                url: "{{ url('/a-propos') }}",
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: "{{ url('/') }}",
                },
                mainEntity: {
                    "@type": "Person",
                    name: "Sylvie Seguinaud",
                    jobTitle: "Développeuse Web & Web Mobile",
                    url: "{{ url('/a-propos') }}",
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

// JSON-LD CV
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
                url: "{{ url('/cv') }}",
                image: "{{ asset('images/sylviecv.webp') }}",
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
                url: "{{ url('/contact') }}",
                inLanguage: "fr",
                isPartOf: {
                    "@type": "WebSite",
                    name: "Portfolio de Sylvie Seguinaud",
                    url: "{{ url('/') }}",
                },
                mainEntityOfPage: "{{ url('/contact') }}",
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
                url: "{{ url('/plan-du-site') }}",
                inLanguage: "fr",
                mainEntity: {
                    "@type": "SiteNavigationElement",
                    name: "Navigation principale",
                    hasPart: [
                        {
                            "@type": "WebPage",
                            name: "Accueil",
                            url: "{{ route('accueil') }}",
                        },
                        {
                            "@type": "WebPage",
                            name: "À propos",
                            url: "{{ route('a-propos') }}",
                        },
                        {
                            "@type": "WebPage",
                            name: "Projets",
                            url: "{{ route('projets.index') }}",
                        },
                        {
                            "@type": "WebPage",
                            name: "CV",
                            url: "{{ route('cv.public') }}",
                        },
                        {
                            "@type": "WebPage",
                            name: "Contact",
                            url: "{{ route('contact.show') }}",
                        },
                        {
                            "@type": "WebPage",
                            name: "Politique de confidentialité",
                            url: "{{ route('confidentialite') }}",
                        },
                        {
                            "@type": "WebPage",
                            name: "Conditions générales d’utilisation",
                            url: "{{ route('cgu') }}",
                        },
                        {
                            "@type": "WebPage",
                            name: "Plan du site",
                            url: "{{ route('plan-du-site') }}",
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
