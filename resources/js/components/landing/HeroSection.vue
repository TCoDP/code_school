<template>
    <section
        id="hero"
        class="relative mt-20 py-24 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 text-white overflow-hidden"
    >
        <div class="absolute inset-0 opacity-30">
            <div
                class="absolute inset-0"
                :style="{ backgroundImage: `url('data:image/svg+xml,%3Csvg width=\\'100\\' height=\\'100\\' xmlns=\\'http://www.w3.org/2000/svg\\'%3E%3Crect width=\\'100\\' height=\\'100\\' fill=\\'none\\'/%3E%3Cpath d=\\'M0 50 L100 50 M50 0 L50 100\\' stroke=\\'rgba(255,255,255,0.1)\\' stroke-width=\\'1\\'/%3E%3C/svg%3E')` }"
            ></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                        Программирование для школьников —<br />
                        <span class="text-yellow-300 drop-shadow-lg">3 раза в неделю</span>, легко и интересно!
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 opacity-95">
                        Онлайн и офлайн-занятия для детей 8–17 лет. Учим создавать сайты, игры и приложения с нуля.
                    </p>
                    <button
                        class="px-8 py-4 bg-white text-primary-600 rounded-lg font-bold text-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
                        @click="scrollToForm"
                    >
                        Записаться на бесплатный урок
                    </button>
                </div>

                <div class="flex justify-center">
                    <div class="bg-black/30 backdrop-blur-md p-8 rounded-2xl border border-white/20 font-mono text-lg">
                        <div class="mb-2">
                            <span class="text-blue-400">function</span>
                            <span class="text-green-400"> startLearning</span>
                            <span class="text-white">()</span>
                            <span class="text-white">{</span>
                        </div>
                        <div class="ml-4 mb-2">
                            <span class="text-blue-400">return</span>
                            <span class="text-yellow-400"> 'Успех!'</span>
                            <span class="text-white">;</span>
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
const scrollToForm = () => {
    const element = document.querySelector('#form-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};
</script>

