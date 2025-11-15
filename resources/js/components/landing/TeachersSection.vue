<template>
    <section
        id="teachers"
        ref="sectionRef"
        class="py-20 bg-gray-50"
    >
        <div class="container mx-auto px-4">
            <h2 
                class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900"
                :class="{ 'animate-fade-in-up': isVisible }"
            >
                Наставники «АйТиПлюс»
            </h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    v-for="(teacher, index) in teachers"
                    :key="teacher.name"
                    :ref="el => { if (el) cardRefs[index] = el }"
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 text-center cursor-pointer group"
                    :class="{ 'animate-slide-in': visibleCards[index] }"
                >
                    <div 
                        class="text-6xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300"
                    >
                        {{ teacher.avatar }}
                    </div>
                    <h3 class="text-2xl font-semibold mb-2 text-gray-900 group-hover:text-primary-600 transition-colors">
                        {{ teacher.name }}
                    </h3>
                    <p class="text-gray-600 mb-4 text-sm">{{ teacher.experience }}</p>
                    <p class="text-gray-600 italic border-t pt-4 mt-4 leading-relaxed group-hover:text-gray-800 transition-colors">
                        «{{ teacher.quote }}»
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const sectionRef = ref(null);
const cardRefs = ref([]);
const isVisible = ref(false);
const visibleCards = ref([false, false, false]);

const teachers = [
    {
        avatar: '👨‍💻',
        name: 'Алексей Петров',
        experience: 'Опыт работы с детьми: 8 лет',
        quote: 'Главное — не просто писать код, а понимать, как он оживает!',
    },
    {
        avatar: '👩‍💻',
        name: 'Мария Соколова',
        experience: 'Опыт работы с детьми: 6 лет',
        quote: 'Каждый ребёнок может стать создателем, нужно только показать путь!',
    },
    {
        avatar: '👨‍💻',
        name: 'Дмитрий Иванов',
        experience: 'Опыт работы с детьми: 5 лет',
        quote: 'Программирование — это суперсила XXI века, и мы её дарим детям!',
    },
];

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
    
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        visibleCards.value[index] = true;
                    }, index * 200);
                }
            });
        },
        { threshold: 0.1 }
    );
    
    cardRefs.value.forEach((card) => {
        if (card) {
            observer.observe(card);
        }
    });
    
    onUnmounted(() => {
        observer.disconnect();
    });
});
</script>

<style scoped>
.animate-slide-in {
    animation: slideIn 0.6s ease-out both;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
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
</style>

