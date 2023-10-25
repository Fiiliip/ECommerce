<template>
    <section>
        <h1 class="text-lg font-bold">{{ title }}</h1>
        <div class="grid justify-center grid-cols xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap">
            <z-listing-card class="m-1" v-for="listing in listings" :key="listing.id" :listing="listing"/>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        query: {
            type: String,
            default: ''
        },
    },
    data() {
        return {
            listings: null,
        }
    },

    async mounted() {
        this.listings = await this._getListings(this.query)
    },
}
</script>