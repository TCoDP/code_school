<template>
    <section
        id="reviews"
        ref="sectionRef"
        class="py-20"
    >
        <div class="container mx-auto px-4">
            <h2 
                class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900"
                :class="{ 'animate-fade-in-up': isVisible }"
            >
                Родители и ученики о нас
            </h2>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div
                    v-for="(review, index) in reviews"
                    :key="review.author"
                    :ref="el => { if (el) cardRefs[index] = el }"
                    class="bg-white p-8 rounded-2xl shadow-md border-l-4 border-primary-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 cursor-pointer group"
                    :class="{ 'animate-slide-in': visibleCards[index] }"
                >
                    <div class="text-2xl mb-4 transform group-hover:scale-110 transition-transform">
                        <span class="inline-block animate-pulse">⭐</span>
                        <span class="inline-block animate-pulse" style="animation-delay: 0.1s">⭐</span>
                        <span class="inline-block animate-pulse" style="animation-delay: 0.2s">⭐</span>
                        <span class="inline-block animate-pulse" style="animation-delay: 0.3s">⭐</span>
                        <span class="inline-block animate-pulse" style="animation-delay: 0.4s">⭐</span>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed text-lg group-hover:text-gray-800 transition-colors">
                        "{{ review.text }}"
                    </p>
                    <div class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors">
                        <strong>{{ review.author }}</strong>{{ review.relation }}
                    </div>
                </div>
            </div>

            <!-- CTA Block -->
            <div class="text-center" :class="{ 'animate-fade-in-up': isVisible }">
                <p class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    Присоединяйтесь к нашим ученикам!
                </p>
                <div class="flex flex-wrap justify-center gap-8 mb-8">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-primary-600 mb-2">
                            <span ref="studentsCountRef">{{ animatedStudents }}</span>+
                        </div>
                        <div class="text-gray-600">Учеников</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-primary-600 mb-2">
                            <span ref="coursesCountRef">{{ animatedCourses }}</span>+
                        </div>
                        <div class="text-gray-600">Курсов</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-primary-600 mb-2">
                            <span ref="projectsCountRef">{{ animatedProjects }}</span>+
                        </div>
                        <div class="text-gray-600">Проектов</div>
                    </div>
                </div>
                <button
                    class="px-8 py-4 bg-primary-500 text-white rounded-lg font-bold text-lg hover:bg-primary-600 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 active:scale-95"
                    @click="scrollToForm"
                >
                    Начать обучение бесплатно
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
const visibleCards = ref([false, false, false]);
const studentsCountRef = ref(null);
const coursesCountRef = ref(null);
const projectsCountRef = ref(null);
const animatedStudents = ref(0);
const animatedCourses = ref(0);
const animatedProjects = ref(0);

const targetStudents = 500;
const targetCourses = 3;
const targetProjects = 1000;

const reviews = [
    {
        text: 'Сын ждёт каждое занятие, как праздник! За полгода он создал уже 3 игры и мечтает стать разработчиком.',
        author: 'Анна',
        relation: ', мама Егора (12 лет)',
    },
    {
        text: 'Теперь я сам сделал свою игру на Python! Преподаватели объясняют так, что всё понятно с первого раза.',
        author: 'Данил',
        relation: ', 13 лет',
    },
    {
        text: 'Дочь начала заниматься в 9 лет, а сейчас в 11 уже делает простые сайты. Очень довольны результатом!',
        author: 'Ольга',
        relation: ', мама Софии (11 лет)',
    },
];

const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

const animateCounter = (type, target, duration = 2000) => {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            if (type === 'students') {
                animatedStudents.value = target;
            } else if (type === 'courses') {
                animatedCourses.value = target;
            } else if (type === 'projects') {
                animatedProjects.value = target;
            }
            clearInterval(timer);
        } else {
            if (type === 'students') {
                animatedStudents.value = Math.floor(current);
            } else if (type === 'courses') {
                animatedCourses.value = Math.floor(current);
            } else if (type === 'projects') {
                animatedProjects.value = Math.floor(current);
            }
        }
    }, 16);
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
                    }, index * 200);
                    
                    // Запускаем анимацию счетчиков когда секция видна
                    if (entry.target === sectionRef.value && animatedStudents.value === 0) {
                        animateCounter('students', targetStudents);
                        animateCounter('courses', targetCourses, 1000);
                        animateCounter('projects', targetProjects);
                    }
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

