<template>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Мои курсы и прогресс</h2>
            
            <!-- Filters -->
            <div class="flex items-center gap-3">
                <button
                    v-for="filter in filters"
                    :key="filter.value"
                    :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-all',
                        activeFilter === filter.value
                            ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md'
                            : 'bg-white text-gray-700 border-2 border-gray-200 hover:border-primary-300'
                    ]"
                    @click="activeFilter = filter.value"
                >
                    {{ filter.label }}
                </button>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid gap-6">
            <div
                v-for="course in filteredCourses"
                :key="course.id"
                class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
            >
                <div class="p-6 md:p-8">
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="text-5xl">{{ course.icon }}</div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ course.name }}</h3>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold"
                                        :class="getStatusClass(course.status)"
                                    >
                                        {{ getStatusText(course.status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">{{ course.period }}</p>
                                <p class="text-gray-600 leading-relaxed">{{ course.description }}</p>
                                
                                <!-- Technologies -->
                                <div v-if="course.technologies && course.technologies.length > 0" class="flex flex-wrap gap-2 mt-3">
                                    <span
                                        v-for="tech in course.technologies"
                                        :key="tech"
                                        class="px-3 py-1 bg-primary-50 text-primary-700 rounded-lg text-xs font-medium"
                                    >
                                        {{ tech }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Section -->
                    <div class="mb-6 p-4 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-gray-700">Прогресс курса</span>
                            <span class="text-lg font-bold text-primary-600">{{ course.progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div
                                class="bg-gradient-to-r from-primary-500 to-secondary-500 h-4 rounded-full transition-all duration-500 flex items-center justify-end pr-2"
                                :style="{ width: `${course.progress}%` }"
                            >
                                <span v-if="course.progress > 10" class="text-xs font-bold text-white">
                                    {{ course.progress }}%
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Course Stats Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                {{ course.lessonsCompleted }}/{{ course.totalLessons }}
                            </div>
                            <div class="text-xs text-gray-600">Уроков пройдено</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                {{ course.homeworksCompleted }}
                            </div>
                            <div class="text-xs text-gray-600">Заданий выполнено</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div class="text-lg font-bold text-primary-600 mb-1">
                                {{ course.nextLesson }}
                            </div>
                            <div class="text-xs text-gray-600">Следующий урок</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div class="text-lg font-bold text-gray-900 mb-1" v-if="course.startedAt">
                                {{ course.startedAt }}
                            </div>
                            <div class="text-xs text-gray-600">Дата начала</div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                        <button
                            v-if="course.status === 'active'"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                            @click="continueCourse(course.id)"
                        >
                            <span>▶️</span>
                            <span>Продолжить обучение</span>
                        </button>
                        <button
                            class="px-6 py-3 border-2 border-primary-500 text-primary-600 rounded-xl font-semibold hover:bg-primary-50 transition-all flex items-center justify-center gap-2"
                            @click="viewCourseDetails(course.id)"
                        >
                            <span>📖</span>
                            <span>Подробнее о курсе</span>
                        </button>
                        <button
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all flex items-center justify-center gap-2"
                            @click="viewMaterials(course.id)"
                        >
                            <span>📚</span>
                            <span>Материалы</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div
            v-if="filteredCourses.length === 0"
            class="bg-white rounded-2xl shadow-lg border border-gray-200 p-12 text-center"
        >
            <div class="text-6xl mb-4">📚</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                {{ activeFilter === 'all' ? 'У вас пока нет курсов' : getEmptyStateTitle() }}
            </h3>
            <p class="text-gray-600 mb-6">
                {{ activeFilter === 'all' ? 'Запишитесь на курс, чтобы начать обучение' : getEmptyStateDescription() }}
            </p>
            <a
                v-if="activeFilter === 'all'"
                href="/"
                class="inline-block px-8 py-4 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
            >
                Выбрать курс
            </a>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    courses: {
        type: Array,
        default: () => [],
    },
});

const activeFilter = ref('all');

const filters = [
    { value: 'all', label: 'Все курсы' },
    { value: 'active', label: 'Активные' },
    { value: 'completed', label: 'Завершённые' },
];

const filteredCourses = computed(() => {
    if (activeFilter.value === 'all') {
        return props.courses;
    }
    return props.courses.filter(course => course.status === activeFilter.value);
});

const getStatusClass = (status) => {
    const classes = {
        active: 'bg-green-100 text-green-700',
        completed: 'bg-blue-100 text-blue-700',
        paused: 'bg-yellow-100 text-yellow-700',
    };
    return classes[status] || 'bg-gray-100 text-gray-700';
};

const getStatusText = (status) => {
    const texts = {
        active: 'В процессе',
        completed: 'Завершён',
        paused: 'Приостановлен',
    };
    return texts[status] || status;
};

const getEmptyStateTitle = () => {
    const titles = {
        active: 'Нет активных курсов',
        completed: 'Нет завершённых курсов',
    };
    return titles[activeFilter.value] || 'Курсы не найдены';
};

const getEmptyStateDescription = () => {
    const descriptions = {
        active: 'Начните новый курс, чтобы увидеть его здесь',
        completed: 'Завершите курс, чтобы увидеть его здесь',
    };
    return descriptions[activeFilter.value] || '';
};

const continueCourse = (courseId) => {
    // Переход к урокам курса
    router.visit(`/student/courses/${courseId}/lessons`, {
        preserveState: false,
    });
};

const viewCourseDetails = (courseId) => {
    // Можно открыть модальное окно или перейти на детальную страницу
    // Пока просто переходим к материалам
    router.visit(`/student/materials?course=${courseId}`, {
        preserveState: false,
    });
};

const viewMaterials = (courseId) => {
    router.visit(`/student/materials?course=${courseId}`, {
        preserveState: false,
    });
};
</script>
