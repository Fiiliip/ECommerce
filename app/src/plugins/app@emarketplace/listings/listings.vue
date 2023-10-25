<template>
    <div class="my-5 mx-5">
        <div class="flex justify-center">
            <a-searchbar :showCategory="true" />
        </div>
        <h1 class="mt-5 text-3xl font-bold">{{ getCategoryTitle() }}</h1>
        <!-- mt-5 flex flex-row md:justify-between -->
        <div class="mt-5 flex flex-row justify-center">
            <!-- Filters -->
            <!-- <a-listing-filters :filters="filters" @on-filter="onFilter" /> -->

            <!-- Listings -->
            <!-- <div class="grid grid-cols-2 gap-3 lg:grid-cols-3 xl:grid-cols-4">
                <z-listing-card v-for="listing in listings" :key="listing.id" :listing="listing" />
            </div> -->
            <div class="grid gap-3 grid-cols xs:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
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
