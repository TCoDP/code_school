<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Header -->
        <header class="bg-white/95 backdrop-blur-md shadow-md border-b border-gray-200 sticky top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-2 md:gap-4">
                        <a href="/" class="flex items-center gap-2">
                            <span class="text-2xl md:text-3xl">🧠</span>
                            <span class="font-mono text-xl md:text-2xl font-bold text-primary-600">АйТиПлюс</span>
                        </a>
                        <span class="text-gray-400 hidden md:inline">|</span>
                        <span class="text-gray-700 font-semibold text-sm md:text-base hidden sm:inline">Админ-панель</span>
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
                    <a
                        v-for="tab in tabs"
                        :key="tab.id"
                        :href="tab.href"
                        :class="[
                            'px-6 py-3 rounded-xl font-semibold transition-all whitespace-nowrap flex items-center gap-2',
                            isActive(tab.href)
                                ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-lg'
                                : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50'
                        ]"
                    >
                        <span class="text-xl">{{ tab.icon }}</span>
                        <span>{{ tab.label }}</span>
                    </a>
                </nav>
            </div>

            <!-- Content -->
            <slot />
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();
const currentPath = computed(() => page.url);

const tabs = [
    { id: 'dashboard', label: 'Панель управления', icon: '📊', href: '/admin/dashboard' },
    { id: 'courses', label: 'Курсы', icon: '📚', href: '/admin/courses' },
    { id: 'users', label: 'Пользователи', icon: '👥', href: '/admin/users' },
    { id: 'assignments', label: 'Задания', icon: '📝', href: '/admin/assignments' },
    { id: 'materials', label: 'Материалы', icon: '📖', href: '/admin/materials' },
];

const isActive = (href) => {
    return currentPath.value.startsWith(href);
};

const logout = () => {
    router.post('/logout');
};
</script>

