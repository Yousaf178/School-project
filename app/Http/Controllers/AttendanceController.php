<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'schoolClass'])
            ->latest('attendance_date')
            ->get();

        return view('attendances.index', compact('attendances'));
    }
public function daily(Request $request)
{
    $classes = SchoolClass::orderBy('name')->get();

    $selectedClass = $request->class_id;
    $selectedDate = $request->date ?? date('Y-m-d');

    $students = collect();

    if ($selectedClass) {
        $students = Student::orderBy('first_name')->get();
    }

    $attendances = Attendance::where('class_id', $selectedClass)
        ->whereDate('attendance_date', $selectedDate)
        ->get()
        ->keyBy('student_id');

    return view('attendances.daily', compact(
        'classes',
        'students',
        'selectedClass',
        'selectedDate',
        'attendances'
    ));
}
    public function create()
    {
        $students = Student::orderBy('first_name')->get();
        $classes = SchoolClass::orderBy('name')->get();

        return view('attendances.create', compact(
            'students',
            'classes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:school_classes,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused',
            'remarks' => 'nullable|string',
        ]);

        Attendance::create($validated);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance added successfully.');
    }

    public function edit(Attendance $attendance)
    {
$students = Student::orderBy('first_name')->get();
        $classes = SchoolClass::orderBy('name')->get();

        return view('attendances.edit', compact(
            'attendance',
            'students',
            'classes'
        ));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:school_classes,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused',
            'remarks' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance deleted successfully.');
    }

    public function saveDaily(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:school_classes,id',
        'attendance_date' => 'required|date',
        'attendance' => 'required|array',
    ]);

    foreach ($request->attendance as $studentId => $data) {

        Attendance::updateOrCreate(
            [
                'student_id' => $studentId,
                'class_id' => $request->class_id,
                'attendance_date' => $request->attendance_date,
            ],
            [
                'status' => $data['status'],
                'remarks' => $data['remarks'] ?? null,
            ]
        );
    }

    return redirect()
        ->route('attendances.daily', [
            'class_id' => $request->class_id,
            'date' => $request->attendance_date,
        ])
        ->with('success', 'Daily attendance saved successfully.');
}
}