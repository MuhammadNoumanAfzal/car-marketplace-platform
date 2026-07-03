@extends('layouts.user')

@section('title', 'Nitro Motors USA | Sold Inventory')
@section('meta_description', 'Browse recently sold inventory at Nitro Motors USA.')

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
                            <input type="text" class="search-band__field" placeholder="Search sold vehicles">
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
                        <p class="section-label text-sm sm:text-base">Recently Sold</p>
                        <h2 class="inventory-page-title">A look at vehicles that have already moved.</h2>
                    </div>
                    <a href="{{ route('inventory.all') }}" class="inventory-cta-link">Browse Active Inventory</a>
                </div>

                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    @foreach ($soldInventory as $vehicle)
                        <article class="sold-card">
                            <div class="sold-card__topbar">
                                <button type="button" class="inventory-card-showcase__utility">&#9734; Save</button>
                                <button type="button" class="inventory-card-showcase__utility">&#9993; Text To Phone</button>
                            </div>

                            <a href="{{ route('inventory.sold.detail', $vehicle['stock']) }}" class="sold-card__media">
                                <img src="{{ $vehicle['image'] }}" alt="{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}" class="sold-card__image">
                                <div class="sold-card__overlay">
                                    <span class="sold-card__button">View Details</span>
                                </div>
                                <div class="sold-card__stamp">SOLD</div>
                            </a>

                            <a href="{{ route('inventory.sold.detail', $vehicle['stock']) }}" class="sold-card__body">
                                <h3 class="sold-card__title">{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}</h3>
                                <p class="sold-card__price">Price: {{ $vehicle['price'] }}</p>
                            </a>

                            <a href="{{ route('inventory.sold.detail', $vehicle['stock']) }}" class="sold-card__meta">
                                <span>&#9716; {{ $vehicle['mileage'] }}</span>
                                <span>&#35; {{ $vehicle['stock'] }}</span>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
