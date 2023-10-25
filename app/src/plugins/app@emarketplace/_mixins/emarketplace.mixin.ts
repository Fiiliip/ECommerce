export default {
    methods: {
        async _getListings(query: any) {
            let listings = null
            try {
                listings = await this.$axios.get(`api/v1/mall/listings?${query}`)
            } catch (error) {
                console.error(error)
            }
            return listings
        }
    }
}