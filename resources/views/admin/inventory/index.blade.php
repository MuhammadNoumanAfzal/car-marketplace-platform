@extends('layouts.admin')

@section('style')
    <style>
        .inventory-shell {
            max-width: 1240px;
            margin: 0 auto;
        }

        .inventory-toolbar,
        .inventory-table-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 14px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .inventory-toolbar {
            padding: 24px 28px;
            margin-bottom: 20px;
        }

        .inventory-table-panel {
            overflow: hidden;
        }

        .inventory-heading {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 20px;
        }

        .inventory-heading h1 {
            margin: 0;
            font-size: 28px;
            color: #0b1f4d;
        }

        .inventory-heading p {
            margin: 6px 0 0;
            color: #47639d;
        }

        .inventory-toolbar .form-control {
            min-height: 46px;
            border-radius: 10px;
            border-color: #c8d8ff;
            background: #ffffff;
            color: #0b1f4d;
            box-shadow: none;
        }

        .inventory-toolbar .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.12rem rgba(37, 99, 235, 0.14);
        }

        .inventory-toolbar .form-control::placeholder {
            color: #6c86bb;
        }

        .inventory-toolbar select.form-control,
        .inventory-toolbar input.form-control {
            background: #ffffff !important;
            color: #0b1f4d !important;
        }

        .inventory-toolbar select.form-control option {
            background: #ffffff;
            color: #0b1f4d;
        }

        .inventory-btn-dark {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            border: 0;
            border-radius: 10px;
            color: #fff;
            min-height: 46px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .inventory-btn-light {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            border-radius: 10px;
            color: #c81e33;
            min-height: 46px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .inventory-table-panel table {
            margin-bottom: 0;
            background: #ffffff;
        }

        .inventory-table-panel thead th {
            background: #eef4ff;
            border-bottom: 1px solid #d9e4ff;
            color: #31519b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .inventory-table-panel tbody tr,
        .inventory-table-panel.table-striped tbody tr,
        .inventory-table-panel .table-striped tbody tr:nth-of-type(odd),
        .inventory-table-panel .table-striped tbody tr:nth-of-type(even) {
            background: #ffffff !important;
        }

        .inventory-table-panel tbody td {
            background: #ffffff !important;
            color: #0f172a;
            border-top: 1px solid #e5ecff;
        }

        .inventory-table-panel tbody tr:hover td {
            background: #f8fbff !important;
        }

        .vehicle-cell {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 260px;
        }

        .vehicle-thumb {
            width: 76px;
            height: 56px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #d9e4ff;
            background: #edf4ff;
        }

        .vehicle-name {
            display: block;
            font-weight: 700;
            color: #0b1f4d;
        }

        .vehicle-sub {
            display: block;
            font-size: 12px;
            color: #47639d;
            margin-top: 2px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-badge--available {
            background: #e7f0ff;
            color: #1d4ed8;
        }

        .status-badge--sold {
            background: #fff1f2;
            color: #c81e33;
        }

        .inventory-action {
            border-radius: 10px;
        }

        .inventory-action.btn-outline-primary {
            border-color: #a9c4ff;
            color: #1d4ed8;
            background: #eff6ff;
        }

        .inventory-action.btn-outline-secondary {
            border-color: #2563eb;
            color: #153b8a;
            background: #eff6ff;
        }

        .inventory-action.btn-outline-danger {
            border-color: #f3b3ba;
            color: #c81e33;
            background: #fff5f5;
        }

        .inventory-table-panel .text-center {
            color: #31519b;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div class="inventory-shell">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="inventory-toolbar">
                <div class="inventory-heading">
                    <div>
                        <h1>Inventory</h1>
                        <p>Manage vehicle listings, pricing, and what appears on the storefront.</p>
                    </div>
                    <a href="{{ route('admin.inventory.create') }}" class="inventory-btn-dark">Add Inventory</a>
                </div>

                <form method="GET" action="{{ route('admin.inventory.index') }}">
                    <div class="form-row">
                            <div class="col-md-5 mb-2 mb-md-0">
                                <input type="text" name="q" class="form-control" value="{{ $search }}" placeholder="Search make, model, stock, or VIN">
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <select name="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="available" @selected($status === 'available')>Available</option>
                                    <option value="sold" @selected($status === 'sold')>Sold</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2 d-flex">
                                <button type="submit" class="inventory-btn-dark mr-2">Search</button>
                                <a href="{{ route('admin.inventory.index') }}" class="inventory-btn-light">Reset</a>
                            </div>
                    </div>
                </form>
            </div>

            <div class="inventory-table-panel">
                <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Mileage</th>
                                    <th>Stock</th>
                                    <th>Featured</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inventories as $inventory)
                                    <tr>
                                        <td>
                                            <div class="vehicle-cell">
                                                <img
                                                    src="{{ $inventory->main_image ? (preg_match('/^https?:\/\//i', $inventory->main_image) ? $inventory->main_image : (str_starts_with($inventory->main_image, 'storage/') ? asset($inventory->main_image) : asset('storage/' . ltrim($inventory->main_image, '/')))) : 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=600&q=80' }}"
                                                    alt="{{ $inventory->make }} {{ $inventory->model }}"
                                                    class="vehicle-thumb"
                                                >
                                                <div>
                                                    <span class="vehicle-name">{{ $inventory->year }} {{ $inventory->make }} {{ $inventory->model }}</span>
                                                    <span class="vehicle-sub">{{ $inventory->trim ?: 'Standard' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="status-badge status-badge--{{ $inventory->status }}">{{ $inventory->status }}</span></td>
                                        <td>${{ number_format((float) $inventory->price, 2) }}</td>
                                        <td>{{ number_format($inventory->mileage) }}</td>
                                        <td>{{ $inventory->stock }}</td>
                                        <td>{{ $inventory->is_featured ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a href="{{ route('admin.inventory.show', $inventory) }}" class="btn btn-outline-primary btn-sm inventory-action">View</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.inventory.edit', $inventory) }}" class="btn btn-outline-secondary btn-sm inventory-action">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.inventory.destroy', $inventory) }}" method="POST" onsubmit="return confirm('Delete this inventory item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm inventory-action">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No inventory found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                </div>

                <div class="p-3 border-top">
                    {{ $inventories->links() }}
                </div>
            </div>
    </div>
@endsection
