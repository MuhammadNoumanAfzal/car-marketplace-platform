<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">

    <title>Nitro Motors Admin</title>

    <style>
        .dashboard-header .navbar {
            background: linear-gradient(90deg, #0b1f4d 0%, #153b8a 100%);
            border-bottom: 1px solid #16336f;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
        }

        .admin-topbar-meta {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
        }

        .admin-topbar-name {
            font-weight: 600;
        }

        .admin-topbar-link,
        .admin-topbar-button {
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, 0.24);
            color: #ffffff !important;
            text-decoration: none !important;
            background: rgba(255, 255, 255, 0.08);
            font-weight: 700;
        }

        .admin-topbar-button {
            cursor: pointer;
        }

        .nav-left-sidebar.sidebar-dark {
            background: linear-gradient(180deg, #091833 0%, #102b5e 100%);
        }

        .nav-left-sidebar .nav-link,
        .nav-left-sidebar .nav-divider,
        .nav-left-sidebar .submenu .nav-link {
            color: rgba(255, 255, 255, 0.82) !important;
        }

        .nav-left-sidebar .nav-link.active,
        .nav-left-sidebar .nav-link:hover {
            background: linear-gradient(90deg, rgba(214, 32, 52, 0.92) 0%, rgba(29, 78, 216, 0.92) 100%);
            color: #ffffff !important;
        }

        .dashboard-wrapper {
            background: #f3f7ff;
        }

        .page-breadcrumb .breadcrumb {
            background: transparent !important;
            padding: 0;
            margin: 0;
            box-shadow: none !important;
        }

        .page-header {
            background: linear-gradient(90deg, #ffffff 0%, #eef4ff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 12px;
            padding: 14px 18px;
            box-shadow: 0 10px 24px rgba(21, 59, 138, 0.06);
        }

        .page-breadcrumb .breadcrumb-link {
            color: #31519b;
            font-weight: 600;
            background: transparent !important;
        }

        .dashboard-content {
            padding-top: 28px;
            padding-bottom: 28px;
        }

        .breadcrumb-item.active {
            color: #0f172a;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: #d62034;
        }

        .page-breadcrumb,
        .page-breadcrumb nav,
        .page-breadcrumb .breadcrumb-item,
        .page-breadcrumb .breadcrumb-item.active {
            background: transparent !important;
        }

        @media (max-width: 767.98px) {
            .admin-topbar-meta {
                gap: 8px;
            }

            .admin-topbar-name {
                display: none;
            }
        }
    </style>

    @yield('style')
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg fixed-top">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Nitro Motors Admin</a>
                <div class="admin-topbar-meta">
                    <span class="admin-topbar-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <a href="{{ route('admin.account.edit') }}" class="admin-topbar-link">Account</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="mb-0">
                        @csrf
                        <button type="submit" class="admin-topbar-button">Logout</button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="{{ url('admin/dashboard') }}">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Menu</li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'dashboard') active @endif" href="{{ url('admin/dashboard') }}">
                                    <i class="fa fa-fw fa-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'account') active @endif" href="{{ route('admin.account.edit') }}">
                                    <i class="fa fa-fw fa-user-cog"></i> Account Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'marketing-settings') active @endif" href="{{ route('admin.marketing-settings.edit') }}">
                                    <i class="fa fa-fw fa-bullhorn"></i> Marketing Pixels
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'seo-settings') active @endif" href="{{ route('admin.seo-settings.edit') }}">
                                    <i class="fa fa-fw fa-search"></i> SEO Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'inventory') active @endif"
                                    href="#"
                                    data-toggle="collapse"
                                    aria-expanded="{{ $active == 'inventory' ? 'true' : 'false' }}"
                                    data-target="#submenu-inventory"
                                    aria-controls="submenu-inventory">
                                    <i class="fa fa-fw fa-car"></i> Inventory
                                </a>
                                <div id="submenu-inventory" class="collapse submenu @if ($active == 'inventory') show @endif">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.inventory.index') }}">View All</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.inventory.create') }}">Add</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'contact-inquiries') active @endif"
                                    href="#"
                                    data-toggle="collapse"
                                    aria-expanded="{{ $active == 'contact-inquiries' ? 'true' : 'false' }}"
                                    data-target="#submenu-contact-inquiries"
                                    aria-controls="submenu-contact-inquiries">
                                    <i class="fa fa-fw fa-envelope"></i> Contact Inquiries
                                </a>
                                <div id="submenu-contact-inquiries" class="collapse submenu @if ($active == 'contact-inquiries') show @endif">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.contact-inquiries.index') }}">View All</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'appointment-requests') active @endif"
                                    href="#"
                                    data-toggle="collapse"
                                    aria-expanded="{{ $active == 'appointment-requests' ? 'true' : 'false' }}"
                                    data-target="#submenu-appointment-requests"
                                    aria-controls="submenu-appointment-requests">
                                    <i class="fa fa-fw fa-calendar"></i> Appointment Requests
                                </a>
                                <div id="submenu-appointment-requests" class="collapse submenu @if ($active == 'appointment-requests') show @endif">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.appointment-requests.index') }}">View All</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'shipping-requests') active @endif"
                                    href="#"
                                    data-toggle="collapse"
                                    aria-expanded="{{ $active == 'shipping-requests' ? 'true' : 'false' }}"
                                    data-target="#submenu-shipping-requests"
                                    aria-controls="submenu-shipping-requests">
                                    <i class="fa fa-fw fa-truck"></i> Shipping Requests
                                </a>
                                <div id="submenu-shipping-requests" class="collapse submenu @if ($active == 'shipping-requests') show @endif">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.shipping-requests.index') }}">View All</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'consignment-requests') active @endif"
                                    href="#"
                                    data-toggle="collapse"
                                    aria-expanded="{{ $active == 'consignment-requests' ? 'true' : 'false' }}"
                                    data-target="#submenu-consignment-requests"
                                    aria-controls="submenu-consignment-requests">
                                    <i class="fa fa-fw fa-file-alt"></i> Consignment Requests
                                </a>
                                <div id="submenu-consignment-requests" class="collapse submenu @if ($active == 'consignment-requests') show @endif">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.consignment-requests.index') }}">View All</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'sell-your-car-requests') active @endif"
                                    href="#"
                                    data-toggle="collapse"
                                    aria-expanded="{{ $active == 'sell-your-car-requests' ? 'true' : 'false' }}"
                                    data-target="#submenu-sell-your-car-requests"
                                    aria-controls="submenu-sell-your-car-requests">
                                    <i class="fa fa-fw fa-handshake"></i> Sell Your Car Requests
                                </a>
                                <div id="submenu-sell-your-car-requests" class="collapse submenu @if ($active == 'sell-your-car-requests') show @endif">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.sell-your-car-requests.index') }}">View All</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header mb-4">
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{ url('admin/dashboard') }}" class="breadcrumb-link">Nitro Motors Admin</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $heading }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
    <script src="{{ asset('assets/libs/js/dashboard-ecommerce.js') }}"></script>
    <script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status'))
                Swal.fire({
                    icon: @json(session('status_type', 'success')),
                    title: @json(session('status_title', 'Done')),
                    text: @json(session('status')),
                    confirmButtonColor: '#2563eb',
                    background: '#ffffff',
                    color: '#0f172a'
                });
            @elseif ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Something needs attention',
                    text: @json($errors->first()),
                    confirmButtonColor: '#d62034',
                    background: '#ffffff',
                    color: '#0f172a'
                });
            @endif
        });
    </script>

    @yield('script')
</body>

</html>
