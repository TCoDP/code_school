<template>
    <header
        ref="headerRef"
        class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md shadow-sm transition-shadow duration-300"
    >
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center gap-2">
                    <span class="text-3xl">🧠</span>
                    <span class="font-mono text-2xl font-bold text-primary">АйТиПлюс</span>
                </div>

                <nav class="hidden md:flex items-center gap-8" aria-label="Основная навигация">
                    <a
                        v-for="link in navLinks"
                        :key="link.href"
                        :href="link.href"
                        :aria-label="`Перейти к разделу ${link.label}`"
                        class="text-gray-700 font-medium hover:text-primary transition-colors relative group"
                        @click.prevent="scrollTo(link.href)"
                    >
                        {{ link.label }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"
                        ></span>
                    </a>
                </nav>

                <div class="hidden md:flex items-center gap-4">
                    <template v-if="!isAuthenticated">
                        <a
                            href="/login"
                            class="px-6 py-2 text-primary font-semibold hover:text-primary-600 transition-colors"
                        >
                            Войти
                        </a>
                    </template>
                    <template v-else>
                        <a
                            v-if="isAdmin"
                            href="/admin/dashboard"
                            class="px-6 py-2 text-primary font-semibold hover:text-primary-600 transition-colors"
                        >
                            Админ-панель
                        </a>
                        <a
                            href="/student/dashboard"
                            class="px-6 py-2 text-primary font-semibold hover:text-primary-600 transition-colors"
                        >
                            Личный кабинет
                        </a>
                    </template>
                    <button
                        class="px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-600 transition-colors shadow-md hover:shadow-lg"
                        @click="scrollToForm"
                    >
                        Записаться на мастер класс
                    </button>
                </div>

                <button
                    class="md:hidden flex flex-col gap-1.5 p-2"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                >
                    <span
                        class="block w-6 h-0.5 bg-gray-700 transition-all"
                        :class="mobileMenuOpen ? 'rotate-45 translate-y-2' : ''"
                    ></span>
                    <span
                        class="block w-6 h-0.5 bg-gray-700 transition-all"
                        :class="mobileMenuOpen ? 'opacity-0' : ''"
                    ></span>
                    <span
                        class="block w-6 h-0.5 bg-gray-700 transition-all"
                        :class="mobileMenuOpen ? '-rotate-45 -translate-y-2' : ''"
                    ></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div
                v-if="mobileMenuOpen"
                class="md:hidden pb-4 space-y-4"
            >
                <a
                    v-for="link in navLinks"
                    :key="link.href"
                    :href="link.href"
                    class="block text-gray-700 font-medium hover:text-primary transition-colors"
                    @click.prevent="scrollTo(link.href); mobileMenuOpen = false"
                >
                    {{ link.label }}
                </a>
                <template v-if="!isAuthenticated">
                    <a
                        href="/login"
                        class="block w-full px-6 py-2 text-center text-primary font-semibold hover:text-primary-600 transition-colors border-2 border-primary rounded-lg"
                        @click="mobileMenuOpen = false"
                    >
                        Войти
                    </a>
                </template>
                    <template v-else>
                        <a
                            v-if="isAdmin"
                            href="/admin/dashboard"
                            class="block w-full px-6 py-2 text-center text-primary font-semibold hover:text-primary-600 transition-colors border-2 border-primary rounded-lg"
                            @click="mobileMenuOpen = false"
                        >
                            Админ-панель
                        </a>
                        <a
                            href="/student/dashboard"
                            class="block w-full px-6 py-2 text-center text-primary font-semibold hover:text-primary-600 transition-colors border-2 border-primary rounded-lg"
                            @click="mobileMenuOpen = false"
                        >
                            Личный кабинет
                        </a>
                    </template>
                <button
                    class="w-full px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-600 transition-colors"
                    @click="scrollToForm(); mobileMenuOpen = false"
                >
                    Записаться на мастер класс
                </button>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const headerRef = ref(null);
const mobileMenuOpen = ref(false);

const isAuthenticated = computed(() => !!page.props.auth?.user);
const isAdmin = computed(() => page.props.auth?.user?.role === 'admin');

const navLinks = [
    { href: '#how-it-works', label: 'Почему мы?' },
    { href: '#courses', label: 'Курсы' },
    { href: '#teachers', label: 'Преподаватели' },
    { href: '#reviews', label: 'Отзывы' },
    { href: '#contacts', label: 'Контакты' },
];

const scrollTo = (selector) => {
    const element = document.querySelector(selector);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

const scrollToForm = () => {
    scrollTo('#form-section');
};

const handleScroll = () => {
    if (headerRef.value) {
        if (window.scrollY > 100) {
            headerRef.value.classList.add('shadow-md', 'bg-white/98');
            headerRef.value.classList.remove('bg-white/95');
        } else {
            headerRef.value.classList.remove('shadow-md', 'bg-white/98');
            headerRef.value.classList.add('bg-white/95');
        }
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

