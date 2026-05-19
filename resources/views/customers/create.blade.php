@extends('layout.master')
@section('style')
<style>
    .form-control {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
    }

    label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 0.5rem;
    }

   
    button.btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        width: 100%;
    }

    button.btn-primary:hover {
        background-color: #0056b3;
        border-color: #004ea1;
    }
</style
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Add New Customer</h2>
       

        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="full_name">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                    id="full_name" value="{{ old('full_name') }}" required>
                @error('full_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" value="{{ old('phone') }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="father_name">Father's Name</label>
                <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror"
                    id="father_name" value="{{ old('father_name') }}">
                @error('father_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" class="form-control @error('age') is-invalid @enderror"
                    id="age" value="{{ old('age') }}">
                @error('age')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                    id="address" value="{{ old('address') }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"
                    id="image">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
@section('script')
@endsection
