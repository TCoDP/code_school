<template>
    <Head title="Управление материалами" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Материалы</h1>
                <a
                    href="/admin/materials/create"
                    class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                >
                    + Создать материал
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto -mx-4 sm:mx-0">
                    <table class="w-full min-w-[700px]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Материал</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Курс</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Тип</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Урок</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Статус</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-900">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="material in materials"
                                :key="material.id"
                                class="hover:bg-gray-50 transition-colors"
                            >
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">{{ material.icon }}</span>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ material.title }}</p>
                                            <p class="text-sm text-gray-600 line-clamp-2">{{ material.description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ material.course }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-medium">
                                        {{ getTypeLabel(material.type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ material.lesson_number || '-' }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        v-if="material.is_new"
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700"
                                    >
                                        Новое
                                    </span>
                                    <span v-else class="text-gray-500 text-sm">-</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a
                                            :href="`/admin/materials/${material.id}`"
                                            class="px-4 py-2 text-primary-600 hover:text-primary-700 font-medium"
                                        >
                                            Просмотр
                                        </a>
                                        <a
                                            :href="`/admin/materials/${material.id}/edit`"
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
    materials: {
        type: Array,
        default: () => [],
    },
});

const getTypeLabel = (type) => {
    const labels = {
        video: 'Видео',
        document: 'Документ',
        link: 'Ссылка',
        presentation: 'Презентация',
    };
    return labels[type] || type;
};
</script>

