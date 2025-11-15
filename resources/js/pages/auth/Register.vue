<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
// import { store } from '@/routes/register'; // Регистрация отключена
import { Form, Head, router } from '@inertiajs/vue3';
</script>

<template>
    <AuthBase
        title="Регистрация"
        description="Заполните данные для создания аккаунта"
    >
        <Head title="Register" />

        <div class="text-center py-8">
            <p class="text-gray-600 mb-4">Регистрация отключена. Обратитесь к администратору для создания аккаунта.</p>
            <TextLink
                :href="login()"
                class="text-primary-600 hover:text-primary-700 font-medium"
            >
                Вернуться к входу
            </TextLink>
        </div>
        <!-- Форма регистрации отключена
        <Form
            v-bind="store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Имя</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        name="name"
                        placeholder="Ваше имя"
                        class="border-2 border-gray-200 focus:border-primary-500"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        :tabindex="2"
                        autocomplete="email"
                        name="email"
                        placeholder="email@example.com"
                        class="border-2 border-gray-200 focus:border-primary-500"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Пароль</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        name="password"
                        placeholder="Введите пароль"
                        class="border-2 border-gray-200 focus:border-primary-500"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Подтвердите пароль</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        name="password_confirmation"
                        placeholder="Повторите пароль"
                        class="border-2 border-gray-200 focus:border-primary-500"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    class="mt-2 w-full bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold py-3 rounded-lg shadow-md hover:shadow-lg transition-all"
                    tabindex="5"
                    :disabled="processing"
                    data-test="register-user-button"
                >
                    <Spinner v-if="processing" />
                    <span v-if="!processing">Создать аккаунт</span>
                </Button>
            </div>

            <div class="text-center text-sm text-gray-600">
                Уже есть аккаунт?
                <TextLink
                    :href="login()"
                    class="text-primary-600 hover:text-primary-700 font-medium"
                    :tabindex="6"
                    >Войти</TextLink
                >
            </div>
        </Form>
        -->
    </AuthBase>
</template>
