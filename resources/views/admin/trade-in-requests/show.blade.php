@extends('layouts.admin')

@section('style')
    <style>
        .trade-detail-shell { max-width: 1100px; margin: 0 auto; }
        .trade-detail-card, .trade-detail-panel { background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%); border: 1px solid #d9e4ff; border-radius: 16px; box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08); }
        .trade-detail-card { padding: 28px; margin-bottom: 20px; }
        .trade-detail-kicker { font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #d62034; margin-bottom: 8px; }
        .trade-detail-title { margin: 0; font-size: 32px; font-weight: 700; color: #0b1f4d; }
        .trade-detail-copy { margin-top: 8px; color: #47639d; }
        .trade-detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
        .trade-detail-panel { padding: 22px; }
        .trade-detail-label { display: block; font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #6c86bb; margin-bottom: 7px; }
        .trade-detail-value { color: #0f172a; font-size: 16px; line-height: 1.6; }
        .trade-notes-box { white-space: pre-line; color: #334155; line-height: 1.8; }
        .trade-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 22px; }
        .trade-btn-primary, .trade-btn-secondary { min-height: 46px; padding: 0 18px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none !important; }
        .trade-btn-primary { background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%); color: #ffffff; }
        .trade-btn-secondary { background: #fff5f5; border: 1px solid #f3b3ba; color: #c81e33; }
        @media (max-width: 768px) { .trade-detail-grid { grid-template-columns: 1fr; } }
    </style>
@endsection

@section('content')
    <div class="trade-detail-shell">
        <div class="trade-detail-card">
            <div class="trade-detail-kicker">Trade-In Request</div>
            <h1 class="trade-detail-title">{{ $tradeInRequest->first_name }} {{ $tradeInRequest->last_name }}</h1>
            <p class="trade-detail-copy">Submitted {{ $tradeInRequest->created_at->format('M d, Y \a\t h:i A') }}</p>

            <div class="trade-actions">
                <a href="{{ route('admin.trade-in-requests.index') }}" class="trade-btn-primary">Back to Requests</a>
                <form action="{{ route('admin.trade-in-requests.destroy', $tradeInRequest) }}" method="POST" onsubmit="return confirm('Delete this trade-in request?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="trade-btn-secondary">Delete Request</button>
                </form>
            </div>
        </div>

        <div class="trade-detail-grid">
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Owner Email</span>
                <div class="trade-detail-value">{{ $tradeInRequest->email }}</div>
            </div>
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Owner Phone</span>
                <div class="trade-detail-value">{{ $tradeInRequest->phone }}</div>
            </div>
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Current Vehicle</span>
                <div class="trade-detail-value">{{ $tradeInRequest->current_vehicle_year }} {{ $tradeInRequest->current_make }} {{ $tradeInRequest->current_model }}{{ $tradeInRequest->current_trim ? ' - ' . $tradeInRequest->current_trim : '' }}</div>
            </div>
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Mileage / VIN</span>
                <div class="trade-detail-value">{{ $tradeInRequest->current_mileage }} / {{ $tradeInRequest->current_vin ?: 'N/A' }}</div>
            </div>
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Payoff Balance</span>
                <div class="trade-detail-value">{{ $tradeInRequest->trade_payoff ?: 'Not provided' }}</div>
            </div>
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Desired Vehicle</span>
                <div class="trade-detail-value">{{ $tradeInRequest->desired_vehicle ?: 'Not specified' }}</div>
            </div>
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Budget / Timeline</span>
                <div class="trade-detail-value">{{ $tradeInRequest->budget_range ?: 'N/A' }} / {{ $tradeInRequest->purchase_timeline ?: 'N/A' }}</div>
            </div>
            <div class="trade-detail-panel">
                <span class="trade-detail-label">Location</span>
                <div class="trade-detail-value">{{ ($tradeInRequest->city ?: 'N/A') . ', ' . ($tradeInRequest->state ?: 'N/A') }}</div>
            </div>
            <div class="trade-detail-panel" style="grid-column: 1 / -1;">
                <span class="trade-detail-label">Condition Notes</span>
                <div class="trade-notes-box">{{ $tradeInRequest->condition_notes ?: 'No additional notes provided.' }}</div>
            </div>
        </div>
    </div>
@endsection
