<template>
    <section
        id="teachers"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900">
                Наставники «Школы-Кода»
            </h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    v-for="teacher in teachers"
                    :key="teacher.name"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 text-center"
                >
                    <div class="text-6xl mb-4">{{ teacher.avatar }}</div>
                    <h3 class="text-2xl font-semibold mb-2 text-gray-900">{{ teacher.name }}</h3>
                    <p class="text-gray-600 mb-4 text-sm">{{ teacher.experience }}</p>
                    <p class="text-gray-600 italic border-t pt-4 mt-4 leading-relaxed">
                        «{{ teacher.quote }}»
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const teachers = [
    {
        avatar: '👨‍💻',
        name: 'Алексей Петров',
        experience: 'Опыт работы с детьми: 8 лет',
        quote: 'Главное — не просто писать код, а понимать, как он оживает!',
    },
    {
        avatar: '👩‍💻',
        name: 'Мария Соколова',
        experience: 'Опыт работы с детьми: 6 лет',
        quote: 'Каждый ребёнок может стать создателем, нужно только показать путь!',
    },
    {
        avatar: '👨‍💻',
        name: 'Дмитрий Иванов',
        experience: 'Опыт работы с детьми: 5 лет',
        quote: 'Программирование — это суперсила XXI века, и мы её дарим детям!',
    },
];
</script>

