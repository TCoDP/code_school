<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Certificate;
use App\Models\ChatMessage;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StudentDashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        
        // Определяем секцию по имени маршрута
        $routeName = $request->route()->getName();
        $sectionMap = [
            'student.dashboard' => 'courses',
            'student.courses' => 'courses',
            'student.homeworks' => 'homeworks',
            'student.chat' => 'chat',
            'student.materials' => 'materials',
            'student.certificates' => 'certificates',
        ];
        
        $section = $sectionMap[$routeName] ?? $request->get('section', 'courses');

        // Статистика
        $activeCourses = $user->courses()->wherePivot('status', 'active')->count();
        $completedTasks = $user->assignments()->wherePivot('status', 'completed')->count();
        $certificates = $user->certificates()->where('status', 'completed')->count();
        $overallProgress = $this->calculateOverallProgress($user);

        // Данные для разделов
        $data = [
            'section' => $section,
            'stats' => [
                'activeCourses' => $activeCourses,
                'completedTasks' => $completedTasks,
                'certificates' => $certificates,
                'progress' => $overallProgress,
            ],
        ];

        // Загружаем данные в зависимости от раздела
        switch ($section) {
            case 'courses':
                $data['courses'] = $this->getUserCourses($user);
                break;
            case 'homeworks':
                $data['homeworks'] = $this->getUserAssignments($user);
                break;
            case 'chat':
                $data['messages'] = $this->getChatMessages($user);
                break;
            case 'materials':
                $data['materials'] = $this->getUserMaterials($user);
                break;
            case 'certificates':
                $data['certificates'] = $this->getUserCertificates($user);
                break;
        }

        return Inertia::render('student/Dashboard', $data);
    }

    private function calculateOverallProgress($user): int
    {
        $courses = $user->courses;
        if ($courses->isEmpty()) {
            return 0;
        }

        $totalProgress = $courses->sum(function ($course) {
            return $course->pivot->progress;
        });

        return (int) round($totalProgress / $courses->count());
    }

    private function getUserCourses($user): array
    {
        return $user->courses()
            ->wherePivot('status', '!=', 'paused')
            ->get()
            ->map(function ($course) {
                $startedAt = $course->pivot->started_at 
                    ? (is_string($course->pivot->started_at) 
                        ? \Carbon\Carbon::parse($course->pivot->started_at) 
                        : $course->pivot->started_at)
                    : null;
                
                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'icon' => $course->icon,
                    'period' => $course->age_range,
                    'description' => $course->description,
                    'technologies' => $course->technologies ?? [],
                    'totalLessons' => $course->total_lessons,
                    'status' => $course->pivot->status,
                    'progress' => $course->pivot->progress,
                    'lessonsCompleted' => $course->pivot->lessons_completed,
                    'homeworksCompleted' => $course->pivot->homeworks_completed,
                    'nextLesson' => $course->pivot->lessons_completed < $course->total_lessons 
                        ? 'Урок ' . ($course->pivot->lessons_completed + 1) 
                        : 'Курс завершён',
                    'startedAt' => $startedAt ? $startedAt->format('d.m.Y') : null,
                    'completedAt' => $course->pivot->completed_at 
                        ? (is_string($course->pivot->completed_at) 
                            ? \Carbon\Carbon::parse($course->pivot->completed_at)->format('d.m.Y')
                            : $course->pivot->completed_at->format('d.m.Y'))
                        : null,
                ];
            })
            ->toArray();
    }

    private function getUserAssignments($user): array
    {
        // Получаем задания из курсов пользователя
        $courseIds = $user->courses()->pluck('courses.id');
        
        return Assignment::whereIn('course_id', $courseIds)
            ->with('course')
            ->get()
            ->map(function ($assignment) use ($user) {
                // Получаем pivot данные для этого пользователя
                $userAssignment = $user->assignments()->where('assignments.id', $assignment->id)->first();
                $pivot = $userAssignment?->pivot;
                
                // Вычисляем дедлайн на основе даты начала курса
                $coursePivot = $user->courses()->where('courses.id', $assignment->course_id)->first()?->pivot;
                $deadline = null;
                
                if ($coursePivot && $coursePivot->started_at) {
                    // Если started_at - это строка, парсим её в Carbon
                    $startedAt = is_string($coursePivot->started_at) 
                        ? \Carbon\Carbon::parse($coursePivot->started_at)
                        : $coursePivot->started_at;
                    $deadline = $startedAt->copy()->addDays($assignment->days_to_complete);
                } else {
                    $deadline = now()->addDays($assignment->days_to_complete);
                }
                
                return [
                    'id' => $assignment->id,
                    'title' => $assignment->title,
                    'course' => $assignment->course->name,
                    'lesson' => $assignment->lesson_number,
                    'icon' => $assignment->icon,
                    'description' => $assignment->description,
                    'deadline' => $deadline->format('d.m.Y'),
                    'status' => $pivot?->status ?? 'new',
                    'submittedAt' => $pivot?->submitted_at ? \Carbon\Carbon::parse($pivot->submitted_at)->format('d.m.Y') : null,
                    'feedback' => $pivot?->feedback,
                    'grade' => $pivot?->grade,
                ];
            })
            ->sortBy('deadline')
            ->values()
            ->toArray();
    }

    private function getChatMessages($user): array
    {
        return ChatMessage::where('user_id', $user->id)
            ->orWhere('curator_id', $user->id)
            ->with(['user', 'curator'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) use ($user) {
                return [
                    'id' => $message->id,
                    'from' => $message->sender_type,
                    'sender_type' => $message->sender_type,
                    'sender' => $message->sender_type === 'student' 
                        ? $message->user->name 
                        : ($message->curator?->name ?? 'Куратор'),
                    'message' => $message->message,
                    'text' => $message->message,
                    'time' => $message->created_at->format('H:i'),
                    'created_at' => $message->created_at->toIso8601String(),
                ];
            })
            ->toArray();
    }

    private function getUserMaterials($user): array
    {
        $courseIds = $user->courses()->pluck('courses.id');
        
        return Material::whereIn('course_id', $courseIds)
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($material) {
                return [
                    'id' => $material->id,
                    'title' => $material->title,
                    'course' => $material->course->name,
                    'type' => $material->type,
                    'icon' => $material->icon,
                    'description' => $material->description,
                    'isNew' => $material->is_new,
                    'links' => $material->links ?? [],
                ];
            })
            ->toArray();
    }

    private function getUserCertificates($user): array
    {
        return Certificate::where('user_id', $user->id)
            ->with('course')
            ->get()
            ->map(function ($certificate) {
                return [
                    'id' => $certificate->id,
                    'course' => $certificate->course->name,
                    'courseId' => $certificate->course_id,
                    'level' => $certificate->level,
                    'issuedDate' => $certificate->issued_at?->format('d.m.Y'),
                    'progress' => $certificate->progress,
                    'completedTasks' => $certificate->completed_tasks,
                    'totalTasks' => $certificate->total_tasks,
                    'status' => $certificate->status === 'completed' ? 'completed' : 'in_progress',
                    'filePath' => $certificate->file_path,
                    'hasFile' => !empty($certificate->file_path),
                ];
            })
            ->toArray();
    }
}
