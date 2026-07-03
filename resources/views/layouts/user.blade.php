<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Nitro Motors USA')</title>
    <meta name="description" content="@yield('meta_description', 'Modern car marketplace for premium vehicles across the USA.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>

<body class="selection:bg-ember selection:text-white">
    <div class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-hero-grid bg-[size:22px_22px] opacity-30"></div>
        <div class="pointer-events-none absolute left-1/2 top-0 h-[36rem] w-[36rem] -translate-x-1/2 rounded-full bg-ember/10 blur-3xl"></div>
        <div class="pointer-events-none absolute right-0 top-[20rem] h-[28rem] w-[28rem] rounded-full bg-red-600/10 blur-3xl"></div>
        <div class="pointer-events-none absolute left-0 top-[60rem] h-[24rem] w-[24rem] rounded-full bg-zinc-500/10 blur-3xl"></div>

        @include('user.partials.header')

        <main>
            @yield('content')
        </main>

        @include('user.partials.footer')
    </div>

    @yield('scripts')
</body>

</html>
