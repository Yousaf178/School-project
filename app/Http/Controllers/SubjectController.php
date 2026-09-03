<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of subjects.
     */
    public function index(Request $request)
    {
        $query = Subject::query();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");

            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $subjects = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new subject.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created subject.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Subject::create($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject added successfully.');
    }

    /**
     * Display the specified subject.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the subject.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified subject.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $subject->update($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified subject.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }

    public function teachers(Subject $subject)
{
    $teachers = $subject->teachers()
        ->latest()
        ->paginate(10);

    return view('subjects.teachers', compact('subject', 'teachers'));
}
}