<template>
    <Head title="Управление заданиями" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Задания</h1>
                <a
                    href="/admin/assignments/create"
                    class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                >
                    + Создать задание
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto -mx-4 sm:mx-0">
                    <table class="w-full min-w-[700px]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Задание</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Курс</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Урок</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Дней на выполнение</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-900">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="assignment in assignments"
                                :key="assignment.id"
                                class="hover:bg-gray-50 transition-colors"
                            >
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">{{ assignment.icon }}</span>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ assignment.title }}</p>
                                            <p class="text-sm text-gray-600 line-clamp-2">{{ assignment.description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ assignment.course }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ assignment.lesson_number }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ assignment.days_to_complete }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a
                                            :href="`/admin/assignments/${assignment.id}`"
                                            class="px-4 py-2 text-primary-600 hover:text-primary-700 font-medium"
                                        >
                                            Просмотр
                                        </a>
                                        <a
                                            :href="`/admin/assignments/${assignment.id}/edit`"
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
    assignments: {
        type: Array,
        default: () => [],
    },
});
</script>

