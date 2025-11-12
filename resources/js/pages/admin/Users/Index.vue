<template>
    <Head title="Управление пользователями" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Пользователи</h1>
                <a
                    href="/admin/users/create"
                    class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                >
                    + Создать пользователя
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto -mx-4 sm:mx-0">
                    <table class="w-full min-w-[800px]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Пользователь</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Роль</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Курсов</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Сертификатов</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Дата регистрации</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-900">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="user in users"
                                :key="user.id"
                                class="hover:bg-gray-50 transition-colors"
                            >
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ user.name }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ user.email }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        :class="[
                                            'px-3 py-1 rounded-full text-xs font-semibold',
                                            user.role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700'
                                        ]"
                                    >
                                        {{ user.role === 'admin' ? 'Админ' : 'Студент' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ user.courses_count }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ user.certificates_count }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ user.created_at }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a
                                            :href="`/admin/users/${user.id}`"
                                            class="px-4 py-2 text-primary-600 hover:text-primary-700 font-medium"
                                        >
                                            Просмотр
                                        </a>
                                        <a
                                            :href="`/admin/users/${user.id}/edit`"
                                            class="px-4 py-2 text-blue-600 hover:text-blue-700 font-medium"
                                        >
                                            Редактировать
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    users: {
        type: Array,
        default: () => [],
    },
});
</script>

