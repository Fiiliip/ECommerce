<template>
    <div v-if="listing" class="mx-5 my-5">
        <div class="h-full flex flex-col md:flex-row">
            <div class="w-full h-full px-2">
                <!-- Selected Image -->
                <div>
                    <img :src="selectedImage.url" :alt="listing.title" class="xs:h-64 mx-auto" />
                </div>
                <!-- Other Images -->
                <div class="flex mt-2 gap-2 flex-wrap">
                    <img @click="selectedImage = image" v-for="image in listing.images" :key="image.id" :src="image.url" :class="{'opacity-70': image == selectedImage}" class="h-20 sm:h-24 cursor-pointer">
                </div>
            </div>
            <div class="w-full md:w-[75%] lg:w-full h-full px-2 mt-5 md:mt-0">
                <h3 class="text-lg font-semibold">{{ listing.title }}</h3>
                <p class="mt-2">Cena: <span class="font-medium">{{ listing.price }}</span></p>
                <div class="mt-2">
                    <h4 class="font-medium">Kontakt</h4>
                    <p class="text-sm">Meno: <a href="#" class="font-medium hover:text-zinc-400">{{ listing.author.name }}</a></p>
                    <p v-if="listing.author.contact.email" class="text-sm">Email: <a :href="`mailto:${listing.author.contact.email}`" class="hover:text-zinc-400">{{ listing.author.contact.email }}</a></p>
                    <p v-if="listing.author.contact.phone" class="text-sm">Telefón: <a :href="`tel:${listing.author.contact.phone}`" class="hover:text-zinc-400">{{ listing.author.contact.phone }}</a></p>
                </div>
                <div class="flex mt-3 items-center justify-between">
                    <a :href="`http://maps.google.com/?q=${listing.location}`" target="_blank" class="h-5 flex flex-row items-center hover:text-zinc-400 bg-zinc-200 px-2 py-1 mr-1 rounded">
                        <img class="h-3.5 w-3.5 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/location.svg" alt="location"/>
                        <p class="ml-1.5 text-sm">{{ listing.location }}</p>
                    </a>
                    <div class="flex items-center">
                        <div class="h-5 flex flex-row items-center bg-zinc-200 px-2 py-1 mr-1 rounded">
                            <img class="h-4 w-4 mt-[2px] mx-auto" src="@/plugins/app/_assets/_icons/eye.svg" alt="views"/>
                            <p class="ml-1.5 text-sm">{{ listing.views }}</p>
                        </div>
                        <div class="h-5 flex flex-row items-center bg-zinc-200 px-2 py-1 mr-1 rounded">
                            <img class="h-4 w-4 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/calendar.svg" alt="date"/>
                            <p class="ml-1.5 text-sm">{{ listing.date_created }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-2 text-sm">{{ listing.description }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            listing: null,

            selectedImage: null,
        }
    },

    async mounted() {
        // TODO: Change, so it will get query by ID.
        this.listing = await this._getListings()
        this.listing = this.listing[0]

        this.selectedImage = this.listing.images[0]
    }
}
</script>