<template>
    <Head title="Админ-панель" />

    <AdminLayout>
        <div class="space-y-6">
            <h1 class="text-3xl font-bold text-gray-900">Панель управления</h1>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <div
                    v-for="stat in statsList"
                    :key="stat.label"
                    class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">{{ stat.label }}</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stat.value }}</p>
                        </div>
                        <div class="text-4xl">{{ stat.icon }}</div>
                    </div>
                </div>
            </div>

            <!-- Recent Users and Courses -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <!-- Recent Users -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Последние пользователи</h2>
                    <div class="space-y-3">
                        <div
                            v-for="user in recentUsers"
                            :key="user.id"
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors"
                        >
                            <div>
                                <p class="font-semibold text-gray-900">{{ user.name }}</p>
                                <p class="text-sm text-gray-600">{{ user.email }}</p>
                            </div>
                            <span
                                :class="[
                                    'px-3 py-1 rounded-full text-xs font-semibold',
                                    user.role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700'
                                ]"
                            >
                                {{ user.role === 'admin' ? 'Админ' : 'Студент' }}
                            </span>
                        </div>
                    </div>
                    <a
                        href="/admin/users"
                        class="block mt-4 text-center text-primary-600 hover:text-primary-700 font-medium"
                    >
                        Все пользователи →
                    </a>
                </div>

                <!-- Recent Courses -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Последние курсы</h2>
                    <div class="space-y-3">
                        <div
                            v-for="course in recentCourses"
                            :key="course.id"
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors"
                        >
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">{{ course.icon }}</span>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ course.name }}</p>
                                    <p class="text-sm text-gray-600">{{ course.students_count }} студентов</p>
                                </div>
                            </div>
                            <span
                                :class="[
                                    'px-3 py-1 rounded-full text-xs font-semibold',
                                    course.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'
                                ]"
                            >
                                {{ course.is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                        </div>
                    </div>
                    <a
                        href="/admin/courses"
                        class="block mt-4 text-center text-primary-600 hover:text-primary-700 font-medium"
                    >
                        Все курсы →
                    </a>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    stats: {
        type: Object,
        required: true,
    },
    recentUsers: {
        type: Array,
        default: () => [],
    },
    recentCourses: {
        type: Array,
        default: () => [],
    },
});

const statsList = [
    { label: 'Всего пользователей', value: props.stats.totalUsers, icon: '👥' },
    { label: 'Активных студентов', value: props.stats.activeStudents, icon: '🎓' },
    { label: 'Всего курсов', value: props.stats.totalCourses, icon: '📚' },
    { label: 'Активных курсов', value: props.stats.activeCourses, icon: '✅' },
    { label: 'Всего заданий', value: props.stats.totalAssignments, icon: '📝' },
    { label: 'Всего материалов', value: props.stats.totalMaterials, icon: '📖' },
    { label: 'Выданных сертификатов', value: props.stats.totalCertificates, icon: '🏆' },
];
</script>

