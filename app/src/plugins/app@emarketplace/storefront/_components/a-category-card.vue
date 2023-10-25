<template>
    <button @click="$router.push({ name: 'Category', params: { slug: category.slug }})" class="flex py-1 px-3 justify-between border rounded-md hover:bg-zinc-200">
        <p>{{ category.title }}</p>
    </button>
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