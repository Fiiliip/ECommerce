<template>
    <div @click="null" class="p-3 bg-white hover:bg-zinc-100 rounded-md shadow-md cursor-pointer">
        <img src="@/plugins/app/_assets/_icons/placeholder.svg" :alt="product.title" class="w-32 h-32 mx-auto object-cover rounded-lg" />
        <div class="mt-2">
            <h3 class="h-10 text-sm font-semibold text-truncate">{{ product.title }}</h3>
            <div class="line my-2"></div>
            <div class="flex justify-between items-center overflow-hidden">
                <p class="mr-1 text-sm font-bold">{{ product.price }}€</p>
                <div class="flex ml-1 items-center">
                    <img class="h-4 w-4 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/location.svg">
                    <p class="ml-1 text-sm font-semibold">{{ product.location }}</p>
                </div>
            </div>
            <div class="line my-2"></div>
            <div class="flex justify-between items-center">
                <div class="flex mr-1 items-center overflow-hidden">
                    <img class="h-4 w-4 mt-[2px] mx-auto" src="@/plugins/app/_assets/_icons/eye.svg">
                    <p class="ml-1 text-sm font-semibold">{{ product.views }}</p>
                </div>
                <div class="flex ml-1 items-center">
                    <img class="h-4 w-4 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/calendar.svg">
                    <p class="ml-1 text-sm font-semibold">{{ product.date }}</p>
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product: {
                type: Object,
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