<header class="absolute inset-x-0 top-0 z-30">
    <div class="mx-auto flex w-full max-w-[1600px] items-center justify-between px-4 py-6 sm:px-8 lg:px-12 xl:px-16">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-ember text-lg font-bold text-white shadow-glow">N</span>
            <div>
                <p class="font-display text-lg font-semibold tracking-wide text-white">Nitro Motors USA</p>
                <p class="text-xs uppercase tracking-[0.28em] text-slate-400">Premium Auto Gallery</p>
            </div>
        </a>

        <nav class="hidden items-center gap-8 text-sm font-medium text-slate-200 lg:flex">
            <a href="{{ route('home') }}" class="header-link {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('home') }}#inventory" class="header-link">Inventory</a>

            <div class="header-dropdown">
                <a href="{{ route('services.shipping') }}" class="header-link {{ request()->routeIs('services.shipping', 'services.consignment') ? 'is-active' : '' }}">
                    <span>Services</span>
                </a>
                <div class="header-dropdown__menu">
                    <a href="{{ route('services.shipping') }}" class="header-dropdown__item">Vehicle Shipping</a>
                    <a href="{{ route('services.consignment') }}" class="header-dropdown__item">Consignment</a>
                </div>
            </div>

            <div class="header-dropdown">
                <a href="{{ route('about') }}" class="header-link {{ request()->routeIs('about', 'testimonials', 'directions') ? 'is-active' : '' }}">
                    <span>About Us</span>
                </a>
                <div class="header-dropdown__menu">
                    <a href="https://www.instagram.com/" target="_blank" rel="noreferrer" class="header-dropdown__item">Visit Our Instagram</a>
                    <a href="{{ route('testimonials') }}" class="header-dropdown__item">Testimonials</a>
                    <a href="{{ route('directions') }}" class="header-dropdown__item">Directions</a>
                </div>
            </div>

            <a href="{{ route('appointment') }}" class="header-link {{ request()->routeIs('appointment') ? 'is-active' : '' }}">Appointment</a>
            <a href="{{ route('contact') }}" class="header-link {{ request()->routeIs('contact') ? 'is-active' : '' }}">Contact Us</a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}#inventory" class="hidden rounded-full border border-white/15 px-5 py-2.5 text-sm font-semibold text-white transition hover:border-white/30 hover:bg-white/5 sm:inline-flex">Explore Cars</a>
            <a href="{{ route('appointment') }}#quick-contact" class="inline-flex rounded-full bg-ember px-5 py-2.5 text-sm font-semibold text-white shadow-glow transition hover:bg-red-500">Book a Call</a>
        </div>
    </div>
</header>
