@extends('layout.master')

@section('title', 'My Profile | Shahjalal Enterprise')

@section('style')
<style>
    .profile-page-title h1 {
        font-size: 28px;
        font-weight: 850;
        color: #111827;
        margin: 0;
        letter-spacing: -.03em;
    }

    .profile-page-title p {
        color: #6b7280;
        margin: 6px 0 0;
        font-size: 14px;
    }

    .profile-card {
        border: 1px solid #e7edf5;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .profile-card-header {
        padding: 24px 28px;
        background: linear-gradient(135deg, #f8f7ff, #ffffff);
        border-bottom: 1px solid #eef2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .profile-card-header h5 {
        margin: 0;
        font-weight: 850;
        color: #111827;
    }

    .profile-card-body {
        padding: 28px;
    }

    .profile-preview-box {
        border-radius: 22px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        padding: 24px;
        text-align: center;
        height: 100%;
    }

    .profile-img {
        width: 145px;
        height: 145px;
        border-radius: 30px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        box-shadow: 0 16px 30px rgba(15, 23, 42, .10);
        margin-bottom: 16px;
    }

    .profile-name {
        font-size: 20px;
        font-weight: 850;
        color: #111827;
        margin-bottom: 4px;
    }

    .profile-role {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 999px;
        background: #eef2ff;
        color: #3730a3;
        font-size: 13px;
        font-weight: 800;
        margin-top: 8px;
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
        color: #111827;
    }

    .form-control:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, .12);
    }

    .section-title {
        font-weight: 850;
        color: #111827;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eef2f7;
    }

    .btn-gradient {
        border: 0;
        border-radius: 15px;
        padding: 13px 22px;
        font-weight: 850;
        color: #fff;
        background: linear-gradient(135deg, #7c3aed, #ec4899);
        box-shadow: 0 14px 28px rgba(124, 58, 237, .24);
    }

    .btn-gradient:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 18px 34px rgba(124, 58, 237, .32);
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
        line-height: 1.7;
    }

    .required {
        color: #ef4444;
    }

    @media (max-width: 575.98px) {
        .profile-card-body,
        .profile-card-header {
            padding: 22px;
        }
    }
</style>
@endsection

@section('content')
@php
    $roleLabel = (int) ($user->role ?? 0) === 1 ? 'Super Admin' : 'Admin';
@endphp

<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-4">
        <div class="profile-page-title">
            <h1>My Profile</h1>
            <p>Update your personal information, profile photo and password.</p>
        </div>

        <a href="{{ route('index') }}" class="btn btn-light-soft">
            <i class="fa fa-arrow-left me-1"></i>
            Dashboard
        </a>
    </div>

    <div class="profile-card">
        <div class="profile-card-header">
            <div>
                <h5>Profile Information</h5>
                <div class="small text-muted mt-1">Manage your admin account details.</div>
            </div>

            <span class="badge rounded-pill text-bg-light border px-3 py-2">
                {{ $roleLabel }}
            </span>
        </div>

        <div class="profile-card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="profile-preview-box">
                            <img
                                id="profilePreview"
                                src="{{ $user->image ? asset($user->image) : asset('assets/users/user.png') }}"
                                alt="{{ $user->name }}"
                                class="profile-img"
                                onerror="this.src='{{ asset('assets/users/user.png') }}'">

                            <div class="profile-name">{{ $user->name }}</div>
                            <div class="text-muted small">{{ $user->email ?: 'No email' }}</div>
                            <div class="profile-role">{{ $roleLabel }}</div>

                            <div class="mt-4 text-start">
                                <label for="image" class="form-label">Change Profile Photo</label>

                                <input type="file"
                                       name="image"
                                       id="image"
                                       class="form-control @error('image') is-invalid @enderror"
                                       accept="image/*">

                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="small text-muted mt-2">
                                    JPG, PNG, WEBP allowed. Max 4MB.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="section-title">Basic Information</div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">
                                    Name <span class="required">*</span>
                                </label>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name) }}"
                                       placeholder="Enter name"
                                       required>

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="user_name" class="form-label">Username</label>

                                <input type="text"
                                       name="user_name"
                                       id="user_name"
                                       class="form-control @error('user_name') is-invalid @enderror"
                                       value="{{ old('user_name', $user->user_name) }}"
                                       placeholder="Enter username">

                                @error('user_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>

                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $user->email) }}"
                                       placeholder="Enter email">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>

                                <input type="text"
                                       name="phone"
                                       id="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="Enter phone number">

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="section-title mt-5">Change Password</div>

                        <div class="password-note mb-4">
                            <i class="fa fa-info-circle me-1"></i>
                            Password change optional. Keep password fields empty if you do not want to change password.
                        </div>

                        <div class="row g-4">
                            <div class="col-md-4">
                                <label for="current_password" class="form-label">Current Password</label>

                                <input type="password"
                                       name="current_password"
                                       id="current_password"
                                       class="form-control @error('current_password') is-invalid @enderror"
                                       placeholder="Current password">

                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="password" class="form-label">New Password</label>

                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="New password">

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>

                                <input type="password"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       class="form-control"
                                       placeholder="Confirm password">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">
                            <a href="{{ route('index') }}" class="btn btn-light-soft">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-gradient">
                                <i class="fa fa-save me-1"></i>
                                Update Profile
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const profilePreview = document.getElementById('profilePreview');

        if (imageInput && profilePreview) {
            imageInput.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) return;

                profilePreview.src = URL.createObjectURL(file);
            });
        }
    });
</script>
@endsection