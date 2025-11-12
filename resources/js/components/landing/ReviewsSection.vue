<template>
    <section
        id="reviews"
        class="py-20"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900">
                Родители и ученики о нас
            </h2>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div
                    v-for="review in reviews"
                    :key="review.author"
                    class="bg-white p-8 rounded-2xl shadow-md border-l-4 border-primary-500"
                >
                    <div class="text-2xl mb-4">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                        "{{ review.text }}"
                    </p>
                    <div class="font-semibold text-gray-900">
                        <strong>{{ review.author }}</strong>{{ review.relation }}
                    </div>
                </div>
            </div>

            <!-- CTA Block -->
            <div class="text-center">
                <p class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    Присоединяйтесь к нашим ученикам!
                </p>
                <p class="text-lg text-gray-600 mb-8">
                    Более 500 детей уже изучают программирование в «Академии-Кода»
                </p>
                <button
                    class="px-8 py-4 bg-primary-500 text-white rounded-lg font-bold text-lg hover:bg-primary-600 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
                    @click="scrollToForm"
                >
                    Начать обучение бесплатно
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
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
</script>

