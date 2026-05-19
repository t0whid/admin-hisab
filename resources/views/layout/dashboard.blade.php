@extends('layout.master')
@section('style')
@endsection
@section('content')
    <div class="">
        <div class="block-header">
            <div class="row">

                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Dashboard - All Time Total: {{ $allTimeTotal }}tk</h2>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <p><strong>Credit: {{ $totalCredit }}tk</strong></p>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <p><strong>Debit: {{ $totalDebit }}tk</strong></p>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <p><strong>Total: {{ $total }}tk</strong></p>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6" style="font-size: 12px;">
                            <form class="report" action="{{ route('report') }}" method="post">
                                @csrf
                                <input type="date" id="datepicker" class="" name="date"
                                    placeholder="Select Date">
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">

                @foreach ($todayTransactions as $transaction)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card widget_2 traffic">
                            <div class="body">

                                <h6>{{ $transaction->customer->full_name }}</h6>
                                <small><strong>Date:</strong>{{ $transaction->updated_at }}</small></h2>
                                <small><strong>Type:</strong> {{ $transaction->type }}</small>
                                <small><strong>Amount:</strong> {{ $transaction->last_transaction }}</small>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    <div class="container mt-5">
        <canvas id="revenueChart" width="400" height="100"></canvas>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var labels = @json(array_keys($revenueComparison));
        var data = @json(array_values($revenueComparison));

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
