<template>
    <section
        id="why-programming"
        class="py-20 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 text-white"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-12">
                Почему программирование — лучший навык XXI века
            </h2>

            <div class="max-w-4xl mx-auto text-center">
                <p class="text-xl md:text-2xl mb-12 leading-relaxed opacity-95">
                    Дети учатся мыслить логически, искать решения и работать в команде. Даже если не станут
                    программистами, эти навыки помогут им в любой профессии.
                </p>

                <div class="grid md:grid-cols-4 gap-8 mt-12 mb-12">
                    <div
                        v-for="benefit in benefits"
                        :key="benefit.icon"
                        class="flex flex-col items-center gap-3"
                    >
                        <div class="text-5xl">{{ benefit.icon }}</div>
                        <div class="text-lg font-semibold">{{ benefit.text }}</div>
                    </div>
                </div>

                <!-- CTA Block -->
                <div class="mt-12 pt-8 border-t border-white/20">
                    <p class="text-2xl md:text-3xl font-bold mb-6">
                        Дайте вашему ребёнку навык будущего уже сегодня!
                    </p>
                    <button
                        class="px-10 py-5 bg-white text-primary-600 rounded-lg font-bold text-xl hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
                        @click="scrollToForm"
                    >
                        Записаться на бесплатный урок →
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
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
</script>

