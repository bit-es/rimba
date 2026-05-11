<!doctype html>
<html lang="en" class="scroll-smooth dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>Rimba - Resource Integration for Manufacturing & Business Alignment</title>

    <meta name="description" content="Rimba - Resource Integration for Manufacturing & Business Alignment" />
    <meta name="author" content="Rimba" />

    <!-- Icons -->
    <link rel="icon" href="/docs/tapir.png" />

    <!-- Inter web font from bunny.net (GDPR compliant) -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS Play CDN (mostly for development/testing purposes) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <!-- Tailwind CSS v4 Configuration -->
    <style type="text/tailwindcss">
        /* Class based dark mode */
        @custom-variant dark (&:where(.dark, .dark *));

        /* Theme configuration */
        @theme {
            /* Fonts */
            --default-font-family: "Inter";
        }
    </style>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine.js (x-cloak - https://alpinejs.dev/directives/cloak) -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- ✅ GitHub Markdown CSS (CORRECT WAY) -->
    <link rel=" stylesheet" href="https://cdn.jsdelivr.net/npm/github-markdown-css/github-markdown.min.css">
    <!-- ✅ Markdown-it -->
    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>
</head>



<body class="bg-gray-100 p-10">

    <!-- Markdown Block -->

    <div id="doc-viewer" x-data="{
        content: 'Select a feature…',
    
        async load(doc) {
            try {
                const res = await fetch(`/docs/${doc}.md`);
                if (!res.ok) throw new Error('Not found');
    
                const text = await res.text();
                const md = window.markdownit({
                    html: true,
                    linkify: true,
                    typographer: true
                });
    
                this.content = md.render(text);
            } catch (e) {
                this.content = `<p><strong>Documentation not found:</strong> ${doc}</p>`;
            }
        },
    
        init() {
            // ✅ Load from URL if present
            const params = new URLSearchParams(window.location.search);
            const doc = params.get('doc');
            if (doc) this.load(doc);
        }
    }" @load-doc.window="load($event.detail)"
        class="markdown-body bg-white p-10 rounded-xl shadow max-w-none">
        <article x-html="content"></article>
    </div>


</body>

</html>
