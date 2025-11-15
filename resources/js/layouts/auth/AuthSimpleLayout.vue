<script setup lang="ts">
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute inset-0"
                :style="{ backgroundImage: `url('data:image/svg+xml,%3Csvg width=\\'100\\' height=\\'100\\' xmlns=\\'http://www.w3.org/2000/svg\\'%3E%3Crect width=\\'100\\' height=\\'100\\' fill=\\'none\\'/%3E%3Cpath d=\\'M0 50 L100 50 M50 0 L50 100\\' stroke=\\'rgba(99,102,241,0.1)\\' stroke-width=\\'1\\'/%3E%3C/svg%3E')` }"
            ></div>
        </div>

        <div class="w-full max-w-md relative z-10">
            <!-- Logo and Title -->
            <div class="text-center mb-8">
                <Link
                    :href="home()"
                    class="flex items-center justify-center gap-2 mb-4 hover:opacity-80 transition-opacity"
                >
                    <span class="text-4xl">🧠</span>
                        <span class="font-mono text-3xl font-bold text-primary-600">АйТиПлюс</span>
                </Link>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ title }}</h1>
                <p class="text-gray-600">{{ description }}</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-10">
                <slot />
            </div>

            <!-- Back to Home Link -->
            <div class="text-center mt-6">
                <Link
                    :href="home()"
                    class="text-primary-600 hover:text-primary-700 font-medium transition-colors inline-flex items-center gap-2"
                >
                    <span>←</span>
                    <span>Вернуться на главную</span>
                </Link>
            </div>
        </div>
    </div>
</template>
