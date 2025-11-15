<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Header -->
        <header class="bg-white/95 backdrop-blur-md shadow-md border-b border-gray-200 sticky top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <span class="text-3xl">🧠</span>
                            <span class="font-mono text-2xl font-bold text-primary-600">АйТиПлюс</span>
                        </div>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-700 font-semibold">Личный кабинет</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a
                            href="/"
                            class="px-4 py-2 text-gray-700 hover:text-primary-600 transition-colors font-medium"
                        >
                            На главную
                        </a>
                        <button
                            class="px-6 py-2 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                            @click="logout"
                        >
                            Выйти
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 py-8">
                <!-- Navigation Tabs -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 mb-8 overflow-x-auto">
                    <nav class="flex space-x-2 p-2">
                        <button
                            v-for="tab in tabs"
                            :key="tab.id"
                            :class="[
                                'px-4 md:px-6 py-3 rounded-xl font-semibold transition-all whitespace-nowrap flex items-center gap-2 text-sm md:text-base',
                                activeTab === tab.id
                                    ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-lg transform scale-105'
                                    : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50'
                            ]"
                            @click="switchTab(tab.id)"
                        >
                            <span class="text-lg md:text-xl">{{ tab.icon }}</span>
                            <span class="hidden sm:inline">{{ tab.label }}</span>
                        </button>
                    </nav>
                </div>

            <!-- Content -->
            <slot />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    initialTab: {
        type: String,
        default: 'courses',
    },
});

const activeTab = ref(props.initialTab);

const tabs = [
    { id: 'courses', label: 'Мои курсы', icon: '📚' },
    { id: 'homeworks', label: 'Домашние задания', icon: '📝' },
    { id: 'chat', label: 'Чат с куратором', icon: '💬' },
    { id: 'materials', label: 'Материалы', icon: '📖' },
    { id: 'certificates', label: 'Сертификаты', icon: '🏆' },
];

const switchTab = (tabId) => {
    activeTab.value = tabId;
    const routes = {
        courses: '/student/courses',
        homeworks: '/student/homeworks',
        chat: '/student/chat',
        materials: '/student/materials',
        certificates: '/student/certificates',
    };
    router.visit(routes[tabId] || '/student/dashboard', {
        preserveState: true,
        preserveScroll: true,
    });
};

const logout = () => {
    router.post('/logout');
};

onMounted(() => {
    // Определяем активную вкладку по URL
    const path = window.location.pathname;
    const sectionMap = {
        '/student/dashboard': 'courses',
        '/student/courses': 'courses',
        '/student/homeworks': 'homeworks',
        '/student/chat': 'chat',
        '/student/materials': 'materials',
        '/student/certificates': 'certificates',
    };
    
    const section = sectionMap[path] || 'courses';
    if (tabs.some(t => t.id === section)) {
        activeTab.value = section;
    }
});
</script>

