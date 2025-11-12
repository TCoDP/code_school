<template>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Материалы и ссылки</h2>
            <div class="flex gap-2">
                <button
                    :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-colors',
                        filter === 'all' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                    @click="filter = 'all'"
                >
                    Все
                </button>
                <button
                    v-for="course in courses.value"
                    :key="course"
                    :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-colors',
                        filter === course ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                    @click="filter = course"
                >
                    {{ course }}
                </button>
            </div>
        </div>

        <div class="grid gap-4">
            <div
                v-for="material in filteredMaterials"
                :key="material.id"
                class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow"
            >
                <div class="flex items-start gap-4">
                    <div class="text-4xl flex-shrink-0">{{ material.icon }}</div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ material.title }}</h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    {{ material.course }} • {{ material.type }}
                                </p>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold"
                                :class="material.isNew ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'"
                            >
                                {{ material.isNew ? 'Новое' : '' }}
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4">{{ material.description }}</p>
                        <div class="flex flex-wrap gap-2">
                            <a
                                v-for="link in material.links"
                                :key="link.url"
                                :href="link.url"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-600 rounded-lg font-medium hover:bg-primary-100 transition-colors"
                            >
                                <span>{{ link.icon }}</span>
                                <span>{{ link.label }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div
            v-if="filteredMaterials.length === 0"
            class="bg-white rounded-xl shadow-md border border-gray-200 p-12 text-center"
        >
            <div class="text-6xl mb-4">📖</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Нет материалов</h3>
            <p class="text-gray-600">Материалы появятся здесь по мере прохождения курса</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    materials: {
        type: Array,
        default: () => [],
    },
});

const filter = ref('all');

const materials = computed(() => props.materials || []);

const courses = computed(() => {
    const uniqueCourses = [...new Set(materials.value.map(m => m.course))];
    return uniqueCourses;
});

// Проверяем, есть ли параметр course в URL
onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const courseParam = urlParams.get('course');
    if (courseParam) {
        // Находим название курса по ID и устанавливаем фильтр
        const course = materials.value.find(m => m.course_id == courseParam);
        if (course) {
            filter.value = course.course;
        }
    }
});

const filteredMaterials = computed(() => {
    if (filter.value === 'all') return materials.value;
    return materials.value.filter(m => m.course === filter.value);
});
</script>

