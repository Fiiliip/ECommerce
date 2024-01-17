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
        },

        async _getListing(id: number) {
            let listing = null
            try {
                listing = await this.$axios.get(`api/v1/mall/listing/${id}`)
            } catch (error) {
                console.error(error)
            }
            return listing
        },

        getCategoryTitle() {
            return this.$store.getters['emarketplace/categories'].find(category => category.slug === this.$route.query.category)?.title || 'Všetko'
        },

        getFormattedDate(currentDateFormat: string) {
            // Convert date format "YYYY-MM-DD HH:MM:SS" to "DD.MM.YYYY".
            const date = new Date(currentDateFormat)
            return `${date.getDate()}.${date.getMonth() + 1 < 10 ? `0${date.getMonth() + 1}` : date.getMonth() + 1}.${date.getFullYear()}`
        }
    }
}