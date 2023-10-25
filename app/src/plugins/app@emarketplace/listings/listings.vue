<template>
    <div class="mx-5">
        <div class="mt-5 flex justify-center">
            <a-searchbar :showCategory="true" />
        </div>
        <h1 class="mt-5 text-3xl font-bold">Kategória</h1>
        <div class="mt-5 flex flex-col md:flex-row md:justify-between">
            <!-- Filters -->
            <!-- <a-category-filters :filters="filters" @on-filter="onFilter" /> -->
            <a-category-filters />

            <!-- Listings -->
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-3 xl:grid-cols-4">
                <z-listing-card v-for="listing in listings" :key="listing.id" :listing="listing" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            listings: null,
        }
    },

    async mounted() {
        this.listings = await this._getListings()
    }
}
</script>
