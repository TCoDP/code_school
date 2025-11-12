<template>
    <section
        id="schedule"
        class="py-20"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900">
                Гибкий график и удобный формат
            </h2>

            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div
                    v-for="feature in features"
                    :key="feature.icon"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 text-center"
                >
                    <div class="text-5xl mb-4">{{ feature.icon }}</div>
                    <h3 class="text-2xl font-semibold mb-2 text-gray-900">{{ feature.title }}</h3>
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
const features = [
    {
        icon: '⏰',
        title: '3 занятия в неделю',
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
</script>

