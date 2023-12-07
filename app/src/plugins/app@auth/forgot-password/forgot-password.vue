<template>
    <div class="py-12 sm:px-6 lg:px-8 flex flex-1 flex-col justify-center">
        <div class="mt-10 sm:w-full sm:max-w-[480px] sm:mx-auto">
            <div class="px-6 sm:px-12 py-12 bg-white shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold leading-9 tracking-tight">Zabudnuté heslo?</h2>
                <p class="text-sm">Zadajte svoj e-mail a my Vám pošleme verifikačný kód na resetovanie hesla.</p>

                <form @submit.prevent="login()" class="mt-4 space-y-9">
                    <z-form-input v-model="v$.form.email" label="E-Mail" type="email" autocomplete="email" />

                    <div>
                        <div class="mt-5">
                            <button type="submit" @click.prevent="forgotPassword()" class="flex w-full justify-center rounded-md bg-zinc-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600">
                                Pokračovať
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="mt-10 text-center text-sm text-gray-500">
                Pamätáte si na heslo?
                <a href="/auth/login" class="font-semibold leading-6 text-zinc-600 hover:text-zinc-500" @click.prevent="$router.push({name: 'Login'})">Prihlásiť sa</a>.
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
            },
        }
    },
    validations() {
        return {
            form: {
                email: { required, email },
            }
        }
    },
    methods: {
        async forgotPassword() {
            if (!await this.v$.$validate()) return

            try {
                // TODO: Send AXIOS request.
                localStorage.setItem('emarketplace_reset_password_user_email', this.form.email)
                this.$router.push({ name: 'Reset Password' })
            } catch(error) {
                console.log(error)
            }
        }
    }
}
</script>