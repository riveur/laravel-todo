<script setup>
import { useCategories } from '@/composables/categories'
import { PencilIcon, TrashIcon, CheckIcon } from '@heroicons/vue/solid'
import { reactive, inject, watch } from 'vue'
import { categoryStateKey } from '@/keys'

const emits = defineEmits(['exit-edit', 'updated', 'deleted'])

const swal = inject('$swal')

const { category, categoryAvailable } = inject(categoryStateKey)

const data = reactive({
    name: '',
    editState: false,
})

const { updateCategory, destroyCategory } = useCategories()

const toggleEdit = () => {
    data.editState = !data.editState
}

const update = async (id) => {
    try {
        await updateCategory(id, { name: category.value.name })
        emits('updated')
        toggleEdit()
    } catch (e) {}
}

const deleteCategory = (id) => {
    swal.fire({
        title: 'Notification de suppression',
        text: `Êtes-vous sûr de vouloir supprimer la catégorie n°${id} ? En supprimant cette catégorie, les tâches associées seront aussi supprimées.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
        confirmButtonText: 'Supprimer',
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                destroyCategory(id)
                categoryAvailable.value = false
                emits('deleted')
            } catch (e) {}
        }
    })
}

watch(
    () => category.value.id,
    (nValue, oValue) => {
        if (data.editState) {
            toggleEdit()
        }
    }
)
</script>
<template>
    <div class="selected-category flex justify-between">
        <div class="flex justify-between items-center w-full" v-if="data.editState">
            <input
                type="text"
                class="block py-1.5 px-0 pl-2 w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none peer"
                placeholder="Catégorie"
                v-model="category.name"
                @keyup.esc="toggleEdit"
                @keyup.enter="update(category.id)"
            />
            <button type="button" @click.prevent="update(category.id)">
                <CheckIcon class="ml-2 h-6 w-6" />
            </button>
        </div>
        <span v-else>{{ category.name }}</span>
        <div class="actions flex justify-center items-center">
            <button type="button" @click.prevent="toggleEdit" v-show="!data.editState">
                <PencilIcon class="h-6 w-6 hover:text-gray-500" />
            </button>
            <button type="button" @click.prevent="deleteCategory(category.id)">
                <TrashIcon class="h-6 w-6 hover:text-gray-500" />
            </button>
        </div>
    </div>
</template>
