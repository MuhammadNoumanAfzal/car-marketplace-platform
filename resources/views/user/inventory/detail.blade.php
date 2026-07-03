@extends('layouts.user')

@section('title', 'Nitro Motors USA | ' . $vehicle['year'] . ' ' . $vehicle['make'] . ' ' . $vehicle['model'])
@section('meta_description', 'View details for the ' . $vehicle['year'] . ' ' . $vehicle['make'] . ' ' . $vehicle['model'] . ' at Nitro Motors USA.')

@section('content')
    <section class="relative z-10 bg-asphalt pb-16 pt-32 sm:pt-36">
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="vehicle-detail-shell">
                <a href="{{ $vehicle['status'] === 'sold' ? route('inventory.sold') : route('inventory.all') }}" class="vehicle-detail-back">
                    <span>&#8592;</span>
                    <span>Back To {{ $vehicle['status'] === 'sold' ? 'Sold Inventory' : 'Inventory' }}</span>
                </a>

                <div class="vehicle-detail-grid">
                    <aside class="vehicle-detail-sidebar">
                        <div class="vehicle-detail-sidebar__card">
                            <p class="section-label text-xs sm:text-sm">{{ $vehicle['status'] === 'sold' ? 'Recently Sold' : 'Available Now' }}</p>
                            <h1 class="vehicle-detail-sidebar__title">{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}</h1>
                            <p class="vehicle-detail-sidebar__trim">{{ $vehicle['trim'] }}</p>

                            <div class="vehicle-detail-price-card">
                                <span class="vehicle-detail-price-card__label">{{ $vehicle['status'] === 'sold' ? 'Sale Status' : 'Listed Price' }}</span>
                                <strong class="vehicle-detail-price-card__value">{{ $vehicle['price'] }}</strong>
                                @if ($vehicle['status'] !== 'sold')
                                    <p class="vehicle-detail-price-card__meta">Total with fees: {{ $vehicle['total_price'] }}</p>
                                @endif
                            </div>

                            <div class="vehicle-detail-specs">
                                <div class="vehicle-detail-specs__row"><span>Mileage</span><strong>{{ $vehicle['mileage'] }} mi</strong></div>
                                <div class="vehicle-detail-specs__row"><span>Stock</span><strong>{{ $vehicle['stock'] }}</strong></div>
                                <div class="vehicle-detail-specs__row"><span>VIN</span><strong>{{ $vehicle['vin'] }}</strong></div>
                                <div class="vehicle-detail-specs__row"><span>Engine</span><strong>{{ $vehicle['engine'] }}</strong></div>
                                <div class="vehicle-detail-specs__row"><span>Transmission</span><strong>{{ $vehicle['transmission'] }}</strong></div>
                                <div class="vehicle-detail-specs__row"><span>Drivetrain</span><strong>{{ $vehicle['drivetrain'] }}</strong></div>
                                <div class="vehicle-detail-specs__row"><span>Exterior</span><strong>{{ $vehicle['exterior'] }}</strong></div>
                                <div class="vehicle-detail-specs__row"><span>Interior</span><strong>{{ $vehicle['interior'] }}</strong></div>
                                <div class="vehicle-detail-specs__row"><span>Fuel</span><strong>{{ $vehicle['fuel'] }}</strong></div>
                            </div>

                            <div class="vehicle-detail-actions">
                                <a href="{{ route('contact') }}" class="search-band__button w-full justify-center">
                                    <span>{{ $vehicle['status'] === 'sold' ? 'Ask About Similar Vehicles' : 'Contact For Availability' }}</span>
                                </a>
                                <a href="{{ route('appointment') }}" class="vehicle-detail-actions__secondary">Call: +1 (305) 555-0147</a>
                            </div>
                        </div>
                    </aside>

                    <div class="vehicle-detail-content">
                        <div class="vehicle-detail-gallery">
                            <div class="vehicle-detail-gallery__hero">
                                <img src="{{ $vehicle['gallery'][0] }}" alt="{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}" class="vehicle-detail-gallery__hero-image">
                                @if ($vehicle['status'] === 'sold')
                                    <div class="vehicle-detail-gallery__status">Sold</div>
                                @endif
                            </div>

                            <div class="vehicle-detail-gallery__thumbs">
                                @foreach ($vehicle['gallery'] as $image)
                                    <div class="vehicle-detail-gallery__thumb">
                                        <img src="{{ $image }}" alt="{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }} gallery image" class="vehicle-detail-gallery__thumb-image">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <nav class="vehicle-detail-tabs" data-detail-tabs>
                            <a href="#description" class="vehicle-detail-tabs__link is-active" data-detail-tab-link>Description</a>
                            <a href="#features" class="vehicle-detail-tabs__link" data-detail-tab-link>Features</a>
                            <a href="#photos" class="vehicle-detail-tabs__link" data-detail-tab-link>Photos</a>
                            <a href="#finance" class="vehicle-detail-tabs__link" data-detail-tab-link>Finance</a>
                            <a href="#contact" class="vehicle-detail-tabs__link" data-detail-tab-link>Contact Us</a>
                        </nav>

                        <div class="vehicle-detail-panels">
                            <section id="description" class="vehicle-detail-panel" data-detail-tab-section>
                                <p class="vehicle-detail-panel__eyebrow">Description</p>
                                <p class="vehicle-detail-panel__copy">{{ $vehicle['description'] }}</p>
                            </section>

                            <section id="features" class="vehicle-detail-panel" data-detail-tab-section>
                                <p class="vehicle-detail-panel__eyebrow">Highlights</p>
                                <div class="vehicle-detail-feature-grid">
                                    @foreach ($vehicle['features'] as $feature)
                                        <div class="vehicle-detail-feature">{{ $feature }}</div>
                                    @endforeach
                                </div>
                            </section>

                            <section id="photos" class="vehicle-detail-panel" data-detail-tab-section>
                                <p class="vehicle-detail-panel__eyebrow">Photos</p>
                                <div class="vehicle-detail-photo-grid">
                                    @foreach ($vehicle['gallery'] as $image)
                                        <div class="vehicle-detail-photo-grid__item">
                                            <img src="{{ $image }}" alt="{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }} photo" class="vehicle-detail-photo-grid__image">
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <section id="finance" class="vehicle-detail-panel" data-detail-tab-section>
                                <p class="vehicle-detail-panel__eyebrow">Finance</p>
                                <div class="vehicle-detail-finance-grid">
                                    <div class="vehicle-detail-finance-card">
                                        <span class="vehicle-detail-finance-card__label">Estimated Down Payment</span>
                                        <strong class="vehicle-detail-finance-card__value">{{ $vehicle['status'] === 'sold' ? 'Ask Us' : '$4,500' }}</strong>
                                    </div>
                                    <div class="vehicle-detail-finance-card">
                                        <span class="vehicle-detail-finance-card__label">Estimated Monthly</span>
                                        <strong class="vehicle-detail-finance-card__value">{{ $vehicle['status'] === 'sold' ? 'Contact Team' : '$689/mo' }}</strong>
                                    </div>
                                    <div class="vehicle-detail-finance-card">
                                        <span class="vehicle-detail-finance-card__label">Finance Support</span>
                                        <strong class="vehicle-detail-finance-card__value">Available Nationwide</strong>
                                    </div>
                                </div>
                                <p class="vehicle-detail-panel__copy">We can help with financing guidance, trade-in coordination, and remote paperwork support so the purchase feels organized from first inquiry to delivery.</p>
                            </section>

                            <section id="contact" class="vehicle-detail-panel" data-detail-tab-section>
                                <p class="vehicle-detail-panel__eyebrow">Contact Us</p>
                                <div class="vehicle-detail-contact-grid">
                                    <a href="{{ route('contact') }}" class="vehicle-detail-contact-card">
                                        <span class="vehicle-detail-contact-card__title">Message The Team</span>
                                        <span class="vehicle-detail-contact-card__copy">Ask for availability, pricing breakdown, trade-in help, or a walkaround.</span>
                                    </a>
                                    <a href="{{ route('appointment') }}" class="vehicle-detail-contact-card">
                                        <span class="vehicle-detail-contact-card__title">Book An Appointment</span>
                                        <span class="vehicle-detail-contact-card__copy">Schedule a showroom visit or a virtual vehicle walkthrough.</span>
                                    </a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
