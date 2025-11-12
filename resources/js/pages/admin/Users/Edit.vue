<template>
    <Head title="Редактировать пользователя" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Редактировать пользователя</h1>
                <a
                    href="/admin/users"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors"
                >
                    ← Назад к списку
                </a>
            </div>

            <form
                @submit.prevent="submit"
                class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8"
            >
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Имя *</label>
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Email *</label>
                        <input
                            v-model="form.email"
                            type="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Новый пароль (оставьте пустым, чтобы не менять)</label>
                        <input
                            v-model="form.password"
                            type="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Подтверждение пароля</label>
                        <input
                            v-model="form.password_confirmation"
                            type="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Роль *</label>
                        <select
                            v-model="form.role"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="user">Студент</option>
                            <option value="admin">Администратор</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                        >
                            Сохранить изменения
                        </button>
                        <a
                            href="/admin/users"
                            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors"
                        >
                            Отмена
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const form = reactive({
    name: props.user.name || '',
    email: props.user.email || '',
    password: '',
    password_confirmation: '',
    role: props.user.role || 'user',
});

const submit = () => {
    router.put(`/admin/users/${props.user.id}`, form);
};
</script>

