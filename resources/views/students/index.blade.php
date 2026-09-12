@extends('layouts.app')

@section('title', 'Student List')

@section('content')

    <div class="page-header">
        <h2>Student List</h2>

        <a href="{{ route('students.create') }}" class="btn btn-primary">
            + Add Student
        </a>
    </div>

    <div class="card">

        <div class="table-container">

            @if($students->count() > 0)

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th>Program</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($students as $student)

                            <tr>
                                <td>{{ $student->id }}</td>

                                <td>{{ $student->lastname }}</td>

                                <td>{{ $student->firstname }}</td>

                                <td>{{ $student->program }}</td>

                                <td>{{ $student->year }}</td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('students.show', $student->id) }}"
                                            class="btn btn-primary">
                                            View
                                        </a>

                                        <a
                                            href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-warning">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('students.destroy', $student->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete the record?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger">
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

            @else

                <div class="empty-message">
                    <p>No students found.</p>

                    <br>

                    <a href="{{ route('students.create') }}" class="btn btn-primary">
                        Add Your First Student
                    </a>
                </div>

            @endif

        </div>

    </div>

@endsection