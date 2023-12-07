<template>
    <div class="w-[95%] sm:w-[85%] md:w-[75%] lg:w-[70%] flex p-4 bg-white rounded-md shadow-md">
        <!-- Search search -->
        <input v-model="query.search" @keyup.enter="search()" type="text" class="w-full p-2 mr-2 border rounded-md ring-1 ring-inset ring-zinc-300 focus:ring-2 focus:ring-zinc-600" placeholder="Hľadať...">
        <!-- Category Dropdown -->
        <div v-if="showCategory" class="relative w-full sm:w-[80%] md:w-[70%] lg:w-[60%] mr-2">
            <button @click="showDropdown = !showDropdown" class="w-full flex p-2 items-center justify-between border rounded-md hover:bg-zinc-100">
                <p>{{ getCategoryTitle() }}</p>
                <div>
                    <img class="w-3 h-3 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/arrow-down.svg">
                </div>
            </button>

            <!-- Dropdown -->
            <div :class="[ showDropdown ? 'block' : 'hidden' ]" class="absolute w-full h-64 overflow-y-scroll mt-2 bg-white divide-y divide-zinc-300 rounded-lg shadow z-10">
                <ul class="py-2 text-sm">
                    <li @click="query.category = category.slug" class="cursor-pointer" v-for="category in categories" :key="category.id">
                        <a @click="search()" :href="query.search ? `/listings/?category=${category.slug}&search=${query.search.replace(' ', '+')}` : `/listings/?category=${category.slug}`" class="block px-4 py-2 hover:bg-zinc-100">{{ category.title }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Search -->
        <a @click="search()" :href="`${href}`" class="hidden sm:block w-36 p-2 border rounded-md bg-zinc-900 hover:bg-zinc-700">
            <img class="w-5 h-5 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/search.svg">
        </a>
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
            categories: this.$store.getters['emarketplace/categories'],

            query: {
                category: '',
                search: '',
            },
            href: '',

            showDropdown: false,
        }
    },

    mounted() {
        this.query.category = this.$route.query.category ? this.$route.query.category : ''
        this.query.search = this.$route.query.search?.replace('+', ' ')
    },

    methods: {
        search() {
            if (this.query.category && this.query.search) {
                this.$router.push({ name: 'Listings', query: this.query })
                window.location.href = this.href
            } else if (this.query.category) {
                this.$router.push({ name: 'Listings', query: { category: this.query.category } })
                window.location.href = this.href
            } else if (this.query.search) {
                this.$router.push({ name: 'Listings', query: { search: this.query.search } })
                window.location.href = this.href
            } else {
                this.$router.push({ name: 'Listings' })
                window.location.href = this.href
            }
        },
    },

    watch: {
        query: {
            handler(value) {
                this.href = '/listings'

                if (value.category && value.search) {
                    this.href += `/?category=${value.category}&search=${value.search.replace(' ', '+')}`
                } else if (value.category) {
                    this.href += `/?category=${value.category}`
                } else if (value.search) {
                    this.href += `/?search=${value.search.replace(' ', '+')}`
                }
            },
            deep: true
        }
    }
}
</script>