@extends('layouts.admin')

@section('style')
    <style>
        .consignment-detail-shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .consignment-detail-card,
        .consignment-detail-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 16px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .consignment-detail-card {
            padding: 28px;
            margin-bottom: 20px;
        }

        .consignment-detail-kicker {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d62034;
            margin-bottom: 8px;
        }

        .consignment-detail-title {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #0b1f4d;
        }

        .consignment-detail-copy {
            margin-top: 8px;
            color: #47639d;
        }

        .consignment-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .consignment-detail-panel {
            padding: 22px;
        }

        .consignment-detail-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #6c86bb;
            margin-bottom: 7px;
        }

        .consignment-detail-value {
            color: #0f172a;
            font-size: 16px;
            line-height: 1.6;
        }

        .consignment-notes-box {
            white-space: pre-line;
            color: #334155;
            line-height: 1.8;
        }

        .consignment-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .consignment-btn-primary,
        .consignment-btn-secondary {
            min-height: 46px;
            padding: 0 18px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
        }

        .consignment-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            color: #ffffff;
        }

        .consignment-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        @media (max-width: 768px) {
            .consignment-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="consignment-detail-shell">
        <div class="consignment-detail-card">
            <div class="consignment-detail-kicker">Consignment Request</div>
            <h1 class="consignment-detail-title">{{ $consignmentRequest->first_name }} {{ $consignmentRequest->last_name }}</h1>
            <p class="consignment-detail-copy">Submitted {{ $consignmentRequest->created_at->format('M d, Y \a\t h:i A') }}</p>

            <div class="consignment-actions">
                <a href="{{ route('admin.consignment-requests.index') }}" class="consignment-btn-primary">Back to Requests</a>
                <form action="{{ route('admin.consignment-requests.destroy', $consignmentRequest) }}" method="POST" onsubmit="return confirm('Delete this consignment request?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="consignment-btn-secondary">Delete Request</button>
                </form>
            </div>
        </div>

        <div class="consignment-detail-grid">
            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Email</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->email }}</div>
            </div>

            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Phone</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->phone }}</div>
            </div>

            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Vehicle</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->vehicle_year }} {{ $consignmentRequest->make }} {{ $consignmentRequest->model }}{{ $consignmentRequest->trim ? ' - ' . $consignmentRequest->trim : '' }}</div>
            </div>

            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Mileage / Transmission</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->mileage }} / {{ $consignmentRequest->transmission }}</div>
            </div>

            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Exterior / Interior</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->exterior_color ?: 'N/A' }} / {{ $consignmentRequest->interior_color ?: 'N/A' }}</div>
            </div>

            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Engine Details</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->cylinders ?: 'N/A' }} cylinders / {{ $consignmentRequest->liters ?: 'N/A' }} liters</div>
            </div>

            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Address</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->address }}, {{ $consignmentRequest->city }}, {{ $consignmentRequest->state }} {{ $consignmentRequest->zip }}</div>
            </div>

            <div class="consignment-detail-panel">
                <span class="consignment-detail-label">Lien Holder</span>
                <div class="consignment-detail-value">{{ $consignmentRequest->lien_holder ?: 'None provided' }}</div>
            </div>

            <div class="consignment-detail-panel" style="grid-column: 1 / -1;">
                <span class="consignment-detail-label">Additional Options</span>
                <div class="consignment-notes-box">{{ $consignmentRequest->additional_options ?: 'No additional options provided.' }}</div>
            </div>
        </div>
    </div>
@endsection
