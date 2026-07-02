<section @if (($sectionId ?? null)) id="{{ $sectionId }}" @endif class="relative z-10 bg-asphalt pb-16">
    <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
        <div class="page-cta">
            <div>
                <p class="page-cta__eyebrow">{{ $eyebrow }}</p>
                <h2 class="page-cta__title">{{ $title }}</h2>
                <p class="page-cta__copy">{{ $copy }}</p>
            </div>

            <div class="page-cta__actions">
                <a href="{{ $primaryUrl }}" class="hero-actions__primary">
                    <span>{{ $primaryLabel }}</span>
                    <span class="hero-actions__arrow">&#8594;</span>
                </a>

                @if (!empty($secondaryLabel) && !empty($secondaryUrl))
                    <a href="{{ $secondaryUrl }}" class="hero-actions__secondary">
                        <span class="hero-actions__secondary-line"></span>
                        <span>{{ $secondaryLabel }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
