<template>
    <section
        id="form-section"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">
                    Запишитесь на мастер класс
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
                ref="formRef"
                class="max-w-2xl mx-auto bg-white p-8 md:p-12 rounded-2xl shadow-lg transform transition-all duration-300 hover:shadow-2xl"
                :class="{ 'animate-fade-in-up': isVisible }"
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
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-all duration-300 focus:ring-4 focus:ring-primary-200 focus:scale-[1.02]"
                        placeholder="Введите ваше имя"
                        @focus="onInputFocus"
                        @blur="onInputBlur"
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
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-all duration-300 focus:ring-4 focus:ring-primary-200 focus:scale-[1.02]"
                        placeholder="8-17"
                        @focus="onInputFocus"
                        @blur="onInputBlur"
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
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-all duration-300 focus:ring-4 focus:ring-primary-200 focus:scale-[1.02]"
                        placeholder="+7 (999) 123-45-67 или email@example.com"
                        @focus="onInputFocus"
                        @blur="onInputBlur"
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
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none transition-all duration-300 focus:ring-4 focus:ring-primary-200 focus:scale-[1.02] cursor-pointer"
                        @focus="onInputFocus"
                        @blur="onInputBlur"
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
                    :disabled="isSubmitting"
                    class="w-full px-8 py-4 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-bold text-lg hover:from-primary-600 hover:to-secondary-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span v-if="!isSubmitting" class="flex items-center justify-center gap-2">
                        <span>Записаться</span>
                        <span class="animate-bounce">✉️</span>
                    </span>
                    <span v-else class="flex items-center justify-center gap-2">
                        <span class="animate-spin">⏳</span>
                        <span>Отправка...</span>
                    </span>
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
import { ref, reactive, onMounted } from 'vue';

const formRef = ref(null);
const isVisible = ref(false);
const isSubmitting = ref(false);
const showNotification = ref(false);

const form = reactive({
    parentName: '',
    childAge: null,
    contact: '',
    course: '',
});

const onInputFocus = (event) => {
    event.target.parentElement.classList.add('input-focused');
};

const onInputBlur = (event) => {
    event.target.parentElement.classList.remove('input-focused');
};

const handleSubmit = async () => {
    isSubmitting.value = true;
    
    // Имитация отправки данных
    await new Promise(resolve => setTimeout(resolve, 1500));
    
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
    
    isSubmitting.value = false;
};

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
    
    // Intersection Observer для анимации формы
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    isVisible.value = true;
                }
            });
        },
        { threshold: 0.1 }
    );
    
    if (formRef.value) {
        observer.observe(formRef.value);
    }
});
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

.input-focused {
    transform: scale(1.01);
    transition: transform 0.2s ease-out;
}
</style>

