<template>
    <header>
        <div class="w-full h-14 px-5 flex justify-between items-center text-white bg-zinc-900">
            <p @click="$router.push({ name: 'Home' })" class="cursor-pointer">EMarketplace</p>
            <div class="flex gap-8 text-sm">
                <a @click="$router.push({ name: 'New Listing '})" class="hover:text-zinc-300" href="/new-listing">Pridať inzerát</a>
                <a @click="$router.push({ name: 'Login' })" class="hover:text-zinc-300" href="/auth/login" >Prihlásiť sa</a>
            </div>
        </div>
    </header>
</template>