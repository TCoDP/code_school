<template>
    <Head title="Личный кабинет" />

    <StudentLayout>
        <div class="space-y-6">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-primary-500 to-secondary-500 rounded-2xl p-6 md:p-8 text-white">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    Добро пожаловать, {{ userName }}! 👋
                </h1>
                <p class="text-lg opacity-90">
                    Продолжайте обучение и достигайте новых высот в программировании
                </p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200">
                    <div class="text-3xl mb-2">📚</div>
                    <div class="text-2xl font-bold text-gray-900">{{ activeCourses }}</div>
                    <div class="text-sm text-gray-600">Активных курсов</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200">
                    <div class="text-3xl mb-2">✅</div>
                    <div class="text-2xl font-bold text-gray-900">{{ completedTasks }}</div>
                    <div class="text-sm text-gray-600">Выполнено заданий</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200">
                    <div class="text-3xl mb-2">🏆</div>
                    <div class="text-2xl font-bold text-gray-900">{{ certificatesCount }}</div>
                    <div class="text-sm text-gray-600">Сертификатов</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200">
                    <div class="text-3xl mb-2">📈</div>
                    <div class="text-2xl font-bold text-gray-900">{{ progress }}%</div>
                    <div class="text-sm text-gray-600">Общий прогресс</div>
                </div>
            </div>

            <!-- Active Section -->
            <component
                :is="currentComponent"
                :courses="coursesData"
                :homeworks="homeworksData"
                :messages="messagesData"
                :materials="materialsData"
                :certificates="certificatesData"
            />
        </div>
    </StudentLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import StudentLayout from '@/layouts/student/StudentLayout.vue';
import MyCourses from '@/components/student/MyCourses.vue';
import Homeworks from '@/components/student/Homeworks.vue';
import Chat from '@/components/student/Chat.vue';
import Materials from '@/components/student/Materials.vue';
import Certificates from '@/components/student/Certificates.vue';

const props = defineProps({
    section: {
        type: String,
        default: 'courses',
    },
    stats: {
        type: Object,
        required: true,
    },
    courses: {
        type: Array,
        default: () => [],
    },
    homeworks: {
        type: Array,
        default: () => [],
    },
    messages: {
        type: Array,
        default: () => [],
    },
    materials: {
        type: Array,
        default: () => [],
    },
    certificates: {
        type: Array,
        default: () => [],
    },
});

const page = usePage();
const userName = computed(() => page.props.auth?.user?.name || 'Студент');

const activeCourses = computed(() => props.stats.activeCourses || 0);
const completedTasks = computed(() => props.stats.completedTasks || 0);
const certificatesCount = computed(() => props.stats.certificates || 0);
const progress = computed(() => props.stats.progress || 0);

const components = {
    courses: MyCourses,
    homeworks: Homeworks,
    chat: Chat,
    materials: Materials,
    certificates: Certificates,
};

const currentComponent = computed(() => components[props.section] || MyCourses);

const coursesData = computed(() => props.courses || []);
const homeworksData = computed(() => props.homeworks || []);
const messagesData = computed(() => props.messages || []);
const materialsData = computed(() => props.materials || []);
const certificatesData = computed(() => props.certificates || []);
</script>

