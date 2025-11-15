<template>
    <section
        id="why-us"
        ref="sectionRef"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <h2 
                class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900"
                :class="{ 'animate-fade-in-up': isVisible }"
            >
                Почему родители выбирают именно «АйТиПлюс»
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <div
                    v-for="(feature, index) in features"
                    :key="feature.icon"
                    :ref="el => { if (el) cardRefs[index] = el }"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 text-center cursor-pointer group"
                    :class="{ 'animate-slide-in': visibleCards[index] }"
                    @mouseenter="onCardHover(index)"
                >
                    <div 
                        class="text-5xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300"
                    >
                        {{ feature.icon }}
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900 group-hover:text-primary-600 transition-colors">
                        {{ feature.title }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">{{ feature.text }}</p>
                </div>
            </div>

            <!-- CTA Block -->
            <div class="text-center bg-gradient-to-r from-primary-500 to-secondary-500 rounded-2xl p-8 md:p-12 text-white">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">
                    Готовы начать обучение?
                </h3>
                <p class="text-xl mb-8 opacity-95">
                    Запишитесь на мастер класс и убедитесь сами!
                </p>
                <button
                    class="px-8 py-4 bg-white text-primary-600 rounded-lg font-bold text-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
                    @click="scrollToForm"
                >
                    Записаться на мастер класс
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const sectionRef = ref(null);
const cardRefs = ref([]);
const isVisible = ref(false);
const visibleCards = ref([false, false, false, false, false, false]);

const features = [
    {
        icon: '👩‍🏫',
        title: 'Опытные преподаватели',
        text: 'Умеющие объяснять детям сложные вещи простым языком',
    },
    {
        icon: '🧩',
        title: '2 занятия в неделю',
        text: 'Оптимальный ритм без перегрузки — учимся с удовольствием',
    },
    {
        icon: '🎮',
        title: 'Учим через игры',
        text: 'И реальные проекты — создаём то, что интересно детям',
    },
    {
        icon: '🤝',
        title: 'Малые группы',
        text: 'Внимание к каждому ученику и индивидуальный подход',
    },
    {
        icon: '🏆',
        title: 'Сертификат и портфолио',
        text: 'По итогам обучения — документы и проекты для будущего',
    },
    {
        icon: '💡',
        title: 'Современные технологии',
        text: 'Изучаем актуальные языки программирования и инструменты, используемые в реальных проектах',
    },
];

const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

const onCardHover = (index) => {
    // Дополнительная логика при наведении
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
                    }, index * 100);
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

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
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

