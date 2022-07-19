<script setup>
import { useCategories } from '@/composables/categories.js'

const props = defineProps({
    categories: {
        type: [Array, Object],
        required: true,
    },
})

const emit = defineEmits(['change'])
</script>
<template>
    <div>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">Catégorie</label>
        <div class="relative">
            <select
                @change="emit('change', $event.target.value)"
                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-state"
            >
                <option value="none">-- Choisissez --</option>
                <option v-for="category in props.categories" :key="category.id" :value="category.slug">
                    {{ category.name }}
                </option>
            </select>
        </div>
    </div>
</template>
