<template>
    <header>
        <div class="w-full h-14 px-5 flex justify-between items-center text-white bg-zinc-900">
            <p>ECommerce</p>
            <div class="flex gap-8 text-sm">
                <a class="hover:text-zinc-300" href="#">Pridať inzerát</a>
                <a @click="$router.push({ name: 'Login' })" class="hover:text-zinc-300" href="/auth/login" >Prihlásiť sa</a>
            </div>
        </div>
    </header>
</template>