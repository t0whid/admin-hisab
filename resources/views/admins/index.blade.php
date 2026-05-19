@extends('layout.master')

@section('title', 'Admins | Shahjalal Enterprise')

@section('style')
<style>
    .page-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .page-title h1 {
        font-size: 30px;
        font-weight: 900;
        color: #111827;
        margin: 0;
        letter-spacing: -.04em;
    }

    .page-title p {
        color: #6b7280;
        margin: 7px 0 0;
        font-size: 14px;
    }

    .admin-card {
        border: 1px solid #e7edf5;
        border-radius: 28px;
        box-shadow: 0 22px 55px rgba(15, 23, 42, 0.08);
        overflow: hidden;
        background: #ffffff;
    }

    .table-toolbar {
        padding: 26px 28px;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        background:
            radial-gradient(circle at top right, rgba(124, 58, 237, 0.10), transparent 28%),
            linear-gradient(135deg, #ffffff, #f8f7ff);
    }

    .table-toolbar h5 {
        font-size: 21px;
        font-weight: 900;
        color: #111827;
        margin: 0;
        letter-spacing: -.03em;
    }

    .table-toolbar .small {
        color: #64748b !important;
        font-weight: 600;
    }

    .total-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border-radius: 999px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #111827;
        font-size: 13px;
        font-weight: 850;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.05);
    }

    .admin-table-wrap {
        padding: 18px;
    }

    .table-modern {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table-modern thead th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .06em;
        border-bottom: 1px solid #e5e7eb;
        padding: 15px 16px;
        white-space: nowrap;
        font-weight: 900;
    }

    .table-modern tbody td {
        padding: 15px 16px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .admin-avatar {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
        box-shadow: 0 10px 22px rgba(15, 23, 42, .07);
    }

    .admin-name {
        font-weight: 900;
        color: #111827;
        letter-spacing: -.02em;
    }

    .admin-sub {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        margin-top: 2px;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #7c3aed, #ec4899);
        border: 0;
        color: #fff;
        border-radius: 16px;
        padding: 12px 18px;
        font-weight: 900;
        box-shadow: 0 14px 28px rgba(124, 58, 237, .24);
        text-decoration: none;
    }

    .btn-gradient:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 18px 34px rgba(124, 58, 237, .32);
    }

    .btn-icon-soft,
    .btn-icon-danger,
    .btn-icon-lock {
        width: 39px;
        height: 39px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        text-decoration: none;
        transition: all .18s ease;
    }

    .btn-icon-soft {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .btn-icon-soft:hover {
        background: #ede9fe;
        color: #7c3aed;
        transform: translateY(-1px);
    }

    .btn-icon-danger {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .btn-icon-danger:hover {
        background: #fecaca;
        color: #991b1b;
        transform: translateY(-1px);
    }

    .btn-icon-lock {
        background: #f1f5f9;
        color: #94a3b8;
        border: 1px solid #e2e8f0;
        cursor: not-allowed;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .status-active {
        background: #dcfce7;
        color: #15803d;
    }

    .status-inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .empty-admin-state {
        border-radius: 24px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        padding: 48px 24px;
        text-align: center;
        color: #64748b;
    }

    .empty-admin-state i {
        width: 66px;
        height: 66px;
        border-radius: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #7c3aed;
        font-size: 28px;
        margin-bottom: 14px;
    }

    @media (max-width: 767.98px) {
        .page-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .admin-table-wrap {
            padding: 12px;
        }

        .table-toolbar {
            padding: 22px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="page-head">
        <div class="page-title">
            <h1>Admins</h1>
            <p>Create and manage super admin accounts.</p>
        </div>

        <a href="{{ route('admins.create') }}" class="btn btn-gradient">
            <i class="fa fa-plus me-1"></i>
            Add Admin
        </a>
    </div>

    <div class="card admin-card">
        <div class="table-toolbar">
            <div>
                <h5>Admin List</h5>
                <div class="small mt-1">Search, sort, export and manage administrator records.</div>
            </div>

            <span class="total-pill">
                <i class="fa fa-user-secret text-muted"></i>
                Total: {{ $admins->count() }}
            </span>
        </div>

        <div class="table-responsive admin-table-wrap">
            <table id="datatable-buttons" class="table table-modern table-hover align-middle w-100 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="no-sort no-search">Photo</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="no-sort no-search text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="fw-bold text-muted">{{ $loop->iteration }}</td>

                            <td>
                                <img src="{{ $admin->image ? asset($admin->image) : asset('assets/users/user.png') }}"
                                     alt="{{ $admin->name }}"
                                     class="admin-avatar"
                                     onerror="this.src='{{ asset('assets/users/user.png') }}'">
                            </td>

                            <td>
                                <div class="admin-name">{{ $admin->name }}</div>
                                <div class="admin-sub">Super Admin</div>
                            </td>

                            <td>{{ $admin->user_name ?: '-' }}</td>
                            <td>{{ $admin->email ?: '-' }}</td>
                            <td>{{ $admin->phone ?: '-' }}</td>

                            <td>
                                @if ($admin->status)
                                    <span class="status-pill status-active">
                                        <i class="fa fa-check-circle"></i>
                                        Active
                                    </span>
                                @else
                                    <span class="status-pill status-inactive">
                                        <i class="fa fa-ban"></i>
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admins.edit', $admin->id) }}"
                                       class="btn-icon-soft"
                                       title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    @if (auth()->id() !== $admin->id)
                                        <form action="{{ route('admins.destroy', $admin->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-icon-danger" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button type="button"
                                                class="btn-icon-lock"
                                                disabled
                                                title="You cannot delete your own account">
                                            <i class="fa fa-lock"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($admins->count() === 0)
                <div class="empty-admin-state">
                    <i class="fa fa-user-secret"></i>
                    <div class="fw-bold text-dark">No admin found</div>
                    <div class="small mt-1">Create your first admin account to manage the system.</div>
                    <a href="{{ route('admins.create') }}" class="btn btn-gradient mt-3">
                        <i class="fa fa-plus me-1"></i>
                        Add Admin
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection