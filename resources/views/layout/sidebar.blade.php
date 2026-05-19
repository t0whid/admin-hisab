@php
    $currentRoute = Route::currentRouteName();

    $userImage = $user && !empty($user->image)
        ? asset($user->image)
        : asset('assets/backend/images/profile_av.jpg');

    $roleLabel = ($user && (int) ($user->role ?? 0) === 1)
        ? 'Super Admin'
        : 'Admin';
@endphp

<style>
    .admin-sidebar {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .developer-credit {
        margin: auto 16px 16px;
        padding: 14px;
        border-radius: 20px;
        background:
            linear-gradient(135deg, rgba(124, 58, 237, 0.18), rgba(236, 72, 153, 0.12)),
            rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .developer-credit-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .credit-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: linear-gradient(135deg, #7c3aed, #ec4899);
        box-shadow: 0 10px 22px rgba(124, 58, 237, 0.28);
    }

    .credit-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .09em;
        color: rgba(255, 255, 255, 0.52);
        font-weight: 800;
        line-height: 1.2;
    }

    .credit-name {
        color: #ffffff;
        font-size: 13px;
        font-weight: 850;
        line-height: 1.25;
        margin-top: 2px;
    }

    .credit-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.10);
        margin: 10px 0;
    }

    .credit-link {
        display: flex;
        align-items: center;
        gap: 7px;
        color: rgba(255, 255, 255, 0.72);
        font-size: 11.5px;
        text-decoration: none;
        margin-top: 7px;
        line-height: 1.35;
        word-break: break-all;
        transition: all .18s ease;
    }

    .credit-link i {
        width: 14px;
        color: rgba(255, 255, 255, 0.48);
    }

    .credit-link:hover {
        color: #ffffff;
        transform: translateX(2px);
    }

    .credit-link:hover i {
        color: #ffffff;
    }
</style>

<aside class="admin-sidebar" id="adminSidebar">
    <div class="brand-card">
        <a href="{{ route('index') }}" class="d-flex align-items-center gap-3">
            <span class="brand-logo">
                <i class="fa fa-line-chart"></i>
            </span>

            <span>
                <span class="brand-title d-block">Shahjalal Enterprise</span>
                <span class="brand-subtitle d-block">Admin Panel</span>
            </span>
        </a>
    </div>

    <div class="sidebar-user d-flex align-items-center gap-3">
        <img src="{{ $userImage }}"
             alt="{{ $user->name ?? 'User' }}"
             class="user-avatar"
             onerror="this.src='{{ asset('assets/backend/images/profile_av.jpg') }}'">

        <div class="min-w-0">
            <div class="fw-bold text-white text-truncate">
                {{ $user->name ?? 'Admin' }}
            </div>

            <div class="small text-white-50">
                {{ $roleLabel }}
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
            <a href="{{ route('customers.index') }}"
               class="sidebar-link {{ str_starts_with($currentRoute ?? '', 'customers.') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span>Customers</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admins.index') }}"
               class="sidebar-link {{ str_starts_with($currentRoute ?? '', 'admins.') ? 'active' : '' }}">
                <i class="fa fa-user-secret"></i>
                <span>Admins</span>
            </a>
        </li>

        <li>
            <a href="{{ route('report') }}"
               class="sidebar-link {{ $currentRoute === 'report' ? 'active' : '' }}">
                <i class="fa fa-bar-chart"></i>
                <span>Reports</span>
            </a>
        </li>

        <li>
            <a href="{{ route('backup.index') }}"
               class="sidebar-link {{ str_starts_with($currentRoute ?? '', 'backup.') ? 'active' : '' }}">
                <i class="fa fa-database"></i>
                <span>Backup</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-section-label">Account</div>

    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('profile.edit') }}"
               class="sidebar-link {{ str_starts_with($currentRoute ?? '', 'profile.') ? 'active' : '' }}">
                <i class="fa fa-user"></i>
                <span>My Profile</span>
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}" class="sidebar-link">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

    <div class="developer-credit">
        <div class="developer-credit-top">
            <div class="credit-icon">
                <i class="fa fa-code"></i>
            </div>

            <div>
                <div class="credit-label">Developed by</div>
                <div class="credit-name">Towhid Hasan Zahor</div>
            </div>
        </div>

        <div class="credit-divider"></div>

        <a href="mailto:towhid.hasan.zahor@gmail.com" class="credit-link">
            <i class="fa fa-envelope"></i>
            <span>towhid.hasan.zahor@gmail.com</span>
        </a>

        <a href="tel:01521256487" class="credit-link">
            <i class="fa fa-phone"></i>
            <span>01521256487</span>
        </a>
    </div>
</aside>