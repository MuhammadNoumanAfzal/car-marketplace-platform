@extends('layouts.admin')

@section('style')
    <style>
        .shipping-shell {
            max-width: 1240px;
            margin: 0 auto;
        }

        .shipping-toolbar,
        .shipping-table-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 14px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .shipping-toolbar {
            padding: 24px 28px;
            margin-bottom: 20px;
        }

        .shipping-heading h1 {
            margin: 0;
            font-size: 28px;
            color: #0b1f4d;
        }

        .shipping-heading p {
            margin: 8px 0 0;
            color: #47639d;
        }

        .shipping-toolbar .form-control {
            min-height: 46px;
            border-radius: 10px;
            border: 1px solid #c8d8ff;
            background: #ffffff;
            color: #0b1f4d;
            box-shadow: none;
        }

        .shipping-toolbar .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.12rem rgba(37, 99, 235, 0.14);
        }

        .shipping-btn-primary,
        .shipping-btn-secondary {
            min-height: 46px;
            border-radius: 10px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .shipping-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            border: 0;
            color: #fff;
        }

        .shipping-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        .shipping-table-panel {
            overflow: hidden;
        }

        .shipping-table-panel table {
            margin-bottom: 0;
            background: #fff;
        }

        .shipping-table-panel thead th {
            background: #eef4ff;
            border-bottom: 1px solid #d9e4ff;
            color: #31519b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .shipping-table-panel tbody td {
            background: #ffffff !important;
            color: #0f172a;
            border-top: 1px solid #e5ecff;
            vertical-align: top;
        }

        .shipping-name {
            font-weight: 700;
            color: #0b1f4d;
        }

        .shipping-meta {
            font-size: 12px;
            color: #47639d;
            margin-top: 4px;
        }

        .shipping-type {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 700;
        }

        .shipping-notes {
            max-width: 360px;
            color: #334155;
            line-height: 1.6;
        }
    </style>
@endsection

@section('content')
    <div class="shipping-shell">
        <div class="shipping-toolbar">
            <div class="shipping-heading mb-4">
                <h1>Shipping Requests</h1>
                <p>Review all vehicle shipping requests submitted from the website.</p>
            </div>

            <form method="GET" action="{{ route('admin.shipping-requests.index') }}">
                <div class="form-row">
                    <div class="col-md-8 mb-2 mb-md-0">
                        <input type="text" name="q" class="form-control" value="{{ $search }}" placeholder="Search by contact, vehicle, transport type, route, or notes">
                    </div>
                    <div class="col-md-4 d-flex">
                        <button type="submit" class="shipping-btn-primary mr-2">Search</button>
                        <a href="{{ route('admin.shipping-requests.index') }}" class="shipping-btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="shipping-table-panel">
            <div class="table-responsive">
                <table class="table table-striped table-bordered first">
                    <thead>
                        <tr>
                            <th>Contact</th>
                            <th>Vehicle</th>
                            <th>Transport</th>
                            <th>Route</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shippingRequests as $request)
                            <tr>
                                <td>
                                    <div class="shipping-name">{{ $request->name }}</div>
                                    <div class="shipping-meta">{{ $request->email }}</div>
                                    <div class="shipping-meta">{{ $request->phone }}</div>
                                </td>
                                <td>
                                    <div>{{ $request->vehicle_year }} {{ $request->vehicle_make }} {{ $request->vehicle_model }}</div>
                                    <div class="shipping-meta">{{ $request->pickup_window }}</div>
                                </td>
                                <td><span class="shipping-type">{{ $request->transport_type }}</span></td>
                                <td class="shipping-notes">
                                    <strong>{{ $request->origin }}</strong> to <strong>{{ $request->destination }}</strong>
                                </td>
                                <td>
                                    <a href="{{ route('admin.shipping-requests.show', $request) }}" class="btn btn-outline-primary btn-sm">View</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.shipping-requests.destroy', $request) }}" method="POST" onsubmit="return confirm('Delete this shipping request?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No shipping requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $shippingRequests->links() }}
            </div>
        </div>
    </div>
@endsection
