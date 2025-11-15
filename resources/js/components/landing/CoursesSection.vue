<template>
    <section
        id="courses"
        ref="sectionRef"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <h2 
                class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900"
                :class="{ 'animate-fade-in-up': isVisible }"
            >
                Программы обучения в «АйТиПлюс»
            </h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    v-for="(course, index) in courses"
                    :key="course.name"
                    :ref="el => { if (el) cardRefs[index] = el }"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 border-t-4 cursor-pointer group"
                    :class="[
                        `border-${course.color}-500`,
                        { 'animate-slide-in': visibleCards[index] }
                    ]"
                    @mouseenter="onCardHover(index)"
                >
                    <div
                        class="inline-block bg-primary-500 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4 transform group-hover:scale-110 transition-transform"
                    >
                        {{ course.age }}
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-gray-900 group-hover:text-primary-600 transition-colors">
                        {{ course.name }}
                    </h3>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span
                            v-for="(tech, techIndex) in course.tech"
                            :key="tech"
                            class="bg-gray-100 text-primary-600 px-3 py-1 rounded-lg text-sm font-medium transform group-hover:scale-105 transition-transform"
                            :style="{ transitionDelay: techIndex * 50 + 'ms' }"
                        >
                            {{ tech }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ course.description }}</p>
                    <div class="space-y-3">
                        <button
                            class="w-full px-6 py-3 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95"
                            @click="scrollToForm"
                        >
                            <span class="flex items-center justify-center gap-2">
                                <span>Записаться на занятие</span>
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </span>
                        </button>
                        <button
                            class="w-full px-6 py-3 border-2 border-primary-500 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-all transform hover:scale-105 active:scale-95"
                        >
                            Подробнее о занятии
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const sectionRef = ref(null);
const cardRefs = ref([]);
const isVisible = ref(false);
const visibleCards = ref([false, false, false]);

const courses = [
    {
        age: '8–10 лет',
        name: 'Junior Code',
        tech: ['Scratch', 'Minecraft Education'],
        description: 'Первые шаги в программировании через визуальные блоки и игровую среду',
        color: 'primary',
    },
    {
        age: '11–13 лет',
        name: 'Python Start',
        tech: ['Python', 'Игры', 'Сайты'],
        description: 'Создание игр, изучение логики программирования и первые веб-проекты',
        color: 'secondary',
    },
    {
        age: '14–17 лет',
        name: 'Web & AI',
        tech: ['HTML/CSS/JS', 'Чат-боты', 'Нейросети'],
        description: 'Современная веб-разработка и знакомство с искусственным интеллектом',
        color: 'accent',
    },
];

const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

const onCardHover = (index) => {
    // Можно добавить дополнительную логику при наведении
};

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
    
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        visibleCards.value[index] = true;
                    }, index * 200);
                }
            });
        },
        { threshold: 0.1 }
    );
    
    cardRefs.value.forEach((card) => {
        if (card) {
            observer.observe(card);
        }
    });
    
    onUnmounted(() => {
        observer.disconnect();
    });
});
</script>

<style scoped>
.animate-slide-in {
    animation: slideIn 0.6s ease-out both;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

