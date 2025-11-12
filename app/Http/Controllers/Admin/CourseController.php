<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function index(): Response
    {
        $courses = Course::withCount('users')->latest()->get()->map(function($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
                'icon' => $course->icon,
                'age_range' => $course->age_range,
                'description' => $course->description,
                'technologies' => $course->technologies,
                'total_lessons' => $course->total_lessons,
                'is_active' => $course->is_active,
                'students_count' => $course->users_count,
                'created_at' => $course->created_at->format('d.m.Y'),
            ];
        });

        return Inertia::render('admin/Courses/Index', [
            'courses' => $courses,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Courses/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'age_range' => 'required|string',
            'description' => 'required|string',
            'technologies' => 'nullable|array',
            'total_lessons' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курс успешно создан');
    }

    public function show(Course $course): Response
    {
        $course->load(['assignments', 'materials', 'users']);
        
        return Inertia::render('admin/Courses/Show', [
            'course' => [
                'id' => $course->id,
                'name' => $course->name,
                'icon' => $course->icon,
                'age_range' => $course->age_range,
                'description' => $course->description,
                'technologies' => $course->technologies,
                'total_lessons' => $course->total_lessons,
                'is_active' => $course->is_active,
                'assignments' => $course->assignments,
                'materials' => $course->materials,
                'students_count' => $course->users()->count(),
            ],
        ]);
    }

    public function edit(Course $course): Response
    {
        return Inertia::render('admin/Courses/Edit', [
            'course' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'age_range' => 'required|string',
            'description' => 'required|string',
            'technologies' => 'nullable|array',
            'total_lessons' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курс успешно обновлен');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курс успешно удален');
    }
}
