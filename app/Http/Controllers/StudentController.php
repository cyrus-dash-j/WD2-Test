<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Imported for deleting files

class StudentController extends Controller
{
    // Display all students
    public function index()
    {
        $students = Student::all();

        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Save new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:50',
            'firstname' => 'required|string|max:50',
            'province' => 'required|string|max:50',
            'country' => 'required|string|max:50',
            'school' => 'required|string|max:50',
            'program' => 'required|string|max:10',
            'year' => 'required|integer|min:1|max:10',
            'birthday' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        // Handle Image Upload
        if ($request->hasFile('profile_image')) {
            // Stores image in storage/app/public/students folder
            $validated['profile_image'] = $request->file('profile_image')->store('students', 'public');
        }

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student added successfully!');
    }

    // Display one student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:50',
            'firstname' => 'required|string|max:50',
            'province' => 'required|string|max:50',
            'country' => 'required|string|max:50',
            'school' => 'required|string|max:50',
            'program' => 'required|string|max:10',
            'year' => 'required|integer|min:1|max:10',
            'birthday' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Image Update
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if ($student->profile_image) {
                Storage::disk('public')->delete($student->profile_image);
            }
            // Store new image
            $validated['profile_image'] = $request->file('profile_image')->store('students', 'public');
        }

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy(Student $student)
    {
        // Delete image from storage when student is deleted
        if ($student->profile_image) {
            Storage::disk('public')->delete($student->profile_image);
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
