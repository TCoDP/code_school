<script setup lang="ts">
import { dashboard, login, register, home } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { ref, onMounted } from 'vue';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const scrollToSection = (id: string) => {
    const element = document.getElementById(id);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

const breadcrumbs = [
    { title: 'Главная', href: '/' },
    { title: 'Обучение программированию' },
];

onMounted(() => {
    // Плавная прокрутка к якорям при загрузке страницы с хешем
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        setTimeout(() => scrollToSection(hash), 100);
    }
});
</script>

<template>
    <Head title="Школа программирования - Начни свой путь в IT">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-white dark:from-slate-900 dark:to-slate-800">
        <!-- Навигация -->
        <header class="sticky top-0 z-50 w-full border-b bg-white/80 backdrop-blur-sm dark:bg-slate-900/80">
            <nav class="container mx-auto flex h-16 items-center justify-between px-4 lg:px-8">
                <div class="flex items-center gap-8">
                    <Link :href="home()" class="text-xl font-bold text-slate-900 dark:text-white">
                        CodeSchool
                    </Link>
                    <div class="hidden gap-6 md:flex">
                        <button
                            @click="scrollToSection('about')"
                            class="text-sm font-medium text-slate-600 transition-colors hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
                        >
                            О нас
                        </button>
                        <button
                            @click="scrollToSection('courses')"
                            class="text-sm font-medium text-slate-600 transition-colors hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
                        >
                            Курсы
                        </button>
                        <button
                            @click="scrollToSection('reviews')"
                            class="text-sm font-medium text-slate-600 transition-colors hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
                        >
                            Отзывы
                        </button>
                        <button
                            @click="scrollToSection('contact')"
                            class="text-sm font-medium text-slate-600 transition-colors hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
                        >
                            Контакты
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
                    >
                        Личный кабинет
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
                        >
                            Войти
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="register()"
                        >
                            <Button variant="default" size="sm">
                                Регистрация
                            </Button>
                        </Link>
                    </template>
                </div>
            </nav>
        </header>

        <!-- Хлебные крошки -->
        <div class="container mx-auto px-4 py-4 lg:px-8">
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </div>

        <!-- Hero секция -->
        <section id="hero" class="container mx-auto px-4 py-20 lg:px-8 lg:py-32">
            <div class="mx-auto max-w-4xl text-center">
                <h1 class="mb-6 text-4xl font-bold tracking-tight text-slate-900 dark:text-white lg:text-6xl">
                    Стань разработчиком
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        за 6 месяцев
                    </span>
                </h1>
                <p class="mb-8 text-lg text-slate-600 dark:text-slate-300 lg:text-xl">
                    Практические курсы программирования с нуля до профессионала.
                    Обучаем современным технологиям и помогаем найти работу мечты.
                </p>
                <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
                    <Link :href="canRegister ? register() : login()">
                        <Button size="lg" class="w-full sm:w-auto">
                            Начать обучение
                        </Button>
                    </Link>
                    <Button
                        variant="outline"
                        size="lg"
                        class="w-full sm:w-auto"
                        @click="scrollToSection('courses')"
                    >
                        Посмотреть курсы
                    </Button>
                </div>
                <div class="mt-12 grid grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold text-slate-900 dark:text-white">1000+</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Студентов</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-slate-900 dark:text-white">85%</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Трудоустройство</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-slate-900 dark:text-white">4.9</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Рейтинг</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- О нас -->
        <section id="about" class="bg-slate-100 py-20 dark:bg-slate-800/50">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="mx-auto max-w-4xl">
                    <h2 class="mb-4 text-3xl font-bold text-slate-900 dark:text-white lg:text-4xl">
                        Почему выбирают нас?
                    </h2>
                    <p class="mb-12 text-lg text-slate-600 dark:text-slate-300">
                        Мы не просто обучаем программированию — мы готовим специалистов,
                        которые востребованы на рынке труда.
                    </p>
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 text-4xl">💼</div>
                            <h3 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">
                                Практика с первого дня
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300">
                                Реальные проекты и задачи из индустрии. Никакой теории без практики.
                            </p>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 text-4xl">👨‍🏫</div>
                            <h3 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">
                                Опытные менторы
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300">
                                Преподаватели с опытом работы в крупных IT-компаниях.
                            </p>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 text-4xl">🚀</div>
                            <h3 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">
                                Помощь в трудоустройстве
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300">
                                Подготовка резюме, собеседования и помощь в поиске работы.
                            </p>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 text-4xl">📚</div>
                            <h3 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">
                                Актуальные технологии
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300">
                                Изучаем только то, что используется в реальных проектах.
                            </p>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 text-4xl">⏰</div>
                            <h3 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">
                                Гибкий график
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300">
                                Учитесь в удобное время. Онлайн и офлайн форматы.
                            </p>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 text-4xl">🤝</div>
                            <h3 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">
                                Сообщество
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300">
                                Общение с единомышленниками и поддержка на всех этапах.
                            </p>
                        </div>
                    </div>
                    <div class="mt-12 text-center">
                        <Link :href="canRegister ? register() : login()">
                            <Button size="lg">
                                Присоединиться к нам
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Курсы -->
        <section id="courses" class="py-20">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="mx-auto max-w-4xl">
                    <h2 class="mb-4 text-3xl font-bold text-slate-900 dark:text-white lg:text-4xl">
                        Наши курсы
                    </h2>
                    <p class="mb-12 text-lg text-slate-600 dark:text-slate-300">
                        Выберите направление, которое вам интересно, и начните свой путь в IT.
                    </p>
                    <div class="grid gap-8 md:grid-cols-2">
                        <div class="group rounded-xl border-2 border-slate-200 bg-white p-8 transition-all hover:border-blue-500 hover:shadow-lg dark:border-slate-700 dark:bg-slate-900">
                            <div class="mb-4 text-5xl">💻</div>
                            <h3 class="mb-3 text-2xl font-semibold text-slate-900 dark:text-white">
                                Full-Stack разработка
                            </h3>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                Изучите фронтенд и бэкенд разработку. Создавайте полноценные веб-приложения.
                            </p>
                            <ul class="mb-6 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                                <li>✓ JavaScript, TypeScript</li>
                                <li>✓ React, Vue.js</li>
                                <li>✓ Node.js, Laravel</li>
                                <li>✓ Базы данных</li>
                            </ul>
                            <div class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">
                                6 месяцев
                            </div>
                            <Link :href="canRegister ? register() : login()">
                                <Button class="w-full" variant="default">
                                    Записаться на курс
                                </Button>
                            </Link>
                        </div>
                        <div class="group rounded-xl border-2 border-slate-200 bg-white p-8 transition-all hover:border-blue-500 hover:shadow-lg dark:border-slate-700 dark:bg-slate-900">
                            <div class="mb-4 text-5xl">📱</div>
                            <h3 class="mb-3 text-2xl font-semibold text-slate-900 dark:text-white">
                                Мобильная разработка
                            </h3>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                Создавайте приложения для iOS и Android. От идеи до публикации в App Store.
                            </p>
                            <ul class="mb-6 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                                <li>✓ React Native</li>
                                <li>✓ Swift, Kotlin</li>
                                <li>✓ Flutter</li>
                                <li>✓ UI/UX для мобильных</li>
                            </ul>
                            <div class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">
                                5 месяцев
                            </div>
                            <Link :href="canRegister ? register() : login()">
                                <Button class="w-full" variant="default">
                                    Записаться на курс
                                </Button>
                            </Link>
                        </div>
                        <div class="group rounded-xl border-2 border-slate-200 bg-white p-8 transition-all hover:border-blue-500 hover:shadow-lg dark:border-slate-700 dark:bg-slate-900">
                            <div class="mb-4 text-5xl">🤖</div>
                            <h3 class="mb-3 text-2xl font-semibold text-slate-900 dark:text-white">
                                Python & Data Science
                            </h3>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                Изучите Python и машинное обучение. Работайте с данными и создавайте AI-решения.
                            </p>
                            <ul class="mb-6 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                                <li>✓ Python основы</li>
                                <li>✓ Data Science</li>
                                <li>✓ Machine Learning</li>
                                <li>✓ Анализ данных</li>
                            </ul>
                            <div class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">
                                7 месяцев
                            </div>
                            <Link :href="canRegister ? register() : login()">
                                <Button class="w-full" variant="default">
                                    Записаться на курс
                                </Button>
                            </Link>
                        </div>
                        <div class="group rounded-xl border-2 border-slate-200 bg-white p-8 transition-all hover:border-blue-500 hover:shadow-lg dark:border-slate-700 dark:bg-slate-900">
                            <div class="mb-4 text-5xl">🎨</div>
                            <h3 class="mb-3 text-2xl font-semibold text-slate-900 dark:text-white">
                                Frontend разработка
                            </h3>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                Создавайте красивые и функциональные интерфейсы. Станьте экспертом в веб-дизайне.
                            </p>
                            <ul class="mb-6 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                                <li>✓ HTML, CSS, JavaScript</li>
                                <li>✓ React, Vue.js</li>
                                <li>✓ TypeScript</li>
                                <li>✓ Современные инструменты</li>
                            </ul>
                            <div class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">
                                4 месяца
                            </div>
                            <Link :href="canRegister ? register() : login()">
                                <Button class="w-full" variant="default">
                                    Записаться на курс
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Отзывы -->
        <section id="reviews" class="bg-slate-100 py-20 dark:bg-slate-800/50">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="mx-auto max-w-4xl">
                    <h2 class="mb-4 text-3xl font-bold text-slate-900 dark:text-white lg:text-4xl">
                        Отзывы наших студентов
                    </h2>
                    <p class="mb-12 text-lg text-slate-600 dark:text-slate-300">
                        Узнайте, что говорят о нас те, кто уже прошёл обучение.
                    </p>
                    <div class="grid gap-8 md:grid-cols-2">
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 flex items-center gap-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                "Отличный курс! Преподаватели объясняют всё очень доступно.
                                Уже через 3 месяца нашёл работу Junior разработчиком.
                                Рекомендую всем, кто хочет сменить профессию."
                            </p>
                            <div class="font-semibold text-slate-900 dark:text-white">
                                Алексей М.
                            </div>
                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                Full-Stack разработчик
                            </div>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 flex items-center gap-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                "Лучшая инвестиция в себя! Программа очень структурированная,
                                много практики. Менторы всегда готовы помочь.
                                Теперь работаю в крупной IT-компании."
                            </p>
                            <div class="font-semibold text-slate-900 dark:text-white">
                                Мария К.
                            </div>
                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                Frontend разработчик
                            </div>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 flex items-center gap-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                "Начал с нуля, без опыта в программировании.
                                Благодаря курсу освоил Python и Data Science.
                                Сейчас работаю аналитиком данных. Спасибо!"
                            </p>
                            <div class="font-semibold text-slate-900 dark:text-white">
                                Дмитрий С.
                            </div>
                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                Data Scientist
                            </div>
                        </div>
                        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-slate-900">
                            <div class="mb-4 flex items-center gap-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="mb-4 text-slate-600 dark:text-slate-300">
                                "Отличная поддержка на всех этапах обучения.
                                Помогли с резюме и подготовили к собеседованиям.
                                Уже работаю в команде разработки мобильных приложений."
                            </p>
                            <div class="font-semibold text-slate-900 dark:text-white">
                                Анна В.
                            </div>
                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                Mobile разработчик
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 text-center">
                        <Link :href="canRegister ? register() : login()">
                            <Button size="lg">
                                Присоединиться к студентам
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Контакты -->
        <section id="contact" class="py-20">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="mx-auto max-w-2xl">
                    <h2 class="mb-4 text-3xl font-bold text-slate-900 dark:text-white lg:text-4xl">
                        Готовы начать?
                    </h2>
                    <p class="mb-8 text-lg text-slate-600 dark:text-slate-300">
                        Запишитесь на бесплатную консультацию или начните обучение прямо сейчас.
                    </p>
                    <div class="rounded-xl border-2 border-slate-200 bg-white p-8 dark:border-slate-700 dark:bg-slate-900">
                        <div class="mb-6 space-y-4">
                            <div>
                                <h3 class="mb-2 font-semibold text-slate-900 dark:text-white">
                                    📧 Email
                                </h3>
                                <a
                                    href="mailto:info@codeschool.ru"
                                    class="text-blue-600 hover:underline dark:text-blue-400"
                                >
                                    info@codeschool.ru
                                </a>
                            </div>
                            <div>
                                <h3 class="mb-2 font-semibold text-slate-900 dark:text-white">
                                    📞 Телефон
                                </h3>
                                <a
                                    href="tel:+79991234567"
                                    class="text-blue-600 hover:underline dark:text-blue-400"
                                >
                                    +7 (999) 123-45-67
                                </a>
                            </div>
                            <div>
                                <h3 class="mb-2 font-semibold text-slate-900 dark:text-white">
                                    💬 Telegram
                                </h3>
                                <a
                                    href="https://t.me/codeschool"
                                    target="_blank"
                                    class="text-blue-600 hover:underline dark:text-blue-400"
                                >
                                    @codeschool
                                </a>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <Link :href="canRegister ? register() : login()">
                                <Button size="lg" class="w-full">
                                    Начать обучение сейчас
                                </Button>
                            </Link>
                            <Button
                                variant="outline"
                                size="lg"
                                class="w-full"
                                @click="scrollToSection('courses')"
                            >
                                Посмотреть все курсы
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Футер -->
        <footer class="border-t bg-slate-50 py-12 dark:bg-slate-900">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="grid gap-8 md:grid-cols-4">
                    <div>
                        <h3 class="mb-4 font-semibold text-slate-900 dark:text-white">
                            CodeSchool
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            Школа программирования для всех, кто хочет изменить свою жизнь.
                        </p>
                    </div>
                    <div>
                        <h4 class="mb-4 font-semibold text-slate-900 dark:text-white">
                            Навигация
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <button
                                    @click="scrollToSection('about')"
                                    class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
                                >
                                    О нас
                                </button>
                            </li>
                            <li>
                                <button
                                    @click="scrollToSection('courses')"
                                    class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
                                >
                                    Курсы
                                </button>
                            </li>
                            <li>
                                <button
                                    @click="scrollToSection('reviews')"
                                    class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
                                >
                                    Отзывы
                                </button>
                            </li>
                            <li>
                                <button
                                    @click="scrollToSection('contact')"
                                    class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
                                >
                                    Контакты
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-4 font-semibold text-slate-900 dark:text-white">
                            Курсы
                        </h4>
                        <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                            <li>Full-Stack</li>
                            <li>Mobile разработка</li>
                            <li>Python & Data Science</li>
                            <li>Frontend</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-4 font-semibold text-slate-900 dark:text-white">
                            Контакты
                        </h4>
                        <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                            <li>info@codeschool.ru</li>
                            <li>+7 (999) 123-45-67</li>
                            <li>@codeschool</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t pt-8 text-center text-sm text-slate-600 dark:text-slate-400">
                    <p>© 2024 CodeSchool. Все права защищены.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
