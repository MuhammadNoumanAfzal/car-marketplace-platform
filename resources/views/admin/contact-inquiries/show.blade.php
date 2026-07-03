@extends('layouts.admin')

@section('style')
    <style>
        .inquiry-detail-shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .inquiry-detail-card,
        .inquiry-detail-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 16px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .inquiry-detail-card {
            padding: 28px;
            margin-bottom: 20px;
        }

        .inquiry-detail-kicker {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d62034;
            margin-bottom: 8px;
        }

        .inquiry-detail-title {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #0b1f4d;
        }

        .inquiry-detail-copy {
            margin-top: 8px;
            color: #47639d;
        }

        .inquiry-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .inquiry-detail-panel {
            padding: 22px;
        }

        .inquiry-detail-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #6c86bb;
            margin-bottom: 7px;
        }

        .inquiry-detail-value {
            color: #0f172a;
            font-size: 16px;
            line-height: 1.6;
        }

        .inquiry-message-box {
            white-space: pre-line;
            color: #334155;
            line-height: 1.8;
        }

        .inquiry-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .inquiry-btn-primary,
        .inquiry-btn-secondary {
            min-height: 46px;
            padding: 0 18px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
        }

        .inquiry-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            color: #ffffff;
        }

        .inquiry-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        @media (max-width: 768px) {
            .inquiry-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="inquiry-detail-shell">
        <div class="inquiry-detail-card">
            <div class="inquiry-detail-kicker">Contact Inquiry</div>
            <h1 class="inquiry-detail-title">{{ $inquiry->name }}</h1>
            <p class="inquiry-detail-copy">Received {{ $inquiry->created_at->format('M d, Y \a\t h:i A') }}</p>

            <div class="inquiry-actions">
                <a href="{{ route('admin.contact-inquiries.index') }}" class="inquiry-btn-primary">Back to Inquiries</a>
                <form action="{{ route('admin.contact-inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inquiry-btn-secondary">Delete Inquiry</button>
                </form>
            </div>
        </div>

        <div class="inquiry-detail-grid">
            <div class="inquiry-detail-panel">
                <span class="inquiry-detail-label">Email</span>
                <div class="inquiry-detail-value">{{ $inquiry->email }}</div>
            </div>

            <div class="inquiry-detail-panel">
                <span class="inquiry-detail-label">Phone</span>
                <div class="inquiry-detail-value">{{ $inquiry->phone ?: 'No phone provided' }}</div>
            </div>

            <div class="inquiry-detail-panel" style="grid-column: 1 / -1;">
                <span class="inquiry-detail-label">Topic</span>
                <div class="inquiry-detail-value">{{ $inquiry->topic }}</div>
            </div>

            <div class="inquiry-detail-panel" style="grid-column: 1 / -1;">
                <span class="inquiry-detail-label">Message</span>
                <div class="inquiry-message-box">{{ $inquiry->message }}</div>
            </div>
        </div>
    </div>
@endsection
