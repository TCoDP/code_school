<template>
    <section
        id="contacts"
        class="py-20"
    >
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900">
                Контакты «Академии-Кода»
            </h2>

            <div class="grid md:grid-cols-2 gap-12 mb-12">
                <div class="space-y-6">
                    <div
                        v-for="contact in contacts"
                        :key="contact.type"
                        class="flex gap-6 items-start"
                    >
                        <div class="text-3xl flex-shrink-0">{{ contact.icon }}</div>
                        <div>
                            <strong class="block text-lg text-gray-900 mb-1">{{ contact.label }}</strong>
                            <a
                                v-if="contact.href"
                                :href="contact.href"
                                class="text-primary-600 hover:text-primary-700 hover:underline transition-colors"
                            >
                                {{ contact.value }}
                            </a>
                            <span
                                v-else
                                class="text-gray-600"
                            >{{ contact.value }}</span>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <a
                            v-for="social in socialLinks"
                            :key="social.name"
                            :href="social.href"
                            class="px-6 py-3 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-600 transition-colors"
                        >
                            {{ social.name }}
                        </a>
                    </div>
                </div>

                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-2xl p-12 text-center">
                    <p class="text-4xl mb-4">📍</p>
                    <p class="text-gray-600 mb-2">Карта будет здесь</p>
                    <p class="text-sm text-gray-500">Интегрируйте Яндекс.Карты или Google Maps</p>
                </div>
            </div>

            <div class="text-center pt-8 border-t border-gray-200">
                <a
                    href="/terms-of-service"
                    class="text-primary-600 hover:text-primary-700 hover:underline transition-colors"
                >
                    Оферта
                </a>
                <span class="mx-4 text-gray-400">|</span>
                <a
                    href="/privacy-policy"
                    class="text-primary-600 hover:text-primary-700 hover:underline transition-colors"
                >
                    Политика конфиденциальности
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
const contacts = [
    {
        icon: '📞',
        label: 'Телефон',
        value: '8-905-808-8000',
        href: 'tel:+79058088000',
    },
    {
        icon: '✉️',
        label: 'Email',
        value: 'the1stcenter@gmail.com',
        href: 'mailto:the1stcenter@gmail.com',
    },
    {
        icon: '📍',
        label: 'Адрес',
        value: 'Тагилстроевская, 6В',
        href: null,
    },
];

const socialLinks = [
    { name: 'VK', href: 'https://vk.com/the1st' },
];
</script>

