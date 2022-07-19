<script setup>
import SearchCategory from '@/Components/Categories/SearchCategory.vue'
import { categoryStateKey } from '@/keys'
import { inject } from '@vue/runtime-core'

const emits = defineEmits(['change'])

const { categories } = inject(categoryStateKey)
</script>

<template>
    <div class="category">
        <search-category @change="(value) => emits('change', value)" :categories="categories" />
    </div>
</template>
