<template>
    <Head title="Просмотр задания" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">{{ assignment.title }}</h1>
                <div class="flex gap-3">
                    <a
                        :href="`/admin/assignments/${assignment.id}/edit`"
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors"
                    >
                        Редактировать
                    </a>
                    <a
                        href="/admin/assignments"
                        class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors"
                    >
                        ← Назад к списку
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Название</label>
                        <p class="text-lg font-semibold text-gray-900">{{ assignment.title }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Курс</label>
                        <p class="text-lg text-gray-900">{{ assignment.course }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Урок</label>
                        <p class="text-lg text-gray-900">{{ assignment.lesson_number }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Дней на выполнение</label>
                        <p class="text-lg text-gray-900">{{ assignment.days_to_complete }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Описание</label>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ assignment.description }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Студентов выполняют</label>
                        <p class="text-lg text-gray-900">{{ assignment.users_count || 0 }}</p>
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
    assignment: {
        type: Object,
        required: true,
    },
});
</script>

