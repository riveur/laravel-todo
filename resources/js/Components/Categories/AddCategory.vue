<script setup>
import BreezeButton from '@/Components/Button.vue'
import { reactive, ref } from '@vue/reactivity'
import axios from '@/axios'
import { useCategories } from '@/composables/categories'

const emits = defineEmits(['newValue'])

const data = reactive({
    name: '',
    processing: false,
})

const { getCategories, storeCategory, errors } = useCategories()

const handleClick = async () => {
    data.processing = true
    try {
        await storeCategory({ name: data.name })

        data.name = ''
        emits('newValue')
    } catch (e) {}

    data.processing = false
}
</script>

<template>
    <div class="add-category">
        <div class="flex mt-2">
            <input type="text" class="block form-input px-4 py-3 w-full rounded" :class="{ 'border-red-500': errors['name'] }" placeholder="Nouvelle catégorie" v-model="data.name" @keyup.enter="handleClick" />
            <BreezeButton class="ml-2" :class="{ 'opacity-50': data.processing }" :disabled="data.processing" type="button" @click="handleClick">Ajouter</BreezeButton>
        </div>
        <span v-show="errors['name']" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"> {{ errors['name'] }} </span>
    </div>
</template>
