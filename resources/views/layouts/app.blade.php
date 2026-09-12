<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Student Management System')</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            color: #333;
        }

        .navbar {
            background-color: #1f2937;
            padding: 18px 0;
        }

        .navbar-container {
            width: 90%;
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            color: white;
            font-size: 22px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 15px;
        }

        .navbar a:hover {
            color: #60a5fa;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h2 {
            font-size: 28px;
            color: #1f2937;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* Buttons */

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-success {
            background-color: #16a34a;
            color: white;
        }

        .btn-success:hover {
            background-color: #15803d;
        }

        .btn-warning {
            background-color: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        /* Table */

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background-color: #1f2937;
            color: white;
            padding: 13px;
            text-align: left;
        }

        table td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background-color: #f9fafb;
        }

        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        /* Forms */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        /* Validation */

        .alert {
            padding: 14px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert ul {
            margin-left: 20px;
        }

        /* Student Details */

        .details-table {
            width: 100%;
        }

        .details-table tr {
            border-bottom: 1px solid #ddd;
        }

        .details-table td {
            padding: 14px;
        }

        .details-table td:first-child {
            width: 200px;
            font-weight: bold;
            background-color: #f9fafb;
        }

        .back-link {
            margin-top: 20px;
        }

        /* Empty state */

        .empty-message {
            text-align: center;
            padding: 30px;
            color: #777;
        }

        /* Responsive */

        @media (max-width: 700px) {
            .navbar-container {
                flex-direction: column;
                gap: 10px;
            }

            .navbar a {
                margin: 0 8px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-container">
            <h1>Student Management System</h1>

            <div>
                <a href="{{ route('students.index') }}">Students</a>
                <a href="{{ route('students.create') }}">Add Student</a>
            </div>
        </div>
    </nav>

    <main class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

</body>
</html>
```
