<script setup>
import { PencilIcon, TrashIcon } from '@heroicons/vue/solid'
import EditTask from './EditTask.vue'
import { useTasks } from '@/composables/tasks.js'
import { inject, ref } from 'vue'

const props = defineProps({
    description: {
        type: String,
        required: true,
    },
    id: {
        type: Number,
        required: true,
    },
    done: {
        type: Number,
        required: true,
    },
})

const emits = defineEmits(['delete', 'editing', 'updated'])

const swal = inject('$swal')

const { updateTaskStatus, destroyTask } = useTasks()

const editComponent = ref(null)

const editState = ref(false)

const doneState = ref(parseInt(props.done) === 1 ? true : false)

const hideEditForm = () => {
    editComponent.value.hide()
    editState.value = false
}

const handleEdit = () => {
    editState.value = !editState.value
    editComponent.value.toggleVisible()
    emits('editing')
}

const updatedTask = () => {
    emits('updated')
    hideEditForm()
}

const updateStatus = async (id) => {
    doneState.value = !doneState.value
    try {
        await updateTaskStatus(id, { is_done: doneState.value ? 1 : 0 })
        emits('updated')
    } catch (e) {}
}

const deleteTask = (id) => {
    swal.fire({
        title: 'Notification de suppression',
        text: `Êtes-vous sûr de vouloir supprimer la tâche n°${id}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
        confirmButtonText: 'Supprimer',
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                destroyTask(id)
                emits('delete')
            } catch (e) {}
        }
    })
}

defineExpose({
    editState,
    id: props.id,
    hideEditForm,
})
</script>

<template>
    <div class="flex justify-between border-t-2">
        <div class="form-check py-1.5" v-show="!editState">
            <input
                class="
                    form-check-input
                    appearance-none
                    h-5
                    w-5
                    border border-gray-300
                    rounded-sm
                    bg-white
                    checked:bg-blue-600 checked:border-blue-600
                    focus:outline-none
                    transition
                    duration-200
                    mt-1
                    align-top
                    bg-no-repeat bg-center bg-contain
                    float-left
                    mr-2
                    cursor-pointer
                "
                type="checkbox"
                :checked="doneState"
                @change="updateStatus(props.id)"
                :id="`task-${props.id}`"
            />
            <label class="form-check-label inline-block text-gray-800 text-xl cursor-pointer" :class="{ 'line-through': doneState }" :for="`task-${id}`">
                {{ description }}
            </label>
        </div>
        <edit-task :task_description="description" :task_id="props.id" ref="editComponent" @exit-edit="handleEdit" @updated="updatedTask" />
        <div class="actions flex justify-center items-center">
            <button type="button" @click.prevent="handleEdit" v-show="!editState">
                <PencilIcon class="h-6 w-6 hover:text-gray-500" />
            </button>
            <button type="button" @click.prevent="deleteTask(id)">
                <TrashIcon class="h-6 w-6 hover:text-gray-500" />
            </button>
        </div>
    </div>
</template>
