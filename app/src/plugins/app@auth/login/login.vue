<template>
    <div class="py-12 sm:px-6 lg:px-8 flex flex-1 flex-col justify-center">
        <div class="mt-10 sm:w-full sm:max-w-[480px] sm:mx-auto">
            <div class="px-6 sm:px-12 py-12 bg-white shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold leading-9 tracking-tight">Prihlásiť sa</h2>

                <form @submit.prevent="login()" class="mt-4 space-y-9">
                    <z-auth-input v-model="v$.form.email" label="E-Mail" type="email" autocomplete="email" />
                    <z-auth-input v-model="v$.form.password" label="Heslo" type="password" autocomplete="password"/>

                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input v-model="rememberMe" id="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 accent-zinc-500 focus:ring-zinc-600" />
                                <label for="remember-me" class="ml-3 block text-sm leading-6">Zapamätať si ma</label>
                            </div>

                            <div class="text-sm leading-6">
                                <a href="/auth/forgot-password" class="font-semibold hover:text-zinc-500" @click.prevent="$router.push({name: 'Forgot Password'})">Zabudnuté heslo?</a>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" @click.prevent="login()" class="flex w-full justify-center rounded-md bg-zinc-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600">
                                Prihlásiť sa
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="mt-10 text-center text-sm text-gray-500">
                Nemáte ešte účet?
                <a href="/auth/register" class="font-semibold leading-6 text-zinc-600 hover:text-zinc-500" @click.prevent="$router.push({name: 'Register'})">Registrovať sa</a>.
            </p>
        </div>
    </div>
</template>

<script>
import useVuealidate from '@vuelidate/core'
import { required, email } from '@vuelidate/validators'

export default {
    data() {
        return {
            v$: useVuealidate(),
            form: {
                email: '',
                password: '',
            },
            rememberMe: false
        }
    },
    validations() {
        return {
            form: {
                email: { required, email },
                password: { required },
            }
        }
    },
    methods: {
        async login() {
            if (!await this.v$.$validate()) return

            try {
                // TODO: Send AXIOS request.

                if (this.rememberMe) {
                    localStorage.setItem('ecommerce_user_remember_me', 'true')
                } else {
                    localStorage.setItem('ecommerce_user_remember_me', 'false')
                }

                this.$router.replace({ name: 'Home' })
            } catch(error) {
                console.log(error)
            }
        }
    }
}
</script>