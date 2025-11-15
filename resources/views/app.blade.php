<!DOCTYPE html>
<html lang="ru" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'АйТиПлюс') }}</title>

        {{-- SEO Meta Tags --}}
        <meta name="description" content="АйТиПлюс — обучение программированию для всех от 8 лет. Онлайн и офлайн занятия, опытные преподаватели, современные технологии. Запишитесь на бесплатный пробный урок!">
        <meta name="keywords" content="программирование для детей, обучение программированию, курсы программирования, Python для детей, веб-разработка для школьников, IT курсы для детей, АйТиПлюс">
        <meta name="author" content="АйТиПлюс">
        <meta name="robots" content="index, follow">
        <meta name="language" content="Russian">
        <meta name="revisit-after" content="7 days">
        
        {{-- Open Graph / Facebook --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="АйТиПлюс — Программирование для всех">
        <meta property="og:description" content="Обучение программированию для всех от 8 лет. Онлайн и офлайн занятия, опытные преподаватели, современные технологии.">
        <meta property="og:image" content="{{ asset('favicon.svg') }}">
        <meta property="og:locale" content="ru_RU">
        <meta property="og:site_name" content="АйТиПлюс">
        
        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="АйТиПлюс — Программирование для всех">
        <meta name="twitter:description" content="Обучение программированию для всех от 8 лет. Онлайн и офлайн занятия, опытные преподаватели, современные технологии.">
        <meta name="twitter:image" content="{{ asset('favicon.svg') }}">
        
        {{-- Canonical URL --}}
        <link rel="canonical" href="{{ url()->current() }}">

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/js/app.ts', 'resources/css/app.css'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
