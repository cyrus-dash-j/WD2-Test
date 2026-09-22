@extends('layouts.app')

@section('title', 'Student Details')

@section('styles')
<style>
    .details-container-card { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 40px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); max-width: 650px; margin: 0 auto; text-align: center; }
    .detail-avatar { width: 130px; height: 130px; border-radius: 50%; object-fit: cover; border: 4px solid #f8fafc; box-shadow: 0 4px 10px rgba(0,0,0,0.08); margin: 0 auto 24px auto; background: #f1f5f9; }
    .detail-avatar-placeholder { width: 130px; height: 130px; border-radius: 50%; background: #e0e7ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 36px; margin: 0 auto 24px auto; border: 4px solid #f8fafc; box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
    .details-table { width: 100%; border-collapse: collapse; margin-top: 24px; text-align: left; }
    .details-table tr { border-bottom: 1px solid #f1f5f9; }
    .details-table tr:last-child { border-bottom: none; }
    .details-table td { padding: 14px 0; font-size: 14px; color: #374151; }
    .details-table td.label-column { font-weight: 600; color: #9ca3af; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; width: 35%; }
</style>
@endsection

@section('content')

    <div class="page-header" style="max-width: 650px; margin: 0 auto 32px auto;">
        <div class="page-title">
            <h2>Student Profile Sheet</h2>
            <p style="color: #6b7280; font-size: 14px; margin-top: 4px;">Internal system profile summary report.</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">⬅️ Directory</a>
    </div>

    <div class="details-container-card">
        @if($student->profile_image)
            <img src="{{ asset('storage/' . $student->profile_image) }}" class="detail-avatar" alt="Profile Photo">
        @else
            <div class="detail-avatar-placeholder">
                {{ strtoupper(substr($student->firstname, 0, 1) . substr($student->lastname, 0, 1)) }}
            </div>
        @endif

        <h2 style="font-size: 24px; font-weight: 700; color: #111827;">{{ $student->lastname }}, {{ $student->firstname }}</h2>
        <span style="display: inline-block; padding: 4px 12px; font-size: 12px; font-weight: 600; border-radius: 20px; background: #f3f4f6; color: #4b5563; border: 1px solid #e5e7eb; margin-top: 6px;">
            Academic Year {{ $student->year }}
        </span>

        <table class="details-table">
            <tr>
                <td class="label-column">Record Registry ID</td>
                <td style="font-family: monospace; font-weight: 600;">#{{ $student->id }}</td>
            </tr>
            <tr>
                <td class="label-column">Declared Program</td>
                <td><span style="font-weight: 600; color: #1e40af; background: #eff6ff; padding: 2px 8px; border-radius: 4px; border: 1px solid #bfdbfe;">{{ $student->program }}</span></td>
            </tr>
            <tr>
                <td class="label-column">Institutional Branch</td>
                <td style="font-weight: 500;">{{ $student->school }}</td>
            </tr>
            <tr>
                <td class="label-column">Date of Birth</td>
                <td>{{ \Carbon\Carbon::parse($student->birthday)->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td class="label-column">Regional Province</td>
                <td>{{ $student->province }}</td>
            </tr>
            <tr>
                <td class="label-column">Sovereign Country</td>
                <td>{{ $student->country }}</td>
            </tr>
        </table>

        <div class="form-actions" style="margin-top: 32px; display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning" style="padding: 12px;">Modify Core Metrics</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary" style="padding: 12px;">Return to Dashboard</a>
        </div>
    </div>

@endsection
