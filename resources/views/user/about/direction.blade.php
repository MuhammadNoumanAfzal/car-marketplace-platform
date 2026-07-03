@extends('layouts.user')

@section('title', 'Directions | Nitro Motors USA')
@section('meta_description', 'Find Nitro Motors USA, view directions, nearby landmarks, showroom hours, and contact details.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Directions',
        'title' => 'Find the showroom fast and arrive with the details you need.',
        'copy' => 'View location details, nearby landmarks, working hours, and the easiest route to connect with the Nitro Motors USA team.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.22), rgba(10,10,10,0.64)), url('https://images.unsplash.com/photo-1489824904134-891ab64532f1?auto=format&fit=crop&w=1400&q=80')",
    ])

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="location-page-grid">
                <div class="map-panel reveal-card" data-reveal>
                    <div class="map-panel__canvas">
                        <div class="map-panel__overlay">
                            <p class="map-panel__label">Google Maps</p>
                            <h2 class="map-panel__title">1450 NW 79th Avenue, Miami, FL 33126</h2>
                            <p class="map-panel__copy">Embed your final Google Maps iframe here when the production location link is ready.</p>
                        </div>
                    </div>
                </div>

                <div class="direction-panel reveal-card" data-reveal data-reveal-delay="90">
                    <div class="direction-panel__group">
                        <p class="direction-panel__eyebrow">Showroom</p>
                        <h3 class="direction-panel__title">Nitro Motors USA</h3>
                        <p class="direction-panel__copy">1450 NW 79th Avenue<br>Miami, FL 33126</p>
                    </div>

                    <div class="direction-panel__group">
                        <p class="direction-panel__eyebrow">Contact</p>
                        <p class="direction-panel__copy">Phone: +1 (305) 555-0147<br>Email: info@nitromotorsusa.com</p>
                    </div>

                    <div class="direction-panel__group">
                        <p class="direction-panel__eyebrow">Working Hours</p>
                        <p class="direction-panel__copy">Monday - Friday: 10:00 AM - 7:00 PM<br>Saturday - Sunday: By Appointment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="grid gap-5 lg:grid-cols-[1.05fr_0.95fr]">
                <div class="route-card reveal-card" data-reveal>
                    <p class="route-card__eyebrow">Step By Step</p>
                    <h2 class="route-card__title">The easiest way to reach the showroom.</h2>

                    <div class="mt-6 space-y-4">
                        @foreach ($directions as $direction)
                            <div class="route-step reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 70 }}">
                                <div class="route-step__count">0{{ $loop->iteration }}</div>
                                <p class="route-step__copy">{{ $direction }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="route-card reveal-card" data-reveal data-reveal-delay="110">
                    <p class="route-card__eyebrow">Nearby Landmarks</p>
                    <h2 class="route-card__title">Useful reference points before you arrive.</h2>

                    <div class="mt-6 grid gap-4">
                        @foreach ($landmarks as $landmark)
                            <div class="landmark-pill reveal-card" data-reveal data-reveal-delay="{{ 120 + ($loop->index * 65) }}">{{ $landmark }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('user.partials.page-cta', [
        'eyebrow' => 'Quick Contact',
        'title' => 'Need help before you visit?',
        'copy' => 'Call ahead for a virtual walkaround, route support, or appointment scheduling.',
        'primaryLabel' => 'Read Testimonials',
        'primaryUrl' => route('testimonials'),
        'secondaryLabel' => 'About Us',
        'secondaryUrl' => route('about'),
    ])
@endsection
