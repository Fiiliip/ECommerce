<template>
    <div v-if="listing" @click="$router.push({ name: 'Listing', params: { id: listing.id }})" class="relative h-fit flex flex-col justify-between p-3 bg-white hover:bg-zinc-100 rounded-md shadow-md cursor-pointer">
        <div class="h-48 flex items-center overflow-hidden rounded-lg">
            <img :src="listing.images[0].url" :alt="listing.title" class="h-full w-full" />
        </div>
        <div class="h-[40%] mt-2">
            <h3 class="h-10 text-sm font-semibold text-truncate">{{ listing.title }}</h3>
            <div class="line my-2"></div>
            <div class="flex justify-between items-center overflow-hidden">
                <p class="mr-1 text-sm font-bold">{{ getFormattedPrice(listing.price) }}</p>
                <div class="flex ml-1 items-center">
                    <img class="h-4 w-4 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/location.svg">
                    <p class="ml-1 text-sm font-semibold">{{ listing.location }}</p>
                </div>
            </div>
            <div class="line my-2"></div>
            <div class="flex justify-between items-center">
                <div class="flex mr-1 items-center overflow-hidden">
                    <img class="h-4 w-4 mt-[2px] mx-auto" src="@/plugins/app/_assets/_icons/eye.svg">
                    <p class="ml-1 text-sm font-semibold">{{ listing.views }}</p>
                </div>
                <div class="flex ml-1 items-center">
                    <img class="h-4 w-4 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/calendar.svg">
                    <p class="ml-1 text-sm font-semibold">{{ getFormattedDate(listing.created_at) }}</p>
                </div> 
            </div>
        </div>
    </div>
    <div v-else class="skelet block h-[200px] w-full rounded-md shadow-md"></div>
</template>

<script>
export default {
    props: {
        listing: {
                type: [Object, null],
                required: true,
            },
        },
    };
</script>

<style lang="scss" scoped>
.text-truncate {
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
	white-space: pre-wrap;
}

.line {
    content: "";
    width: 100%;
    height: 0.5px;
    background-color: black;
}
</style>