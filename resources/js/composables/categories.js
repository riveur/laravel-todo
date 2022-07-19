import axios from "@/axios";
import { ref } from "vue";

export function useCategories() {

    const categories = ref([])
    const category = ref({})
    const errors = ref([])

    const getCategories = async () => {
        let response = await axios.get('/api/task-categories')

        categories.value = response.data.data
    }

    const getCategoryBySlugAndUser = async (slug, user_id) => {
        let response = await axios.get(`/api/task-categories/${slug}/${user_id}`)

        category.value = response.data.data
    }

    const storeCategory = async (data) => {
        errors.value = []

        try {
            await axios.post('api/task-categories', data)
        } catch(e) {
            if(e.response.status === 422) {
                errors.value = _.mapValues(e.response.data.errors, (value) => {
                    return _.join(value, ', ')
                })
            }
        }
    }

    const updateCategory = async (id, data = category.value) => {
        errors.value = []

        try {
            await axios.put('api/task-categories/' + id, data)
        } catch(e) {
            if(e.response.status === 422) {
                errors.value = _.mapValues(e.response.data.errors, (value) => {
                    return _.join(value, ', ')
                })
            }
        }

    }

    const destroyCategory = async (id) => {
        await axios.delete('/api/task-categories/' + id)
    }

    return {
        categories,
        category,
        errors,
        getCategories,
        getCategory: getCategoryBySlugAndUser,
        storeCategory,
        updateCategory,
        destroyCategory
    }
}
