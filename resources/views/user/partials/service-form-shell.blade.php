<section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
    <div class="mx-auto grid w-full max-w-[1600px] gap-5 px-4 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:px-12 xl:px-16">
        <div class="contact-panel reveal-card" data-reveal>
            {!! $sidebar !!}
        </div>

        <div class="contact-form-card reveal-card" data-reveal data-reveal-delay="100">
            @if (session('status'))
                <div class="contact-alert" role="status">
                    {{ session('status') }}
                </div>
            @endif

            {!! $form !!}
        </div>
    </div>
</section>
