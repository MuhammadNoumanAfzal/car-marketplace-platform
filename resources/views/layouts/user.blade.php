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

    <a
        href="https://wa.me/13055550147"
        target="_blank"
        rel="noreferrer"
        aria-label="Chat on WhatsApp"
        class="whatsapp-float"
        style="position:fixed;right:24px;bottom:24px;z-index:9999;display:flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:9999px;background:#25D366;color:#ffffff;border:1px solid rgba(167,243,208,.25);box-shadow:0 18px 40px rgba(37,211,102,.35);"
    >
        <svg viewBox="0 0 24 24" width="28" height="28" style="display:block;width:28px;height:28px;fill:currentColor;" aria-hidden="true">
            <path d="M19.05 4.94A9.9 9.9 0 0 0 12 2C6.48 2 2 6.48 2 12c0 1.76.46 3.47 1.32 4.97L2 22l5.18-1.28A9.96 9.96 0 0 0 12 22c5.52 0 10-4.48 10-10 0-2.67-1.04-5.18-2.95-7.06ZM12 20.2a8.2 8.2 0 0 1-4.18-1.14l-.3-.18-3.08.76.82-3-.2-.31A8.16 8.16 0 0 1 3.8 12c0-4.52 3.68-8.2 8.2-8.2 2.19 0 4.24.85 5.79 2.4A8.14 8.14 0 0 1 20.2 12c0 4.52-3.68 8.2-8.2 8.2Zm4.5-6.16c-.25-.12-1.47-.72-1.7-.8-.23-.08-.4-.12-.57.12-.17.25-.65.8-.8.96-.15.17-.3.19-.55.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.22-1.45-1.37-1.7-.14-.25-.02-.38.11-.51.11-.11.25-.3.37-.44.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.57-1.37-.78-1.88-.21-.5-.43-.43-.57-.44h-.49c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.43 1.02 2.6.13.17 1.77 2.7 4.28 3.79.6.26 1.07.41 1.43.53.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.17-.48-.29Z"/>
        </svg>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status'))
                Swal.fire({
                    icon: @json(session('status_type', 'success')),
                    title: @json(session('status_title', 'Done')),
                    text: @json(session('status')),
                    confirmButtonColor: '#2563eb',
                    background: '#ffffff',
                    color: '#0f172a'
                });
            @elseif ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Please check the form',
                    text: @json($errors->first()),
                    confirmButtonColor: '#d62034',
                    background: '#ffffff',
                    color: '#0f172a'
                });
            @endif
        });
    </script>

    @yield('scripts')
</body>

</html>
