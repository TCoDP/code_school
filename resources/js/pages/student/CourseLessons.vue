<template>
    <Head :title="`${course.name} - Уроки`" />

    <StudentLayout>
        <div class="space-y-6">
            <!-- Course Header -->
            <div class="bg-gradient-to-r from-primary-500 to-secondary-500 rounded-2xl p-6 md:p-8 text-white">
                <div class="flex items-start gap-4 mb-4">
                    <span class="text-5xl">{{ course.icon }}</span>
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ course.name }}</h1>
                        <p class="text-lg opacity-90 mb-4">{{ course.description }}</p>
                        <div class="flex items-center gap-6">
                            <div>
                                <div class="text-2xl font-bold">{{ course.lessonsCompleted }}/{{ course.totalLessons }}</div>
                                <div class="text-sm opacity-80">Уроков пройдено</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">{{ course.progress }}%</div>
                                <div class="text-sm opacity-80">Прогресс</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-white/20 rounded-full h-3 mt-4">
                    <div
                        class="bg-white h-3 rounded-full transition-all duration-500"
                        :style="{ width: `${course.progress}%` }"
                    ></div>
                </div>
            </div>

            <!-- Back Button -->
            <button
                @click="goBack"
                class="flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium transition-colors"
            >
                <span>←</span>
                <span>Вернуться к курсам</span>
            </button>

            <!-- Lessons List -->
            <div class="space-y-4">
                <div
                    v-for="lesson in lessons"
                    :key="lesson.number"
                    :class="[
                        'bg-white rounded-2xl shadow-lg border-2 overflow-hidden transition-all',
                        lesson.isCurrent ? 'border-primary-500 shadow-xl' : 'border-gray-200',
                        lesson.isCompleted ? 'opacity-90' : ''
                    ]"
                >
                    <!-- Lesson Header -->
                    <div
                        :class="[
                            'p-6 border-b-2',
                            lesson.isCurrent
                                ? 'bg-gradient-to-r from-primary-50 to-secondary-50 border-primary-200'
                                : lesson.isCompleted
                                ? 'bg-green-50 border-green-200'
                                : 'bg-gray-50 border-gray-200'
                        ]"
                    >
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    :class="[
                                        'w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold',
                                        lesson.isCurrent
                                            ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white'
                                            : lesson.isCompleted
                                            ? 'bg-green-500 text-white'
                                            : 'bg-gray-300 text-gray-700'
                                    ]"
                                >
                                    {{ lesson.number }}
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">
                                        Урок {{ lesson.number }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ lesson.isCurrent ? 'Текущий урок' : lesson.isCompleted ? 'Пройден' : 'Не начат' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    v-if="lesson.isCurrent"
                                    class="px-4 py-2 bg-primary-500 text-white rounded-lg font-semibold text-sm"
                                >
                                    Продолжить
                                </span>
                                <span
                                    v-else-if="lesson.isCompleted"
                                    class="text-2xl"
                                >
                                    ✅
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson Content -->
                    <div class="p-6 space-y-6">
                        <!-- Materials -->
                        <div v-if="lesson.materials.length > 0">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <span>📚</span>
                                <span>Материалы урока</span>
                            </h4>
                            <div class="grid gap-4">
                                <div
                                    v-for="material in lesson.materials"
                                    :key="material.id"
                                    class="bg-gray-50 rounded-xl p-4 border border-gray-200 hover:border-primary-300 transition-colors"
                                >
                                    <div class="flex items-start gap-4">
                                        <div class="text-3xl flex-shrink-0">{{ material.icon }}</div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between mb-2">
                                                <div>
                                                    <h5 class="font-semibold text-gray-900 mb-1">{{ material.title }}</h5>
                                                    <p class="text-sm text-gray-600 mb-2">{{ material.description }}</p>
                                                    <span class="inline-block px-2 py-1 bg-primary-100 text-primary-700 rounded text-xs font-medium">
                                                        {{ getMaterialTypeLabel(material.type) }}
                                                    </span>
                                                </div>
                                                <span
                                                    v-if="material.isNew"
                                                    class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-semibold"
                                                >
                                                    Новое
                                                </span>
                                            </div>
                                            <div v-if="material.links && material.links.length > 0" class="flex flex-wrap gap-2 mt-3">
                                                <a
                                                    v-for="link in material.links"
                                                    :key="link.url"
                                                    :href="link.url"
                                                    target="_blank"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-primary-500 text-white rounded-lg font-medium hover:bg-primary-600 transition-colors text-sm"
                                                >
                                                    <span>{{ link.icon }}</span>
                                                    <span>{{ link.label }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assignments -->
                        <div v-if="lesson.assignments.length > 0">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <span>📝</span>
                                <span>Домашние задания</span>
                            </h4>
                            <div class="grid gap-4">
                                <div
                                    v-for="assignment in lesson.assignments"
                                    :key="assignment.id"
                                    class="bg-gray-50 rounded-xl p-4 border border-gray-200"
                                >
                                    <div class="flex items-start gap-4">
                                        <div class="text-3xl flex-shrink-0">{{ assignment.icon }}</div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between mb-2">
                                                <div>
                                                    <h5 class="font-semibold text-gray-900 mb-1">{{ assignment.title }}</h5>
                                                    <p class="text-sm text-gray-600">{{ assignment.description }}</p>
                                                </div>
                                                <span
                                                    :class="[
                                                        'px-3 py-1 rounded-full text-xs font-semibold',
                                                        getAssignmentStatusClass(assignment.status)
                                                    ]"
                                                >
                                                    {{ getAssignmentStatusLabel(assignment.status) }}
                                                </span>
                                            </div>
                                            <div v-if="assignment.grade" class="mt-2">
                                                <span class="text-sm font-semibold text-primary-600">
                                                    Оценка: {{ assignment.grade }}/10
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State for Lesson -->
                        <div
                            v-if="lesson.materials.length === 0 && lesson.assignments.length === 0"
                            class="text-center py-8 text-gray-500"
                        >
                            Материалы для этого урока появятся позже
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </StudentLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import StudentLayout from '@/layouts/student/StudentLayout.vue';

const props = defineProps({
    course: {
        type: Object,
        required: true,
    },
    lessons: {
        type: Array,
        default: () => [],
    },
});

const goBack = () => {
    router.visit('/student/courses');
};

const getMaterialTypeLabel = (type) => {
    const labels = {
        video: 'Видеоурок',
        document: 'Документ',
        link: 'Ссылка',
        presentation: 'Презентация',
    };
    return labels[type] || type;
};

const getAssignmentStatusClass = (status) => {
    const classes = {
        new: 'bg-gray-100 text-gray-700',
        pending: 'bg-yellow-100 text-yellow-700',
        review: 'bg-blue-100 text-blue-700',
        completed: 'bg-green-100 text-green-700',
    };
    return classes[status] || 'bg-gray-100 text-gray-700';
};

const getAssignmentStatusLabel = (status) => {
    const labels = {
        new: 'Новое',
        pending: 'На проверке',
        review: 'На проверке',
        completed: 'Выполнено',
    };
    return labels[status] || status;
};
</script>

