<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Nitro Motors</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                linear-gradient(135deg, rgba(11, 31, 77, 0.96), rgba(29, 78, 216, 0.9)),
                radial-gradient(circle at top right, rgba(214, 32, 52, 0.3), transparent 35%),
                #091833;
            font-family: Arial, Helvetica, sans-serif;
            padding: 24px;
        }

        .admin-login-shell {
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(217, 228, 255, 0.9);
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(7, 18, 48, 0.28);
            overflow: hidden;
        }

        .admin-login-header {
            padding: 28px 30px 18px;
            background: linear-gradient(135deg, #0b1f4d 0%, #1d4ed8 100%);
            color: #ffffff;
        }

        .admin-login-header small {
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-weight: 700;
            opacity: 0.72;
            margin-bottom: 12px;
        }

        .admin-login-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
        }

        .admin-login-header p {
            margin: 10px 0 0;
            color: rgba(255, 255, 255, 0.82);
        }

        .admin-login-body {
            padding: 30px;
        }

        .admin-login-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #0f172a;
        }

        .admin-login-input {
            width: 100%;
            height: 56px;
            border-radius: 16px;
            border: 1px solid #cddafb;
            padding: 0 16px;
            font-size: 1rem;
            color: #0f172a;
            background: #f8fbff;
        }

        .admin-login-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
            background: #ffffff;
        }

        .admin-login-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 6px;
            color: #42506b;
        }

        .admin-login-button {
            width: 100%;
            height: 56px;
            border: 0;
            border-radius: 16px;
            background: linear-gradient(90deg, #d62034 0%, #2563eb 100%);
            color: #ffffff;
            font-weight: 800;
            font-size: 1rem;
            box-shadow: 0 16px 32px rgba(37, 99, 235, 0.2);
        }

        .admin-login-help {
            margin-top: 18px;
            color: #5b6780;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <div class="admin-login-shell">
        <div class="admin-login-header">
            <small>Nitro Motors</small>
            <h1>Admin Login</h1>
            <p>Sign in to manage inventory, leads, appointments, and requests.</p>
        </div>

        <div class="admin-login-body">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label class="admin-login-label" for="email">Email Address</label>
                    <input id="email" type="email" name="email" class="admin-login-input" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label class="admin-login-label" for="password">Password</label>
                    <input id="password" type="password" name="password" class="admin-login-input" required>
                </div>

                <label class="admin-login-check">
                    <input type="checkbox" name="remember" value="1">
                    <span>Keep me signed in</span>
                </label>

                <button type="submit" class="admin-login-button mt-4">Sign In</button>
            </form>

            <div class="admin-login-help">
                Use your admin credentials to access the dashboard.
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status'))
                Swal.fire({
                    icon: @json(session('status_type', 'success')),
                    title: @json(session('status_title', 'Done')),
                    text: @json(session('status')),
                    confirmButtonColor: '#2563eb'
                });
            @elseif ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login failed',
                    text: @json($errors->first()),
                    confirmButtonColor: '#d62034'
                });
            @endif
        });
    </script>
</body>

</html>
