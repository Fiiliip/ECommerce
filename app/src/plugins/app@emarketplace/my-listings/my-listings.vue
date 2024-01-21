<template>
    <div class="my-5 mx-5">
        <h1 class="mt-5 text-3xl font-bold">Moje inzeráty</h1>
        <div class="mt-5 flex flex-row justify-center">
            <div class="w-full grid gap-3 grid-cols xs:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                <z-listing-card v-for="(listing, listingIdx) in $skelet(listings, 10)" :key="`listing-${listingIdx}`" :listing="listing" />
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
        this.listings = await this._getListings(new URLSearchParams(this.$route.query).toString())
    }
}
</script>

<style>

</style>