<template>
    <Head title="Редактировать задание" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Редактировать задание</h1>
                <a
                    href="/admin/assignments"
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
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Название задания *</label>
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
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Иконка (эмодзи)</label>
                        <input
                            v-model="form.icon"
                            type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Номер урока *</label>
                        <input
                            v-model.number="form.lesson_number"
                            type="number"
                            required
                            min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Дней на выполнение *</label>
                        <input
                            v-model.number="form.days_to_complete"
                            type="number"
                            required
                            min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                        >
                            Сохранить изменения
                        </button>
                        <a
                            href="/admin/assignments"
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
    assignment: {
        type: Object,
        required: true,
    },
    courses: {
        type: Array,
        default: () => [],
    },
});

const form = reactive({
    course_id: props.assignment.course_id || '',
    title: props.assignment.title || '',
    description: props.assignment.description || '',
    icon: props.assignment.icon || '📝',
    lesson_number: props.assignment.lesson_number || 1,
    days_to_complete: props.assignment.days_to_complete || 7,
});

const submit = () => {
    router.put(`/admin/assignments/${props.assignment.id}`, form);
};
</script>

