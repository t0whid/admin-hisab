@extends('layout.master')

@section('title', 'Customers | Shahjalal Enterprise')

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

        .customer-card {
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
            letter-spacing: -.02em;
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
            font-weight: 850;
        }

        .table-modern tbody td {
            padding: 15px 16px;
            color: #334155;
            border-color: #eef2f7;
        }

        .customer-row {
            cursor: pointer;
            transition: all .18s ease;
        }

        .customer-row:hover {
            background: #f8f7ff;
        }

        .avatar-img {
            width: 48px;
            height: 48px;
            border-radius: 15px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .06);
        }

        .amount-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 11px;
            border-radius: 999px;
            font-weight: 850;
            color: #0f766e;
            background: #ccfbf1;
            font-size: 13px;
            white-space: nowrap;
        }

        .amount-danger {
            color: #b91c1c;
            background: #fee2e2;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            border: 0;
            color: #fff;
            border-radius: 14px;
            padding: 11px 17px;
            font-weight: 850;
            box-shadow: 0 12px 24px rgba(124, 58, 237, .22);
        }

        .btn-gradient:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(124, 58, 237, .30);
        }

        .btn-icon-soft {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            text-decoration: none;
        }

        .btn-icon-soft:hover {
            background: #ede9fe;
            color: #7c3aed;
        }

        .btn-icon-danger {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .btn-icon-danger:hover {
            background: #fecaca;
            color: #991b1b;
        }

        .btn-icon-danger:disabled {
            opacity: .45;
            cursor: not-allowed;
        }

        @media (max-width: 767.98px) {
            .page-head {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="page-head">
            <div class="page-title">
                <h1>Customers</h1>
                <p>Manage customer profiles, contact details and transactions.</p>
            </div>

            <a href="{{ route('customers.create') }}" class="btn btn-gradient">
                <i class="fa fa-plus me-1"></i> Add Customer
            </a>
        </div>

        <div class="card customer-card">
            <div class="table-toolbar">
                <div>
                    <h5>Customer List</h5>
                    <div class="small text-muted mt-1">Search, sort, export and print customer records.</div>
                </div>
                <span class="badge rounded-pill text-bg-light border px-3 py-2">
                    Total: {{ isset($customers) ? $customers->count() : 0 }}
                </span>
            </div>

            <div class="table-responsive p-3">
                <table id="datatable-buttons" class="table table-modern table-hover align-middle w-100 datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="no-sort no-search">Photo</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Address</th>
                            <th>Amount</th>
                            <th>Phone</th>
                            <th class="no-sort no-search text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($customers as $customer)
                            @php
                                $customerAmount = (float) ($customer->amount ?? 0);
                                $canDelete = abs($customerAmount) <= 0.00001;
                            @endphp

                            <tr class="customer-row"
                                onclick="window.location='{{ route('customers.show', $customer->id) }}';">
                                <td class="fw-bold text-muted">{{ $loop->iteration }}</td>

                                <td>
                                    <img src="{{ $customer->image ? asset($customer->image) : asset('assets/customers/user.png') }}"
                                        alt="{{ $customer->full_name }}" class="avatar-img"
                                        onerror="this.src='{{ asset('assets/customers/user.png') }}'">
                                </td>

                                <td>
                                    <div class="fw-bold text-dark">{{ $customer->full_name }}</div>
                                    <div class="small text-muted">{{ $customer->email ?: 'No email' }}</div>
                                </td>

                                <td>{{ $customer->father_name ?: '-' }}</td>

                                <td>{{ $customer->address ?: '-' }}</td>

                                <td>
                                    <span class="amount-badge {{ !$canDelete ? 'amount-danger' : '' }}">
                                        {{ number_format($customerAmount, 2) }}
                                    </span>
                                </td>

                                <td>{{ $customer->phone ?: '-' }}</td>

                                <td class="text-end" onclick="event.stopPropagation();">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('customers.show', $customer->id) }}" class="btn-icon-soft"
                                            title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn-icon-soft"
                                            title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirmCustomerDelete({{ $canDelete ? 'true' : 'false' }});">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-icon-danger"
                                                title="{{ $canDelete ? 'Delete' : 'Amount must be 0 before delete' }}"
                                                {{ $canDelete ? '' : 'disabled' }}>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmCustomerDelete(canDelete) {
            if (!canDelete) {
                alert('Customer cannot be deleted. Customer amount must be 0.');
                return false;
            }

            return confirm(
                'Are you sure you want to delete this customer? This customer transaction history will also be deleted.'
                );
        }
    </script>
@endsection
