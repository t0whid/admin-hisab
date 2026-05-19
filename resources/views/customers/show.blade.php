@extends('layout.master')

@section('style')
<style>
    .page-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 24px; }
    .page-title h1 { font-size: 28px; font-weight: 800; color: #111827; margin: 0; }
    .page-title p { color: #6b7280; margin: 6px 0 0; font-size: 14px; }
    .profile-card, .details-card, .history-card { border: 0; border-radius: 24px; box-shadow: 0 18px 45px rgba(15, 23, 42, .08); overflow: hidden; background: #fff; }
    .profile-card { padding: 26px; text-align: center; }
    .profile-img { width: 220px; height: 270px; max-width: 100%; border-radius: 22px; object-fit: cover; border: 1px solid #e5e7eb; background: #f8fafc; box-shadow: 0 16px 30px rgba(15,23,42,.10); }
    .profile-name { font-size: 22px; font-weight: 900; color: #111827; margin: 18px 0 4px; }
    .profile-phone { color: #6b7280; margin-bottom: 0; }
    .amount-pill { display: inline-flex; align-items: center; justify-content: center; padding: 10px 16px; border-radius: 999px; background: #ccfbf1; color: #0f766e; font-weight: 900; margin-top: 16px; }
    .details-card-header, .history-card-header { padding: 22px 24px; border-bottom: 1px solid #eef2f7; background: linear-gradient(135deg, #f8f7ff, #fff); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .details-card-header h5, .history-card-header h5 { margin: 0; font-weight: 900; color: #111827; }
    .details-list { padding: 8px 24px 24px; }
    .detail-row { display: grid; grid-template-columns: 180px 1fr; gap: 14px; padding: 16px 0; border-bottom: 1px solid #eef2f7; }
    .detail-row:last-child { border-bottom: 0; }
    .detail-label { color: #64748b; font-weight: 800; }
    .detail-value { color: #111827; font-weight: 700; word-break: break-word; }
    .btn-gradient { border: 0; border-radius: 14px; padding: 11px 18px; font-weight: 800; color: #fff; background: linear-gradient(135deg,#7c3aed,#ec4899); box-shadow: 0 14px 28px rgba(124,58,237,.24); }
    .btn-gradient:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 18px 34px rgba(124,58,237,.32); }
    .btn-light-soft { border-radius: 14px; padding: 11px 16px; font-weight: 800; background: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; }
    .btn-danger-soft { border: 0; border-radius: 14px; padding: 11px 18px; font-weight: 800; background: #fee2e2; color: #b91c1c; }
    .btn-danger-soft:hover { background: #fecaca; color: #991b1b; }
    .table-modern { margin-bottom: 0; vertical-align: middle; }
    .table-modern thead th { background: #f8fafc; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid #e5e7eb; padding: 14px 16px; white-space: nowrap; }
    .table-modern tbody td { padding: 14px 16px; color: #334155; border-color: #eef2f7; }
    .type-badge { display: inline-flex; padding: 7px 10px; border-radius: 999px; font-size: 12px; font-weight: 900; background: #e0e7ff; color: #3730a3; }
    @media (max-width: 767.98px) { .detail-row { grid-template-columns: 1fr; gap: 4px; } }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="page-head">
        <div class="page-title">
            <h1>Customer Details</h1>
            <p>View profile, balance and transaction history.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('customers.index') }}" class="btn btn-light-soft"><i class="fa fa-arrow-left me-1"></i> Back</a>
            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-gradient"><i class="fa fa-edit me-1"></i> Edit</a>
            <a href="{{ route('transactions.create', $customer->id) }}" class="btn btn-danger-soft"><i class="fa fa-plus me-1"></i> Add Transaction</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-3 col-lg-4">
            <div class="profile-card h-100">
                <img
                    src="{{ $customer->image ? asset($customer->image) : asset('assets/customers/user.png') }}"
                    alt="{{ $customer->full_name }}"
                    class="profile-img"
                    onerror="this.src='{{ asset('assets/customers/user.png') }}'">
                <div class="profile-name">{{ $customer->full_name }}</div>
                <p class="profile-phone">{{ $customer->phone ?: 'No phone number' }}</p>
                <div class="amount-pill">Amount: {{ $customer->amount ?? 0 }}</div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8">
            <div class="details-card h-100">
                <div class="details-card-header">
                    <h5>Personal Information</h5>
                </div>

                <div class="details-list">
                    <div class="detail-row">
                        <div class="detail-label">Full Name</div>
                        <div class="detail-value">{{ $customer->full_name ?: '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Father Name</div>
                        <div class="detail-value">{{ $customer->father_name ?: '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Address</div>
                        <div class="detail-value">{{ $customer->address ?: '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Age</div>
                        <div class="detail-value">{{ $customer->age ?: '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile</div>
                        <div class="detail-value">{{ $customer->phone ?: '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $customer->email ?: '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Amount</div>
                        <div class="detail-value">{{ $customer->amount ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="history-card mt-4">
        <div class="history-card-header">
            <h5>Transaction History</h5>
            <a href="{{ route('transactions.create', $customer->id) }}" class="btn btn-gradient btn-sm">
                <i class="fa fa-plus me-1"></i> Add Transaction
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Transaction</th>
                        <th>Total Amount</th>
                        <th>Description</th>
                        <th>Update By</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td><span class="type-badge">{{ ucfirst($transaction->type) }}</span></td>
                            <td>{{ $transaction->last_transaction }}</td>
                            <td class="fw-bold">{{ $transaction->total_amount }}</td>
                            <td>{{ $transaction->description ?: '-' }}</td>
                            <td>{{ $transaction->updated_by ?: '-' }}</td>
                            <td>{{ $transaction->created_at ? $transaction->created_at->format('Y-m-d') : '-' }}</td>
                            <td>
                                @if ($loop->first)
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-light-soft">Update</a>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="fw-bold text-muted">No transactions found</div>
                                <a href="{{ route('transactions.create', $customer->id) }}" class="btn btn-sm btn-gradient mt-3">Add First Transaction</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
