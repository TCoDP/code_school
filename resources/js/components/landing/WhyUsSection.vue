<template>
    <section
        id="why-us"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900">
                Почему родители выбирают именно «Академию-Кода»
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <div
                    v-for="feature in features"
                    :key="feature.icon"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 text-center"
                >
                    <div class="text-5xl mb-4">{{ feature.icon }}</div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">{{ feature.title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ feature.text }}</p>
                </div>
            </div>

            <!-- CTA Block -->
            <div class="text-center bg-gradient-to-r from-primary-500 to-secondary-500 rounded-2xl p-8 md:p-12 text-white">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">
                    Готовы начать обучение?
                </h3>
                <p class="text-xl mb-8 opacity-95">
                    Запишитесь на бесплатный пробный урок и убедитесь сами!
                </p>
                <button
                    class="px-8 py-4 bg-white text-primary-600 rounded-lg font-bold text-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
                    @click="scrollToForm"
                >
                    Записаться на пробный урок
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
const features = [
    {
        icon: '👩‍🏫',
        title: 'Опытные преподаватели',
        text: 'Умеющие объяснять детям сложные вещи простым языком',
    },
    {
        icon: '🧩',
        title: '3 занятия в неделю',
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
];

const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};
</script>

