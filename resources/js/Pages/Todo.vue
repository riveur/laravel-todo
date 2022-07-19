<script setup>
import BreezeAuthenticatedLayout from '@/layouts/Authenticated.vue'
import Category from '@/Components/Categories/Category.vue'
import Options from '@/Components/Categories/Options.vue'
import Tasks from '@/Components/Tasks/Tasks.vue'
import { Head, usePage } from '@inertiajs/inertia-vue3'
import { computed, onMounted, provide, ref } from 'vue'
import { categoryStateKey } from '@/keys'
import { useCategories } from '@/composables/categories'

const categoryAvailable = ref(false)

const { category, categories, getCategory, getCategories } = useCategories()

const userId = computed(() => usePage().props.value.auth.user.id)

const categorySlug = computed(() => category.value.slug)

const getCategoryBySlugAndUser = async (slug, user_id) => {
    if (slug !== 'none') {
        await getCategory(slug, user_id)
        categoryAvailable.value = true
    } else {
        category.value = {}
        categoryAvailable.value = false
    }
}

onMounted(() => {
    getCategories()
})

provide(categoryStateKey, { category, categories, categoryAvailable })
</script>

<template>
    <Head title="TodoList" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">TodoList</h2>
        </template>

        <div class="container mx-auto">
            <div class="py-12">
                <div class="px-2 grid grid-cols-12 gap-2 h-full">
                    <div class="col-span-12 xl:col-span-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <category @change="(value) => getCategoryBySlugAndUser(value, userId)" />
                                <tasks v-if="categoryAvailable" @reload="getCategoryBySlugAndUser(categorySlug, userId)" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-4">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <options @needReload="getCategories" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

