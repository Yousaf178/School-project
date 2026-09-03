<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Subject;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    $query = Teacher::with('subject');

    // Search
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('country', 'like', "%{$search}%")
              ->orWhereHas('subject', function ($subjectQuery) use ($search) {
                  $subjectQuery->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Subject filter
    if ($request->filled('subject_id')) {
        $query->where('subject_id', $request->subject_id);
    }

    // Status filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $teachers = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // Get subjects from subjects table
    $subjects = Subject::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('teachers.index', compact(
        'teachers',
        'subjects'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $subjects = Subject::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('teachers.create', compact('subjects'));
}

    /**
     * Store a newly created resource in storage.
     */
    
   public function store(Request $request)
{
    $validated = $request->validate([
        'first_name'    => 'required|string|max:255',
        'last_name'     => 'required|string|max:255',
        'email'         => 'required|email|unique:teachers,email',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'phone'         => 'nullable|string|max:30',
        'subject_id' => 'required|exists:subjects,id',
        'country'       => 'nullable|string|max:255',
        'status'        => 'required|boolean',
    ]);

    if ($request->hasFile('profile_image')) {

        $validated['profile_image'] = $request
            ->file('profile_image')
            ->store('teachers', 'public');
    }

    Teacher::create($validated);

    return redirect()
        ->route('teachers.index')
        ->with('success', 'Teacher added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
{
    return view('teachers.show', compact('teacher'));
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Teacher $teacher)
{
    $subjects = Subject::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('teachers.edit', compact(
        'teacher',
        'subjects'
    ));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:teachers,email,' . $teacher->id,
        'phone'      => 'nullable|string|max:30',
        'subject'    => 'nullable|string|max:255',
        'country'    => 'nullable|string|max:255',
        'status'     => 'required|boolean',
    ]);

    $teacher->update($validated);

    return redirect()
        ->route('teachers.index')
        ->with('success', 'Teacher updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
