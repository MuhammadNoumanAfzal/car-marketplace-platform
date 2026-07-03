@extends('layouts.admin')

@section('style')
    <style>
        .inquiry-shell {
            max-width: 1240px;
            margin: 0 auto;
        }

        .inquiry-toolbar,
        .inquiry-table-panel {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 14px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .inquiry-toolbar {
            padding: 24px 28px;
            margin-bottom: 20px;
        }

        .inquiry-heading h1 {
            margin: 0;
            font-size: 28px;
            color: #0b1f4d;
        }

        .inquiry-heading p {
            margin: 8px 0 0;
            color: #47639d;
        }

        .inquiry-toolbar .form-control {
            min-height: 46px;
            border-radius: 10px;
            border: 1px solid #c8d8ff;
            background: #ffffff;
            color: #0b1f4d;
            box-shadow: none;
        }

        .inquiry-toolbar .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.12rem rgba(37, 99, 235, 0.14);
        }

        .inquiry-btn-primary,
        .inquiry-btn-secondary {
            min-height: 46px;
            border-radius: 10px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .inquiry-btn-primary {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            border: 0;
            color: #fff;
        }

        .inquiry-btn-secondary {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        .inquiry-table-panel {
            overflow: hidden;
        }

        .inquiry-table-panel table {
            margin-bottom: 0;
            background: #fff;
        }

        .inquiry-table-panel thead th {
            background: #eef4ff;
            border-bottom: 1px solid #d9e4ff;
            color: #31519b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .inquiry-table-panel tbody td {
            background: #ffffff !important;
            color: #0f172a;
            border-top: 1px solid #e5ecff;
            vertical-align: top;
        }

        .inquiry-name {
            font-weight: 700;
            color: #0b1f4d;
        }

        .inquiry-meta {
            font-size: 12px;
            color: #47639d;
            margin-top: 4px;
        }

        .inquiry-topic {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 700;
        }

        .inquiry-message {
            max-width: 360px;
            color: #334155;
            line-height: 1.6;
        }

        .inquiry-table-panel .dataTables_wrapper {
            color: #31519b;
        }

        .inquiry-table-panel .dataTables_length,
        .inquiry-table-panel .dataTables_filter {
            padding: 16px 18px 0;
            color: #31519b;
        }

        .inquiry-table-panel .dataTables_length select,
        .inquiry-table-panel .dataTables_filter input {
            min-height: 40px;
            border-radius: 10px;
            border: 1px solid #c8d8ff !important;
            background: #ffffff !important;
            color: #0b1f4d !important;
            box-shadow: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="inquiry-shell">
        <div class="inquiry-toolbar">
            <div class="inquiry-heading mb-4">
                <h1>Contact Inquiries</h1>
                <p>Review all messages submitted from the website contact form.</p>
            </div>

            <form method="GET" action="{{ route('admin.contact-inquiries.index') }}">
                <div class="form-row">
                    <div class="col-md-8 mb-2 mb-md-0">
                        <input type="text" name="q" class="form-control" value="{{ $search }}" placeholder="Search by name, email, phone, topic, or message">
                    </div>
                    <div class="col-md-4 d-flex">
                        <button type="submit" class="inquiry-btn-primary mr-2">Search</button>
                        <a href="{{ route('admin.contact-inquiries.index') }}" class="inquiry-btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="inquiry-table-panel">
            <div class="table-responsive">
                <table class="table table-striped table-bordered first">
                    <thead>
                        <tr>
                            <th>Contact</th>
                            <th>Topic</th>
                            <th>Message</th>
                            <th>Received</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inquiries as $inquiry)
                            <tr>
                                <td>
                                    <div class="inquiry-name">{{ $inquiry->name }}</div>
                                    <div class="inquiry-meta">{{ $inquiry->email }}</div>
                                    <div class="inquiry-meta">{{ $inquiry->phone ?: 'No phone provided' }}</div>
                                </td>
                                <td><span class="inquiry-topic">{{ $inquiry->topic }}</span></td>
                                <td class="inquiry-message">{{ \Illuminate\Support\Str::limit($inquiry->message, 120) }}</td>
                                <td>{{ $inquiry->created_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <a href="{{ route('admin.contact-inquiries.show', $inquiry) }}" class="btn btn-outline-primary btn-sm">View</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.contact-inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No contact inquiries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $inquiries->links() }}
            </div>
        </div>
    </div>
@endsection
