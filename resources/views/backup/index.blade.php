@extends('layout.master')

@section('title', 'Database Backup | Shahjalal Enterprise')

@section('content')
    <style>
        .backup-panel {
            border-radius: 24px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .backup-header {
            padding: 26px 30px;
            background: linear-gradient(135deg, #0f172a, #166534);
            color: #ffffff;
        }

        .backup-header h1 {
            font-weight: 800;
            margin-bottom: 6px;
        }

        .backup-header p {
            margin-bottom: 0;
            color: rgba(255, 255, 255, 0.76);
        }

        .backup-body {
            padding: 30px;
        }

        .backup-icon-box {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            background: #ecfdf5;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .backup-meta {
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            padding: 16px 18px;
        }

        .backup-meta-label {
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .backup-meta-value {
            color: #0f172a;
            font-weight: 800;
            margin-bottom: 0;
        }

        .backup-btn {
            border-radius: 16px;
            padding: 14px 24px;
            font-weight: 800;
            box-shadow: 0 14px 28px rgba(22, 163, 74, 0.22);
        }

        .backup-warning {
            border-radius: 18px;
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
            padding: 16px 18px;
        }

        @media (max-width: 575.98px) {
            .backup-header,
            .backup-body {
                padding: 22px;
            }

            .backup-btn {
                width: 100%;
            }
        }
    </style>

    <div class="backup-panel">
        <div class="backup-header">
            <h1 class="h3">Database Backup</h1>
            <p>Download your latest database backup as a compressed ZIP file.</p>
        </div>

        <div class="backup-body">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="backup-icon-box">
                            <i class="fa fa-database"></i>
                        </div>

                        <div>
                            <h4 class="fw-bold mb-2">Backup Database as ZIP</h4>
                            <p class="text-muted mb-3">
                                Use this option before deployment, data migration, or major system changes.
                            </p>

                            <div class="backup-warning">
                                <i class="fa fa-exclamation-triangle me-1"></i>
                                Keep the downloaded backup private. It may contain customer and transaction data.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('backup.downloadzip') }}"
                       class="btn btn-success btn-lg backup-btn">
                        <i class="fa fa-download me-1"></i>
                        Download Backup ZIP
                    </a>
                </div>
            </div>

            <hr class="my-4">

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="backup-meta">
                        <div class="backup-meta-label">Format</div>
                        <p class="backup-meta-value">ZIP File</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="backup-meta">
                        <div class="backup-meta-label">Status</div>
                        <p class="backup-meta-value text-success">Ready</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="backup-meta">
                        <div class="backup-meta-label">Recommended</div>
                        <p class="backup-meta-value">Before Update</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection