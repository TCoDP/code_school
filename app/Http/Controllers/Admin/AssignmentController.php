<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AssignmentController extends Controller
{
    public function index(): Response
    {
        $assignments = Assignment::with('course')->latest()->get()->map(function($assignment) {
            return [
                'id' => $assignment->id,
                'title' => $assignment->title,
                'course' => $assignment->course->name,
                'course_id' => $assignment->course_id,
                'lesson_number' => $assignment->lesson_number,
                'days_to_complete' => $assignment->days_to_complete,
                'icon' => $assignment->icon,
                'description' => $assignment->description,
            ];
        });

        return Inertia::render('admin/Assignments/Index', [
            'assignments' => $assignments,
        ]);
    }

    public function create(): Response
    {
        $courses = Course::where('is_active', true)->get()->map(function($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
            ];
        });

        return Inertia::render('admin/Assignments/Create', [
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'lesson_number' => 'required|integer|min:1',
            'days_to_complete' => 'required|integer|min:1',
        ]);

        Assignment::create($validated);

        return redirect()->route('admin.assignments.index')
            ->with('success', 'Задание успешно создано');
    }

    public function show(Assignment $assignment): Response
    {
        $assignment->load(['course', 'users']);
        
        return Inertia::render('admin/Assignments/Show', [
            'assignment' => [
                'id' => $assignment->id,
                'title' => $assignment->title,
                'description' => $assignment->description,
                'icon' => $assignment->icon,
                'lesson_number' => $assignment->lesson_number,
                'days_to_complete' => $assignment->days_to_complete,
                'course' => $assignment->course->name,
                'users_count' => $assignment->users()->count(),
            ],
        ]);
    }

    public function edit(Assignment $assignment): Response
    {
        $courses = Course::where('is_active', true)->get();
        
        return Inertia::render('admin/Assignments/Edit', [
            'assignment' => $assignment,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'lesson_number' => 'required|integer|min:1',
            'days_to_complete' => 'required|integer|min:1',
        ]);

        $assignment->update($validated);

        return redirect()->route('admin.assignments.index')
            ->with('success', 'Задание успешно обновлено');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('admin.assignments.index')
            ->with('success', 'Задание успешно удалено');
    }
}
