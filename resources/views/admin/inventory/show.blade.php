@extends('layouts.admin')

@php
    $mainImage = $inventory->main_image
        ? (preg_match('/^https?:\/\//i', $inventory->main_image)
            ? $inventory->main_image
            : (str_starts_with($inventory->main_image, 'storage/')
                ? asset($inventory->main_image)
                : asset('storage/' . ltrim($inventory->main_image, '/'))))
        : 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1200&q=80';

    $gallery = collect($inventory->gallery ?? [])
        ->filter()
        ->map(function ($image) {
            if (preg_match('/^https?:\/\//i', $image)) {
                return $image;
            }

            return str_starts_with($image, 'storage/')
                ? asset($image)
                : asset('storage/' . ltrim($image, '/'));
        })
        ->values();

    if ($gallery->isEmpty()) {
        $gallery = collect([$mainImage]);
    }
@endphp

@section('style')
    <style>
        .inventory-detail-shell {
            max-width: 1240px;
            margin: 0 auto;
        }

        .inventory-detail-card,
        .inventory-detail-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 16px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .inventory-detail-card {
            padding: 28px;
            margin-bottom: 20px;
        }

        .inventory-detail-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(320px, 0.9fr);
            gap: 22px;
        }

        .inventory-detail-kicker {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d62034;
            margin-bottom: 8px;
        }

        .inventory-detail-title {
            font-size: 34px;
            font-weight: 700;
            color: #0b1f4d;
            margin: 0 0 8px;
        }

        .inventory-detail-copy {
            color: #47639d;
            margin-bottom: 18px;
        }

        .inventory-detail-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }

        .inventory-btn-primary,
        .inventory-btn-secondary {
            min-height: 46px;
            padding: 0 18px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            font-weight: 600;
        }

        .inventory-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            color: #ffffff;
        }

        .inventory-btn-secondary {
            background: #fff5f5;
            color: #c81e33;
            border: 1px solid #f3b3ba;
        }

        .inventory-main-image {
            width: 100%;
            aspect-ratio: 16 / 10;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #d9e4ff;
            background: #eef4ff;
        }

        .inventory-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
            gap: 12px;
            margin-top: 14px;
        }

        .inventory-gallery img {
            width: 100%;
            height: 86px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #d9e4ff;
            background: #eef4ff;
        }

        .inventory-detail-panel {
            padding: 22px;
        }

        .inventory-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .inventory-meta-item {
            padding: 14px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid #e1eaff;
        }

        .inventory-meta-label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #6c86bb;
            margin-bottom: 5px;
        }

        .inventory-meta-value {
            display: block;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        .inventory-section-title {
            font-size: 18px;
            font-weight: 700;
            color: #0b1f4d;
            margin: 0 0 14px;
        }

        .inventory-description {
            color: #334155;
            line-height: 1.7;
            white-space: pre-line;
        }

        .inventory-features {
            display: grid;
            gap: 10px;
        }

        .inventory-feature {
            padding: 12px 14px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #e1eaff;
            color: #153b8a;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .inventory-detail-grid {
                grid-template-columns: 1fr;
            }

            .inventory-meta {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="inventory-detail-shell">
        <div class="inventory-detail-card">
            <div class="inventory-detail-kicker">{{ ucfirst($inventory->status) }} Inventory</div>
            <h1 class="inventory-detail-title">{{ $inventory->year }} {{ $inventory->make }} {{ $inventory->model }}</h1>
            <p class="inventory-detail-copy">
                Stock {{ $inventory->stock }} {{ $inventory->trim ? ' | ' . $inventory->trim : '' }}
            </p>

            <div class="inventory-detail-grid">
                <div>
                    <img src="{{ $mainImage }}" alt="{{ $inventory->make }} {{ $inventory->model }}" class="inventory-main-image">

                    <div class="inventory-gallery">
                        @foreach ($gallery as $image)
                            <img src="{{ $image }}" alt="Vehicle photo">
                        @endforeach
                    </div>
                </div>

                <div class="inventory-detail-panel">
                    <h2 class="inventory-section-title">Vehicle Overview</h2>

                    <div class="inventory-meta">
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Status</span>
                            <span class="inventory-meta-value">{{ ucfirst($inventory->status) }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Featured</span>
                            <span class="inventory-meta-value">{{ $inventory->is_featured ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Price</span>
                            <span class="inventory-meta-value">${{ number_format((float) $inventory->price, 2) }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Mileage</span>
                            <span class="inventory-meta-value">{{ number_format((int) $inventory->mileage) }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">VIN</span>
                            <span class="inventory-meta-value">{{ $inventory->vin ?: 'N/A' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Engine</span>
                            <span class="inventory-meta-value">{{ $inventory->engine ?: 'N/A' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Transmission</span>
                            <span class="inventory-meta-value">{{ $inventory->transmission ?: 'N/A' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Drivetrain</span>
                            <span class="inventory-meta-value">{{ $inventory->drivetrain ?: 'N/A' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Exterior</span>
                            <span class="inventory-meta-value">{{ $inventory->exterior ?: 'N/A' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Interior</span>
                            <span class="inventory-meta-value">{{ $inventory->interior ?: 'N/A' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Fuel</span>
                            <span class="inventory-meta-value">{{ $inventory->fuel ?: 'N/A' }}</span>
                        </div>
                        <div class="inventory-meta-item">
                            <span class="inventory-meta-label">Total Price</span>
                            <span class="inventory-meta-value">${{ number_format((float) $inventory->total_price, 2) }}</span>
                        </div>
                    </div>

                    <div class="inventory-detail-actions">
                        <a href="{{ route('admin.inventory.edit', $inventory) }}" class="inventory-btn-primary">Edit Inventory</a>
                        <a href="{{ route('admin.inventory.index') }}" class="inventory-btn-secondary">Back to Inventory</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="inventory-detail-grid">
            <div class="inventory-detail-panel">
                <h2 class="inventory-section-title">Description</h2>
                <div class="inventory-description">{{ $inventory->description ?: 'No description added yet.' }}</div>
            </div>

            <div class="inventory-detail-panel">
                <h2 class="inventory-section-title">Features</h2>
                <div class="inventory-features">
                    @forelse (($inventory->features ?? []) as $feature)
                        <div class="inventory-feature">{{ $feature }}</div>
                    @empty
                        <div class="inventory-feature">No features added yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
