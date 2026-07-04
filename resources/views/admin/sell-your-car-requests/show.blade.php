@extends('layouts.admin')

@section('style')
    <style>
        .sell-detail-shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .sell-detail-card,
        .sell-detail-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 16px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .sell-detail-card {
            padding: 28px;
            margin-bottom: 20px;
        }

        .sell-detail-kicker {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d62034;
            margin-bottom: 8px;
        }

        .sell-detail-title {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #0b1f4d;
        }

        .sell-detail-copy {
            margin-top: 8px;
            color: #47639d;
        }

        .sell-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .sell-detail-panel {
            padding: 22px;
        }

        .sell-detail-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #6c86bb;
            margin-bottom: 7px;
        }

        .sell-detail-value {
            color: #0f172a;
            font-size: 16px;
            line-height: 1.6;
        }

        .sell-notes-box {
            white-space: pre-line;
            color: #334155;
            line-height: 1.8;
        }

        .sell-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .sell-btn-primary,
        .sell-btn-secondary {
            min-height: 46px;
            padding: 0 18px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
        }

        .sell-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            color: #ffffff;
        }

        .sell-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        @media (max-width: 768px) {
            .sell-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="sell-detail-shell">
        <div class="sell-detail-card">
            <div class="sell-detail-kicker">Sell Your Car Request</div>
            <h1 class="sell-detail-title">{{ $sellYourCarRequest->first_name }} {{ $sellYourCarRequest->last_name }}</h1>
            <p class="sell-detail-copy">Submitted {{ $sellYourCarRequest->created_at->format('M d, Y \a\t h:i A') }}</p>

            <div class="sell-actions">
                <a href="{{ route('admin.sell-your-car-requests.index') }}" class="sell-btn-primary">Back to Requests</a>
                <form action="{{ route('admin.sell-your-car-requests.destroy', $sellYourCarRequest) }}" method="POST" onsubmit="return confirm('Delete this sell your car request?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="sell-btn-secondary">Delete Request</button>
                </form>
            </div>
        </div>

        <div class="sell-detail-grid">
            <div class="sell-detail-panel">
                <span class="sell-detail-label">Owner Email</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->email }}</div>
            </div>

            <div class="sell-detail-panel">
                <span class="sell-detail-label">Owner Phone</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->phone }}</div>
            </div>

            <div class="sell-detail-panel">
                <span class="sell-detail-label">Vehicle</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->vehicle_year }} {{ $sellYourCarRequest->make }} {{ $sellYourCarRequest->model }}{{ $sellYourCarRequest->trim ? ' - ' . $sellYourCarRequest->trim : '' }}</div>
            </div>

            <div class="sell-detail-panel">
                <span class="sell-detail-label">Mileage / Transmission</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->mileage }} / {{ $sellYourCarRequest->transmission }}</div>
            </div>

            <div class="sell-detail-panel">
                <span class="sell-detail-label">Exterior / Interior</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->exterior_color ?: 'N/A' }} / {{ $sellYourCarRequest->interior_color ?: 'N/A' }}</div>
            </div>

            <div class="sell-detail-panel">
                <span class="sell-detail-label">Engine Details</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->cylinders ?: 'N/A' }} cylinders / {{ $sellYourCarRequest->liters ?: 'N/A' }} liters</div>
            </div>

            <div class="sell-detail-panel">
                <span class="sell-detail-label">Owner Address</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->address }}, {{ $sellYourCarRequest->city }}, {{ $sellYourCarRequest->state }} {{ $sellYourCarRequest->zip }}</div>
            </div>

            <div class="sell-detail-panel">
                <span class="sell-detail-label">Lien Holder</span>
                <div class="sell-detail-value">{{ $sellYourCarRequest->lien_holder ?: 'None provided' }}</div>
            </div>

            <div class="sell-detail-panel" style="grid-column: 1 / -1;">
                <span class="sell-detail-label">Vehicle Notes / Owner Details</span>
                <div class="sell-notes-box">{{ $sellYourCarRequest->additional_options ?: 'No additional notes provided.' }}</div>
            </div>
        </div>
    </div>
@endsection
