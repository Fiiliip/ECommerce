<template>
    <header>
        <div class="w-full h-14 px-5 flex justify-between items-center text-white bg-zinc-900">
            <p @click="$router.push({ name: 'Home' })" class="cursor-pointer">EMarketplace</p>

            <!-- Larger Screens -->
            <div class="hidden xs:flex gap-8 text-sm">
                <a @click="$router.push({ name: 'New Listing '})" class="hover:text-zinc-300" href="/new-listing">Pridať inzerát</a>
                <div v-if="this.$store.getters['auth/isLoggedIn']" class="flex gap-8">
                    <a @click="$router.push({ name: 'My Listings', query: $store.getters['auth/user'].id})" class="hover:text-zinc-300" :href="`/my-listings/?user=${$store.getters['auth/user'].id}`">Moje inzeráty</a>
                    <a @click="logout()" href="#" class="hover:text-zinc-300">Odhlásiť sa</a>
                </div>
                <a v-else @click="$router.push({ name: 'Login' })" class="hover:text-zinc-300" href="/auth/login">Prihlásiť sa</a>
            </div>

            <!-- Smaller Screens -->
            <div class="xs:hidden relative">
                <button @click="showMobileMenu = !showMobileMenu" class="flex items-center space-y-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div v-if="showMobileMenu" class="xs:hidden absolute top-12 right-0 px-4 pb-2 text-sm bg-zinc-900 rounded-b-lg">
                <a @click="$router.push({ name: 'New Listing '})" class="block py-2 hover:text-zinc-300" href="/new-listing">Pridať inzerát</a>
                <div v-if="this.$store.getters['auth/isLoggedIn']" class="flex flex-col gap-2">
                    <a @click="$router.push({ name: 'My Listings', query: $store.getters['auth/user'].id})" class="hover:text-zinc-300" :href="`/my-listings/?user=${$store.getters['auth/user'].id}`">Moje inzeráty</a>
                    <a @click="logout()" href="#" class="hover:text-zinc-300">Odhlásiť sa</a>
                </div>
                <a v-else @click="$router.push({ name: 'Login' })" class="hover:text-zinc-300" href="/auth/login">Prihlásiť sa</a>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    data() {
        return {
            showMobileMenu: false,
        }
    },

    methods: {
        async logout() {
            this.$loader.startLoading('Odhlasujem sa...')
            await this.$store.dispatch('auth/logout')
            this.$loader.stopLoading()
        }
    }
}
</script>