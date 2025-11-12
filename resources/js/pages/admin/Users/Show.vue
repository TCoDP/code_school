<template>
    <Head title="Просмотр пользователя" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">{{ user.name }}</h1>
                <div class="flex gap-3">
                    <a
                        :href="`/admin/users/${user.id}/edit`"
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors"
                    >
                        Редактировать
                    </a>
                    <a
                        href="/admin/users"
                        class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors"
                    >
                        ← Назад к списку
                    </a>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Основная информация -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Основная информация</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-600">Имя</label>
                            <p class="text-lg font-semibold text-gray-900">{{ user.name }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Email</label>
                            <p class="text-lg text-gray-900">{{ user.email }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Роль</label>
                            <span
                                :class="[
                                    'inline-block px-3 py-1 rounded-full text-sm font-semibold mt-2',
                                    user.role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700'
                                ]"
                            >
                                {{ user.role === 'admin' ? 'Администратор' : 'Студент' }}
                            </span>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Дата регистрации</label>
                            <p class="text-lg text-gray-900">{{ user.created_at }}</p>
                        </div>
                    </div>
                </div>

                <!-- Курсы и сертификаты -->
                <div class="space-y-6">
                    <!-- Курсы -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Курсы ({{ user.courses?.length || 0 }})</h2>
                        <div
                            v-if="user.courses && user.courses.length > 0"
                            class="space-y-2"
                        >
                            <div
                                v-for="course in user.courses"
                                :key="course.id"
                                class="p-3 bg-gray-50 rounded-lg"
                            >
                                <div class="flex items-center gap-2">
                                    <span>{{ course.icon }}</span>
                                    <p class="font-semibold text-gray-900">{{ course.name }}</p>
                                </div>
                            </div>
                        </div>
                        <p
                            v-else
                            class="text-gray-500"
                        >
                            Курсов пока нет
                        </p>
                    </div>

                    <!-- Сертификаты -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Сертификаты ({{ user.certificates?.length || 0 }})</h2>
                        <div
                            v-if="user.certificates && user.certificates.length > 0"
                            class="space-y-2"
                        >
                            <div
                                v-for="certificate in user.certificates"
                                :key="certificate.id"
                                class="p-3 bg-gray-50 rounded-lg"
                            >
                                <p class="font-semibold text-gray-900">{{ certificate.course?.name || 'Курс' }}</p>
                                <p class="text-sm text-gray-600">{{ certificate.level }}</p>
                            </div>
                        </div>
                        <p
                            v-else
                            class="text-gray-500"
                        >
                            Сертификатов пока нет
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});
</script>

