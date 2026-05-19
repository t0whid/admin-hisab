@extends('layout.master')

@section('style')
<style>
    .page-title h1 { font-size: 28px; font-weight: 800; color: #111827; margin: 0; }
    .page-title p { color: #6b7280; margin: 6px 0 0; font-size: 14px; }
    .form-card { border: 0; border-radius: 24px; box-shadow: 0 18px 45px rgba(15, 23, 42, .08); overflow: hidden; }
    .form-card-header { padding: 22px 26px; border-bottom: 1px solid #eef2f7; background: linear-gradient(135deg, #f8f7ff, #fff); }
    .form-card-header h5 { font-weight: 800; margin: 0; color: #111827; }
    .form-card-body { padding: 26px; }
    .form-label { font-weight: 800; color: #374151; font-size: 14px; }
    .form-control { border-radius: 14px; border: 1px solid #dde3ee; min-height: 48px; padding: 10px 14px; }
    .form-control:focus { border-color: #7c3aed; box-shadow: 0 0 0 4px rgba(124,58,237,.12); }
    .btn-gradient { border: 0; border-radius: 14px; padding: 12px 22px; font-weight: 800; color: #fff; background: linear-gradient(135deg,#7c3aed,#ec4899); box-shadow: 0 14px 28px rgba(124,58,237,.24); }
    .btn-gradient:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 18px 34px rgba(124,58,237,.32); }
    .btn-light-soft { border-radius: 14px; padding: 12px 18px; font-weight: 800; background: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; }
    .preview-img { width: 92px; height: 92px; border-radius: 18px; object-fit: cover; border: 1px solid #e5e7eb; background: #f8fafc; }
    .required { color: #ef4444; }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-4">
        <div class="page-title">
            <h1>Edit Customer</h1>
            <p>Update customer profile and contact information.</p>
        </div>
        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-light-soft">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card form-card">
        <div class="form-card-header d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <h5>Customer Information</h5>
            <img src="{{ $customer->image ? asset($customer->image) : asset('assets/customers/user.png') }}" alt="{{ $customer->full_name }}" class="preview-img" onerror="this.src='{{ asset('assets/customers/user.png') }}'">
        </div>
        <div class="form-card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name <span class="required">*</span></label>
                        <input type="text" name="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name', $customer->full_name) }}" placeholder="Enter full name" required>
                        @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $customer->phone) }}" placeholder="Enter phone number">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Father's Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name', $customer->father_name) }}" placeholder="Enter father's name">
                        @error('father_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" id="age" class="form-control @error('age') is-invalid @enderror" value="{{ old('age', $customer->age) }}" placeholder="Enter age">
                        @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $customer->email) }}" placeholder="Enter email address">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Change Image</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $customer->address) }}" placeholder="Enter address">
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-light-soft">Cancel</a>
                    <button type="submit" class="btn btn-gradient">
                        <i class="fa fa-save me-1"></i> Update Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
