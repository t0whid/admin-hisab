@extends('layout.master')

@section('title', 'Report | Shahjalal Enterprise')

@section('content')
    @php
        $transactions = $transactions ?? collect();
        $revenueLabels = array_keys($revenueComparison ?? []);
        $revenueData = array_values($revenueComparison ?? []);
    @endphp

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div>
            <h1 class="page-title h3 mb-1">Report</h1>
            <div class="page-subtitle">Filtered transaction report and revenue comparison.</div>
        </div>

        <form class="d-flex flex-column flex-sm-row gap-2" action="{{ route('report') }}" method="post">
            @csrf
            <input type="date" id="datepicker" name="date" class="form-control" required>
            <button type="submit" class="btn btn-gradient px-4 rounded-4">
                <i class="fa fa-filter me-1"></i> Filter
            </button>
        </form>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card p-4 h-100">
                <div class="stat-label">All Time Total</div>
                <div class="stat-value">{{ number_format($allTimeTotal ?? 0, 2) }} tk</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card p-4 h-100">
                <div class="stat-label">Credit</div>
                <div class="stat-value text-success">{{ number_format($totalCredit ?? 0, 2) }} tk</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card p-4 h-100">
                <div class="stat-label">Debit</div>
                <div class="stat-value text-danger">{{ number_format($totalDebit ?? 0, 2) }} tk</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card p-4 h-100">
                <div class="stat-label">Total</div>
                <div class="stat-value">{{ number_format($total ?? 0, 2) }} tk</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-8">
            <div class="modern-card p-4 h-100">
                <h5 class="fw-bold mb-1">Revenue Chart</h5>
                <div class="small text-muted mb-3">Visual report based on available revenue data.</div>

                <div style="height: 340px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="modern-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Transactions</h5>
                        <div class="small text-muted">{{ $transactions->count() }} transaction(s)</div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3" style="max-height: 340px; overflow-y: auto;">
                    @forelse ($transactions as $transaction)
                        @php
                            $isCredit = strtolower($transaction->type ?? '') === 'credit';
                        @endphp

                        <div class="transaction-card border rounded-4 p-3">
                            <div class="d-flex justify-content-between gap-2">
                                <div>
                                    <div class="fw-bold">
                                        {{ $transaction->customer->full_name ?? 'Unknown Customer' }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ optional($transaction->updated_at)->format('d M Y, h:i A') ?? $transaction->updated_at }}
                                    </div>
                                </div>

                                <span class="type-badge {{ $isCredit ? 'amount-credit' : 'amount-debit' }}">
                                    {{ ucfirst($transaction->type ?? 'N/A') }}
                                </span>
                            </div>

                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <span class="small text-muted">Amount</span>
                                <span class="fw-bold">{{ number_format($transaction->last_transaction ?? 0, 2) }} tk</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fa fa-inbox"></i>
                            </div>
                            <div class="fw-bold text-dark">No transaction found</div>
                            <div class="small">No transaction available for this report.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const revenueCanvas = document.getElementById('revenueChart');

        if (revenueCanvas) {
            new Chart(revenueCanvas, {
                type: 'line',
                data: {
                    labels: @json($revenueLabels),
                    datasets: [{
                        label: 'Revenue',
                        data: @json($revenueData),
                        borderWidth: 3,
                        tension: 0.35,
                        fill: true,
                        backgroundColor: 'rgba(124, 58, 237, 0.10)',
                        borderColor: '#7c3aed',
                        pointBackgroundColor: '#7c3aed',
                        pointBorderWidth: 0,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Revenue: ' + Number(context.raw || 0).toLocaleString() + ' tk';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(148, 163, 184, 0.18)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return Number(value).toLocaleString() + ' tk';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    </script>
@endsection
