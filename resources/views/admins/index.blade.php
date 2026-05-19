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
        font-size: 28px;
        font-weight: 850;
        color: #111827;
        margin: 0;
        letter-spacing: -.03em;
    }

    .page-title p {
        color: #6b7280;
        margin: 6px 0 0;
        font-size: 14px;
    }

    .admin-card {
        border: 1px solid #e7edf5;
        border-radius: 24px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.07);
        overflow: hidden;
        background: #ffffff;
    }

    .table-toolbar {
        padding: 22px 24px;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        background: linear-gradient(135deg, #ffffff, #f8f7ff);
    }

    .table-toolbar h5 {
        font-weight: 850;
        color: #111827;
        margin: 0;
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
        font-weight: 850;
    }

    .table-modern tbody td {
        padding: 15px 16px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .avatar-img {
        width: 48px;
        height: 48px;
        border-radius: 15px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #7c3aed, #ec4899);
        border: 0;
        color: #fff;
        border-radius: 14px;
        padding: 11px 17px;
        font-weight: 850;
        box-shadow: 0 12px 24px rgba(124, 58, 237, .22);
        text-decoration: none;
    }

    .btn-gradient:hover {
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-icon-soft,
    .btn-icon-danger {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }

    .btn-icon-soft {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-icon-soft:hover {
        background: #ede9fe;
        color: #7c3aed;
    }

    .btn-icon-danger {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fecaca;
    }

    .btn-icon-danger:hover {
        background: #fecaca;
        color: #991b1b;
    }

    .role-pill {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 999px;
        background: #eef2ff;
        color: #3730a3;
        font-weight: 800;
        font-size: 13px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="page-head">
        <div class="page-title">
            <h1>Admins</h1>
            <p>Create and manage admin accounts.</p>
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
                <div class="small text-muted mt-1">All admins are created as Super Admin.</div>
            </div>

            <span class="badge rounded-pill text-bg-light border px-3 py-2">
                Total: {{ $admins->count() }}
            </span>
        </div>

        <div class="table-responsive p-3">
            <table id="datatable-buttons" class="table table-modern table-hover align-middle w-100 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        {{-- <th>Role</th> --}}
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="fw-bold text-muted">{{ $loop->iteration }}</td>

                            <td>
                                <img src="{{ $admin->image ? asset($admin->image) : asset('assets/users/user.png') }}"
                                     alt="{{ $admin->name }}"
                                     class="avatar-img"
                                     onerror="this.src='{{ asset('assets/users/user.png') }}'">
                            </td>

                            <td>
                                <div class="fw-bold text-dark">{{ $admin->name }}</div>
                            </td>

                            <td>{{ $admin->user_name ?: '-' }}</td>
                            <td>{{ $admin->email ?: '-' }}</td>
                            <td>{{ $admin->phone ?: '-' }}</td>

                            {{-- <td>
                                <span class="role-pill">Super Admin</span>
                            </td> --}}

                            <td>
                                @if ($admin->status)
                                    <span class="badge rounded-pill text-bg-success">Active</span>
                                @else
                                    <span class="badge rounded-pill text-bg-secondary">Inactive</span>
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
                                                class="btn-icon-danger"
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
                <div class="text-center py-5 text-muted">
                    <i class="fa fa-user fa-2x mb-3 d-block"></i>
                    No admin found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection