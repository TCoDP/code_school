<template>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Чат с куратором</h2>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span
                    class="w-2 h-2 rounded-full"
                    :class="isOnline ? 'bg-green-500' : 'bg-gray-400'"
                ></span>
                {{ isOnline ? 'Куратор онлайн' : 'Куратор офлайн' }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden flex flex-col"
             style="height: 600px;">
            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4">
                <div
                    v-for="message in messages"
                    :key="message.id"
                    :class="[
                        'flex',
                        (message.from === 'student' || message.sender_type === 'student') ? 'justify-end' : 'justify-start'
                    ]"
                >
                    <div
                        :class="[
                            'max-w-[70%] rounded-2xl p-4',
                            (message.from === 'student' || message.sender_type === 'student')
                                ? 'bg-primary-500 text-white'
                                : 'bg-gray-100 text-gray-900'
                        ]"
                    >
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-semibold">{{ (message.from === 'student' || message.sender_type === 'student') ? 'Вы' : (message.sender || 'Куратор') }}</span>
                            <span class="text-xs opacity-70">{{ message.time || (message.created_at ? new Date(message.created_at).toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' }) : '') }}</span>
                        </div>
                        <p class="text-sm">{{ message.message || message.text }}</p>
                    </div>
                </div>
            </div>

            <!-- Input -->
            <div class="border-t border-gray-200 p-4">
                <form
                    class="flex gap-3"
                    @submit.prevent="sendMessage"
                >
                    <input
                        v-model="newMessage"
                        type="text"
                        placeholder="Напишите сообщение..."
                        class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none"
                    />
                    <button
                        type="submit"
                        class="px-6 py-3 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-600 transition-colors"
                    >
                        Отправить
                    </button>
                </form>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Быстрые вопросы</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <button
                    v-for="quickQuestion in quickQuestions"
                    :key="quickQuestion"
                    class="px-4 py-2 bg-gray-50 hover:bg-primary-50 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors"
                    @click="sendQuickMessage(quickQuestion)"
                >
                    {{ quickQuestion }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    messages: {
        type: Array,
        default: () => [],
    },
});

const isOnline = ref(true);
const newMessage = ref('');

const messages = ref(props.messages || []);

const quickQuestions = [
    'Нужна помощь',
    'Вопрос по заданию',
    'Техническая проблема',
    'Когда проверят?',
];

const sendMessage = () => {
    if (!newMessage.value.trim()) return;

    messages.value.push({
        id: messages.value.length + 1,
        from: 'student',
        text: newMessage.value,
        time: new Date().toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' }),
    });

    newMessage.value = '';

    // Auto-scroll to bottom
    setTimeout(() => {
        const chatContainer = document.querySelector('.overflow-y-auto');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }, 100);
};

const sendQuickMessage = (question) => {
    newMessage.value = question;
    sendMessage();
};
</script>

