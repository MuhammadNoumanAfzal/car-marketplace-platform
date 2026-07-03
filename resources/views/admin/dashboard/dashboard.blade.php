@extends('layouts.admin')
@section('content')
    <style>
        .admin-dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .admin-stat-card,
        .admin-panel {
            background: #ffffff;
            border: 1px solid #d9e4ff;
            border-radius: 18px;
            box-shadow: 0 16px 38px rgba(14, 30, 84, 0.08);
        }

        .admin-stat-card {
            padding: 22px;
            text-decoration: none !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            color: #0f172a;
        }

        .admin-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 44px rgba(14, 30, 84, 0.14);
        }

        .admin-stat-card.blue {
            background: linear-gradient(135deg, #ffffff 0%, #eef4ff 100%);
        }

        .admin-stat-card.red {
            background: linear-gradient(135deg, #ffffff 0%, #fff0f3 100%);
        }

        .admin-stat-label {
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #4f5f7f;
            margin-bottom: 10px;
        }

        .admin-stat-count {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 12px;
            color: #0b1f4d;
        }

        .admin-stat-link {
            font-size: 0.96rem;
            font-weight: 700;
            color: #d62034;
        }

        .admin-panel {
            padding: 24px;
        }

        .admin-panel h2 {
            margin-bottom: 8px;
            color: #0b1f4d;
        }

        .admin-panel-copy {
            margin-bottom: 18px;
            color: #5b6780;
        }

        .admin-recent-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-recent-table th,
        .admin-recent-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e7eeff;
            vertical-align: middle;
        }

        .admin-recent-table th {
            font-size: 0.84rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #5b6780;
        }

        .admin-recent-table td {
            color: #172033;
        }

        .admin-view-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            border-radius: 999px;
            background: linear-gradient(90deg, #1d4ed8 0%, #2563eb 100%);
            color: #ffffff !important;
            font-weight: 700;
            text-decoration: none !important;
        }

        .admin-empty-state {
            padding: 18px 0 6px;
            color: #5b6780;
        }
    </style>

    <div class="admin-dashboard-grid">
        @foreach ($stats as $stat)
            <a href="{{ $stat['route'] }}" class="admin-stat-card {{ $stat['accent'] }}">
                <div class="admin-stat-label">{{ $stat['label'] }}</div>
                <div class="admin-stat-count">{{ $stat['count'] }}</div>
                <div class="admin-stat-link">Open section</div>
            </a>
        @endforeach
    </div>

    <div class="admin-panel">
        <h2>Recent Consignment Requests</h2>
        <p class="admin-panel-copy">These leads come from the consignment form on the website and are now visible here in backend.</p>

        @if ($recentConsignmentRequests->isEmpty())
            <div class="admin-empty-state">No consignment requests have been submitted yet.</div>
        @else
            <div class="table-responsive">
                <table class="admin-recent-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Vehicle</th>
                            <th>Phone</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentConsignmentRequests as $request)
                            <tr>
                                <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                <td>{{ $request->vehicle_year }} {{ $request->make }} {{ $request->model }}</td>
                                <td>{{ $request->phone }}</td>
                                <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <a href="{{ route('admin.consignment-requests.show', $request) }}" class="admin-view-link">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
