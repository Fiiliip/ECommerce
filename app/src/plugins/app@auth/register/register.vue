<template>
    <div class="py-12 sm:px-6 lg:px-8 flex flex-1 flex-col justify-center">
        <div class="mt-10 sm:w-full sm:max-w-[480px] sm:mx-auto">
            <div class="px-6 sm:px-12 py-12 bg-white shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold leading-9 tracking-tight">Registrovať sa</h2>

                <form @submit.prevent="register()" class="mt-4 space-y-9">
                    <div class="md:flex md:space-y-0 space-y-6">
                        <z-auth-input class="md:me-1" v-model="v$.form.name" name="first-name" type="text" label="Meno" autocomplete="given-name"/>
                        <z-auth-input class="md:ms-1" v-model="v$.form.surname" name="last-name" type="text" label="Priezvisko" autocomplete="family-name"/>
                    </div>

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
                            <button type="submit" @click.prevent="register()" class="flex w-full justify-center rounded-md bg-zinc-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600">
                                Registrovať sa
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="mt-10 text-center text-sm text-gray-500">
                Už máte učet?
                <a href="/auth/register" class="font-semibold leading-6 text-zinc-600 hover:text-zinc-500" @click.prevent="$router.push({name: 'Login'})">Prihlásiť sa</a>.
            </p>
        </div>
    </div>
</template>

<script>
import useVuealidate from '@vuelidate/core'
import { required, email, minLength } from '@vuelidate/validators'

export default {
    data() {
        return {
            v$: useVuealidate(),
            form: {
                name: '',
                surname: '',
                email: '',
                password: '',
            },
            rememberMe: false
        }
    },
    validations() {
        return {
            form: { 
                name: { required },
                surname: { required },
                email: { required, email },
                password: { required, minLength: minLength(8) },
            }
        }
    },
    methods: {
        async register() {
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