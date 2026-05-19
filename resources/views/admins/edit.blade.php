@extends('layout.master')

@section('title', 'Edit Admin | Shahjalal Enterprise')

@section('style')
<style>
    .page-title h1 {
        font-size: 28px;
        font-weight: 850;
        color: #111827;
        margin: 0;
    }

    .page-title p {
        color: #6b7280;
        margin: 6px 0 0;
        font-size: 14px;
    }

    .form-card {
        border: 1px solid #e7edf5;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .form-card-header {
        padding: 24px 28px;
        background: linear-gradient(135deg, #f8f7ff, #ffffff);
        border-bottom: 1px solid #eef2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .form-card-header h5 {
        margin: 0;
        font-weight: 850;
        color: #111827;
    }

    .form-card-body {
        padding: 28px;
    }

    .admin-preview-img {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
    }

    .form-label {
        font-weight: 800;
        color: #374151;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 50px;
        border-radius: 15px;
        border: 1px solid #dde3ee;
        padding: 11px 14px;
    }

    .form-control:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, .12);
    }

    .btn-gradient {
        border: 0;
        border-radius: 15px;
        padding: 13px 22px;
        font-weight: 850;
        color: #fff;
        background: linear-gradient(135deg, #7c3aed, #ec4899);
    }

    .btn-gradient:hover {
        color: #fff;
    }

    .btn-light-soft {
        border-radius: 15px;
        padding: 13px 20px;
        font-weight: 800;
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }

    .password-note {
        border-radius: 18px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        padding: 16px;
        font-size: 14px;
    }

    .required {
        color: #ef4444;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-4">
        <div class="page-title">
            <h1>Edit Admin</h1>
            <p>Update admin account information.</p>
        </div>

        <a href="{{ route('admins.index') }}" class="btn btn-light-soft">
            <i class="fa fa-arrow-left me-1"></i>
            Back
        </a>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div>
                <h5>Admin Information</h5>
                <div class="small text-muted mt-1">Role is fixed as Super Admin.</div>
            </div>

            <img src="{{ $admin->image ? asset($admin->image) : asset('assets/users/user.png') }}"
                 alt="{{ $admin->name }}"
                 class="admin-preview-img"
                 onerror="this.src='{{ asset('assets/users/user.png') }}'">
        </div>

        <div class="form-card-body">
            <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $admin->name) }}"
                               placeholder="Enter name"
                               required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" name="user_name" id="user_name"
                               class="form-control @error('user_name') is-invalid @enderror"
                               value="{{ old('user_name', $admin->user_name) }}"
                               placeholder="Enter username">
                        @error('user_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $admin->email) }}"
                               placeholder="Enter email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $admin->phone) }}"
                               placeholder="Enter phone">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" name="image" id="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="status"
                                   {{ old('status', $admin->status) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="status">Active</label>
                        </div>
                    </div>
                </div>

                <div class="password-note mt-4">
                    <i class="fa fa-info-circle me-1"></i>
                    Password change optional. Keep password fields empty if you do not want to change password.
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Enter new password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control"
                               placeholder="Confirm new password">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">
                    <a href="{{ route('admins.index') }}" class="btn btn-light-soft">Cancel</a>

                    <button type="submit" class="btn btn-gradient">
                        <i class="fa fa-save me-1"></i>
                        Update Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection