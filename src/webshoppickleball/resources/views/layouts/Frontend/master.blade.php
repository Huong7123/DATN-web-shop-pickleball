<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Pickleball Pro')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec5b",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102216",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .error{
            font-size: 13px;
            color: red;
            font-weight: 100;
        }
        .loader {
            width: 50px;
            padding: 8px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #13EC5B;
            --_m:
                conic-gradient(#0000 10%, #000),
                linear-gradient(#000 0 0) content-box;
            -webkit-mask: var(--_m);
            mask: var(--_m);
            -webkit-mask-composite: source-out;
            mask-composite: subtract;
            animation: l3 1s infinite linear;
            }
            @keyframes l3 {
            to { transform: rotate(1turn); }
        }

    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#0d1b12] dark:text-gray-200">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <!-- TopNavBar -->
        <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-solid border-primary/20">
            @include('layouts.Frontend.widget.__header')
        </header>
        <main class="layout-container flex h-full grow flex-col">
            <div class="container mx-auto px-4">
                @yield('content')
            </div>
            <div id="global-loader" class="fixed inset-0 z-[9999] hidden bg-black/40 flex items-center justify-center">
                <div class="loader"></div>
            </div>
        </main>
        <!-- Footer -->
        <footer class="bg-primary/5 dark:bg-primary/10 mt-16">
            @include('layouts.Frontend.widget.__footer')
        </footer>
    </div>
</body>
<script>
    function showLoader() {
        $('#global-loader').removeClass('hidden');
    }
    function hideLoader() {
        $('#global-loader').addClass('hidden');
    }
</script>

</html>