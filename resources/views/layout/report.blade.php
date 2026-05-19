@extends('layout.master')

@section('title', 'Transaction Report | Shahjalal Enterprise')

@section('content')
    @php
        $transactions = $transactions ?? collect();
        $revenueLabels = array_keys($revenueComparison ?? []);
        $revenueData = array_values($revenueComparison ?? []);
        $selectedDate = $selectedDate ?? date('Y-m-d');
        $reportDateFormatted = \Carbon\Carbon::parse($selectedDate)->format('d M Y');
    @endphp

    <style>
        .report-hero {
            border-radius: 24px;
            padding: 28px;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.96), rgba(49, 46, 129, 0.94)),
                radial-gradient(circle at top right, rgba(124, 58, 237, 0.32), transparent 35%);
            color: #fff;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.16);
            position: relative;
            overflow: hidden;
        }

        .report-hero::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: -80px;
            top: -80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .report-hero h1 {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .report-filter-card {
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 16px 35px rgba(15, 23, 42, 0.08);
        }

        .report-summary-box {
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            background: #fff;
            padding: 22px;
            height: 100%;
        }

        .report-summary-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .report-summary-value {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
        }

        .report-document {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .report-document-header {
            padding: 24px 26px;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
        }

        .report-document-title {
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .report-document-meta {
            color: #64748b;
            font-size: 14px;
        }

        .report-table thead th {
            background: #0f172a;
            color: #ffffff;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border: 0;
            padding: 14px 16px;
        }

        .report-table tbody td {
            padding: 15px 16px;
            vertical-align: middle;
            border-color: #eef2f7;
        }

        .report-table tbody tr:hover {
            background: #f8fafc;
        }

        .report-chart-card {
            border-radius: 24px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            box-shadow: 0 16px 35px rgba(15, 23, 42, 0.07);
        }

        .mini-report-note {
            border-radius: 18px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 16px;
            color: #475569;
            font-size: 14px;
        }

        @media print {
            .app-sidebar,
            .app-topbar,
            .report-filter-card,
            .dataTables_filter,
            .dataTables_length,
            .dt-buttons,
            .dataTables_paginate,
            .dataTables_info,
            .btn,
            .report-chart-card {
                display: none !important;
            }

            .app-content {
                margin: 0 !important;
                padding: 0 !important;
            }

            .report-hero {
                background: #fff !important;
                color: #000 !important;
                box-shadow: none !important;
                border: 1px solid #ddd;
            }

            .report-document {
                box-shadow: none !important;
                border: 1px solid #ddd;
            }
        }
    </style>

    <div class="report-hero mb-4">
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-8">
                <div class="small text-white-50 fw-bold text-uppercase mb-2">
                    Financial Statement
                </div>
                <h1 class="mb-2">Transaction Report</h1>
                <p class="mb-0 text-white-50">
                    Detailed debit/credit statement for {{ $reportDateFormatted }}.
                </p>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0 text-lg-end">
                <button type="button" onclick="window.print()" class="btn btn-light rounded-4 px-4">
                    <i class="fa fa-print me-1"></i>
                    Print Report
                </button>
            </div>
        </div>
    </div>

    <div class="report-filter-card p-4 mb-4">
        <form action="{{ route('report') }}" method="POST">
            @csrf

            <div class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label for="datepicker" class="form-label fw-bold">Select Report Date</label>
                    <input type="date"
                           id="datepicker"
                           name="date"
                           class="form-control form-control-lg rounded-4"
                           value="{{ $selectedDate }}"
                           required>
                </div>

                <div class="col-lg-3 col-md-6">
                    <button type="submit" class="btn btn-gradient btn-lg rounded-4 px-4 w-100">
                        <i class="fa fa-filter me-1"></i>
                        Generate Report
                    </button>
                </div>

                <div class="col-lg-5">
                    <div class="mini-report-note">
                        This page is designed as a statement/report page. Use the filter to generate a date-wise transaction report.
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="report-summary-box">
                <div class="report-summary-label">Opening / All Time Balance</div>
                <div class="report-summary-value">
                    {{ number_format($allTimeTotal ?? 0, 2) }}
                </div>
                <div class="small text-muted">tk</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-summary-box">
                <div class="report-summary-label">Total Credit</div>
                <div class="report-summary-value text-success">
                    {{ number_format($totalCredit ?? 0, 2) }}
                </div>
                <div class="small text-muted">tk</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-summary-box">
                <div class="report-summary-label">Total Debit</div>
                <div class="report-summary-value text-danger">
                    {{ number_format($totalDebit ?? 0, 2) }}
                </div>
                <div class="small text-muted">tk</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-summary-box">
                <div class="report-summary-label">Net Amount</div>
                <div class="report-summary-value {{ ($total ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ number_format($total ?? 0, 2) }}
                </div>
                <div class="small text-muted">tk</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-8">
            <div class="report-document">
                <div class="report-document-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <div>
                            <h5 class="report-document-title">Transaction Statement</h5>
                            <div class="report-document-meta">
                                Date: {{ $reportDateFormatted }} |
                                Total Transactions: {{ $transactions->count() }}
                            </div>
                        </div>

                        <div class="text-md-end">
                            <div class="fw-bold">Shahjalal Enterprise</div>
                            <div class="small text-muted">Generated: {{ now()->format('d M Y, h:i A') }}</div>
                        </div>
                    </div>
                </div>

                <div class="p-3 p-md-4">
                    <div class="table-responsive">
                        <table class="table report-table modern-datatable w-100 align-middle">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Transaction Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($transactions as $transaction)
                                    @php
                                        $isCredit = strtolower($transaction->type ?? '') === 'credit';
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <div class="fw-bold text-dark">
                                                {{ $transaction->customer->full_name ?? 'Unknown Customer' }}
                                            </div>
                                        </td>

                                        <td>
                                            @if ($isCredit)
                                                <span class="badge text-bg-success rounded-pill px-3 py-2">
                                                    Credit
                                                </span>
                                            @else
                                                <span class="badge text-bg-danger rounded-pill px-3 py-2">
                                                    Debit
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="fw-bold {{ $isCredit ? 'text-success' : 'text-danger' }}">
                                                {{ number_format($transaction->last_transaction ?? 0, 2) }} tk
                                            </span>
                                        </td>

                                        <td>
                                            {{ optional($transaction->updated_at)->format('d M Y, h:i A') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fa fa-inbox fa-2x mb-3 d-block"></i>
                                                <strong>No transaction found</strong>
                                                <div class="small">No transaction available for {{ $reportDateFormatted }}.</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                            @if ($transactions->count() > 0)
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Total Credit</th>
                                        <th class="text-success">{{ number_format($totalCredit ?? 0, 2) }} tk</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Total Debit</th>
                                        <th class="text-danger">{{ number_format($totalDebit ?? 0, 2) }} tk</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Net Total</th>
                                        <th>{{ number_format($total ?? 0, 2) }} tk</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="report-chart-card p-4 h-100">
                <h5 class="fw-bold mb-1">30 Days Trend</h5>
                <div class="small text-muted mb-3">
                    Revenue movement ending on {{ $reportDateFormatted }}.
                </div>

                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Report Date</span>
                    <strong>{{ $reportDateFormatted }}</strong>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Transactions</span>
                    <strong>{{ $transactions->count() }}</strong>
                </div>

                <div class="d-flex justify-content-between">
                    <span class="text-muted">Net Amount</span>
                    <strong class="{{ ($total ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format($total ?? 0, 2) }} tk
                    </strong>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const revenueCanvas = document.getElementById('revenueChart');

            if (revenueCanvas) {
                new Chart(revenueCanvas, {
                    type: 'bar',
                    data: {
                        labels: @json($revenueLabels),
                        datasets: [{
                            label: 'Revenue',
                            data: @json($revenueData),
                            borderWidth: 0,
                            borderRadius: 8,
                            backgroundColor: 'rgba(79, 70, 229, 0.75)'
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
                                    label: function (context) {
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
                                    callback: function (value) {
                                        return Number(value).toLocaleString() + ' tk';
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection