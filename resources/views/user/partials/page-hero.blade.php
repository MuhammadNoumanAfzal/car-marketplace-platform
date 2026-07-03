<section class="relative z-10 overflow-hidden bg-asphalt pb-12 pt-32 sm:pb-14 sm:pt-36">
    <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
        <div class="page-hero">
            <div class="page-hero__copy reveal-card" data-reveal>
                <p class="section-label">{{ $eyebrow }}</p>
                <h1 class="page-hero__title">{{ $title }}</h1>
                <p class="page-hero__text">{{ $copy }}</p>
            </div>

            @if (!empty($media))
                <div class="page-hero__media reveal-card" data-reveal data-reveal-delay="90">
                    <div class="page-hero__frame">
                        <div class="page-hero__image" style="background-image: {{ $media }}"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
