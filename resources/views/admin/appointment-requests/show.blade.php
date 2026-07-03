@extends('layouts.admin')

@section('style')
    <style>
        .appointment-detail-shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .appointment-detail-card,
        .appointment-detail-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 16px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .appointment-detail-card {
            padding: 28px;
            margin-bottom: 20px;
        }

        .appointment-detail-kicker {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d62034;
            margin-bottom: 8px;
        }

        .appointment-detail-title {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #0b1f4d;
        }

        .appointment-detail-copy {
            margin-top: 8px;
            color: #47639d;
        }

        .appointment-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .appointment-detail-panel {
            padding: 22px;
        }

        .appointment-detail-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #6c86bb;
            margin-bottom: 7px;
        }

        .appointment-detail-value {
            color: #0f172a;
            font-size: 16px;
            line-height: 1.6;
        }

        .appointment-notes-box {
            white-space: pre-line;
            color: #334155;
            line-height: 1.8;
        }

        .appointment-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .appointment-btn-primary,
        .appointment-btn-secondary {
            min-height: 46px;
            padding: 0 18px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
        }

        .appointment-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            color: #ffffff;
        }

        .appointment-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        @media (max-width: 768px) {
            .appointment-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="appointment-detail-shell">
        <div class="appointment-detail-card">
            <div class="appointment-detail-kicker">Appointment Request</div>
            <h1 class="appointment-detail-title">{{ $appointment->name }}</h1>
            <p class="appointment-detail-copy">Requested {{ $appointment->created_at->format('M d, Y \a\t h:i A') }}</p>

            <div class="appointment-actions">
                <a href="{{ route('admin.appointment-requests.index') }}" class="appointment-btn-primary">Back to Requests</a>
                <form action="{{ route('admin.appointment-requests.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Delete this appointment request?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="appointment-btn-secondary">Delete Request</button>
                </form>
            </div>
        </div>

        <div class="appointment-detail-grid">
            <div class="appointment-detail-panel">
                <span class="appointment-detail-label">Email</span>
                <div class="appointment-detail-value">{{ $appointment->email }}</div>
            </div>

            <div class="appointment-detail-panel">
                <span class="appointment-detail-label">Phone</span>
                <div class="appointment-detail-value">{{ $appointment->phone }}</div>
            </div>

            <div class="appointment-detail-panel">
                <span class="appointment-detail-label">Appointment Type</span>
                <div class="appointment-detail-value">{{ $appointment->appointment_type }}</div>
            </div>

            <div class="appointment-detail-panel">
                <span class="appointment-detail-label">Preferred Time</span>
                <div class="appointment-detail-value">{{ \Carbon\Carbon::parse($appointment->preferred_date)->format('M d, Y') }} at {{ $appointment->preferred_time }}</div>
            </div>

            <div class="appointment-detail-panel" style="grid-column: 1 / -1;">
                <span class="appointment-detail-label">Notes</span>
                <div class="appointment-notes-box">{{ $appointment->notes ?: 'No notes provided.' }}</div>
            </div>
        </div>
    </div>
@endsection
