@extends('layouts.admin')

@section('content')
    <style>
        .admin-account-shell,
        .admin-account-panel {
            background: #ffffff;
            border: 1px solid #d9e4ff;
            border-radius: 18px;
            box-shadow: 0 16px 38px rgba(14, 30, 84, 0.08);
        }

        .admin-account-shell {
            padding: 28px;
        }

        .admin-account-title {
            margin-bottom: 10px;
            color: #0b1f4d;
            font-size: 2rem;
            font-weight: 800;
        }

        .admin-account-copy {
            color: #5b6780;
            margin-bottom: 24px;
        }

        .admin-account-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .admin-account-field label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #172033;
        }

        .admin-account-field input {
            width: 100%;
            height: 54px;
            border-radius: 14px;
            border: 1px solid #cad7fb;
            padding: 0 15px;
            background: #f8fbff;
            color: #0f172a;
        }

        .admin-account-field input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            background: #ffffff;
        }

        .admin-account-panel {
            padding: 22px;
            margin-top: 24px;
        }

        .admin-account-panel h2 {
            color: #0b1f4d;
            margin-bottom: 8px;
        }

        .admin-account-panel p {
            color: #5b6780;
            margin-bottom: 18px;
        }

        .admin-account-actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
        }

        .admin-account-button {
            height: 52px;
            padding: 0 22px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(90deg, #1d4ed8 0%, #2563eb 100%);
            color: #ffffff;
            font-weight: 800;
        }

        @media (max-width: 767.98px) {
            .admin-account-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="admin-account-shell">
        <h1 class="admin-account-title">Account Settings</h1>
        <p class="admin-account-copy">Update your admin profile details and change your password whenever you need.</p>

        <form method="POST" action="{{ route('admin.account.update') }}">
            @csrf
            @method('PUT')

            <div class="admin-account-grid">
                <div class="admin-account-field">
                    <label for="name">Admin Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="admin-account-field">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
            </div>

            <div class="admin-account-panel">
                <h2>Change Password</h2>
                <p>Leave the password fields empty if you only want to update your name or email.</p>

                <div class="admin-account-grid">
                    <div class="admin-account-field">
                        <label for="current_password">Current Password</label>
                        <input id="current_password" type="password" name="current_password">
                    </div>

                    <div class="admin-account-field">
                        <label for="password">New Password</label>
                        <input id="password" type="password" name="password">
                    </div>

                    <div class="admin-account-field">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation">
                    </div>
                </div>
            </div>

            <div class="admin-account-actions">
                <button type="submit" class="admin-account-button">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
