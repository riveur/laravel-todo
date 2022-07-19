<script setup>
import BreezeButton from '@/Components/Button.vue'
import { computed, inject, reactive } from 'vue'
import { useTasks } from '@/composables/tasks.js'
import { usePage } from '@inertiajs/inertia-vue3'
import { categoryStateKey } from '@/keys'

const emits = defineEmits(['newValue'])

const data = reactive({
    task: '',
    processing: false,
})

const userId = computed(() => usePage().props.value.auth.user.id)

const { category } = inject(categoryStateKey)

const { storeTask, errors } = useTasks()

const handleClick = async () => {
    data.processing = true

    try {
        await storeTask({
            description: data.task,
            user_id: userId.value,
            task_category_id: category.value.id,
        })
        data.task = ''
        emits('newValue')
    } catch (e) {}

    data.processing = false
}
</script>

<template>
    <div class="add-task">
        <div class="flex mt-2">
            <input type="text" class="block form-input px-4 py-3 w-full rounded" :class="{ 'border-red-500': errors['description'] }" placeholder="Nouvelle tâche" v-model="data.task" @keyup.enter="handleClick" />
            <BreezeButton class="ml-2" :class="{ 'opacity-50': data.processing }" :disabled="data.processing" type="button" @click="handleClick">Ajouter</BreezeButton>
        </div>
        <span v-show="errors['description']" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"> {{ errors['description'] }} </span>
    </div>
</template>
