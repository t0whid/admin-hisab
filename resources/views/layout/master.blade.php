<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Shahjalal Enterprise')</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    {{-- DataTables Bootstrap 5 + Buttons --}}
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

    {{-- Toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        :root {
            --app-bg: #f4f7fb;
            --sidebar-bg: #101828;
            --sidebar-bg-soft: #172033;
            --sidebar-text: #d0d5dd;
            --sidebar-muted: #98a2b3;
            --sidebar-active: #7c3aed;
            --card-border: #e7edf5;
            --text-main: #101828;
            --text-muted: #667085;
            --primary: #7c3aed;
            --primary-soft: rgba(124, 58, 237, .10);
            --danger-soft: rgba(239, 68, 68, .10);
            --success-soft: rgba(16, 185, 129, .10);
            --warning-soft: rgba(245, 158, 11, .12);
            --topbar-height: 72px;
            --sidebar-width: 280px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--app-bg);
            color: var(--text-main);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        a {
            text-decoration: none;
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #111827 0%, #101828 55%, #0b1220 100%);
            color: var(--sidebar-text);
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1040;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, .06);
        }

        .admin-main {
            width: 100%;
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
        }

        .admin-topbar {
            height: var(--topbar-height);
            background: rgba(255, 255, 255, .86);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--card-border);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .admin-content {
            flex: 1;
            padding: 28px;
        }

        .admin-footer {
            padding: 18px 28px;
            color: var(--text-muted);
            font-size: 13px;
            border-top: 1px solid var(--card-border);
            background: #ffffff;
        }

        .brand-card {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 14px 30px rgba(124, 58, 237, .28);
        }

        .brand-title {
            color: #ffffff;
            font-weight: 800;
            font-size: 16px;
            line-height: 1.2;
        }

        .brand-subtitle {
            color: var(--sidebar-muted);
            font-size: 12px;
        }

        .sidebar-user {
            margin: 18px 16px;
            padding: 14px;
            border-radius: 18px;
            background: rgba(255, 255, 255, .055);
            border: 1px solid rgba(255, 255, 255, .07);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, .16);
        }

        .sidebar-section-label {
            color: var(--sidebar-muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 8px 22px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0 12px 24px;
            margin: 0;
        }

        .sidebar-link,
        .sidebar-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--sidebar-text);
            padding: 12px 14px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 650;
            transition: all .18s ease;
            border: 0;
            background: transparent;
            text-align: left;
        }

        .sidebar-link i,
        .sidebar-toggle i {
            width: 18px;
            text-align: center;
            color: #a7b0c0;
        }

        .sidebar-link:hover,
        .sidebar-toggle:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, .075);
        }

        .sidebar-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, rgba(124, 58, 237, .95), rgba(236, 72, 153, .82));
            box-shadow: 0 14px 28px rgba(124, 58, 237, .22);
        }

        .sidebar-link.active i {
            color: #ffffff;
        }

        .sidebar-submenu {
            padding-left: 34px;
            margin: 4px 0 10px;
        }

        .sidebar-submenu a {
            display: block;
            color: var(--sidebar-muted);
            padding: 9px 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 650;
        }

        .sidebar-submenu a:hover,
        .sidebar-submenu a.active {
            color: #ffffff;
            background: rgba(255, 255, 255, .07);
        }

        .topbar-btn {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            border: 1px solid var(--card-border);
            background: #ffffff;
            color: #344054;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .topbar-btn:hover {
            color: var(--primary);
            border-color: rgba(124, 58, 237, .25);
            background: var(--primary-soft);
        }

        .page-title {
            font-weight: 850;
            letter-spacing: -.03em;
            color: var(--text-main);
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        .modern-card {
            border: 1px solid var(--card-border);
            border-radius: 22px;
            background: #ffffff;
            box-shadow: 0 12px 32px rgba(16, 24, 40, .06);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 110px;
            height: 110px;
            border-radius: 999px;
            right: -38px;
            top: -40px;
            background: var(--primary-soft);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-soft);
            color: var(--primary);
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 750;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 850;
            letter-spacing: -.03em;
        }

        .transaction-card {
            transition: all .18s ease;
        }

        .transaction-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 42px rgba(16, 24, 40, .09);
        }

        .type-badge {
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 800;
        }

        .amount-credit {
            background: var(--success-soft);
            color: #059669;
        }

        .amount-debit {
            background: var(--danger-soft);
            color: #dc2626;
        }

        .empty-state {
            padding: 46px 24px;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state-icon {
            width: 62px;
            height: 62px;
            border-radius: 20px;
            background: var(--primary-soft);
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 14px;
        }

        .btn-gradient {
            border: 0;
            color: #fff;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            box-shadow: 0 12px 24px rgba(124, 58, 237, .22);
        }

        .btn-gradient:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(124, 58, 237, .28);
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            border-color: var(--card-border);
            min-height: 42px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .25rem rgba(124, 58, 237, .12);
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 12px;
            border: 1px solid #dde3ee;
            padding: 8px 12px;
            min-height: 40px;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .25rem rgba(124, 58, 237, .12);
            outline: 0;
        }

        .dataTables_wrapper .dt-buttons .btn {
            border-radius: 12px !important;
            font-weight: 800;
            padding: 8px 14px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #334155;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .06);
        }

        .dataTables_wrapper .dt-buttons .btn:hover {
            color: #ffffff;
            border-color: transparent;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
        }

        .dataTables_wrapper .page-link {
            border-radius: 10px;
            margin: 0 2px;
            border-color: #e2e8f0;
            color: #475569;
        }

        .dataTables_wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            border-color: transparent;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            color: #64748b;
            font-size: 14px;
        }

        #toast-container > div {
            border-radius: 14px;
            box-shadow: 0 18px 45px rgba(16, 24, 40, .16);
            opacity: 1;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            body.sidebar-open .admin-sidebar {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-content {
                padding: 20px 16px;
            }

            .admin-footer {
                padding: 16px;
            }

            .mobile-sidebar-backdrop {
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, .52);
                z-index: 1039;
                display: none;
            }

            body.sidebar-open .mobile-sidebar-backdrop {
                display: block;
            }
        }
    </style>

    @yield('style')
    @yield('styles')
    @stack('styles')
</head>

<body>
    <div class="mobile-sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="admin-shell">
        @include('layout.sidebar', ['user' => Auth::user()])

        <main class="admin-main">
            @include('layout.top_nav', ['user' => Auth::user()])

            <section class="admin-content">
                @yield('content')
            </section>

            <footer class="admin-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                    <span>&copy; {{ date('Y') }} Shahjalal Enterprise. All rights reserved.</span>
                    <span>Admin Panel</span>
                </div>
            </footer>
        </main>
    </div>

    {{-- jQuery is used for Toastr and DataTables only --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- DataTables Bootstrap 5 + Buttons --}}
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.body;
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    body.classList.toggle('sidebar-open');
                });
            }

            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function () {
                    body.classList.remove('sidebar-open');
                });
            }

            document.querySelectorAll('.admin-sidebar a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 992) {
                        body.classList.remove('sidebar-open');
                    }
                });
            });
        });

        toastr.options = {
            closeButton: true,
            progressBar: true,
            newestOnTop: true,
            positionClass: 'toast-top-right',
            preventDuplicates: true,
            timeOut: 3500,
            extendedTimeOut: 1200,
            showDuration: 250,
            hideDuration: 250,
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };
    </script>

    <script>
        $(function () {
            const $tables = $('.datatable, #datatable-buttons');

            $tables.each(function () {
                const $table = $(this);

                if ($.fn.DataTable.isDataTable(this)) {
                    return;
                }

                $table.DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                    order: [[0, 'asc']],
                    dom:
                        "<'row align-items-center g-3 mb-3'<'col-md-6'B><'col-md-6'f>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row align-items-center g-3 mt-3'<'col-md-5'i><'col-md-7'p>>",
                    buttons: [
                        { extend: 'copy', className: 'btn btn-sm' },
                        { extend: 'excel', className: 'btn btn-sm' },
                        { extend: 'pdf', className: 'btn btn-sm' },
                        { extend: 'print', className: 'btn btn-sm' }
                    ],
                    language: {
                        search: '',
                        searchPlaceholder: 'Search records...',
                        lengthMenu: 'Show _MENU_',
                        emptyTable: 'No records found',
                        zeroRecords: 'No matching records found'
                    },
                    columnDefs: [
                        { targets: 'no-sort', orderable: false },
                        { targets: 'no-search', searchable: false }
                    ]
                });
            });
        });
    </script>

    {{-- Laravel flash messages --}}
    @if (session('success'))
        <script>toastr.success(@json(session('success')));</script>
    @endif

    @if (session('error'))
        <script>toastr.error(@json(session('error')));</script>
    @endif

    @if (session('warning'))
        <script>toastr.warning(@json(session('warning')));</script>
    @endif

    @if (session('info'))
        <script>toastr.info(@json(session('info')));</script>
    @endif

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        </script>
    @endif

    @yield('script')
    @yield('scripts')
    @stack('scripts')
</body>

</html>
