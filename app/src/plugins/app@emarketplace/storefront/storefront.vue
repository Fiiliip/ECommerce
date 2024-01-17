<template>
    <div class="py-20 mx-5">
        <section class="flex justify-center">
            <z-searchbar></z-searchbar>
        </section>
        
        <section class="mt-20">
            <h1 class="text-lg font-bold">Kategórie</h1>
            <div class="flex flex-wrap">
                <a-category-card class="m-1" v-for="(category, categoryIdx) in $skelet(categories, 10)" :key="`category-${categoryIdx}`" :category="category"></a-category-card>
            </div>
        </section>

        <a-listings-section class="mt-20" v-for="listingSection in listingSections" :key="listingSection" :title="listingSection.title" :query="listingSection.query"></a-listings-section>
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
                    query: 'mostRecent=3',
                },
                {
                    title: 'Najpopulárnejšie inzeráty',
                    query: 'mostViewed=5',
                }
            ],
        }
    },
}
</script>