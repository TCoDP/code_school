<template>
    <section
        id="form-section"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">
                    Запишитесь на бесплатный пробный урок
                </h2>
                <p class="text-xl text-gray-600 mb-6">
                    Узнайте, подходит ли программирование вашему ребёнку — это бесплатно и без обязательств!
                </p>
                <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Бесплатно</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Без обязательств</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Запись за 2 минуты</span>
                    </div>
                </div>
            </div>

            <form
                class="max-w-2xl mx-auto bg-white p-8 md:p-12 rounded-2xl shadow-lg"
                @submit.prevent="handleSubmit"
            >
                <div class="mb-6">
                    <label
                        for="parentName"
                        class="block mb-2 font-semibold text-gray-900"
                    >
                        Имя родителя
                    </label>
                    <input
                        id="parentName"
                        v-model="form.parentName"
                        type="text"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-colors"
                        placeholder="Введите ваше имя"
                    />
                </div>

                <div class="mb-6">
                    <label
                        for="childAge"
                        class="block mb-2 font-semibold text-gray-900"
                    >
                        Возраст ребёнка
                    </label>
                    <input
                        id="childAge"
                        v-model.number="form.childAge"
                        type="number"
                        min="8"
                        max="17"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-colors"
                        placeholder="8-17"
                    />
                </div>

                <div class="mb-6">
                    <label
                        for="contact"
                        class="block mb-2 font-semibold text-gray-900"
                    >
                        Телефон / Email
                    </label>
                    <input
                        id="contact"
                        v-model="form.contact"
                        type="text"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-colors"
                        placeholder="+7 (999) 123-45-67 или email@example.com"
                    />
                </div>

                <div class="mb-8">
                    <label
                        for="course"
                        class="block mb-2 font-semibold text-gray-900"
                    >
                        Выбор курса
                    </label>
                    <select
                        id="course"
                        v-model="form.course"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-colors"
                    >
                        <option
                            value=""
                            disabled
                        >
                            Выберите курс
                        </option>
                        <option value="junior">Junior Code (8–10 лет)</option>
                        <option value="python">Python Start (11–13 лет)</option>
                        <option value="web">Web & AI (14–17 лет)</option>
                    </select>
                </div>

                <button
                    type="submit"
                    class="w-full px-8 py-4 bg-primary-500 text-white rounded-lg font-bold text-lg hover:bg-primary-600 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                >
                    Записаться
                </button>
            </form>
        </div>

        <!-- Notification -->
        <div
            v-if="showNotification"
            class="fixed top-24 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-xl z-50 animate-slide-in-right"
        >
            Спасибо! Мы свяжемся с вами в ближайшее время.
        </div>
    </section>
</template>

<script setup>
import { ref, reactive } from 'vue';

const form = reactive({
    parentName: '',
    childAge: null,
    contact: '',
    course: '',
});

const showNotification = ref(false);

const handleSubmit = () => {
    // Здесь можно отправить данные на сервер
    console.log('Form submitted:', form);

    // Показать уведомление
    showNotification.value = true;
    setTimeout(() => {
        showNotification.value = false;
    }, 5000);

    // Сбросить форму
    form.parentName = '';
    form.childAge = null;
    form.contact = '';
    form.course = '';
};
</script>

<style scoped>
@keyframes slide-in-right {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in-right {
    animation: slide-in-right 0.3s ease-out;
}
</style>

