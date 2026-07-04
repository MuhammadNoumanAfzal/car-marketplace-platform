@extends('layouts.admin')

@section('style')
    <style>
        .sell-shell {
            max-width: 1240px;
            margin: 0 auto;
        }

        .sell-toolbar,
        .sell-table-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 14px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .sell-toolbar {
            padding: 24px 28px;
            margin-bottom: 20px;
        }

        .sell-heading h1 {
            margin: 0;
            font-size: 28px;
            color: #0b1f4d;
        }

        .sell-heading p {
            margin: 8px 0 0;
            color: #47639d;
        }

        .sell-toolbar .form-control {
            min-height: 46px;
            border-radius: 10px;
            border: 1px solid #c8d8ff;
            background: #ffffff;
            color: #0b1f4d;
            box-shadow: none;
        }

        .sell-toolbar .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.12rem rgba(37, 99, 235, 0.14);
        }

        .sell-btn-primary,
        .sell-btn-secondary {
            min-height: 46px;
            border-radius: 10px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sell-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            border: 0;
            color: #fff;
        }

        .sell-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        .sell-table-panel {
            overflow: hidden;
        }

        .sell-table-panel table {
            margin-bottom: 0;
            background: #fff;
        }

        .sell-table-panel thead th {
            background: #eef4ff;
            border-bottom: 1px solid #d9e4ff;
            color: #31519b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .sell-table-panel tbody td {
            background: #ffffff !important;
            color: #0f172a;
            border-top: 1px solid #e5ecff;
            vertical-align: top;
        }

        .sell-name {
            font-weight: 700;
            color: #0b1f4d;
        }

        .sell-meta {
            font-size: 12px;
            color: #47639d;
            margin-top: 4px;
        }

        .sell-vehicle {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 700;
        }
    </style>
@endsection

@section('content')
    <div class="sell-shell">
        <div class="sell-toolbar">
            <div class="row align-items-end">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <div class="sell-heading">
                        <h1>Sell Your Car Requests</h1>
                        <p>Review direct owner submissions from the storefront sell-your-car page.</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <form method="GET" action="{{ route('admin.sell-your-car-requests.index') }}">
                        <div class="form-row">
                            <div class="col-md-8 mb-2 mb-md-0">
                                <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Search by owner, email, phone, vehicle, or notes">
                            </div>
                            <div class="col-md-4 d-flex">
                                <button type="submit" class="btn sell-btn-primary btn-block mr-2">Search</button>
                                <a href="{{ route('admin.sell-your-car-requests.index') }}" class="btn sell-btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="sell-table-panel">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th>Vehicle</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Submitted</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sellYourCarRequests as $request)
                            <tr>
                                <td>
                                    <div class="sell-name">{{ $request->first_name }} {{ $request->last_name }}</div>
                                    <div class="sell-meta">{{ $request->email }}</div>
                                </td>
                                <td>
                                    <span class="sell-vehicle">{{ $request->vehicle_year }} {{ $request->make }} {{ $request->model }}</span>
                                    <div class="sell-meta">{{ $request->trim ?: 'No trim provided' }} / {{ $request->mileage }} mi</div>
                                </td>
                                <td>{{ $request->city }}, {{ $request->state }}</td>
                                <td>{{ $request->phone }}</td>
                                <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.sell-your-car-requests.show', $request) }}" class="btn btn-outline-primary btn-sm">View</a>
                                    <form action="{{ route('admin.sell-your-car-requests.destroy', $request) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this sell your car request?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No sell your car requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $sellYourCarRequests->links() }}
        </div>
    </div>
@endsection
