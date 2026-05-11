<!doctype html>
<html lang="en" class="scroll-smooth dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>Rimba - Resource Integration for Manufacturing & Business Alignment</title>

    <meta name="description" content="Rimba - Resource Integration for Manufacturing & Business Alignment" />
    <meta name="author" content="Rimba" />

    <!-- Icons -->
    <link rel="icon" href="/pics/tapir.png" />

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
    <!-- GitHub Markdown CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/github-markdown-css/github-markdown.min.css">

    <!-- Markdown-it -->
    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>
</head>

<body class="antialiased">
    <!-- Page Container -->
    <div x-data="{
        darkMode: true,
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
    
            // Toggle dark class on html element
            if (this.darkMode) {
                document.body.parentNode.classList.add('dark');
            } else {
                document.body.parentNode.classList.remove('dark');
            }
        }
    }" class="min-h-dvh min-w-80 bg-white text-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
        <!-- Page Content -->
        <main id="page-content" class="mx-auto flex max-w-6xl flex-auto flex-col px-4 pb-4 lg:px-8 lg:pb-8">
            <!-- Main Header -->
            <header id="page-header" class="flex flex-none items-center justify-between py-7">
                <div class="flex items-center gap-2">
                    <!-- Logo -->
                    <a href="javascript:void(0)"
                        class="text-2xl font-thin tracking-widest hover:text-purple-600 active:opacity-75 dark:hover:text-purple-400">
                        Rimba
                    </a>
                    <!-- END Logo -->

                    <!-- Toggle Dark Mode -->
                    <button x-on:click="toggleDarkMode()" type="button"
                        class="relative inline-flex size-9 items-center justify-center text-zinc-600 hover:opacity-75 dark:text-zinc-400">
                        <div x-cloak x-show="!darkMode" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180"
                            class="absolute inset-0 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="hi-outline hi-sun inline-block size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                        <div x-cloak x-show="darkMode" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180"
                            class="absolute inset-0 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="hi-outline hi-moon inline-block size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                        </div>
                    </button>
                    <!-- END Toggle Dark Mode -->
                </div>
                <div class="flex items-center gap-4">
                    <!-- Nav -->
                    <nav class="flex items-center gap-6">
                        <a href="#features"
                            class="text-sm font-medium decoration-purple-600 decoration-2 underline-offset-8 hover:text-black hover:underline dark:decoration-purple-400 dark:hover:text-white">
                            Features
                        </a>
                        {{-- <a href="#contact"
                            class="text-sm font-medium decoration-purple-600 decoration-2 underline-offset-8 hover:text-black hover:underline dark:decoration-purple-400 dark:hover:text-white">
                            Hire me
                        </a> --}}
                    </nav>
                    <!-- END Nav -->
                </div>
            </header>
            <!-- END Main Header -->

            <!-- Main Content -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-12">
                <!-- Photo -->
                <div class="col-span-1 md:col-span-5">
                    <img src="/pics/tapir_pic_dark.jpg" alt="Photo"
                        class="rounded-xl object-cover w-full aspect-square" />
                </div>
                <!-- END Photo -->

                <!-- Intro -->
                <div
                    class="relative col-span-1 flex flex-col overflow-hidden rounded-xl bg-zinc-100 p-12 md:col-span-7 dark:bg-zinc-900">
                    <div aria-hidden="true"
                        class="absolute -top-20 -left-20 size-48 rounded-full bg-yellow-500 blur-2xl"></div>
                    <div aria-hidden="true"
                        class="absolute -top-10 -right-10 size-64 rounded-full bg-orange-300 blur-3xl"></div>
                    <div aria-hidden="true"
                        class="absolute inset-0 bg-yellow-100/50 backdrop-blur-md dark:bg-yellow-900/75"></div>
                    <div class="relative mt-auto">
                        <h1 class="text-4xl font-medium text-black dark:text-white">
                            Resource Integration for Manufacturing & Business Alignment
                        </h1>
                        <h2 class="mt-3 leading-relaxed text-zinc-900 dark:text-zinc-200">
                            The Industrial Nervous System for Your Factory
                            RIMBA is not just software — it’s a living environment where People, Assets, and Data speak
                            the same language.
                            Designed for modern manufacturing and enterprise teams, RIMBA brings everything your
                            organization needs into one unified platform — enabling clarity, efficiency, and smarter
                            decisions at every level.
                        </h2>
                    </div>
                </div>
                <!-- END Intro -->
                <!-- Self Service Portal -->
                <div class="col-span-1 md:col-span-12">
                    <a href="#moreinfo" @click="$dispatch('load-doc', 'All')">
                  
                    <div class="relative flex flex-col overflow-hidden rounded-xl bg-zinc-100 p-12 dark:bg-zinc-900">

                        <!-- Decorative Blobs -->
                        <div aria-hidden="true"
                            class="absolute -top-20 -left-20 size-48 rounded-full bg-green-400 blur-2xl"></div>
                        <div aria-hidden="true"
                            class="absolute -bottom-10 -right-10 size-72 rounded-full bg-emerald-300 blur-3xl"></div>
                        <div aria-hidden="true"
                            class="absolute inset-0 bg-green-100/50 backdrop-blur-md dark:bg-green-900/60"></div>

                        <!-- Content -->
                        <div class="relative text-center max-w-3xl mx-auto">
                            <h2 class="text-3xl font-medium text-black dark:text-white">
                                🧰 Staff Self‑Service Portal
                            </h2>

                            <p class="mt-4 text-zinc-800 leading-relaxed dark:text-zinc-200">
                                The RIMBA Self-Service Portal is your <strong>personal toolbox of services</strong> —
                                empowering every employee to find, select, and use what they need independently,
                                anytime.
                            </p>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- END Self Service Portal -->
                <!-- Features -->
                @php
                    $features = [
                        [
                            'icon' => 'svg/org-elephant.svg',
                            'title' => 'Organization',
                            'pic' => 'svg/org-orgunit.svg',
                            'desc' =>
                                'Social structure of the elephant herd, Organization connects people within an intelligent and coordinated hierarchy.',
                        ],
                        [
                            'icon' => 'svg/ldi-owl.svg',
                            'title' => 'Learn',
                            'pic' => 'svg/ldi-learn.svg',
                            'desc' =>
                                'Owls are universally associated with wisdom and knowledge. Learning is about gaining insight — having the wisdom to act correctly in real-world scenarios.',
                        ],
                        [
                            'icon' => 'svg/doc-honeybee.svg',
                            'title' => 'Document',
                            'pic' => 'svg/doc-document.svg',
                            'desc' =>
                                'Honeybees that tirelessly gather and store nectar, the Document system organizes and preserves knowledge for easy retrieval.',
                        ],
                        [
                            'icon' => 'svg/eam-horse.svg',
                            'title' => 'Asset',
                            'pic' => 'svg/eam-asset.svg',
                            'desc' =>
                                'Horses are known for their strength and value. Assets are the backbone of operations — reliable, long-lasting, and essential for carrying business forward.',
                        ],
                        [
                            'icon' => 'svg/job-buffalo.svg',
                            'title' => 'Task',
                            'pic' => 'svg/job-task.svg',
                            'desc' =>
                                'Like a buffalo that continues to move and perseveres through challenges, Tasks drive disciplined execution and continuous progress.',
                        ],
                        [
                            'icon' => 'svg/ldi-butterfly.svg',
                            'title' => 'Certificate',
                            'pic' => 'svg/ldi-certificate.svg',
                            'desc' =>
                                'A butterfly emerging through transformation, Certificates represent achievement, growth, and capability.',
                        ],
                        [
                            'icon' => 'svg/cal-bird.svg',
                            'title' => 'Calendar',
                            'pic' => 'svg/cal-calendar.svg',
                            'desc' =>
                                'Just like a bird kicks off the morning, the Calendar keeps everyone informed with work hours, events, and holidays.',
                        ],
                        [
                            'icon' => 'svg/sec-leopard.svg',
                            'title' => 'Authorization',
                            'pic' => 'svg/sec-security.svg',
                            'desc' =>
                                'Like a leopard that guards its territory, Security protects access and enforces control across the system.',
                        ],
                        [
                            'icon' => 'svg/svc-orangutan.svg',
                            'title' => 'Catalog',
                            'pic' => 'svg/svc-menu.svg',
                            'desc' =>
                                'An orangutan that skillfully uses tools, the Service Menu enables flexible and intelligent use of available services.',
                        ],
                        [
                            'icon' => 'svg/pwf-turtle.svg',
                            'title' => 'Workflow',
                            'pic' => 'svg/pwf-workflow.svg',
                            'desc' =>
                                'Turtle diagrams that define inputs, processes, and outputs, Workflows structure operations into clear, controlled, and repeatable steps.',
                        ],
                        [
                            'icon' => 'svg/loc-eagle.svg',
                            'title' => 'Location',
                            'pic' => 'svg/loc-location.svg',
                            'desc' =>
                                'Eagle\'s sharp eye from above, Location provides clear visibility and awareness across the operational landscape.',
                        ],
                        [
                            'icon' => 'svg/req-parrot.svg',
                            'title' => 'Request',
                            'pic' => 'svg/req-request.svg',
                            'desc' =>
                                'A parrot that listens and repeats exactly as heard, Requests capture instructions clearly and relay them without distortion.',
                        ],
                    ];
                @endphp
                @foreach ($features as $feature)
                    <a href="#moreinfo" @click="$dispatch('load-doc', '{{ $feature['title'] }}')"
                        class="group relative col-span-1 overflow-hidden rounded-xl bg-zinc-100 p-6 hover:bg-zinc-200/75 active:bg-zinc-200 md:col-span-3 dark:bg-zinc-900 dark:hover:bg-zinc-800/75 dark:active:bg-zinc-800">
                        <!-- Hover Icon -->
                        <div class="absolute top-6 right-6 scale-0 opacity-0 transition duration-75 ease-out group-hover:scale-100 group-hover:opacity-100"
                            aria-hidden="true">
                            <div class="w-6 h-6 [&>svg]:w-full [&>svg]:h-full [&>svg]:fill-current">
                                {!! file_get_contents(resource_path($feature['icon'])) !!}
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="text-lg font-medium text-zinc-950 dark:text-zinc-50">
                            {{ $feature['title'] }}
                        </h3>

                        <!-- Description -->
                        <h4 class="text-sm text-zinc-600 dark:text-zinc-400">
                            {{ $feature['desc'] }}
                        </h4>

                        <!-- Main Image -->
                        <div class="mt-10 transition duration-150 ease-out group-hover:scale-105">
                            <div class="rounded-xl object-contain w-full aspect-square">
                                {!! file_get_contents(resource_path($feature['pic'])) !!}
                            </div>
                        </div>

                    </a>
                @endforeach
                <!-- END Features -->

                <!-- Documentation Slide-over -->
                <div x-data="{
                    open: false,
                    content: 'Select a feature to view documentation…',
                
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
                            this.open = true; // ✅ open slide-over
                        } catch (e) {
                            this.content = `<p><strong>Documentation not found:</strong> ${doc}</p>`;
                            this.open = true;
                        }
                    }
                }" @load-doc.window="load($event.detail)">
                    <!-- Backdrop -->
                    <div x-show="open" x-transition.opacity @click="open = false"
                        class="fixed inset-0 bg-black/40 z-40"></div>

                    <!-- Slide-over panel -->
                    <div x-show="open" x-transition:enter="transform transition ease-in-out duration-300"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-300"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                        class="fixed inset-y-0 right-0 z-50 w-full max-w-3xl bg-white dark:bg-zinc-900 shadow-xl flex flex-col">

                        <!-- Header -->
                        <div class="flex items-center justify-between px-6 py-4 border-b dark:border-zinc-800">
                            <h2 class="text-lg font-semibold">
                                📘 Documentation
                            </h2>

                            <button @click="open = false"
                                class="text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200">
                                ✕
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 overflow-y-auto p-6">
                            <div class="markdown-body max-w-none">
                                <article x-html="content"></article>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END Documentation Slide-over -->

                <!-- Footer -->
                <footer
                    class="flex flex-col gap-6 py-7 text-center text-sm md:col-span-12 md:flex-row-reverse md:justify-between md:gap-0 md:text-left">
                    <nav class="flex items-center justify-center gap-4">
                        <a href="javascript:void(0)" class="text-zinc-400 hover:text-zinc-800 dark:hover:text-white">
                            <svg class="bi bi-twitter-x inline-block size-5" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path
                                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="text-zinc-400 hover:text-[#1877f2]">
                            <svg class="icon-facebook inline-block size-5" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.192 5 15.115 5H18V0h-3.808C10.596 0 9 1.583 9 4.615V8z">
                                </path>
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="text-zinc-400 hover:text-[#405de6]">
                            <svg class="icon-instagram inline-block size-5" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z">
                                </path>
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="text-zinc-400 hover:text-[#333] dark:hover:text-zinc-50">
                            <svg class="icon-github inline-block size-5" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z">
                                </path>
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="text-zinc-400 hover:text-[#ea4c89]">
                            <svg class="icon-dribbble inline-block size-5" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12 12-5.373 12-12S18.628 0 12 0zm9.885 11.441c-2.575-.422-4.943-.445-7.103-.073a42.153 42.153 0 00-.767-1.68c2.31-1 4.165-2.358 5.548-4.082a9.863 9.863 0 012.322 5.835zm-3.842-7.282c-1.205 1.554-2.868 2.783-4.986 3.68a46.287 46.287 0 00-3.488-5.438A9.894 9.894 0 0112 2.087c2.275 0 4.368.779 6.043 2.072zM7.527 3.166a44.59 44.59 0 013.537 5.381c-2.43.715-5.331 1.082-8.684 1.105a9.931 9.931 0 015.147-6.486zM2.087 12l.013-.256c3.849-.005 7.169-.448 9.95-1.322.233.475.456.952.67 1.432-3.38 1.057-6.165 3.222-8.337 6.48A9.865 9.865 0 012.087 12zm3.829 7.81c1.969-3.088 4.482-5.098 7.598-6.027a39.137 39.137 0 012.043 7.46c-3.349 1.291-6.953.666-9.641-1.433zm11.586.43a41.098 41.098 0 00-1.92-6.897c1.876-.265 3.94-.196 6.199.196a9.923 9.923 0 01-4.279 6.701z">
                                </path>
                            </svg>
                        </a>
                    </nav>
                    <div class="text-zinc-500 dark:text-zinc-400/80">
                        <span class="font-medium">Bites</span> ©
                        <span x-text="new Date().getFullYear()"></span>
                    </div>
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Main Content -->
        </main>
        <!-- END Page Content -->
    </div>
    <!-- END Page Container -->
</body>

</html>
