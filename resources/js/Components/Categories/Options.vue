<script setup>
import { categoryStateKey } from '@/keys'
import { computed, inject } from 'vue'
import AddCategory from './AddCategory.vue'
import EditCategory from './EditCategory.vue'

const emits = defineEmits(['needReload'])

const { category, categoryAvailable } = inject(categoryStateKey)

const taskDone = computed(() => {
    return category.value.tasks ? category.value.tasks.filter((task) => task.is_done === 1).length : '...'
})
const taskActive = computed(() => {
    return category.value.tasks ? category.value.tasks.filter((task) => task.is_done === 0).length : '...'
})
</script>

<template>
    <div class="options">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">Options</label>
        <ul v-show="categoryAvailable" class="pb-2 border-b">
            <li class="pb-2">
                Catégorie séléctionné :
                <edit-category @updated="emits('needReload')" @deleted="emits('needReload')" />
            </li>
            <li class="pt-2 border-t">
                Tâches en cours : <span> {{ taskActive }} </span>
            </li>
            <li>
                Tâches terminées : <span> {{ taskDone }} </span>
            </li>
        </ul>
        <add-category @newValue="emits('needReload')" />
    </div>
</template>
