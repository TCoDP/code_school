<template>
    <Head title="Управление курсами" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Курсы</h1>
                <a
                    href="/admin/courses/create"
                    class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                >
                    + Создать курс
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto -mx-4 sm:mx-0">
                    <table class="w-full min-w-[640px]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Курс</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Возраст</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Уроков</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Студентов</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Статус</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-900">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="course in courses"
                                :key="course.id"
                                class="hover:bg-gray-50 transition-colors"
                            >
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">{{ course.icon }}</span>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ course.name }}</p>
                                            <p class="text-sm text-gray-600">{{ course.description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ course.age_range }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ course.total_lessons }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ course.students_count }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        :class="[
                                            'px-3 py-1 rounded-full text-xs font-semibold',
                                            course.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'
                                        ]"
                                    >
                                        {{ course.is_active ? 'Активен' : 'Неактивен' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a
                                            :href="`/admin/courses/${course.id}`"
                                            class="px-4 py-2 text-primary-600 hover:text-primary-700 font-medium"
                                        >
                                            Просмотр
                                        </a>
                                        <a
                                            :href="`/admin/courses/${course.id}/edit`"
                                            class="px-4 py-2 text-blue-600 hover:text-blue-700 font-medium"
                                        >
                                            Редактировать
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    courses: {
        type: Array,
        default: () => [],
    },
});
</script>

