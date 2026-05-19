@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/light-gallery/css/lightgallery.css') }}">
    <style>
        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 10px;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        hr {
            margin-top: 1px;
            margin-bottom: 1px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" id="flash-message">
                {{ session('success') }}
            </div>
        @endif
        <div class="row gutters-sm">
            <div class="col-md-3 mb-3">
                <div class="card">
            <div class="d-flex flex-column align-items-center text-center">
                    <img 
                        src="{{ ($customer->image && file_exists(($customer->image))) ? asset($customer->image) : asset('assets/customers/user.png') }}" 
                        alt="{{ $customer->full_name }}" 
                        style="width:210px; height:265px; border-radius:10px;"
                    >
                </div>
            </div>


            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Amount:</strong></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $customer->amount }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Full Name:</strong></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $customer->full_name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Father Name:</strong></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $customer->father_name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Address</strong>:</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $customer->address }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Age:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $customer->age }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Mobile</strong>:</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $customer->phone }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Email</strong></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $customer->email }}
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <a class="btn btn-info" href="{{ route('customers.edit', $customer->id) }}">Update</a>
                            </div>
                            <div class="col-sm-6 text-center">
                                <a class="btn btn-danger" href="{{ route('transactions.create', $customer->id) }}">Add
                                    Transaction</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters-sm">
            <div class="col-sm-12 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="d-flex align-items-center mb-3"><i
                                class="material-icons text-info mr-2">Transaction</i>History</h6>

                        <div class="card">

                            <div class="body">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                                        <tfoot>
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
                                        </tfoot>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucfirst($transaction->type) }}</td>
                                                    <td>{{ $transaction->last_transaction }}</td>
                                                    <td>{{ $transaction->total_amount }}</td>
                                                    <td>{{ $transaction->description }}</td>
                                                    <td>{{ $transaction->updated_by }}</td>
                                                    <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                                                    <td>
                                                        @if ($loop->first)
                                                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                                class="btn btn-warning">Update</a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/backend/plugins/light-gallery/js/lightgallery-all.min.js') }}"></script> <!-- Light Gallery Plugin Js -->
@endsection
