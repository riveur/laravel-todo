<script setup>
import { CheckIcon } from '@heroicons/vue/solid'
import axios from '@/axios'
import { reactive, ref } from 'vue'
import { useTasks } from '@/composables/tasks'

const props = defineProps({
    task_description: {
        type: String,
        required: true,
    },
    task_id: {
        type: Number,
        required: true,
    },
})

const emits = defineEmits(['exit-edit', 'updated'])

const data = reactive({
    visible: false,
    description: props.task_description,
})

const { updateTask } = useTasks()

const toggleVisible = () => {
    data.visible = !data.visible
}

const hide = () => {
    data.visible = false
}

const updateTaskDescription = async (id) => {
    try {
        await updateTask(id, { description: data.description })
        emits('updated')
    } catch (e) {}
}

defineExpose({
    toggleVisible,
    hide,
})
</script>

<template>
    <div class="flex justify-between items-center w-full" v-show="data.visible">
        <input
            type="text"
            class="block py-1.5 px-0 pl-2 w-full text-xl text-gray-900 bg-transparent border-0 appearance-none focus:outline-none peer"
            placeholder="Tâche"
            v-model="data.description"
            @keyup.esc="emits('exit-edit')"
            @keyup.enter="updateTaskDescription(props.task_id)"
        />
        <button type="button" @click.prevent="updateTaskDescription(props.task_id)">
            <CheckIcon class="ml-2 h-6 w-6" />
        </button>
    </div>
</template>
