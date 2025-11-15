<template>
    <section
        id="hero"
        ref="heroRef"
        class="relative mt-20 py-24 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 text-white overflow-hidden"
    >
        <div class="absolute inset-0 opacity-30">
            <div
                class="absolute inset-0"
                :style="{ backgroundImage: `url('data:image/svg+xml,%3Csvg width=\\'100\\' height=\\'100\\' xmlns=\\'http://www.w3.org/2000/svg\\'%3E%3Crect width=\\'100\\' height=\\'100\\' fill=\\'none\\'/%3E%3Cpath d=\\'M0 50 L100 50 M50 0 L50 100\\' stroke=\\'rgba(255,255,255,0.1)\\' stroke-width=\\'1\\'/%3E%3C/svg%3E')` }"
            ></div>
        </div>

        <!-- Animated particles -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                v-for="i in 20"
                :key="i"
                class="absolute w-2 h-2 bg-white/20 rounded-full animate-float"
                :style="{
                    left: Math.random() * 100 + '%',
                    top: Math.random() * 100 + '%',
                    animationDelay: Math.random() * 3 + 's',
                    animationDuration: (3 + Math.random() * 4) + 's',
                }"
            ></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div :class="{ 'animate-fade-in-up': isVisible }">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                        Программирование для всех —<br />
                        <span class="inline-block animate-pulse">легко и интересно!</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 opacity-95">
                        Онлайн и офлайн-занятия для всех от 8 лет. Учим создавать сайты, игры и приложения с нуля.
                    </p>
                    <button
                        class="px-8 py-4 bg-white text-primary-600 rounded-lg font-bold text-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 active:scale-95"
                        @click="scrollToForm"
                    >
                        <span class="flex items-center gap-2">
                            <span>Записаться на мастер класс</span>
                            <span class="animate-bounce">👇</span>
                        </span>
                    </button>
                </div>

                <div class="flex justify-center" :class="{ 'animate-fade-in': isVisible }">
                    <div 
                        class="bg-black/30 backdrop-blur-md p-8 rounded-2xl border border-white/20 font-mono text-lg hover:bg-black/40 transition-all cursor-pointer group"
                        @mouseenter="startTyping"
                    >
                        <div class="mb-2">
                            <span class="text-blue-400">function</span>
                            <span class="text-green-400"> startLearning</span>
                            <span class="text-white">()</span>
                            <span class="text-white">{</span>
                        </div>
                        <div class="ml-4 mb-2">
                            <span class="text-blue-400">return</span>
                            <span class="text-yellow-400"> '{{ typedText }}'</span>
                            <span class="text-white">;</span>
                            <span 
                                v-if="isTyping"
                                class="text-white animate-pulse"
                            >|</span>
                        </div>
                        <div>
                            <span class="text-white">}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const heroRef = ref(null);
const isVisible = ref(false);
const typedText = ref('');
const isTyping = ref(false);

const messages = ['Успех!', 'Круто!', 'Вау!', 'Супер!', 'Отлично!'];
let currentMessageIndex = 0;
let typingTimeout = null;

const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

const startTyping = () => {
    if (isTyping.value) return;
    
    isTyping.value = true;
    typedText.value = '';
    const message = messages[currentMessageIndex];
    let charIndex = 0;
    
    const typeChar = () => {
        if (charIndex < message.length) {
            typedText.value += message[charIndex];
            charIndex++;
            typingTimeout = setTimeout(typeChar, 100);
        } else {
            isTyping.value = false;
            currentMessageIndex = (currentMessageIndex + 1) % messages.length;
        }
    };
    
    typeChar();
};

let observer = null;
let autoTypeInterval = null;

onMounted(() => {
    // Fade in animation
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
    
    // Intersection Observer for scroll animations
    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    isVisible.value = true;
                }
            });
        },
        { threshold: 0.1 }
    );
    
    if (heroRef.value) {
        observer.observe(heroRef.value);
    }
    
    // Auto typing animation
    const autoType = () => {
        if (!isTyping.value) {
            startTyping();
        }
    };
    
    autoTypeInterval = setInterval(autoType, 5000);
});

onUnmounted(() => {
    if (observer) {
        observer.disconnect();
    }
    if (autoTypeInterval) {
        clearInterval(autoTypeInterval);
    }
    if (typingTimeout) {
        clearTimeout(typingTimeout);
    }
});
</script>

<style scoped>
@keyframes float {
    0%, 100% {
        transform: translateY(0) translateX(0);
        opacity: 0.2;
    }
    50% {
        transform: translateY(-20px) translateX(10px);
        opacity: 0.5;
    }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

.animate-fade-in {
    animation: fadeIn 1s ease-out 0.3s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>

