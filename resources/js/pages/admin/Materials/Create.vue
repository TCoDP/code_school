<template>
    <Head title="Создать материал" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Создать материал</h1>
                <a
                    href="/admin/materials"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors"
                >
                    ← Назад к списку
                </a>
            </div>

            <form
                @submit.prevent="submit"
                class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8"
            >
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Курс *</label>
                        <select
                            v-model="form.course_id"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="">Выберите курс</option>
                            <option
                                v-for="course in courses"
                                :key="course.id"
                                :value="course.id"
                            >
                                {{ course.name }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Название материала *</label>
                        <input
                            v-model="form.title"
                            type="text"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Описание *</label>
                        <textarea
                            v-model="form.description"
                            required
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Тип *</label>
                        <select
                            v-model="form.type"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="video">Видео</option>
                            <option value="document">Документ</option>
                            <option value="link">Ссылка</option>
                            <option value="presentation">Презентация</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Иконка (эмодзи)</label>
                        <input
                            v-model="form.icon"
                            type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="▶️"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Номер урока</label>
                        <input
                            v-model.number="form.lesson_number"
                            type="number"
                            min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="flex items-center gap-2">
                            <input
                                v-model="form.is_new"
                                type="checkbox"
                                class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500"
                            />
                            <span class="text-sm font-semibold text-gray-900">Пометить как новое</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                        >
                            Создать материал
                        </button>
                        <a
                            href="/admin/materials"
                            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors"
                        >
                            Отмена
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    courses: {
        type: Array,
        default: () => [],
    },
});

const form = reactive({
    course_id: '',
    title: '',
    description: '',
    type: 'video',
    icon: '▶️',
    lesson_number: null,
    links: [],
    is_new: false,
});

const submit = () => {
    router.post('/admin/materials', form);
};
</script>

