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
</style>
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Edit Transaction for {{ $customer->full_name }}</h2>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="type">Type</label>
                <select class="form-control" name="type" id="type" required>
                    <option value="">Select</option>
                    <option value="credit" {{ $transaction->type == 'credit' ? 'selected' : '' }}>Credit</option>
                    <option value="debit" {{ $transaction->type == 'debit' ? 'selected' : '' }}>Debit</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="last_transaction">Amount</label>
                <input type="number" name="last_transaction" id="last_transaction" class="form-control" value="{{ $transaction->last_transaction }}" required>
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $transaction->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="transaction_date" id="transaction_date" class="form-control"  value="{{ request('date', date('Y-m-d')) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
