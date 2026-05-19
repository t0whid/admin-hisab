@php
    $userImage = $user && !empty($user->image) ? asset($user->image) : asset('assets/backend/images/profile_av.jpg');
@endphp

<header class="admin-topbar">
    <div class="h-100 px-3 px-lg-4 d-flex align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <button type="button" class="topbar-btn d-lg-none" id="sidebarToggle" aria-label="Toggle sidebar">
                <i class="fa fa-bars"></i>
            </button>

            <div>
                <div class="fw-bold">Dashboard</div>
                <div class="small text-muted d-none d-sm-block">
                    Welcome back, {{ $user->name ?? 'Admin' }}
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('customers.create') }}" class="btn btn-gradient rounded-4 d-none d-md-inline-flex align-items-center gap-2 px-3">
                <i class="fa fa-plus"></i>
                <span>New Customer</span>
            </a>

            <div class="dropdown">
                <button class="btn bg-white border rounded-4 d-flex align-items-center gap-2 px-2 px-sm-3 py-2"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <img src="{{ $userImage }}" alt="{{ $user->name ?? 'User' }}" class="user-avatar" style="width: 34px; height: 34px;">
                    <span class="fw-bold d-none d-sm-inline">{{ $user->name ?? 'Admin' }}</span>
                    <i class="fa fa-angle-down text-muted"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 mt-2 p-2">
                    <li>
                        <a class="dropdown-item rounded-3 py-2" href="javascript:void(0);">
                            <i class="fa fa-user me-2 text-muted"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item rounded-3 py-2" href="{{ route('backup.index') }}">
                            <i class="fa fa-database me-2 text-muted"></i> Backup
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item rounded-3 py-2 text-danger" href="{{ route('logout') }}">
                            <i class="fa fa-sign-out me-2"></i> Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
