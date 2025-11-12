<template>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Домашние задания и проверки</h2>
            <div class="flex gap-2">
                <button
                    :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-colors',
                        filter === 'all' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                    @click="filter = 'all'"
                >
                    Все
                </button>
                <button
                    :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-colors',
                        filter === 'pending' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                    @click="filter = 'pending'"
                >
                    На проверке
                </button>
                <button
                    :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-colors',
                        filter === 'completed' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                    @click="filter = 'completed'"
                >
                    Выполнено
                </button>
            </div>
        </div>

        <div class="grid gap-4">
            <div
                v-for="homework in filteredHomeworks"
                :key="homework.id"
                class="bg-white rounded-xl shadow-md border border-gray-200 p-6"
            >
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">{{ homework.icon }}</span>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ homework.title }}</h3>
                                <p class="text-sm text-gray-500">
                                    Курс: {{ homework.course }} • Урок {{ homework.lesson }}
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-3">{{ homework.description }}</p>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>📅 Срок: {{ homework.deadline }}</span>
                            <span v-if="homework.submittedAt">✅ Сдано: {{ homework.submittedAt }}</span>
                        </div>
                    </div>
                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold whitespace-nowrap"
                        :class="getStatusClass(homework.status)"
                    >
                        {{ getStatusLabel(homework.status) }}
                    </span>
                </div>

                <!-- Mentor Feedback -->
                <div
                    v-if="homework.feedback"
                    class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200"
                >
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-lg">👨‍🏫</span>
                        <span class="font-semibold text-gray-900">Комментарий наставника:</span>
                    </div>
                    <p class="text-gray-700">{{ homework.feedback }}</p>
                    <div
                        v-if="homework.grade"
                        class="mt-2 text-sm font-semibold text-primary-600"
                    >
                        Оценка: {{ homework.grade }}/10
                    </div>
                </div>

                <!-- Actions -->
                <div
                    v-if="homework.status === 'pending' || homework.status === 'new'"
                    class="mt-4 flex gap-3"
                >
                    <button
                        class="px-6 py-2 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-600 transition-colors"
                    >
                        Выполнить задание
                    </button>
                    <button
                        class="px-6 py-2 border-2 border-primary-500 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-colors"
                    >
                        Посмотреть материалы
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div
            v-if="filteredHomeworks.length === 0"
            class="bg-white rounded-xl shadow-md border border-gray-200 p-12 text-center"
        >
            <div class="text-6xl mb-4">📝</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Нет заданий</h3>
            <p class="text-gray-600">Все задания выполнены! Отличная работа! 🎉</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    homeworks: {
        type: Array,
        default: () => [],
    },
});

const filter = ref('all');

const homeworks = computed(() => props.homeworks || []);

const filteredHomeworks = computed(() => {
    if (filter.value === 'all') return homeworks.value;
    if (filter.value === 'pending') return homeworks.value.filter(h => h.status === 'review' || h.status === 'pending');
    if (filter.value === 'completed') return homeworks.value.filter(h => h.status === 'completed');
    return homeworks.value;
});

const getStatusClass = (status) => {
    const classes = {
        new: 'bg-yellow-100 text-yellow-700',
        pending: 'bg-blue-100 text-blue-700',
        review: 'bg-purple-100 text-purple-700',
        completed: 'bg-green-100 text-green-700',
    };
    return classes[status] || 'bg-gray-100 text-gray-700';
};

const getStatusLabel = (status) => {
    const labels = {
        new: 'Новое',
        pending: 'В работе',
        review: 'На проверке',
        completed: 'Выполнено',
    };
    return labels[status] || 'Неизвестно';
};
</script>

