<template>
    <Head>
        <title>АйТиПлюс — Программирование для всех | Обучение программированию для детей 8-17 лет</title>
        <meta name="description" content="АйТиПлюс — обучение программированию для детей 8-17 лет. Онлайн и офлайн занятия, опытные преподаватели, современные технологии. Запишитесь на мастер класс!" />
        <meta name="keywords" content="программирование для детей, обучение программированию, курсы программирования, Python для детей, веб-разработка для школьников, IT курсы для детей, АйТиПлюс" />
        <meta property="og:title" content="АйТиПлюс — Программирование для всех" />
        <meta property="og:description" content="Обучение программированию для детей 8-17 лет. Онлайн и офлайн занятия, опытные преподаватели, современные технологии." />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="/" />
        <meta name="twitter:card" content="summary_large_image" />
        <link rel="canonical" href="/" />
    </Head>
    
    <component :is="'script'" type="application/ld+json" v-html="structuredData"></component>
    
    <main class="min-h-screen bg-white">
        <!-- Header -->
        <header>
            <LandingHeader />
        </header>

        <!-- Hero Section -->
        <section aria-label="Главная секция">
            <HeroSection />
        </section>

        <!-- Why Us Section -->
        <section aria-label="Почему выбирают нас">
            <WhyUsSection />
        </section>

        <!-- How It Works Section -->
        <section aria-label="Почему мы?">
            <HowItWorksSection />
        </section>

        <!-- Courses Section -->
        <section aria-label="Курсы">
            <CoursesSection />
        </section>

        <!-- Teachers Section -->
        <section aria-label="Преподаватели">
            <TeachersSection />
        </section>

        <!-- Reviews Section -->
        <section aria-label="Отзывы">
            <ReviewsSection />
        </section>

        <!-- Why Programming Section -->
        <section aria-label="Почему программирование">
            <WhyProgrammingSection />
        </section>

        <!-- Schedule Section -->
        <section aria-label="Расписание">
            <ScheduleSection />
        </section>

        <!-- Form Section -->
        <section aria-label="Форма записи">
            <FormSection />
        </section>

        <!-- Contacts Section -->
        <section aria-label="Контакты">
            <ContactsSection />
        </section>

        <!-- Footer -->
        <footer>
            <LandingFooter />
        </footer>

        <!-- Floating CTA Button -->
        <FloatingCTA />
    </main>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import LandingHeader from '@/components/landing/LandingHeader.vue';
import HeroSection from '@/components/landing/HeroSection.vue';
import WhyUsSection from '@/components/landing/WhyUsSection.vue';
import HowItWorksSection from '@/components/landing/HowItWorksSection.vue';
import CoursesSection from '@/components/landing/CoursesSection.vue';
import TeachersSection from '@/components/landing/TeachersSection.vue';
import ReviewsSection from '@/components/landing/ReviewsSection.vue';
import WhyProgrammingSection from '@/components/landing/WhyProgrammingSection.vue';
import ScheduleSection from '@/components/landing/ScheduleSection.vue';
import FormSection from '@/components/landing/FormSection.vue';
import ContactsSection from '@/components/landing/ContactsSection.vue';
import LandingFooter from '@/components/landing/LandingFooter.vue';
import FloatingCTA from '@/components/landing/FloatingCTA.vue';

const structuredData = computed(() => {
    const baseUrl = typeof window !== 'undefined' ? window.location.origin : '';
    
    const data = {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "АйТиПлюс",
        "alternateName": "IT Plus",
        "description": "Обучение программированию для детей 8-17 лет. Онлайн и офлайн занятия, опытные преподаватели, современные технологии.",
        "url": baseUrl || "https://code_school.test",
        "logo": {
            "@type": "ImageObject",
            "url": `${baseUrl || 'https://code_school.test'}/favicon.svg`
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "ул. Тагилстроевская, 6В",
            "addressLocality": "г. Нижний Тагил",
            "addressRegion": "Свердловская область",
            "postalCode": "622000",
            "addressCountry": "RU"
        },
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+7-905-808-8000",
                "contactType": "customer service",
                "email": "the1stcenter@gmail.com",
                "availableLanguage": "Russian"
            }
        ],
        "sameAs": [
            "https://vk.com/the1st"
        ],
        "offers": {
            "@type": "Offer",
            "name": "Курсы программирования для детей",
            "description": "Обучение программированию для детей 8-17 лет. Онлайн и офлайн форматы.",
            "price": "0",
            "priceCurrency": "RUB",
            "availability": "https://schema.org/InStock"
        },
        "areaServed": {
            "@type": "Country",
            "name": "Россия"
        }
    };
    
    return JSON.stringify(data);
});
</script>

