<template>
    <section
        id="how-it-works"
        ref="sectionRef"
        class="py-20"
    >
        <div class="container mx-auto px-4">
            <h2 
                class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900"
                :class="{ 'animate-fade-in-up': isVisible }"
            >
                Почему мы?
            </h2>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <div
                        v-for="(info, index) in infoItems"
                        :key="info.icon"
                        :ref="el => { if (el) infoRefs[index] = el }"
                        class="flex gap-6 items-start transform transition-all duration-300 hover:translate-x-2 cursor-pointer group"
                        :class="{ 'animate-slide-in-left': visibleInfo[index] }"
                    >
                        <div class="text-4xl flex-shrink-0 transform group-hover:scale-125 group-hover:rotate-12 transition-all">
                            {{ info.icon }}
                        </div>
                        <div class="text-lg">
                            <strong class="text-gray-900 group-hover:text-primary-600 transition-colors">{{ info.title }}</strong>
                            <span class="text-gray-600"> {{ info.subtitle }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div
                        v-for="(schedule, index) in schedules"
                        :key="index"
                        :ref="el => { if (el) scheduleRefs[index] = el }"
                        class="bg-gradient-to-br from-primary-500 to-secondary-500 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 cursor-pointer"
                        :class="{ 'animate-slide-in-right': visibleSchedules[index] }"
                    >
                        <div class="text-2xl font-bold mb-2">{{ schedule.day }}</div>
                        <div class="text-xl font-semibold mb-2 opacity-95">{{ schedule.type }}</div>
                        <div class="opacity-90">{{ schedule.desc }}</div>
                    </div>
                </div>
            </div>

            <!-- CTA Block -->
            <div class="mt-16 text-center">
                <p class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    Хотите увидеть, как проходят наши занятия?
                </p>
                <p class="text-lg text-gray-600 mb-8">
                    Приходите на мастер класс — никаких обязательств!
                </p>
                <button
                    class="px-8 py-4 bg-primary-500 text-white rounded-lg font-bold text-lg hover:bg-primary-600 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
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
const infoRefs = ref([]);
const scheduleRefs = ref([]);
const isVisible = ref(false);
const visibleInfo = ref([false, false, false, false]);
const visibleSchedules = ref([false, false, false]);

const infoItems = [
    {
        icon: '📅',
        title: '2 урока в неделю',
        subtitle: '(по 60–90 мин)',
    },
    {
        icon: '💻',
        title: 'Онлайн или офлайн',
        subtitle: '— выбирайте удобный формат',
    },
    {
        icon: '👥',
        title: 'Командные и индивидуальные',
        subtitle: 'проекты',
    },
    {
        icon: '💬',
        title: 'Поддержка наставников',
        subtitle: 'на каждом этапе',
    },
];

const schedules = [
    {
        day: 'Понедельник',
        type: 'Практика',
        desc: 'Закрепляем материал через код',
    },
    {
        day: 'Среда',
        type: 'Теория + мини-проект',
        desc: 'Новые знания и быстрый результат',
    },
    {
        day: 'Пятница',
        type: 'Игра / проект с командой',
        desc: 'Весёлое завершение недели',
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
                    if (entry.target.classList.contains('info-item') || infoRefs.value.includes(entry.target)) {
                        const infoIndex = infoRefs.value.indexOf(entry.target);
                        if (infoIndex !== -1) {
                            setTimeout(() => {
                                visibleInfo.value[infoIndex] = true;
                            }, infoIndex * 150);
                        }
                    } else if (scheduleRefs.value.includes(entry.target)) {
                        const scheduleIndex = scheduleRefs.value.indexOf(entry.target);
                        if (scheduleIndex !== -1) {
                            setTimeout(() => {
                                visibleSchedules.value[scheduleIndex] = true;
                            }, scheduleIndex * 200);
                        }
                    }
                }
            });
        },
        { threshold: 0.1 }
    );
    
    infoRefs.value.forEach((item) => {
        if (item) {
            item.classList.add('info-item');
            observer.observe(item);
        }
    });
    
    scheduleRefs.value.forEach((item) => {
        if (item) {
            observer.observe(item);
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
.animate-slide-in-left {
    animation: slideInLeft 0.6s ease-out both;
}

.animate-slide-in-right {
    animation: slideInRight 0.6s ease-out both;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
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

