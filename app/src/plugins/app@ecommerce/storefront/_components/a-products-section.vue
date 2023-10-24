<template>
    <section>
        <h1 class="text-lg font-bold">{{ title }}</h1>
        <div class="grid justify-center grid-cols xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap">
            <z-product-card class="m-1" v-for="product in products" :key="product.id" :product="product"/>
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
            products: null,
        }
    },

    async mounted() {
        this.products = await this._getProducts(this.query)
    },
}
</script>