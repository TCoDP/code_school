<template>
    <div
        v-if="showFloatingCTA"
        class="fixed bottom-6 right-6 z-50 animate-bounce-in"
    >
        <button
            class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-full font-bold text-lg shadow-2xl hover:shadow-primary-500/50 transition-all transform hover:scale-105"
            @click="scrollToForm"
        >
            <span class="text-2xl">📝</span>
            <span class="hidden sm:inline">Записаться на урок</span>
            <span class="sm:hidden">Записаться</span>
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const showFloatingCTA = ref(false);

const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

onMounted(() => {
    // Показываем плавающую кнопку после прокрутки вниз
    const handleScroll = () => {
        if (window.scrollY > 500) {
            showFloatingCTA.value = true;
        } else {
            showFloatingCTA.value = false;
        }
    };

    window.addEventListener('scroll', handleScroll);
    
    // Проверяем начальную позицию
    handleScroll();
});
</script>

<style scoped>
@keyframes bounce-in {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.animate-bounce-in {
    animation: bounce-in 0.5s ease-out;
}
</style>

