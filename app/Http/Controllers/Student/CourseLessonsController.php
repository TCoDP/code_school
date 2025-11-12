<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseLessonsController extends Controller
{
    public function show(Request $request, $courseId): Response
    {
        $user = $request->user();
        
        // Проверяем, что пользователь имеет доступ к курсу
        $course = $user->courses()->where('courses.id', $courseId)->firstOrFail();
        
        // Получаем материалы курса, сгруппированные по урокам
        $materials = Material::where('course_id', $courseId)
            ->orderBy('lesson_number', 'asc')
            ->get()
            ->groupBy('lesson_number')
            ->map(function ($lessonMaterials, $lessonNumber) use ($user, $courseId) {
                $coursePivot = $user->courses()->where('courses.id', $courseId)->first()->pivot;
                $lessonsCompleted = $coursePivot->lessons_completed ?? 0;
                
                return [
                    'lessonNumber' => (int) $lessonNumber,
                    'isCompleted' => $lessonNumber <= $lessonsCompleted,
                    'isCurrent' => $lessonNumber == ($lessonsCompleted + 1),
                    'materials' => $lessonMaterials->map(function ($material) {
                        return [
                            'id' => $material->id,
                            'title' => $material->title,
                            'description' => $material->description,
                            'icon' => $material->icon,
                            'type' => $material->type,
                            'links' => $material->links ?? [],
                            'isNew' => $material->is_new,
                        ];
                    })->values()->toArray(),
                ];
            })
            ->values()
            ->toArray();
        
        // Получаем задания курса
        $assignments = $course->assignments()
            ->orderBy('lesson_number', 'asc')
            ->get()
            ->map(function ($assignment) use ($user) {
                $userAssignment = $user->assignments()->where('assignments.id', $assignment->id)->first();
                $pivot = $userAssignment?->pivot;
                
                return [
                    'id' => $assignment->id,
                    'lessonNumber' => $assignment->lesson_number,
                    'title' => $assignment->title,
                    'description' => $assignment->description,
                    'icon' => $assignment->icon,
                    'status' => $pivot?->status ?? 'new',
                    'grade' => $pivot?->grade,
                ];
            })
            ->groupBy('lessonNumber')
            ->toArray();
        
        // Объединяем материалы и задания по урокам
        $lessons = [];
        for ($i = 1; $i <= $course->total_lessons; $i++) {
            $lessonMaterials = collect($materials)->firstWhere('lessonNumber', $i);
            $lessonAssignments = $assignments[$i] ?? [];
            
            $lessons[] = [
                'number' => $i,
                'materials' => $lessonMaterials['materials'] ?? [],
                'assignments' => array_values($lessonAssignments),
                'isCompleted' => $lessonMaterials['isCompleted'] ?? false,
                'isCurrent' => $lessonMaterials['isCurrent'] ?? false,
            ];
        }
        
        return Inertia::render('student/CourseLessons', [
            'course' => [
                'id' => $course->id,
                'name' => $course->name,
                'icon' => $course->icon,
                'description' => $course->description,
                'totalLessons' => $course->total_lessons,
                'lessonsCompleted' => $coursePivot->lessons_completed ?? 0,
                'progress' => $coursePivot->progress ?? 0,
            ],
            'lessons' => $lessons,
        ]);
    }
}
