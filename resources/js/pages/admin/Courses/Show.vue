<template>
    <Head title="Просмотр курса" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">{{ course.name }}</h1>
                <div class="flex gap-3">
                    <a
                        :href="`/admin/courses/${course.id}/edit`"
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors"
                    >
                        Редактировать
                    </a>
                    <a
                        href="/admin/courses"
                        class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors"
                    >
                        ← Назад к списку
                    </a>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Основная информация -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Основная информация</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-600">Название</label>
                            <p class="text-lg font-semibold text-gray-900">{{ course.name }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Иконка</label>
                            <p class="text-3xl">{{ course.icon }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Возрастная группа</label>
                            <p class="text-lg text-gray-900">{{ course.age_range }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Описание</label>
                            <p class="text-gray-700">{{ course.description }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Технологии</label>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span
                                    v-for="tech in course.technologies"
                                    :key="tech"
                                    class="px-3 py-1 bg-primary-50 text-primary-600 rounded-full text-sm font-medium"
                                >
                                    {{ tech }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Всего уроков</label>
                            <p class="text-lg text-gray-900">{{ course.total_lessons }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Статус</label>
                            <span
                                :class="[
                                    'inline-block px-3 py-1 rounded-full text-sm font-semibold mt-2',
                                    course.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'
                                ]"
                            >
                                {{ course.is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Студентов</label>
                            <p class="text-lg text-gray-900">{{ course.students_count }}</p>
                        </div>
                    </div>
                </div>

                <!-- Задания и материалы -->
                <div class="space-y-6">
                    <!-- Задания -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Задания ({{ course.assignments?.length || 0 }})</h2>
                        <div
                            v-if="course.assignments && course.assignments.length > 0"
                            class="space-y-2"
                        >
                            <div
                                v-for="assignment in course.assignments"
                                :key="assignment.id"
                                class="p-3 bg-gray-50 rounded-lg"
                            >
                                <div class="flex items-center gap-2">
                                    <span>{{ assignment.icon }}</span>
                                    <p class="font-semibold text-gray-900">{{ assignment.title }}</p>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Урок {{ assignment.lesson_number }}</p>
                            </div>
                        </div>
                        <p
                            v-else
                            class="text-gray-500"
                        >
                            Заданий пока нет
                        </p>
                    </div>

                    <!-- Материалы -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Материалы ({{ course.materials?.length || 0 }})</h2>
                        <div
                            v-if="course.materials && course.materials.length > 0"
                            class="space-y-2"
                        >
                            <div
                                v-for="material in course.materials"
                                :key="material.id"
                                class="p-3 bg-gray-50 rounded-lg"
                            >
                                <div class="flex items-center gap-2">
                                    <span>{{ material.icon }}</span>
                                    <p class="font-semibold text-gray-900">{{ material.title }}</p>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">{{ material.type }}</p>
                            </div>
                        </div>
                        <p
                            v-else
                            class="text-gray-500"
                        >
                            Материалов пока нет
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    course: {
        type: Object,
        required: true,
    },
});
</script>

