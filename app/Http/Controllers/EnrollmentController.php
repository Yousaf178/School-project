<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with([
            'student',
            'schoolClass',
            'academicYear'
        ])->latest()->get();

        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::all();
        $classes = SchoolClass::all();
        $academicYears = AcademicYear::all();

        return view('enrollments.create', compact(
            'students',
            'classes',
            'academicYears'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:school_classes,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'enrollment_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        Enrollment::create($request->all());

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Student enrolled successfully.');
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $classes = SchoolClass::all();
        $academicYears = AcademicYear::all();

        return view('enrollments.edit', compact(
            'enrollment',
            'students',
            'classes',
            'academicYears'
        ));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:school_classes,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'enrollment_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        $enrollment->update($request->all());

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}