<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php($marketingSettings = \App\Models\MarketingSetting::query()->first())
    @php($seoSettings = \App\Models\SeoSetting::query()->first())
    @php($siteTitle = $seoSettings?->site_title ?: 'Nitro Motors USA')
    @php($defaultTitle = $seoSettings?->default_meta_title ?: $siteTitle)
    @php($metaTitle = trim($__env->yieldContent('title', $defaultTitle)))
    @php($metaDescription = trim($__env->yieldContent('meta_description', $seoSettings?->default_meta_description ?: 'Modern car marketplace for premium vehicles across the USA.')))
    @php($metaKeywords = trim($__env->yieldContent('meta_keywords', $seoSettings?->default_meta_keywords ?: '')))
    @php($canonicalBaseUrl = rtrim($seoSettings?->canonical_base_url ?: config('app.url'), '/'))
    @php($canonicalUrl = trim($__env->yieldContent('canonical', $canonicalBaseUrl . request()->getPathInfo())))
    @php($robotsDirective = ($seoSettings?->enable_indexing ?? true) ? ($seoSettings?->robots_directive ?: 'index,follow') : 'noindex,nofollow')
    @php($ogImage = trim($__env->yieldContent('og_image', $seoSettings?->default_og_image ?: asset('favicon.ico'))))
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    @if ($metaKeywords !== '')
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    <meta name="robots" content="{{ $robotsDirective }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta property="og:site_name" content="{{ $siteTitle }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    @if ($seoSettings?->google_search_console_verification)
        <meta name="google-site-verification" content="{{ $seoSettings->google_search_console_verification }}">
    @endif
    @if ($seoSettings?->bing_webmaster_verification)
        <meta name="msvalidate.01" content="{{ $seoSettings->bing_webmaster_verification }}">
    @endif
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'AutoDealer',
            'name' => $seoSettings?->business_name ?: $siteTitle,
            'url' => $canonicalBaseUrl,
            'telephone' => $seoSettings?->business_phone,
            'email' => $seoSettings?->business_email,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $seoSettings?->business_address,
            ],
            'image' => $ogImage,
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $siteTitle,
            'url' => $canonicalBaseUrl,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => $canonicalBaseUrl . route('inventory.all', [], false) . '?keyword={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($marketingSettings?->meta_pixel_id)
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $marketingSettings->meta_pixel_id }}');
            fbq('track', 'PageView');
        </script>
    @endif
    @if ($marketingSettings?->google_tag_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $marketingSettings->google_tag_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $marketingSettings->google_tag_id }}');
        </script>
    @endif
    @if ($seoSettings?->google_analytics_measurement_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoSettings->google_analytics_measurement_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seoSettings->google_analytics_measurement_id }}');
        </script>
    @endif
    @if ($marketingSettings?->tiktok_pixel_id)
        <script>
            !function (w, d, t) {
                w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"];
                ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);
                ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){
                var r="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{};ttq._i[e]=[];ttq._i[e]._u=r;ttq._t=ttq._t||{};ttq._t[e]=+new Date;ttq._o=ttq._o||{};ttq._o[e]=n||{};
                n=document.createElement("script");n.type="text/javascript";n.async=!0;n.src=r+"?sdkid="+e+"&lib="+t;
                e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
                ttq.load('{{ $marketingSettings->tiktok_pixel_id }}'); ttq.page();
            }(window, document, 'ttq');
        </script>
    @endif
    @if ($marketingSettings?->snapchat_pixel_id)
        <script>
            (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
            {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
            a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
            r.src=n;var u=t.getElementsByTagName(s)[0];u.parentNode.insertBefore(r,u);})
            (window,document,'https://sc-static.net/scevent.min.js');
            snaptr('init', '{{ $marketingSettings->snapchat_pixel_id }}');
            snaptr('track', 'PAGE_VIEW');
        </script>
    @endif
    @if ($marketingSettings?->pinterest_tag_id)
        <script>
            !function(e){if(!window.pintrk){window.pintrk = function () {
            window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
            n=window.pintrk;n.queue=[],n.version="3.0";var
            t=document.createElement("script");t.async=!0,t.src=e;var
            r=document.getElementsByTagName("script")[0];r.parentNode.insertBefore(t,r)}}
            ("https://s.pinimg.com/ct/core.js");
            pintrk('load', '{{ $marketingSettings->pinterest_tag_id }}');
            pintrk('page');
        </script>
    @endif
    @if ($marketingSettings?->linkedin_partner_id)
        <script type="text/javascript">
            _linkedin_partner_id = "{{ $marketingSettings->linkedin_partner_id }}";
            window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
            window._linkedin_data_partner_ids.push(_linkedin_partner_id);
        </script>
        <script type="text/javascript">
            (function(l) {
                if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
                window.lintrk.q=[]}
                var s = document.getElementsByTagName("script")[0];
                var b = document.createElement("script");
                b.type = "text/javascript";b.async = true;
                b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
                s.parentNode.insertBefore(b, s);
            })(window.lintrk);
        </script>
    @endif
    @if ($marketingSettings?->custom_head_scripts)
        {!! $marketingSettings->custom_head_scripts !!}
    @endif
    @yield('styles')
</head>

<body class="selection:bg-ember selection:text-white">
    @if ($marketingSettings?->custom_body_scripts)
        {!! $marketingSettings->custom_body_scripts !!}
    @endif
    @if ($marketingSettings?->meta_pixel_id)
        <noscript>
            <img height="1" width="1" style="display:none" alt=""
                src="https://www.facebook.com/tr?id={{ $marketingSettings->meta_pixel_id }}&ev=PageView&noscript=1" />
        </noscript>
    @endif
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
        href="https://wa.me/13127359915"
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
