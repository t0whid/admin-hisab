@extends('layout.master')
@section('style')
    <style>
        table.dataTable td,
        table.dataTable th {
            vertical-align: middle;
            padding: 2px;
        }
    </style>
@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Customers List</h2>
                    @if (session('success'))
                        <div class="alert alert-success" id="flash-message">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Address</th>
                                            <th>Amount</th>
                                            <th>Phone</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Address</th>
                                            <th>Amount</th>
                                            <th>Phone</th>
                                            <th>Photo</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr onclick="window.location='{{ route('customers.show', $customer->id) }}';"
                                                style="cursor: pointer;">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $customer->full_name }}</td>
                                                <td>{{ $customer->father_name }}</td>
                                                <td>{{ $customer->address }}</td>
                                                <td>{{ $customer->amount }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td><img src="{{ $customer->image }}" alt="{{ $customer->full_name }}"
                                                        style="width: 50px; height: 50px;"></td>
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
@endsection
@section('script')
@endsection
