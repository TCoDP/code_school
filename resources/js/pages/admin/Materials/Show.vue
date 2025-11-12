<template>
    <Head title="Просмотр материала" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">{{ material.title }}</h1>
                <div class="flex gap-3">
                    <a
                        :href="`/admin/materials/${material.id}/edit`"
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors"
                    >
                        Редактировать
                    </a>
                    <a
                        href="/admin/materials"
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
                        <p class="text-lg font-semibold text-gray-900">{{ material.title }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Курс</label>
                        <p class="text-lg text-gray-900">{{ material.course }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Тип</label>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm font-medium">
                            {{ getTypeLabel(material.type) }}
                        </span>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Урок</label>
                        <p class="text-lg text-gray-900">{{ material.lesson_number || '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Описание</label>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ material.description }}</p>
                    </div>
                    <div
                        v-if="material.links && material.links.length > 0"
                    >
                        <label class="text-sm text-gray-600">Ссылки</label>
                        <div class="space-y-2 mt-2">
                            <a
                                v-for="(link, index) in material.links"
                                :key="index"
                                :href="link.url"
                                target="_blank"
                                class="block px-4 py-2 bg-gray-50 rounded-lg hover:bg-gray-100 text-primary-600 hover:text-primary-700"
                            >
                                {{ link.label || link.url }}
                            </a>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Статус</label>
                        <span
                            v-if="material.is_new"
                            class="inline-block px-3 py-1 rounded-full text-sm font-semibold mt-2 bg-green-100 text-green-700"
                        >
                            Новое
                        </span>
                        <span
                            v-else
                            class="text-gray-500"
                        >
                            -
                        </span>
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
    material: {
        type: Object,
        required: true,
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

