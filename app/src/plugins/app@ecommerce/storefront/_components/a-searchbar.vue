<template>
    <div class="w-[95%] sm:w-[70%] flex p-4 bg-white rounded-md shadow-md">
        <input type="text" class="w-full p-2 mr-2 border rounded-md focus:ring focus:ring-blue-400" placeholder="Hľadať...">
        <button @click="null" class="hidden sm:block w-36 p-2 border rounded-md bg-zinc-900 hover:bg-zinc-700">
            <img class="w-5 h-5 mx-auto" src="@/plugins/app/_assets/_icons/search.svg">
        </button>
    </div>
</template>

<script>
export default {
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