<template>
    <Head title="Редактировать курс" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Редактировать курс</h1>
                <a
                    href="/admin/courses"
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
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Название курса *</label>
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
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
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Возрастная группа *</label>
                        <input
                            v-model="form.age_range"
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
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Технологии (через запятую)</label>
                        <input
                            v-model="technologiesInput"
                            type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            @input="updateTechnologies"
                        />
                        <p class="text-sm text-gray-500 mt-1">Введите технологии через запятую</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Всего уроков *</label>
                        <input
                            v-model.number="form.total_lessons"
                            type="number"
                            required
                            min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="flex items-center gap-2">
                            <input
                                v-model="form.is_active"
                                type="checkbox"
                                class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500"
                            />
                            <span class="text-sm font-semibold text-gray-900">Курс активен</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                        >
                            Сохранить изменения
                        </button>
                        <a
                            href="/admin/courses"
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
import { ref, reactive, onMounted } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    course: {
        type: Object,
        required: true,
    },
});

const technologiesInput = ref(props.course.technologies?.join(', ') || '');

const form = reactive({
    name: props.course.name || '',
    icon: props.course.icon || '',
    age_range: props.course.age_range || '',
    description: props.course.description || '',
    technologies: props.course.technologies || [],
    total_lessons: props.course.total_lessons || 1,
    is_active: props.course.is_active ?? true,
});

const updateTechnologies = () => {
    form.technologies = technologiesInput.value
        .split(',')
        .map(t => t.trim())
        .filter(t => t.length > 0);
};

const submit = () => {
    router.put(`/admin/courses/${props.course.id}`, form);
};
</script>

