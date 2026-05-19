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
        <h2>New Transaction for {{ $customer->full_name }}</h2>

        <form action="{{ route('transactions.store', $customer->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" name="type" id="type">
                    <option value="">Select</option>
                    <option value="credit">Credit</option>
                    <option value="debit">Debit</option>
                </select>
            </div>
            <div class="form-group">
                <label for="last_transaction">Transaction(Taka)</label>
                <input type="number" name="last_transaction" id="last_transaction" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="transaction_date" id="transaction_date" class="form-control"  value="{{ request('date', date('Y-m-d')) }}" required>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
