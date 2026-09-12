@extends('layouts.app')

@section('title', 'Student Details')

@section('content')

    <div class="page-header">
        <h2>Student Details</h2>
    </div>

    <div class="card">

        <table class="details-table">

            <tr>
                <td>ID</td>
                <td>{{ $student->id }}</td>
            </tr>

            <tr>
                <td>Lastname</td>
                <td>{{ $student->lastname }}</td>
            </tr>

            <tr>
                <td>Firstname</td>
                <td>{{ $student->firstname }}</td>
            </tr>

            <tr>
                <td>Province</td>
                <td>{{ $student->province }}</td>
            </tr>

            <tr>
                <td>Country</td>
                <td>{{ $student->country }}</td>
            </tr>

            <tr>
                <td>School</td>
                <td>{{ $student->school }}</td>
            </tr>

            <tr>
                <td>Program</td>
                <td>{{ $student->program }}</td>
            </tr>

            <tr>
                <td>Year</td>
                <td>{{ $student->year }}</td>
            </tr>

            <tr>
                <td>Birthday</td>
                <td>{{ $student->birthday }}</td>
            </tr>

        </table>


        <div class="form-actions">

            <a
                href="{{ route('students.edit', $student->id) }}"
                class="btn btn-warning">
                Edit Student
            </a>

            <a
                href="{{ route('students.index') }}"
                class="btn btn-secondary">
                Back to List
            </a>

        </div>

    </div>

@endsection

