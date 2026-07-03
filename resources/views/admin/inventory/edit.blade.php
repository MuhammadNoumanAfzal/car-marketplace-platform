@extends('layouts.admin')

@section('style')
    <style>
        .inventory-shell {
            max-width: 1180px;
            margin: 0 auto;
        }

        .inventory-panel {
            border: 1px solid #d8e2ff;
            border-radius: 14px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .inventory-panel__header {
            padding: 24px 28px 10px;
            border-bottom: 1px solid #dbe7ff;
        }

        .inventory-panel__body {
            padding: 28px;
        }

        .inventory-kicker {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d62034;
            margin-bottom: 8px;
        }

        .inventory-title {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #0b1f4d;
        }

        .inventory-copy {
            margin: 8px 0 0;
            color: #47639d;
        }

        .inventory-panel .form-control {
            min-height: 46px;
            border-radius: 10px;
            border-color: #c8d8ff;
            background: #ffffff;
            color: #0b1f4d;
            box-shadow: none;
        }

        .inventory-panel .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.12rem rgba(37, 99, 235, 0.14);
        }

        .inventory-panel .form-control::placeholder {
            color: #6c86bb;
        }

        .inventory-panel select.form-control,
        .inventory-panel textarea.form-control,
        .inventory-panel input.form-control {
            background: #ffffff !important;
            color: #0b1f4d !important;
        }

        .inventory-panel select.form-control option {
            background: #ffffff;
            color: #0b1f4d;
        }

        .inventory-panel .col-form-label,
        .inventory-panel .custom-control-label,
        .inventory-panel .form-text {
            color: #31519b;
        }

        .inventory-panel .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #d62034;
            border-color: #d62034;
        }

        .inventory-panel .custom-control-label::before {
            border-color: #b7cbfb;
            background: #ffffff;
        }

        .inventory-panel textarea.form-control {
            min-height: 120px;
        }

        .inventory-panel .btn-primary {
            border: 0;
            border-radius: 10px;
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            padding: 0.8rem 2.5rem;
        }

        .inventory-panel .btn-outline-secondary {
            border-radius: 10px;
            border-color: #2563eb;
            color: #153b8a;
            background: #eff6ff;
        }

        .inventory-panel .btn-outline-danger {
            border-radius: 10px;
            border-color: #f3b3ba;
            color: #c81e33;
            background: #fff5f5;
        }

        .inventory-feature-list {
            display: grid;
            gap: 12px;
        }

        .feature-point-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 12px;
            align-items: center;
        }
    </style>
@endsection

@section('content')
    <div class="inventory-shell">
        <div class="inventory-panel">
            <div class="inventory-panel__header">
                <div class="inventory-kicker">Inventory</div>
                <h1 class="inventory-title">Edit vehicle</h1>
                <p class="inventory-copy">Update listing details, images, and what appears on the frontend.</p>
            </div>
            <div class="inventory-panel__body">
                    <form action="{{ route('admin.inventory.update', $inventory) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.inventory._form')

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Update Inventory</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @stack('inventory-form-script')
@endsection
