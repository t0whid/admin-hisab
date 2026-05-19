@php
    $currentRoute = Route::currentRouteName();
    $userImage = $user && !empty($user->image) ? asset($user->image) : asset('assets/backend/images/profile_av.jpg');
@endphp

<aside class="admin-sidebar" id="adminSidebar">
    <div class="brand-card">
        <a href="{{ route('index') }}" class="d-flex align-items-center gap-3">
            <span class="brand-logo">
                <i class="fa fa-line-chart"></i>
            </span>
            <span>
                <span class="brand-title d-block">Shahjalal</span>
                <span class="brand-subtitle d-block">Enterprise Admin</span>
            </span>
        </a>
    </div>

    <div class="sidebar-user d-flex align-items-center gap-3">
        <img src="{{ $userImage }}" alt="{{ $user->name ?? 'User' }}" class="user-avatar">
        <div class="min-w-0">
            <div class="fw-bold text-white text-truncate">{{ $user->name ?? 'Admin' }}</div>
            <div class="small text-white-50">
                @if (($user->role ?? null) == 1)
                    Super Admin
                @elseif (($user->role ?? null) == 2)
                    Employee
                @else
                    Admin User
                @endif
            </div>
        </div>
    </div>

    <div class="sidebar-section-label">Main Menu</div>

    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('index') }}"
               class="sidebar-link {{ $currentRoute === 'index' ? 'active' : '' }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <button class="sidebar-toggle"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#customersMenu"
                    aria-expanded="{{ str_starts_with($currentRoute ?? '', 'customers.') ? 'true' : 'false' }}">
                <i class="fa fa-users"></i>
                <span class="flex-grow-1">Customers</span>
                <i class="fa fa-angle-down"></i>
            </button>

            <div class="collapse {{ str_starts_with($currentRoute ?? '', 'customers.') ? 'show' : '' }}"
                 id="customersMenu">
                <div class="sidebar-submenu">
                    <a href="{{ route('customers.index') }}"
                       class="{{ $currentRoute === 'customers.index' ? 'active' : '' }}">
                        All Customers
                    </a>
                    <a href="{{ route('customers.create') }}"
                       class="{{ $currentRoute === 'customers.create' ? 'active' : '' }}">
                        Create Customer
                    </a>
                </div>
            </div>
        </li>

        <li>
            <a href="{{ route('backup.index') }}"
               class="sidebar-link {{ str_starts_with($currentRoute ?? '', 'backup.') ? 'active' : '' }}">
                <i class="fa fa-database"></i>
                <span>Backup</span>
            </a>
        </li>

        <li>
            <a href="{{ route('report') }}"
               class="sidebar-link {{ $currentRoute === 'report' ? 'active' : '' }}">
                <i class="fa fa-bar-chart"></i>
                <span>Reports</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-section-label">Account</div>

    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('logout') }}" class="sidebar-link">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
