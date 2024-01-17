<template>
    <button v-if="category" @click="$router.push({ name: 'Listings', query: { category: category.slug }})" class="flex py-1 px-3 justify-between border rounded-md hover:bg-zinc-200">
        <p>{{ category.title }}</p>
    </button>
    <div v-else class="skelet h-[30px] w-[100px] rounded-md"></div>
</template>

<script>
export default {
    props: {
        category: {
            type: Object,
            required: true,
        }
    }
}
</script>