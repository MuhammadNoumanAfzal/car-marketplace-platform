@extends('layouts.user')

@section('title', 'Nitro Motors USA | All Inventory')
@section('meta_description', 'Browse all available inventory at Nitro Motors USA.')

@section('content')
    <section class="relative z-10 bg-asphalt pb-16 pt-32 sm:pt-36">
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="inventory-page-shell">
                <div class="search-band rounded-[32px] border border-white/10 px-5 py-6 shadow-[0_20px_70px_rgba(0,0,0,0.35)] sm:px-6 lg:px-8">
                    <div class="grid gap-5 xl:grid-cols-[repeat(5,minmax(0,1fr))]">
                        <label class="block">
                            <span class="search-band__label">By Year</span>
                            <select class="search-band__field">
                                @foreach ($filters['years'] as $item)<option>{{ $item }}</option>@endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Make</span>
                            <select class="search-band__field">
                                @foreach ($filters['makes'] as $item)<option>{{ $item }}</option>@endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Model</span>
                            <select class="search-band__field">
                                @foreach ($filters['models'] as $item)<option>{{ $item }}</option>@endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Mileage</span>
                            <select class="search-band__field">
                                @foreach ($filters['mileages'] as $item)<option>{{ $item }}</option>@endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Trim</span>
                            <select class="search-band__field">
                                @foreach ($filters['trims'] as $item)<option>{{ $item }}</option>@endforeach
                            </select>
                        </label>
                    </div>

                    <div class="mt-5 grid gap-4 lg:grid-cols-[1.4fr_0.7fr_auto]">
                        <label class="block">
                            <span class="search-band__label">Search By Keyword</span>
                            <input type="text" class="search-band__field" placeholder="Search by keyword">
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Price</span>
                            <select class="search-band__field">
                                @foreach ($filters['prices'] as $item)<option>{{ $item }}</option>@endforeach
                            </select>
                        </label>
                        <div class="flex items-end">
                            <button class="search-band__button w-full lg:w-auto"><span class="text-2xl leading-none">&#9906;</span><span>Search</span></button>
                        </div>
                    </div>
                </div>

                <div class="inventory-page-head">
                    <div>
                        <p class="section-label text-sm sm:text-base">Available Now</p>
                        <h2 class="inventory-page-title">Shop every active vehicle in the showroom.</h2>
                    </div>
                    <a href="{{ route('inventory.sold') }}" class="inventory-cta-link">View Sold Inventory</a>
                </div>

                <div class="grid gap-5 xl:grid-cols-3">
                    @foreach ($featuredInventory as $vehicle)
                        <article class="inventory-card-showcase">
                            <div class="inventory-card-showcase__media">
                                <div class="inventory-card-showcase__topbar">
                                    <button type="button" class="inventory-card-showcase__utility">&#9733; Save</button>
                                    <button type="button" class="inventory-card-showcase__utility">&#9993; Text To Phone</button>
                                </div>
                                <a href="{{ route('inventory.detail', $vehicle['stock']) }}" class="inventory-card-showcase__image-wrap">
                                    <img src="{{ $vehicle['image'] }}" alt="{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}" class="inventory-card-showcase__image">
                                    <div class="inventory-card-showcase__overlay">
                                        <span class="inventory-card-showcase__overlay-button">View Details</span>
                                    </div>
                                </a>
                            </div>

                            <a href="{{ route('inventory.detail', $vehicle['stock']) }}" class="inventory-card-showcase__body">
                                <div class="inventory-card-showcase__heading">
                                    <h3 class="inventory-card-showcase__title">{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}</h3>
                                    <p class="inventory-card-showcase__price">Price: {{ $vehicle['price'] }}</p>
                                </div>

                                <dl class="inventory-card-showcase__fees">
                                    <div class="inventory-card-showcase__fee-row"><dt>Documentation Fee:</dt><dd>{{ $vehicle['doc_fee'] }}</dd></div>
                                    <div class="inventory-card-showcase__fee-row"><dt>Electronic Filing Fee:</dt><dd>{{ $vehicle['filing_fee'] }}</dd></div>
                                    <div class="inventory-card-showcase__fee-row"><dt>Temporary Tag:</dt><dd>{{ $vehicle['tag_fee'] }}</dd></div>
                                </dl>

                                <div class="inventory-card-showcase__total">
                                    <span>Total Price:</span>
                                    <strong>{{ $vehicle['total_price'] }}</strong>
                                </div>
                            </a>

                            <a href="{{ route('inventory.detail', $vehicle['stock']) }}" class="inventory-card-showcase__meta">
                                <span>&#9716; {{ $vehicle['mileage'] }} mi</span>
                                <span>&#35; {{ $vehicle['stock'] }}</span>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
