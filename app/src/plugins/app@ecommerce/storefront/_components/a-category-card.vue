<template>
    <button @click="null" class="flex py-1 px-3 justify-between border rounded-md hover:bg-zinc-200">
        <img src="">
        <p class="">{{ title }}</p>
    </button>
</template>

<script>
export default {
    props: {
        img: {
            type: String,
            default: '',
        },
        title: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            //
        }
    },
    methods: {
        //
    }
}
</script>