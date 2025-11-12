<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Material;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $stats = [
            'totalUsers' => User::count(),
            'totalCourses' => Course::count(),
            'activeCourses' => Course::where('is_active', true)->count(),
            'totalAssignments' => Assignment::count(),
            'totalMaterials' => Material::count(),
            'totalCertificates' => Certificate::where('status', 'completed')->count(),
            'activeStudents' => User::whereHas('courses', function($query) {
                $query->where('status', 'active');
            })->count(),
        ];

        $recentUsers = User::latest()->take(5)->get()->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at->format('d.m.Y'),
            ];
        });

        $recentCourses = Course::latest()->take(5)->get()->map(function($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
                'icon' => $course->icon,
                'students_count' => $course->users()->count(),
                'is_active' => $course->is_active,
            ];
        });

        return Inertia::render('admin/Dashboard', [
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'recentCourses' => $recentCourses,
        ]);
    }
}
