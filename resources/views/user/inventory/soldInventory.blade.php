@extends('layouts.user')

@section('title', 'Nitro Motors USA | Sold Inventory')
@section('meta_description', 'Browse recently sold inventory at Nitro Motors USA.')

@section('content')
    <section class="relative z-10 bg-asphalt pb-16 pt-32 sm:pt-36" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="inventory-page-shell">
                <form action="{{ route('inventory.sold') }}" method="GET" class="search-band reveal-card rounded-[32px] border border-white/10 px-5 py-6 shadow-[0_20px_70px_rgba(0,0,0,0.35)] sm:px-6 lg:px-8" data-reveal>
                    <div class="grid gap-5 xl:grid-cols-[repeat(5,minmax(0,1fr))]">
                        <label class="block">
                            <span class="search-band__label">By Year</span>
                            <select name="year" class="search-band__field">
                                <option value="">Year</option>
                                @foreach ($filters['years'] as $item)
                                    <option value="{{ $item }}" @selected($filters['selected']['year'] === (string) $item)>{{ $item }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Make</span>
                            <select name="make" class="search-band__field">
                                <option value="">Make</option>
                                @foreach ($filters['makes'] as $item)
                                    <option value="{{ $item }}" @selected($filters['selected']['make'] === $item)>{{ $item }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Model</span>
                            <select name="model" class="search-band__field">
                                <option value="">Model</option>
                                @foreach ($filters['models'] as $item)
                                    <option value="{{ $item }}" @selected($filters['selected']['model'] === $item)>{{ $item }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Mileage</span>
                            <select name="max_mileage" class="search-band__field">
                                <option value="">Mileage</option>
                                @foreach ($filters['mileages'] as $item)
                                    <option value="{{ $item['value'] }}" @selected($filters['selected']['max_mileage'] === $item['value'])>{{ $item['label'] }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Trim</span>
                            <select name="trim" class="search-band__field">
                                <option value="">Trim</option>
                                @foreach ($filters['trims'] as $item)
                                    <option value="{{ $item }}" @selected($filters['selected']['trim'] === $item)>{{ $item }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="mt-5 grid gap-4 lg:grid-cols-[1.4fr_0.7fr_auto]">
                        <label class="block">
                            <span class="search-band__label">Search By Keyword</span>
                            <input type="text" name="keyword" class="search-band__field" value="{{ $filters['selected']['keyword'] }}" placeholder="Search sold vehicles">
                        </label>
                        <label class="block">
                            <span class="search-band__label">By Price</span>
                            <select name="price_range" class="search-band__field">
                                @foreach ($filters['prices'] as $item)
                                    <option value="{{ $item['value'] }}" @selected($filters['selected']['price_range'] === $item['value'])>{{ $item['label'] }}</option>
                                @endforeach
                            </select>
                        </label>
                        <div class="flex items-end">
                            <button type="submit" class="search-band__button w-full lg:w-auto"><span class="text-2xl leading-none">&#9906;</span><span>Search</span></button>
                        </div>
                    </div>
                </form>

                <div class="inventory-page-head reveal-card" data-reveal data-reveal-delay="70">
                    <div>
                        <p class="section-label text-sm sm:text-base">Recently Sold</p>
                        <h2 class="inventory-page-title">A look at vehicles that have already moved.</h2>
                    </div>
                    <a href="{{ route('inventory.all') }}" class="inventory-cta-link">Browse Active Inventory</a>
                </div>

                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    @forelse ($soldInventory as $vehicle)
                        <article class="sold-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 85 }}">
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
                    @empty
                        <div class="reveal-card rounded-[24px] border border-white/10 bg-white/[0.03] px-6 py-8 text-zinc-300 md:col-span-2 xl:col-span-4" data-reveal data-reveal-delay="120">
                            No sold inventory matches these filters yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
