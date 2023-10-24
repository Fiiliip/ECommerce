export default {
    methods: {
        async _getProducts(query: any) {
            let products = null
            try {
                products = await this.$axios.get(`api/v1/mall/products?${query}`)
            } catch (error) {
                console.error(error)
            }
            return products
        }
    }
}