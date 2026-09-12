@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

    <div class="page-header">
        <h2>Edit Student</h2>
    </div>

    <div class="card">

        <form
            action="{{ route('students.update', $student->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="form-row">

                <div class="form-group">
                    <label for="lastname">Lastname</label>

                    <input
                        type="text"
                        id="lastname"
                        name="lastname"
                        class="form-control"
                        value="{{ old('lastname', $student->lastname) }}"
                        maxlength="50"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="firstname">Firstname</label>

                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        class="form-control"
                        value="{{ old('firstname', $student->firstname) }}"
                        maxlength="50"
                        required
                    >
                </div>

            </div>


            <div class="form-row">

                <div class="form-group">
                    <label for="province">Province</label>

                    <input
                        type="text"
                        id="province"
                        name="province"
                        class="form-control"
                        value="{{ old('province', $student->province) }}"
                        maxlength="50"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="country">Country</label>

                    <input
                        type="text"
                        id="country"
                        name="country"
                        class="form-control"
                        value="{{ old('country', $student->country) }}"
                        maxlength="50"
                        required
                    >
                </div>

            </div>


            <div class="form-row">

                <div class="form-group">
                    <label for="school">School</label>

                    <input
                        type="text"
                        id="school"
                        name="school"
                        class="form-control"
                        value="{{ old('school', $student->school) }}"
                        maxlength="50"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="program">Program</label>

                    <input
                        type="text"
                        id="program"
                        name="program"
                        class="form-control"
                        value="{{ old('program', $student->program) }}"
                        maxlength="10"
                        required
                    >
                </div>

            </div>


            <div class="form-row">

                <div class="form-group">
                    <label for="year">Year</label>

                    <input
                        type="number"
                        id="year"
                        name="year"
                        class="form-control"
                        value="{{ old('year', $student->year) }}"
                        min="1"
                        max="10"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="birthday">Birthday</label>

                    <input
                        type="date"
                        id="birthday"
                        name="birthday"
                        class="form-control"
                        value="{{ old('birthday', $student->birthday) }}"
                        required
                    >
                </div>

            </div>


            <div class="form-actions">

                <button type="submit" class="btn btn-success">
                    Update Student
                </button>

                <a
                    href="{{ route('students.index') }}"
                    class="btn btn-secondary">
                    Cancel
                </a>

            </div>

        </form>

    </div>

@endsection

