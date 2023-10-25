<template>
    <div class="w-[95%] sm:w-[70%] flex p-4 bg-white rounded-md shadow-md">
        <!-- Search Input -->
        <input type="text" class="w-full p-2 mr-2 border rounded-md focus:ring focus:ring-blue-400" placeholder="Hľadať...">
        <!-- Category Dropdown -->
        <div v-if="showCategory" class="relative w-full mr-2">
            <button @click="showDropdown = !showDropdown" class="w-full flex p-2 items-center justify-between border rounded-md hover:bg-zinc-100">
                <p>{{ getCategoryTitle() }}</p>
                <div>
                    <img class="w-3 h-3 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/arrow-down.svg">
                </div>
            </button>

            <!-- Dropdown -->
            <div :class="[ showDropdown ? 'block' : 'hidden' ]" class="absolute w-full h-64 overflow-y-scroll mt-2 bg-white divide-y divide-zinc-300 rounded-lg shadow z-10">
                <ul class="py-2 text-sm">
                    <li v-for="category in categories" :key="category.id">
                        <a @click="$router.push({ name: 'Category', params: { slug: category.slug} })" :href="`/category/${category.slug}`" class="block px-4 py-2 hover:bg-zinc-100">{{ category.title }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Search Button -->
        <button @click="null" class="hidden sm:block w-36 p-2 border rounded-md bg-zinc-900 hover:bg-zinc-700">
            <img class="w-5 h-5 mx-auto" src="@/plugins/app/_assets/_icons/search.svg">
        </button>
    </div>
</template>

<script>
export default {
    props: {
        showCategory: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {
            categories: this.$store.getters['ecommerce/categories'],
            showDropdown: false,
        }
    },
}
</script>