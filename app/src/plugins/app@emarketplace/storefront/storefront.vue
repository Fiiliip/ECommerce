<template>
    <div class="py-20 mx-5">
        <section class="flex justify-center">
            <a-searchbar></a-searchbar>
        </section>
        
        <section class="mt-20">
            <h1 class="text-lg font-bold">Kategórie</h1>
            <div class="flex flex-wrap">
                <a-category-card class="m-1" v-for="(category, categoryIdx) in categories" :key="categoryIdx" :category="category"></a-category-card>
            </div>
        </section>

        <a-listings-section class="mt-20" v-for="listingSection in listingSections" :key="listingSection" :title="listingSection.title"></a-listings-section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: this.$store.getters['emarketplace/categories'],
            listingSections: [
                {
                    title: 'Najnovšie inzeráty',
                    query: '',
                },
                {
                    title: 'Najpopulárnejšie inzeráty',
                    query: '',
                }
            ],
        }
    },
}
</script>