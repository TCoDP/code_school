<template>
    <section
        id="how-it-works"
        class="py-20"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900">
                Учёба, которую дети ждут с нетерпением
            </h2>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <div
                        v-for="info in infoItems"
                        :key="info.icon"
                        class="flex gap-6 items-start"
                    >
                        <div class="text-4xl flex-shrink-0">{{ info.icon }}</div>
                        <div class="text-lg">
                            <strong class="text-gray-900">{{ info.title }}</strong>
                            <span class="text-gray-600"> {{ info.subtitle }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div
                        v-for="(schedule, index) in schedules"
                        :key="index"
                        class="bg-gradient-to-br from-primary-500 to-secondary-500 text-white p-6 rounded-2xl shadow-lg"
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
                    Приходите на бесплатный пробный урок — никаких обязательств!
                </p>
                <button
                    class="px-8 py-4 bg-primary-500 text-white rounded-lg font-bold text-lg hover:bg-primary-600 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
                    @click="scrollToForm"
                >
                    Записаться на пробный урок
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
const infoItems = [
    {
        icon: '📅',
        title: '3 урока в неделю',
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
</script>

