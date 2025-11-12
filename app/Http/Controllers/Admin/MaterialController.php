<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MaterialController extends Controller
{
    public function index(): Response
    {
        $materials = Material::with('course')->latest()->get()->map(function($material) {
            return [
                'id' => $material->id,
                'title' => $material->title,
                'course' => $material->course->name,
                'course_id' => $material->course_id,
                'type' => $material->type,
                'lesson_number' => $material->lesson_number,
                'icon' => $material->icon,
                'description' => $material->description,
                'is_new' => $material->is_new,
            ];
        });

        return Inertia::render('admin/Materials/Index', [
            'materials' => $materials,
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

        return Inertia::render('admin/Materials/Create', [
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
            'type' => 'required|in:video,document,link,presentation',
            'lesson_number' => 'nullable|integer|min:1',
            'links' => 'nullable|array',
            'is_new' => 'boolean',
        ]);

        Material::create($validated);

        return redirect()->route('admin.materials.index')
            ->with('success', 'Материал успешно создан');
    }

    public function show(Material $material): Response
    {
        $material->load('course');
        
        return Inertia::render('admin/Materials/Show', [
            'material' => [
                'id' => $material->id,
                'title' => $material->title,
                'description' => $material->description,
                'icon' => $material->icon,
                'type' => $material->type,
                'lesson_number' => $material->lesson_number,
                'links' => $material->links,
                'is_new' => $material->is_new,
                'course' => $material->course->name,
            ],
        ]);
    }

    public function edit(Material $material): Response
    {
        $courses = Course::where('is_active', true)->get();
        
        return Inertia::render('admin/Materials/Edit', [
            'material' => $material,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'type' => 'required|in:video,document,link,presentation',
            'lesson_number' => 'nullable|integer|min:1',
            'links' => 'nullable|array',
            'is_new' => 'boolean',
        ]);

        $material->update($validated);

        return redirect()->route('admin.materials.index')
            ->with('success', 'Материал успешно обновлен');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('admin.materials.index')
            ->with('success', 'Материал успешно удален');
    }
}
