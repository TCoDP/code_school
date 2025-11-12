<template>
    <section
        id="courses"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900">
                Программы обучения в «Академии-Кода»
            </h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    v-for="course in courses"
                    :key="course.name"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border-t-4"
                    :class="`border-${course.color}-500`"
                >
                    <div
                        class="inline-block bg-primary-500 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4"
                    >
                        {{ course.age }}
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-gray-900">{{ course.name }}</h3>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span
                            v-for="tech in course.tech"
                            :key="tech"
                            class="bg-gray-100 text-primary-600 px-3 py-1 rounded-lg text-sm font-medium"
                        >
                            {{ tech }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ course.description }}</p>
                    <div class="space-y-3">
                        <button
                            class="w-full px-6 py-3 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-600 transition-colors shadow-md hover:shadow-lg"
                            @click="scrollToForm"
                        >
                            Записаться на курс
                        </button>
                        <button
                            class="w-full px-6 py-3 border-2 border-primary-500 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-colors"
                        >
                            Подробнее о курсе
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
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
</script>

