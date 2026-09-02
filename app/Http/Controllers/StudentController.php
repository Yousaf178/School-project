<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->search;
    $course = $request->course;
    $gender = $request->gender;
    $status = $request->status;

    $students = Student::query()

        // Search
        ->when($search, function ($query) use ($search) {

            $query->where(function ($query) use ($search) {

                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('student_id', 'like', "%{$search}%")
                    ->orWhere('course', 'like', "%{$search}%");

            });
            // dd($query->toSql(), $query->getBindings());

        })

        // Course filter
        ->when($course, function ($query) use ($course) {

            $query->where('course', $course);

        })

        // Gender filter
        ->when($gender, function ($query) use ($gender) {

            $query->where('gender', $gender);

        })

        // Status filter
        ->when($status !== null && $status !== '', function ($query) use ($status) {

            $query->where('status', $status);

        })

        ->latest()
        ->paginate(10)
        ->withQueryString();

    // Get courses for dropdown
    $courses = Student::whereNotNull('course')
        ->where('course', '!=', '')
        ->distinct()
        ->orderBy('course')
        ->pluck('course');

    return view('students.index', compact(
        'students',
        'courses'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('students.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',

        'email' => 'required|email|unique:students,email',
        'phone' => 'nullable|string|max:20',

        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|in:Male,Female,Other',

        'address' => 'nullable|string',
        'city' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',

        'student_id' => 'required|string|max:100|unique:students,student_id',
        'course' => 'nullable|string|max:255',
        'education' => 'nullable|string|max:255',

        'admission_date' => 'nullable|date',

        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        // PDF
        'student_pdf' => 'nullable|file|mimes:pdf|max:5120',

        'status' => 'required|boolean',
    ]);

    // Remove uploaded files from normal form data
    $data = $request->except([
        'profile_image',
        'student_pdf'
    ]);

    // =========================
    // Upload Profile Image
    // =========================

    if ($request->hasFile('profile_image')) {

        $imagePath = $request->file('profile_image')
            ->store('students', 'public');

        $data['profile_image'] = $imagePath;
    }

    // =========================
    // Upload Student PDF
    // =========================

    if ($request->hasFile('student_pdf')) {

        $pdfPath = $request->file('student_pdf')
    ->storeAs(
        'student-documents',
        $request->file('student_pdf')->getClientOriginalName(),
        'public'
    );

        $data['student_pdf'] = $pdfPath;
    }

    // =========================
    // Create Student
    // =========================

    Student::create($data);

    return redirect()
        ->route('students.index')
        ->with('success', 'Student created successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
{
    return view('students.show', compact('student'));
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Student $student)
{
    return view('students.edit', compact('student'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',

        'email' => 'required|email|unique:students,email,' . $student->id,
        'phone' => 'nullable|string|max:20',

        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|in:Male,Female,Other',

        'address' => 'nullable|string',
        'city' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',

        'student_id' => 'required|string|max:100|unique:students,student_id,' . $student->id,
        'course' => 'nullable|string|max:255',
        'education' => 'nullable|string|max:255',

        'admission_date' => 'nullable|date',

        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'student_pdf' => 'nullable|file|mimes:pdf|max:5120',

        'status' => 'required|boolean',
    ]);

    $data = $request->except('profile_image');

    if ($request->hasFile('profile_image')) {

        $imagePath = $request->file('profile_image')
                             ->store('students', 'public');

        $data['profile_image'] = $imagePath;
    }

    if ($request->hasFile('student_pdf')) {

    $pdfPath = $request->file('student_pdf')
        ->store('student-documents', 'public');

    $data['student_pdf'] = $pdfPath;
}

    $student->update($data);

    return redirect()
        ->route('students.index')
        ->with('success', 'Student updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Student $student)
{
    // Delete profile image from storage
    if ($student->profile_image) {
        Storage::disk('public')->delete($student->profile_image);
    }

    // Delete student from database
    $student->delete();

    return redirect()
        ->route('students.index')
        ->with('success', 'Student deleted successfully.');
}

// the below fuction is for double click to edit StudentId field by yousaf
public function updateStudentId(Request $request, Student $student)
{
    $request->validate([
        'student_id' => 'required|string|max:100|unique:students,student_id,' . $student->id,
    ]);

    $student->student_id = $request->student_id;

    $student->save();

    return response()->json([
        'success' => true,
        'student_id' => $student->student_id,
        'message' => 'Student ID updated successfully.'
    ]);
}
// the below function is also used for double click by Yousaf
public function updateEducation(Request $request, Student $student)
{
    $request->validate([
        'education' => 'nullable|string|max:255',
    ]);

    $student->education = $request->education;

    $student->save();

    return response()->json([
        'success' => true,
        'education' => $student->education,
        'message' => 'Education updated successfully.'
    ]);
}
// end by yousaf

// create a code for download pdf button by yousaf
public function download($id)
{
    $student = Student::findOrFail($id);

    $pdf = Pdf::loadView('students.pdf', compact('student'));

    return $pdf->download(
        $student->first_name . '_' . $student->last_name . '_profile.pdf'
    );
}
// end

}
