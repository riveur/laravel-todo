import axios from "@/axios";
import { ref } from "vue";

export function useTasks() {

    const tasks = ref([])
    const task = ref([])
    const errors = ref([])

    const getTasks = async () => {
        let response = await axios.get('/api/tasks')

        tasks.value = response.data.data
    }

    const getTask = async (id) => {
        let response = await axios.get(`/api/tasks/${id}`)

        task.value = response.data.data
    }

    const storeTask = async (data) => {
        errors.value = []

        try {
            await axios.post('api/tasks', data)
        } catch(e) {
            if(e.response.status === 422) {
                errors.value = _.mapValues(e.response.data.errors, (value) => {
                    return _.join(value, ', ')
                })
            }
        }
    }

    const updateTask = async (id, data = task.value) => {
        errors.value = []

        try {
            await axios.put('api/tasks/' + id, data)
        } catch(e) {
            if(e.response.status === 422) {
                errors.value = _.mapValues(e.response.data.errors, (value) => {
                    return _.join(value, ', ')
                })
            }
        }

    }

    const updateTaskStatus = async (id, data = task.value) => {
        errors.value = []

        try {
            await axios.put('api/tasks/status/' + id, data)
        } catch(e) {
            if(e.response.status === 422) {
                errors.value = _.mapValues(e.response.data.errors, (value) => {
                    return _.join(value, ', ')
                })
            }
        }

    }

    const destroyTask = async (id) => {
        await axios.delete('/api/tasks/' + id)
    }

    return {
        tasks,
        task,
        errors,
        getTasks,
        getTask,
        storeTask,
        updateTask,
        updateTaskStatus,
        destroyTask
    }
}
