<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function index()
    {
        $classSubjects = ClassSubject::with([
            'schoolClass',
            'subject'
        ])->latest()->get();

        return view(
            'class_subjects.index',
            compact('classSubjects')
        );
    }

    public function create()
    {
        $classes = SchoolClass::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        return view(
            'class_subjects.create',
            compact('classes', 'subjects')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $exists = ClassSubject::where('class_id', $validated['class_id'])
            ->where('subject_id', $validated['subject_id'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'This subject is already assigned to this class.');
        }

        ClassSubject::create($validated);

        return redirect()
            ->route('class-subjects.index')
            ->with('success', 'Subject assigned to class successfully.');
    }

    public function destroy(ClassSubject $classSubject)
    {
        $classSubject->delete();

        return redirect()
            ->route('class-subjects.index')
            ->with('success', 'Subject removed from class successfully.');
    }
}