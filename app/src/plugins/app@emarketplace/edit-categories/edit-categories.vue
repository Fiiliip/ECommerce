<!-- Create HTML where there will be list of categories. Each category will have it's name in input which can be edited. Add also there option that the category can be deleted. Every action will be send to custom API -->
<template>
    <div>
        <div class="flex mx-5 my-5 px-5 py-2 justify-between items-center bg-white rounded-lg">
            <input placeholder="Title" type="text" class="max-w-[40%] border border-gray-300 rounded-md px-2 py-1 mr-2" v-model="form.title">
            <input placeholder="Slug" type="text" class="max-w-[40%] border border-gray-300 rounded-md px-2 py-1 mr-2" v-model="form.slug">
            <button class="px-3 py-1.5 text-white bg-zinc-600 rounded-lg hover:bg-zinc-500" @click="addCategory()">Pridať</button>
        </div>
        <div v-for="category in $skelet(categories, 10)" :key="`category-${category.id}`" class="">
            <div class="flex mx-5 my-5 px-5 py-2 justify-between items-center bg-white rounded-lg">
                <input type="text" class="border border-gray-300 rounded-md px-2 py-1 mr-2" v-model="category.title">
                <button class="px-3 py-1.5 text-white bg-green-600 rounded-lg hover:bg-green-500" @click="updateCategory(category.id, category.title)">Upraviť</button>
                <button class="px-3 py-1.5 text-white bg-red-600 rounded-lg hover:bg-red-500" @click="deleteCategory(category.id)">Vymazať</button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    data() {
        return {
            form: {
                title: '',
                slug: '',
            },
        }
    },

    computed: {
        ...mapGetters('emarketplace', ['categories'])
    },

    methods: {
        async addCategory() {
            this.$loader.startLoading()
            try {
                await this.$axios.post_auth_data(`/api/v1/mall/category`, this.form)
                this.$toast.success('Category was updated.', 'top')
                await this.$store.dispatch('emarketplace/categories_load')
                this.form = { title: '', slug: '' }
            } catch(error) {
                this.$toast.error(error.response, 'top')
            } finally {
                this.$loader.stopLoading()
            }
        },

        async updateCategory(categoryId, newTitle) {
            this.$loader.startLoading()
            try {
                await this.$axios.put_auth_data(`/api/v1/mall/category/${categoryId}`, { title: newTitle})
                this.$toast.success('Category was updated.', 'top')
                await this.$store.dispatch('emarketplace/categories_load')
            } catch(error) {
                this.$toast.error(error.response, 'top')
            } finally {
                this.$loader.stopLoading()
            }
        },

        async deleteCategory(categoryId) {
            this.$loader.startLoading()
            try {
                await this.$axios.delete_auth(`/api/v1/mall/category/${categoryId}`)
                this.$toast.success('Category was deleted.', 'top')
                await this.$store.dispatch('emarketplace/categories_load')
            } catch(error) {
                this.$toast.error(error.response, 'top')
            } finally {
                this.$loader.stopLoading()
            }
        }
    }
}
</script>