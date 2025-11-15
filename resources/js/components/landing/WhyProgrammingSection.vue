<template>
    <section
        id="why-programming"
        ref="sectionRef"
        class="py-20 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 text-white relative overflow-hidden"
    >
        <!-- Animated background elements -->
        <div class="absolute inset-0 opacity-20">
            <div
                v-for="i in 15"
                :key="i"
                class="absolute w-3 h-3 bg-white rounded-full animate-float"
                :style="{
                    left: Math.random() * 100 + '%',
                    top: Math.random() * 100 + '%',
                    animationDelay: Math.random() * 3 + 's',
                    animationDuration: (4 + Math.random() * 3) + 's',
                }"
            ></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <h2 
                class="text-4xl md:text-5xl font-bold text-center mb-12"
                :class="{ 'animate-fade-in-up': isVisible }"
            >
                Почему программирование — лучший навык XXI века
            </h2>

            <div class="max-w-4xl mx-auto text-center">
                <p 
                    class="text-xl md:text-2xl mb-12 leading-relaxed opacity-95"
                    :class="{ 'animate-fade-in-up': isVisible }"
                >
                    Дети учатся мыслить логически, искать решения и работать в команде. Даже если не станут
                    программистами, эти навыки помогут им в любой профессии.
                </p>

                <div class="grid md:grid-cols-4 gap-8 mt-12 mb-12">
                    <div
                        v-for="(benefit, index) in benefits"
                        :key="benefit.icon"
                        :ref="el => { if (el) benefitRefs[index] = el }"
                        class="flex flex-col items-center gap-3 transform transition-all duration-300 hover:scale-110 cursor-pointer group"
                        :class="{ 'animate-bounce-in': visibleBenefits[index] }"
                    >
                        <div class="text-5xl transform group-hover:rotate-12 transition-transform">
                            {{ benefit.icon }}
                        </div>
                        <div class="text-lg font-semibold group-hover:text-yellow-300 transition-colors">
                            {{ benefit.text }}
                        </div>
                    </div>
                </div>

                <!-- CTA Block -->
                <div 
                    class="mt-12 pt-8 border-t border-white/20"
                    :class="{ 'animate-fade-in-up': isVisible }"
                >
                    <p class="text-2xl md:text-3xl font-bold mb-6">
                        Дайте вашему ребёнку навык будущего уже сегодня!
                    </p>
                    <button
                        class="px-10 py-5 bg-white text-primary-600 rounded-lg font-bold text-xl hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 active:scale-95"
                        @click="scrollToForm"
                    >
                        <span class="flex items-center gap-2">
                            <span>Записаться на мастер класс</span>
                            <span class="animate-bounce">→</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const sectionRef = ref(null);
const benefitRefs = ref([]);
const isVisible = ref(false);
const visibleBenefits = ref([false, false, false, false]);

const benefits = [
    { icon: '🧠', text: 'Логическое мышление' },
    { icon: '🔍', text: 'Решение задач' },
    { icon: '👥', text: 'Работа в команде' },
    { icon: '💡', text: 'Творческое мышление' },
];

const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

let observer = null;

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
    
    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        visibleBenefits.value[index] = true;
                    }, index * 200);
                }
            });
        },
        { threshold: 0.1 }
    );
    
    benefitRefs.value.forEach((benefit) => {
        if (benefit) {
            observer.observe(benefit);
        }
    });
    
    if (sectionRef.value) {
        observer.observe(sectionRef.value);
    }
});

onUnmounted(() => {
    if (observer) {
        observer.disconnect();
    }
});
</script>

<style scoped>
@keyframes float {
    0%, 100% {
        transform: translateY(0) translateX(0);
        opacity: 0.2;
    }
    50% {
        transform: translateY(-20px) translateX(10px);
        opacity: 0.5;
    }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

.animate-bounce-in {
    animation: bounceIn 0.6s ease-out both;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes fadeInUp {
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

