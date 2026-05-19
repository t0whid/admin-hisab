@php
    $user = auth()->user();

    $userImage = $user && !empty($user->image)
        ? asset($user->image)
        : asset('assets/backend/images/profile_av.jpg');

    $roleLabel = $user && (int) ($user->role ?? 0) === 1 ? 'Super Admin' : 'Admin';
@endphp

<style>
    .admin-topbar {
        position: sticky;
        top: 0;
        z-index: 1020;
        height: 76px;
        background: rgba(248, 250, 252, 0.88);
        backdrop-filter: blur(18px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.9);
    }

    .topbar-btn {
        width: 42px;
        height: 42px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        background: #ffffff;
        color: #334155;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .topbar-btn:hover {
        background: #f1f5f9;
        color: #7c3aed;
    }

    .topbar-user-btn {
        border: 1px solid #e5e7eb;
        background: #ffffff;
        border-radius: 18px;
        padding: 7px 10px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
        transition: all 0.2s ease;
    }

    .topbar-user-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.10);
        border-color: #ddd6fe;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 14px;
        object-fit: cover;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
    }

    .user-meta {
        line-height: 1.15;
        text-align: left;
    }

    .user-meta-name {
        font-size: 14px;
        font-weight: 800;
        color: #111827;
        max-width: 130px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-meta-role {
        font-size: 12px;
        color: #64748b;
        font-weight: 700;
    }

    .user-dropdown {
        min-width: 280px;
        border: 0;
        border-radius: 22px;
        box-shadow: 0 22px 55px rgba(15, 23, 42, 0.16);
        overflow: hidden;
    }

    .dropdown-profile-head {
        padding: 18px;
        background: linear-gradient(135deg, #f8f7ff, #ffffff);
        border-bottom: 1px solid #eef2f7;
    }

    .dropdown-profile-avatar {
        width: 52px;
        height: 52px;
        border-radius: 18px;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.12);
        background: #f8fafc;
    }

    .dropdown-profile-name {
        font-weight: 850;
        color: #111827;
        line-height: 1.2;
        max-width: 170px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-profile-email {
        color: #64748b;
        font-size: 13px;
        max-width: 170px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .role-pill {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 999px;
        background: #eef2ff;
        color: #3730a3;
        font-size: 12px;
        font-weight: 800;
        margin-top: 8px;
    }

    .user-dropdown .dropdown-item {
        border-radius: 14px;
        padding: 11px 13px;
        font-weight: 700;
        color: #334155;
        display: flex;
        align-items: center;
    }

    .user-dropdown .dropdown-item i {
        width: 22px;
        margin-right: 10px;
        color: #64748b;
    }

    .user-dropdown .dropdown-item:hover,
    .user-dropdown .dropdown-item.active {
        background: #f3f0ff;
        color: #7c3aed;
    }

    .user-dropdown .dropdown-item:hover i,
    .user-dropdown .dropdown-item.active i {
        color: #7c3aed;
    }

    .user-dropdown .dropdown-item.text-danger {
        color: #dc2626 !important;
    }

    .user-dropdown .dropdown-item.text-danger i {
        color: #dc2626;
    }

    .user-dropdown .dropdown-item.text-danger:hover {
        background: #fee2e2;
        color: #b91c1c !important;
    }

    @media (max-width: 575.98px) {
        .admin-topbar {
            height: 68px;
        }

        .user-dropdown {
            min-width: 260px;
        }
    }
</style>

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
            <a href="{{ route('customers.create') }}"
               class="btn btn-gradient rounded-4 d-none d-md-inline-flex align-items-center gap-2 px-3">
                <i class="fa fa-plus"></i>
                <span>New Customer</span>
            </a>

            <div class="dropdown">
                <button class="topbar-user-btn d-flex align-items-center gap-2"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    <img src="{{ $userImage }}"
                         alt="{{ $user->name ?? 'User' }}"
                         class="user-avatar"
                         onerror="this.src='{{ asset('assets/backend/images/profile_av.jpg') }}'">

                    <span class="user-meta d-none d-sm-block">
                        <span class="user-meta-name">{{ $user->name ?? 'Admin' }}</span>
                        <span class="user-meta-role d-block">{{ $roleLabel }}</span>
                    </span>

                    <i class="fa fa-angle-down text-muted ms-1"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end user-dropdown mt-2 p-0">
                    <li>
                        <div class="dropdown-profile-head">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $userImage }}"
                                     alt="{{ $user->name ?? 'User' }}"
                                     class="dropdown-profile-avatar"
                                     onerror="this.src='{{ asset('assets/backend/images/profile_av.jpg') }}'">

                                <div>
                                    <div class="dropdown-profile-name">
                                        {{ $user->name ?? 'Admin' }}
                                    </div>

                                    <div class="dropdown-profile-email">
                                        {{ $user->email ?? 'No email' }}
                                    </div>

                                    <span class="role-pill">
                                        {{ $roleLabel }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="p-2">
                        <a href="{{ route('profile.edit') }}"
                           class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                            <i class="fa fa-user"></i>
                            <span>My Profile</span>
                        </a>

                        <a href="{{ route('backup.index') }}"
                           class="dropdown-item">
                            <i class="fa fa-database"></i>
                            <span>Backup</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider my-0">
                    </li>

                    <li class="p-2">
                        <a class="dropdown-item text-danger"
                           href="{{ route('logout') }}">
                            <i class="fa fa-sign-out"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>