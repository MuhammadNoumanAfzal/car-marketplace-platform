@extends('layouts.admin')

@section('style')
    <style>
        .shipping-detail-shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .shipping-detail-card,
        .shipping-detail-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 16px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .shipping-detail-card {
            padding: 28px;
            margin-bottom: 20px;
        }

        .shipping-detail-kicker {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d62034;
            margin-bottom: 8px;
        }

        .shipping-detail-title {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #0b1f4d;
        }

        .shipping-detail-copy {
            margin-top: 8px;
            color: #47639d;
        }

        .shipping-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .shipping-detail-panel {
            padding: 22px;
        }

        .shipping-detail-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #6c86bb;
            margin-bottom: 7px;
        }

        .shipping-detail-value {
            color: #0f172a;
            font-size: 16px;
            line-height: 1.6;
        }

        .shipping-notes-box {
            white-space: pre-line;
            color: #334155;
            line-height: 1.8;
        }

        .shipping-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .shipping-btn-primary,
        .shipping-btn-secondary {
            min-height: 46px;
            padding: 0 18px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
        }

        .shipping-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            color: #ffffff;
        }

        .shipping-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        @media (max-width: 768px) {
            .shipping-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="shipping-detail-shell">
        <div class="shipping-detail-card">
            <div class="shipping-detail-kicker">Shipping Request</div>
            <h1 class="shipping-detail-title">{{ $shippingRequest->name }}</h1>
            <p class="shipping-detail-copy">Requested {{ $shippingRequest->created_at->format('M d, Y \a\t h:i A') }}</p>

            <div class="shipping-actions">
                <a href="{{ route('admin.shipping-requests.index') }}" class="shipping-btn-primary">Back to Requests</a>
                <form action="{{ route('admin.shipping-requests.destroy', $shippingRequest) }}" method="POST" onsubmit="return confirm('Delete this shipping request?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="shipping-btn-secondary">Delete Request</button>
                </form>
            </div>
        </div>

        <div class="shipping-detail-grid">
            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Email</span>
                <div class="shipping-detail-value">{{ $shippingRequest->email }}</div>
            </div>

            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Phone</span>
                <div class="shipping-detail-value">{{ $shippingRequest->phone }}</div>
            </div>

            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Vehicle</span>
                <div class="shipping-detail-value">{{ $shippingRequest->vehicle_year }} {{ $shippingRequest->vehicle_make }} {{ $shippingRequest->vehicle_model }}</div>
            </div>

            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Transport Type</span>
                <div class="shipping-detail-value">{{ $shippingRequest->transport_type }}</div>
            </div>

            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Origin</span>
                <div class="shipping-detail-value">{{ $shippingRequest->origin }}</div>
            </div>

            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Destination</span>
                <div class="shipping-detail-value">{{ $shippingRequest->destination }}</div>
            </div>

            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Pickup Window</span>
                <div class="shipping-detail-value">{{ $shippingRequest->pickup_window }}</div>
            </div>

            <div class="shipping-detail-panel">
                <span class="shipping-detail-label">Submitted</span>
                <div class="shipping-detail-value">{{ $shippingRequest->created_at->format('M d, Y h:i A') }}</div>
            </div>

            <div class="shipping-detail-panel" style="grid-column: 1 / -1;">
                <span class="shipping-detail-label">Notes</span>
                <div class="shipping-notes-box">{{ $shippingRequest->notes ?: 'No notes provided.' }}</div>
            </div>
        </div>
    </div>
@endsection
