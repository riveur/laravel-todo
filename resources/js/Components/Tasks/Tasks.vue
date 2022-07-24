<script setup>
import Task from './Task.vue'
import BreezeButton from '@/Components/Button.vue'
import AddTask from './AddTask.vue'
import { inject, ref } from 'vue'
import { categoryStateKey } from '@/keys'

const emits = defineEmits(['reload'])

const { category } = inject(categoryStateKey)

const tasks = ref([])

const editingOnce = (id) => {
    tasks.value.forEach((task) => {
        if (task.id !== id) {
            task.hideEditForm()
        }
    })
}
</script>

<template>
    <div class="tasks mt-2 border-b-2" v-if="category.tasks.length">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tâches</label>
        <task v-for="task in category.tasks" :key="task.id" :id="task.id" :description="task.description" :done="task.is_done" @delete="emits('reload')" @editing="editingOnce(task.id)" @updated="emits('reload')" ref="tasks" />
    </div>
    <div class="tasks mt-2 flex justify-center items-center" v-else>
        <div class="font-xl">Aucune tâche</div>
    </div>
    <add-task @newValue="emits('reload')" />
</template>
