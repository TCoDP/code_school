<template>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Мои сертификаты</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div
                v-for="certificate in props.certificates"
                :key="certificate.id"
                class="bg-white rounded-2xl shadow-lg border-2 border-gray-200 overflow-hidden hover:shadow-xl transition-all transform hover:-translate-y-1"
            >
                <!-- Certificate Preview -->
                <div class="bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 p-8 text-center text-white relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Crect width=\'100\' height=\'100\' fill=\'none\'/%3E%3Cpath d=\'M0 50 L100 50 M50 0 L50 100\' stroke=\'rgba(255,255,255,0.3)\' stroke-width=\'1\'/%3E%3C/svg%3E');"></div>
                    </div>
                    <div class="relative z-10">
                        <div class="text-6xl mb-4">🏆</div>
                        <h3 class="text-2xl font-bold mb-2">{{ certificate.course }}</h3>
                        <p class="text-lg opacity-90 mb-4">{{ certificate.level }}</p>
                        <div class="mt-4 pt-4 border-t border-white/20">
                            <p class="text-sm opacity-80" v-if="certificate.issuedDate">
                                Выдан: {{ certificate.issuedDate }}
                            </p>
                            <p class="text-sm opacity-80" v-else>
                                В процессе получения
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Certificate Info -->
                <div class="p-6">
                    <div class="space-y-3 mb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Прогресс курса:</span>
                            <span class="font-semibold text-gray-900">{{ certificate.progress }}%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Выполнено заданий:</span>
                            <span class="font-semibold text-gray-900">{{ certificate.completedTasks }}/{{ certificate.totalTasks }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Статус:</span>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold"
                                :class="certificate.status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'"
                            >
                                {{ certificate.status === 'completed' ? 'Получен' : 'В процессе' }}
                            </span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div
                        v-if="certificate.status !== 'completed'"
                        class="mb-4"
                    >
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">До получения сертификата</span>
                            <span class="text-sm font-bold text-primary-600">{{ 100 - certificate.progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div
                                class="bg-gradient-to-r from-primary-500 to-secondary-500 h-3 rounded-full transition-all duration-500"
                                :style="{ width: `${certificate.progress}%` }"
                            ></div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                        <button
                            v-if="certificate.status === 'completed'"
                            @click="downloadCertificate(certificate.id)"
                            :disabled="downloading === certificate.id"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 disabled:opacity-50"
                        >
                            <span v-if="downloading !== certificate.id">📥</span>
                            <span v-else class="animate-spin">⏳</span>
                            <span>{{ downloading === certificate.id ? 'Скачивание...' : 'Скачать PDF' }}</span>
                        </button>
                        <button
                            v-if="certificate.status === 'completed'"
                            @click="shareCertificate(certificate)"
                            class="px-6 py-3 border-2 border-primary-500 text-primary-600 rounded-xl font-semibold hover:bg-primary-50 transition-all flex items-center justify-center gap-2"
                        >
                            <span>🔗</span>
                            <span>Поделиться</span>
                        </button>
                        <button
                            v-else
                            @click="viewCourse(certificate.courseId)"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
                        >
                            Продолжить обучение
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div
            v-if="props.certificates.length === 0"
            class="bg-white rounded-2xl shadow-lg border-2 border-gray-200 p-12 text-center"
        >
            <div class="text-6xl mb-4">🏆</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">У вас пока нет сертификатов</h3>
            <p class="text-gray-600 mb-6">Завершите курс, чтобы получить сертификат!</p>
            <a
                href="/student/courses"
                class="inline-block px-8 py-4 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-secondary-600 transition-all shadow-md hover:shadow-lg"
            >
                Перейти к курсам
            </a>
        </div>

        <!-- Info Block -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-200 p-6">
            <div class="flex items-start gap-4">
                <span class="text-3xl">ℹ️</span>
                <div>
                    <h3 class="font-bold text-gray-900 mb-2">Как получить сертификат?</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li>• Пройдите все уроки курса (минимум 80%)</li>
                        <li>• Выполните все домашние задания</li>
                        <li>• Получите положительные оценки от наставника</li>
                        <li>• Сертификат будет доступен для скачивания в формате PDF</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    certificates: {
        type: Array,
        default: () => [],
    },
});

const downloading = ref(null);
const shareUrl = ref(null);

const downloadCertificate = async (certificateId) => {
    downloading.value = certificateId;
    
    try {
        // Скачиваем файл через прямой переход
        window.location.href = `/student/certificates/${certificateId}/download`;
        
        // Сбрасываем состояние через небольшую задержку
        setTimeout(() => {
            downloading.value = null;
        }, 2000);
    } catch (error) {
        console.error('Ошибка при скачивании:', error);
        downloading.value = null;
        alert('Не удалось скачать сертификат. Попробуйте позже.');
    }
};

const shareCertificate = async (certificate) => {
    try {
        const response = await fetch(`/student/certificates/${certificate.id}/share`);
        const data = await response.json();
        
        // Пробуем использовать Web Share API
        if (navigator.share) {
            try {
                await navigator.share({
                    title: data.title,
                    text: data.text,
                    url: data.url,
                });
                return;
            } catch (shareError) {
                // Если пользователь отменил, просто выходим
                if (shareError.name === 'AbortError') {
                    return;
                }
                // Иначе продолжаем с копированием
            }
        }
        
        // Fallback: копируем ссылку в буфер обмена
        if (navigator.clipboard && navigator.clipboard.writeText) {
            try {
                await navigator.clipboard.writeText(data.url);
                alert('✅ Ссылка на сертификат скопирована в буфер обмена!');
            } catch (clipboardError) {
                // Если clipboard API не работает, используем старый метод
                copyToClipboardFallback(data.url);
            }
        } else {
            // Старый метод для браузеров без clipboard API
            copyToClipboardFallback(data.url);
        }
    } catch (error) {
        console.error('Ошибка при поделиться:', error);
        alert('Не удалось поделиться сертификатом. Попробуйте позже.');
    }
};

const copyToClipboardFallback = (text) => {
    // Создаём временный textarea элемент
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.left = '-999999px';
    textarea.style.top = '-999999px';
    document.body.appendChild(textarea);
    textarea.focus();
    textarea.select();
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            alert('✅ Ссылка на сертификат скопирована в буфер обмена!');
        } else {
            // Показываем ссылку для ручного копирования
            prompt('Скопируйте ссылку на сертификат:', text);
        }
    } catch (err) {
        // Показываем ссылку для ручного копирования
        prompt('Скопируйте ссылку на сертификат:', text);
    } finally {
        document.body.removeChild(textarea);
    }
};

const viewCourse = (courseId) => {
    router.visit(`/student/courses/${courseId}/lessons`);
};
</script>
