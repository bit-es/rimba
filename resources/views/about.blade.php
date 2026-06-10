<!doctype html>
<html lang="en" class="scroll-smooth dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>
        Rimba - Resource Integration for Manufacturing & Business Alignment
    </title>

    <meta name="description" content="Rimba - Resource Integration for Manufacturing & Business Alignment" />

    <meta name="author" content="Rimba" />

    <!-- Favicon -->
    <link rel="icon" href="/pics/tapir.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />

    <link href="https://fonts.bunny.net/css?family=asap:400,500,600|chelsea-market:400" rel="stylesheet" />

    <!-- Tailwind -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));

        @theme {
            --font-sans: "Asap", sans-serif;
            --font-logo: "Chelsea Market", cursive;
        }
    </style>

    <!-- Alpine -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Markdown -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/github-markdown-css/github-markdown.min.css">

    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/markdown-it-anchor/dist/markdownItAnchor.umd.js"></script>

</head>

<body class="antialiased">

    <!-- App -->
    <div x-data="appLayout()" class="min-h-dvh min-w-80 bg-white text-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">

        <!-- Main -->
        <main id="page-content" class="mx-auto flex max-w-7xl flex-auto flex-col px-4 pb-4 lg:px-8 lg:pb-8">

            <!-- Header -->
            <header id="page-header" class="flex flex-none items-center justify-between py-7">

                <!-- Left -->
                <div class="flex items-center gap-2">

                    <!-- Logo -->
                    <a href="{{ route('welcome') }}"
                        class="font-logo text-2xl tracking-widest hover:text-lime-600 dark:hover:text-lime-400">

                        RIMBA

                    </a>

                    <!-- Dark Mode -->
                    <button x-on:click="toggleDarkMode()" type="button"
                        class="relative inline-flex size-9 items-center justify-center text-zinc-600 dark:text-zinc-400">

                        <!-- Sun -->
                        <div x-cloak x-show="!darkMode" class="absolute inset-0 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />

                            </svg>

                        </div>

                        <!-- Moon -->
                        <div x-cloak x-show="darkMode" class="absolute inset-0 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />

                            </svg>

                        </div>

                    </button>

                </div>

                <!-- Nav -->
                <nav class="flex items-center gap-6">

                    <a href="#features"
                        class="text-sm font-medium decoration-lime-600 decoration-2 underline-offset-8 hover:text-black hover:underline dark:decoration-lime-400 dark:hover:text-white">

                        Features

                    </a>

                    <a href="#"
                        @click.prevent="$dispatch('load-doc', {
                            path: '/docs/app/AboutMe.md',
                            anchor: 'ecosystem'
                        })"
                        class="text-sm font-medium decoration-lime-600 decoration-2 underline-offset-8 hover:text-black hover:underline dark:decoration-lime-400 dark:hover:text-white">

                        About

                    </a>

                    <a href="#"
                        @click.prevent="$dispatch('load-doc', {
                            path: '/docs/app/BuildMe.md',
                             anchor: 'phases'
                        })"
                        class="text-sm font-medium decoration-lime-600 decoration-2 underline-offset-8 hover:text-black hover:underline dark:decoration-lime-400 dark:hover:text-white">

                        Build

                    </a>

                    <a href="#"
                        @click.prevent="$dispatch('load-doc', {
                            path: '/docs/app/EngineerMe.md',
                            anchor: 'community'
                        })"
                        class="text-sm font-medium decoration-lime-600 decoration-2 underline-offset-8 hover:text-black hover:underline dark:decoration-lime-400 dark:hover:text-white">
                        Engineer

                    </a>

                </nav>

            </header>

            <!-- Content -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-12">

                <!-- Photo -->
                <div class="col-span-1 md:col-span-5">

                    <img src="/pics/rimba.jpg" alt="Photo" class="aspect-square w-full rounded-xl object-cover" />

                </div>

                <!-- Intro -->
                <div
                    class="relative col-span-1 flex flex-col overflow-hidden rounded-xl bg-zinc-100 p-12 md:col-span-7 dark:bg-zinc-900">

                    <div class="absolute -top-20 -left-20 size-48 rounded-full bg-yellow-500 blur-2xl"></div>

                    <div class="absolute -top-10 -right-10 size-64 rounded-full bg-orange-300 blur-3xl"></div>

                    <div class="absolute inset-0 bg-yellow-100/50 backdrop-blur-md dark:bg-yellow-900/75"></div>

                    <div class="relative mt-auto">

                        <h1 class="text-4xl font-medium text-black dark:text-white">
                            Resource Integration for Manufacturing & Business Alignment
                        </h1>

                        <p class="mt-6 leading-relaxed text-zinc-900 dark:text-zinc-200">

                            RIMBA is an integrated manufacturing and business operations
                            platform designed to connect people, processes, assets,
                            knowledge, compliance, and execution within a single ecosystem.

                        </p>

                    </div>

                </div>
                <!-- END Intro -->
                <!-- Self Service Portal -->
                <div class="col-span-1 md:col-span-12">
                    <a href="#moreinfo"
                        @click.prevent="$dispatch('load-doc', {
                                path: '/docs/All.md',
                                anchor: 'portal'
                            })">
                        <div
                            class="relative flex flex-col overflow-hidden rounded-xl bg-zinc-100 p-12 dark:bg-zinc-900">

                            <!-- Decorative Blobs -->
                            <div aria-hidden="true"
                                class="absolute -top-20 -left-20 size-48 rounded-full bg-lime-400 blur-2xl"></div>
                            <div aria-hidden="true"
                                class="absolute -bottom-10 -right-10 size-72 rounded-full bg-lime-300 blur-3xl">
                            </div>
                            <div aria-hidden="true"
                                class="absolute inset-0 bg-gray-100/50 backdrop-blur-md dark:bg-lime-900/60"></div>

                            <!-- Content -->
                            <div class="relative text-center max-w-3xl mx-auto">
                                <h2 class="text-3xl font-medium text-black dark:text-white">
                                    🧰 Staff Self‑Service Portal
                                </h2>

                                <p class="mt-4 text-zinc-800 leading-relaxed dark:text-zinc-200">
                                    The RIMBA Self-Service Portal is your <strong>personal toolbox of services</strong>
                                    —
                                    empowering every employee to find, select, and use what they need independently,
                                    anytime.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- END Self Service Portal -->
                <!-- Features -->
                <div id="features" class="col-span-1 grid grid-cols-1 gap-6 md:col-span-12 md:grid-cols-4">

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
                                'icon' => 'svg/doc-honeybee.svg',
                                'title' => 'Document',
                                'pic' => 'svg/doc-document.svg',
                                'desc' =>
                                    'Honeybees that tirelessly gather and store nectar, the Document system organizes and preserves knowledge for easy retrieval.',
                            ],
                            [
                                'icon' => 'svg/ldi-owl.svg',
                                'title' => 'Learn',
                                'pic' => 'svg/ldi-learn.svg',
                                'desc' =>
                                    'Owls are universally associated with wisdom and knowledge. Learning is about gaining insight — having the wisdom to act correctly in real-world scenarios.',
                            ],
                            [
                                'icon' => 'svg/eam-horse.svg',
                                'title' => 'Asset',
                                'pic' => 'svg/eam-asset.svg',
                                'desc' =>
                                    'Horses are known for their strength and value. Assets are the backbone of operations — reliable, long-lasting, and essential for carrying business forward.',
                            ],
                            [
                                'icon' => 'svg/cal-bird.svg',
                                'title' => 'Calendar',
                                'pic' => 'svg/cal-calendar.svg',
                                'desc' =>
                                    'Just like a bird kicks off the morning, the Calendar keeps everyone informed with work hours, events, and holidays.',
                            ],
                            [
                                'icon' => 'svg/job-ant.svg',
                                // 'icon' => 'svg/job-buffalo.svg',
                                'title' => 'Task',
                                'pic' => 'svg/job-task.svg',
                                'desc' =>
                                    'Like an ant that continues to move and perseveres through challenges, Tasks drive disciplined execution and continuous progress.',
                                // 'Like a buffalo that continues to move and perseveres through challenges, Tasks drive disciplined execution and continuous progress.',
                            ],
                            [
                                'icon' => 'svg/ldi-butterfly.svg',
                                'title' => 'Certificate',
                                'pic' => 'svg/ldi-certificate.svg',
                                'desc' =>
                                    'A butterfly emerging through transformation, Certificates represent achievement, growth, and capability.',
                            ],
                            [
                                'icon' => 'svg/loc-eagle.svg',
                                'title' => 'Location',
                                'pic' => 'svg/loc-location.svg',
                                'desc' =>
                                    'Eagle\'s sharp eye from above, Location provides clear visibility and awareness across the operational landscape.',
                            ],
                            [
                                'icon' => 'svg/sec-leopard.svg',
                                'title' => 'Authorization',
                                'pic' => 'svg/sec-security.svg',
                                'desc' =>
                                    'Like a leopard that guards its territory, Security protects access and enforces control across the system.',
                            ],

                            [
                                'icon' => 'svg/pwf-turtle.svg',
                                'title' => 'Workflow',
                                'pic' => 'svg/pwf-workflow.svg',
                                'desc' =>
                                    'Turtle diagrams that define inputs, processes, and outputs, Workflows structure operations into clear, controlled, and repeatable steps.',
                            ],
                            [
                                'icon' => 'svg/svc-peacock.svg',
                                'title' => 'Catalog',
                                'pic' => 'svg/svc-menu.svg',
                                'desc' =>
                                    'Like a peacock spotting vibrant features in a crowd. Service catalog neatly displays all team offerings, enabling efficient use of available services.',
                            ],
                            [
                                'icon' => 'svg/req-parrot.svg',
                                'title' => 'Request',
                                'pic' => 'svg/req-request.svg',
                                'desc' =>
                                    'A parrot that listens and repeats exactly as heard, Requests capture instructions clearly and relay them without distortion.',
                            ],
                            [
                                'icon' => 'svg/ver-cricket.svg',
                                'title' => 'Version',
                                'pic' => 'svg/ver-major.svg',
                                'desc' =>
                                    'Just as a cricket grows through distinct iterative stages (instars), Versioning tracks every update, patch, and release in a controlled evolution.',
                            ],
                            [
                                'icon' => 'svg/aud-spider.svg',
                                'title' => 'Audit Trail',
                                'pic' => 'svg/aud-footprints.svg',
                                'desc' =>
                                    'Like a spider weaving a traceable web, the Audit Trail records every system action to form a permanent path of truth.',
                            ],
                            [
                                'icon' => 'svg/lcm-orangutan.svg',
                                'title' => 'Contract',
                                'pic' => 'svg/lcm-handshake.svg',
                                'desc' =>
                                    'An orangutan carefully plans every move through the trees to avoid mistakes, the Contract carefully crafted to be clear and fair binding between parties.',
                            ],
                            [
                                'icon' => 'svg/bid-fish.svg',
                                'title' => 'Tendering',
                                'pic' => 'svg/bid-mallet.svg',
                                'desc' =>
                                    'Like a tropical fish standing out in a complex reef, an Invitation to Bid highlights prime opportunities to attract elite vendors.',
                            ],
                        ];
                    @endphp

                    @foreach ($features as $feature)
                        <a href="#"
                            @click.prevent="$dispatch('load-doc', {
                                path: '/docs/All.md',
                                anchor: '{{ $feature['title'] }}'
                            })"
                            class="group relative aspect-square overflow-hidden rounded-xl bg-zinc-100 p-6 hover:bg-zinc-200 dark:bg-zinc-900 dark:hover:bg-zinc-800">

                            <!-- Hover Icon -->
                            <div
                                class="absolute top-6 right-6 scale-0 opacity-0 transition duration-150 ease-out group-hover:scale-100 group-hover:opacity-100">

                                <div
                                    class="w-6 h-6 text-zinc-700 dark:text-zinc-200 [&>svg]:w-full [&>svg]:h-full [&>svg]:fill-current">

                                    {!! file_get_contents(resource_path($feature['icon'])) !!}

                                </div>

                            </div>

                            <!-- Title -->
                            <h3 class="relative z-10 text-lg font-semibold text-zinc-950 dark:text-zinc-50">

                                {{ $feature['title'] }}

                            </h3>

                            <!-- Description -->
                            <p class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">

                                {{ $feature['desc'] }}

                            </p>

                            <!-- Main Illustration -->
                            <div
                                class="absolute bottom-6 left-6 right-6 top-36 flex items-center justify-center overflow-hidden transition duration-150 ease-out group-hover:scale-105">

                                <div
                                    class="h-full w-full flex items-center justify-center rounded-xl [&>svg]:w-auto [&>svg]:h-full [&>svg]:max-h-full [&>svg]:max-w-full [&>svg]:object-contain">

                                    {!! file_get_contents(resource_path($feature['pic'])) !!}

                                </div>

                            </div>

                        </a>
                    @endforeach

                </div>

            </div>

        </main>

        <!-- Documentation Slide Over -->
        <div x-data="docViewer()" @load-doc.window="load($event.detail)">

            <!-- Overlay -->
            <div x-show="open" x-transition class="fixed inset-0 z-40 bg-black/50" @click="open = false">
            </div>

            <!-- Panel -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed top-0 right-0 z-50 h-full w-full overflow-y-auto bg-white shadow-xl md:w-2/3 lg:w-1/2 dark:bg-zinc-900">

                <!-- Header -->
                <div class="flex items-center justify-between border-b p-4 dark:border-zinc-700">

                    <h3 class="font-semibold" x-text="title">
                    </h3>

                    <button @click="open = false" class="text-xl">

                        &times;

                    </button>

                </div>

                <!-- Content -->
                <div class="markdown-body doc-body p-6 dark:prose-invert" x-html="content">
                </div>

            </div>

        </div>

    </div>

    <!-- Scripts -->
    <script>
        function appLayout() {

            return {

                darkMode: true,

                toggleDarkMode() {

                    this.darkMode = !this.darkMode;

                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }

                }

            }

        }

        function docViewer() {

            return {

                open: false,

                title: 'Documentation',

                content: 'Loading...',

                async load(payload) {

                    const path = payload?.path || '/docs/All.md';
                    const anchor = payload?.anchor || null;

                    this.title = path
                        .split('/')
                        .pop()
                        .replace('.md', '');

                    try {

                        const res = await fetch(path);

                        if (!res.ok) {
                            throw new Error('File not found');
                        }

                        const text = await res.text();

                        const md = window.markdownit({
                            html: true,
                            linkify: true,
                            typographer: true
                        }).use(window.markdownItAnchor, {
                            permalink: false
                        });

                        this.content = md.render(text);

                        this.open = true;

                        this.$nextTick(() => {

                            const body = this.$root.querySelector('.doc-body');

                            if (body) {

                                body.scrollTo({
                                    top: 0,
                                    behavior: 'instant'
                                });

                            }

                            if (!anchor) return;

                            const id = anchor
                                .trim()
                                .toLowerCase()
                                .replace(/\s+/g, '-');

                            const el = this.$root.querySelector(`#${id}`);

                            if (el) {

                                el.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });

                            }

                        });

                    } catch (e) {

                        this.content = `
                            <div class="text-red-500">
                                Failed to load documentation.
                            </div>
                        `;

                        this.open = true;

                    }

                }

            }

        }
    </script>

</body>

</html>
