<footer id="contact" class="relative z-10 bg-asphalt pb-8 pt-16">
    <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
        <div class="footer-showcase">
            <div class="footer-showcase__hero">
                <div class="footer-showcase__hero-grid">
                    <div>
                        <p class="section-label">Nitro Motors USA</p>
                        <h2 class="footer-showcase__title">
                            Premium inventory, trusted guidance, and a refined dealership experience.
                        </h2>
                    </div>

                    <div class="footer-showcase__summary">
                        <p class="footer-showcase__copy">
                            Nitro Motors USA helps buyers move from discovery to delivery with cleaner listings, better communication, and premium support.
                        </p>

                        <div class="footer-showcase__actions">
                            <a href="{{ route('inventory.all') }}" class="hero-actions__primary">
                                <span>Browse Inventory</span>
                                <span class="hero-actions__arrow">&#8594;</span>
                            </a>
                            <a href="{{ route('appointment') }}#quick-contact" class="hero-actions__secondary">
                                <span class="hero-actions__secondary-line"></span>
                                <span>Book A Call</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-showcase__grid">
                <div class="footer-panel footer-panel--brand">
                    <div class="flex items-center gap-3">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-ember text-lg font-bold text-white shadow-glow">N</span>
                        <div>
                            <p class="font-display text-lg font-semibold text-white">Nitro Motors USA</p>
                            <p class="text-xs uppercase tracking-[0.3em] text-zinc-400">Premium Auto Gallery</p>
                        </div>
                    </div>

                    <div class="footer-meter">
                        <span class="footer-meter__label">Nationwide buyer support</span>
                        <div class="footer-meter__track">
                            <span class="footer-meter__fill"></span>
                        </div>
                        <span class="footer-meter__value">Active across 30+ states</span>
                    </div>
                </div>

                <div class="footer-panel">
                    <p class="footer-panel__title">Showroom</p>
                    <div class="footer-list">
                        <p>Miami, Florida</p>
                        <p>Mon - Fri: 10:00 AM to 7:00 PM</p>
                        <p>Saturday - Sunday: By Appointment</p>
                    </div>
                </div>

                <div class="footer-panel">
                    <p class="footer-panel__title">Contact</p>
                    <div class="footer-list">
                        <p>sales@nitromotorsusa.com</p>
                        <p>+1 (305) 555-0147</p>
                        <p>Trade-in, financing, and remote buying support</p>
                    </div>
                </div>

                <div class="footer-panel">
                    <p class="footer-panel__title">Follow The Inventory</p>
                    <div class="footer-list">
                        <p>Instagram showroom updates</p>
                        <p>YouTube walkarounds</p>
                        <p>Daily vehicle highlights and arrivals</p>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-bottom__copy">&copy; {{ date('Y') }} Nitro Motors USA. Premium automotive presentation across the USA.</p>
                <div class="footer-bottom__links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('inventory.all') }}">Inventory</a>
                    <a href="{{ route('about') }}">About Us</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>
