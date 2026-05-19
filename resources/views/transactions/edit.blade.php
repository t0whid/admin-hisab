@extends('layout.master')

@section('title', 'Edit Transaction | Shahjalal Enterprise')

@section('style')
<style>
    .transaction-page-title h1 {
        font-size: 28px;
        font-weight: 850;
        color: #111827;
        margin: 0;
        letter-spacing: -.03em;
    }

    .transaction-page-title p {
        color: #6b7280;
        margin: 6px 0 0;
        font-size: 14px;
    }

    .transaction-card {
        border: 1px solid #e7edf5;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .transaction-card-header {
        padding: 24px 28px;
        background: linear-gradient(135deg, #fff7ed, #ffffff);
        border-bottom: 1px solid #eef2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .transaction-card-header h5 {
        margin: 0;
        font-weight: 850;
        color: #111827;
    }

    .customer-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 13px;
        border-radius: 999px;
        background: #eef2ff;
        color: #3730a3;
        font-weight: 800;
        font-size: 13px;
    }

    .transaction-card-body {
        padding: 28px;
    }

    .form-label {
        font-weight: 800;
        color: #374151;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        min-height: 50px;
        border-radius: 15px;
        border: 1px solid #dde3ee;
        padding: 11px 14px;
        color: #111827;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #f97316;
        box-shadow: 0 0 0 4px rgba(249, 115, 22, .12);
    }

    .btn-warning-modern {
        border: 0;
        border-radius: 15px;
        padding: 13px 22px;
        font-weight: 850;
        color: #ffffff;
        background: linear-gradient(135deg, #f97316, #ec4899);
        box-shadow: 0 14px 28px rgba(249, 115, 22, .22);
    }

    .btn-warning-modern:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 18px 34px rgba(249, 115, 22, .30);
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

    .edit-warning {
        border-radius: 20px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        padding: 18px;
        color: #9a3412;
        font-size: 14px;
        line-height: 1.7;
    }

    .required {
        color: #ef4444;
    }

    @media (max-width: 575.98px) {
        .transaction-card-body,
        .transaction-card-header {
            padding: 22px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-4">
        <div class="transaction-page-title">
            <h1>Edit Transaction</h1>
            <p>Update transaction details and automatically adjust balance.</p>
        </div>

        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-light-soft">
            <i class="fa fa-arrow-left me-1"></i>
            Back
        </a>
    </div>

    <div class="transaction-card">
        <div class="transaction-card-header">
            <div>
                <h5>Update Transaction</h5>
                <div class="small text-muted mt-1">Changing amount/type will update customer balance.</div>
            </div>

            <span class="customer-pill">
                <i class="fa fa-user"></i>
                {{ $customer->full_name }}
            </span>
        </div>

        <div class="transaction-card-body">
            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="type" class="form-label">
                                    Transaction Type <span class="required">*</span>
                                </label>

                                <select class="form-select @error('type') is-invalid @enderror"
                                        name="type"
                                        id="type"
                                        required>
                                    <option value="">Select Type</option>
                                    <option value="credit" {{ old('type', $transaction->type) === 'credit' ? 'selected' : '' }}>
                                        Credit
                                    </option>
                                    <option value="debit" {{ old('type', $transaction->type) === 'debit' ? 'selected' : '' }}>
                                        Debit
                                    </option>
                                </select>

                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_transaction" class="form-label">
                                    Amount TK <span class="required">*</span>
                                </label>

                                <input type="number"
                                       name="last_transaction"
                                       id="last_transaction"
                                       class="form-control @error('last_transaction') is-invalid @enderror"
                                       value="{{ old('last_transaction', $transaction->last_transaction) }}"
                                       placeholder="Enter amount"
                                       min="0.01"
                                       step="0.01"
                                       required>

                                @error('last_transaction')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="transaction_date" class="form-label">
                                    Transaction Date <span class="required">*</span>
                                </label>

                                <input type="date"
                                       name="transaction_date"
                                       id="transaction_date"
                                       class="form-control @error('transaction_date') is-invalid @enderror"
                                       value="{{ old('transaction_date', optional($transaction->created_at)->format('Y-m-d') ?? date('Y-m-d')) }}"
                                       required>

                                @error('transaction_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Current Customer Balance</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ number_format((float) ($customer->amount ?? 0), 2) }} TK"
                                       readonly>
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>

                                <textarea name="description"
                                          id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Write transaction note">{{ old('description', $transaction->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="edit-warning h-100">
                            <div class="fw-bold text-dark mb-2">
                                <i class="fa fa-exclamation-triangle me-1"></i>
                                Important
                            </div>

                            <div class="mb-2">
                                Old transaction effect will be reversed first.
                            </div>

                            <div class="mb-2">
                                Then the new transaction value will be applied.
                            </div>

                            <div>
                                This keeps the customer balance correct after edit.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between gap-2 mt-4 flex-wrap">
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-light-soft">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-warning-modern">
                        <i class="fa fa-save me-1"></i>
                        Update Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection