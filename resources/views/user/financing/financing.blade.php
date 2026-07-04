@extends('layouts.user')

@section('title', 'Financing | Nitro Motors USA')
@section('meta_description', 'Explore financing guidance from Nitro Motors USA with a clear, buyer-friendly path from vehicle selection to monthly payment planning.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Financing',
        'title' => 'A smoother financing path for buyers who want clarity before commitment.',
        'copy' => 'Nitro Motors USA helps buyers think through budget, trade-in value, down payment, and vehicle fit so financing feels structured, not stressful.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.22), rgba(10,10,10,0.64)), url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1400&q=80')",
    ])

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] space-y-6 px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="finance-summary-grid">
                @foreach ($highlights as $highlight)
                    <article class="finance-metric-card reveal-card" data-reveal>
                        <p class="finance-metric-card__label">{{ $highlight['label'] }}</p>
                        <h2 class="finance-metric-card__value">{{ $highlight['value'] }}</h2>
                    </article>
                @endforeach
            </div>

            <div class="page-story">
                <article class="page-story__lead reveal-card" data-reveal>
                    <p class="section-label">Why Finance With Us</p>
                    <h2 class="section-title mt-4">We keep the conversation centered on fit, flexibility, and confidence.</h2>
                    <p class="page-story__copy">Good financing support is not just about rates. It is about matching the right vehicle, payment comfort, ownership timeline, and trade-in strategy to your real situation.</p>
                    <p class="page-story__copy">Whether you are buying locally or from another state, our goal is to make the process feel understandable from the first question to the final paperwork step.</p>
                </article>

                <div class="finance-benefit-stack">
                    @foreach ($benefits as $benefit)
                        <article class="page-highlight-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 80 }}">
                            <h3 class="page-highlight-card__title">{{ $benefit['title'] }}</h3>
                            <p class="page-highlight-card__copy">{{ $benefit['copy'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="finance-process-grid">
                <article class="finance-process-card reveal-card" data-reveal>
                    <p class="section-label">How It Works</p>
                    <h2 class="section-title mt-4">Three steps to move from interest to a real financing plan.</h2>

                    <div class="mt-6 space-y-4">
                        @foreach ($steps as $step)
                            <div class="journey-step">
                                <span class="journey-step__count">{{ $loop->iteration }}</span>
                                <p class="route-step__copy">{{ $step }}</p>
                            </div>
                        @endforeach
                    </div>
                </article>

                <article class="finance-checklist-card reveal-card" data-reveal data-reveal-delay="100">
                    <p class="contact-panel__eyebrow">Helpful To Have Ready</p>
                    <h2 class="contact-panel__title">A few details make the financing conversation faster.</h2>
                    <div class="finance-checklist">
                        <div class="finance-checklist__item">Preferred monthly payment range</div>
                        <div class="finance-checklist__item">Approximate down payment amount</div>
                        <div class="finance-checklist__item">Trade-in vehicle details if applicable</div>
                        <div class="finance-checklist__item">Desired vehicle type or stock number</div>
                        <div class="finance-checklist__item">Timeline for purchase and delivery</div>
                    </div>
                </article>
            </div>

            <div class="finance-faq-grid">
                @foreach ($faqs as $faq)
                    <article class="finance-faq-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 70 }}">
                        <p class="finance-faq-card__question">{{ $faq['question'] }}</p>
                        <p class="finance-faq-card__answer">{{ $faq['answer'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('user.partials.page-cta', [
        'eyebrow' => 'Ready To Start?',
        'title' => 'Let’s talk about the vehicle, budget, and financing path that fits best.',
        'copy' => 'Start with inventory, book a consultation, or send us a message and we will help you map out the next step.',
        'primaryLabel' => 'Book Financing Call',
        'primaryUrl' => route('appointment'),
        'secondaryLabel' => 'Browse Inventory',
        'secondaryUrl' => route('inventory.all'),
    ])
@endsection
