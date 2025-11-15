<template>
    <section
        id="schedule"
        ref="sectionRef"
        class="py-20"
    >
        <div class="container mx-auto px-4">
            <h2 
                class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900"
                :class="{ 'animate-fade-in-up': isVisible }"
            >
                Гибкий график и удобный формат
            </h2>

            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div
                    v-for="(feature, index) in features"
                    :key="feature.icon"
                    :ref="el => { if (el) cardRefs[index] = el }"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 text-center cursor-pointer group"
                    :class="{ 'animate-slide-in': visibleCards[index] }"
                >
                    <div class="text-5xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300">
                        {{ feature.icon }}
                    </div>
                    <h3 class="text-2xl font-semibold mb-2 text-gray-900 group-hover:text-primary-600 transition-colors">
                        {{ feature.title }}
                    </h3>
                    <p class="text-gray-600">{{ feature.text }}</p>
                </div>
            </div>

            <!-- CTA Block -->
            <div class="text-center bg-primary-50 rounded-2xl p-8 md:p-12 border-2 border-primary-200">
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    Выберите удобное время для пробного урока
                </h3>
                <p class="text-lg text-gray-600 mb-8">
                    Мы подберём оптимальный график для вашего ребёнка
                </p>
                <button
                    class="px-8 py-4 bg-primary-500 text-white rounded-lg font-bold text-lg hover:bg-primary-600 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
                    @click="scrollToForm"
                >
                    Выбрать время →
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
const visibleCards = ref([false, false, false, false]);

const features = [
    {
        icon: '⏰',
        title: '2 занятия в неделю',
        text: 'По 60–90 минут каждое',
    },
    {
        icon: '💻',
        title: 'Онлайн или офлайн',
        text: 'Выбирайте удобный формат',
    },
    {
        icon: '📅',
        title: 'Гибкое расписание',
        text: 'Возможность выбрать время',
    },
    {
        icon: '🔄',
        title: 'Замена пропущенных',
        text: 'Всегда можно наверстать',
    },
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
                        visibleCards.value[index] = true;
                    }, index * 150);
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
});

onUnmounted(() => {
    if (observer) {
        observer.disconnect();
    }
});
</script>

<style scoped>
.animate-slide-in {
    animation: slideIn 0.6s ease-out both;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
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

