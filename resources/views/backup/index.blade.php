@extends('layout.master')

@section('content')
    <h1>Backup Database as ZIP</h1>

    <a href="{{ route('backup.downloadzip') }}" class="button" style="padding:12px 24px; background:#28a745; color:#fff; text-decoration:none; border-radius:5px;">
        Download Backup ZIP
    </a>
@endsection
