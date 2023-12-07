<template>
    <div class="py-12 sm:px-6 lg:px-8 flex flex-1 flex-col justify-center">
        <div class="mt-10 sm:w-full sm:max-w-[480px] sm:mx-auto">
            <div class="px-6 sm:px-12 py-12 bg-white shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold leading-9 tracking-tight">Resetovanie hesla</h2>
                <p class="text-sm">Zadajte verifikačný kód, ktorý sme Vám odoslali na <span class="font-bold">{{ form.email ? form.email : '[chyba pri spracovaní e-mailu]' }}</span> a nové heslo.</p>

                <form @submit.prevent="resetPassword()" class="mt-4 space-y-9">
                    <z-form-input v-model="v$.form.code" label="Verifikačný kód" type="text" />
                    <z-form-input v-model="v$.form.password" label="Heslo" type="password" autocomplete="password"/>
                    <z-form-input v-model="v$.form.password_confirmation" label="Potvrdenie hesla" type="password" />

                    <div>
                        <div class="mt-5">
                            <button type="submit" @click.prevent="resetPassword()" class="flex w-full justify-center rounded-md bg-zinc-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600">
                                Zmeniť heslo
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="mt-10 text-center text-sm text-gray-500">
                Nedostali ste kód?
                <button class="font-semibold leading-6 text-zinc-600 hover:text-zinc-500" @click="resendVerificationCode()">Znovu odoslať</button>.
            </p>
        </div>
    </div>
</template>

<script>
import useVuealidate from '@vuelidate/core'
import { required, minLength, sameAs } from '@vuelidate/validators'

export default {
    data() {
        return {
            v$: useVuealidate(),
            form: {
                email: localStorage.getItem('emarketplace_reset_password_user_email'),
                code: '',
                password: '',
                password_confirmation: ''
            },
        }
    },
    validations() {
        return {
            form: {
                code: { required },
                password: { required, minLength: minLength(8) },
                password_confirmation: { required, sameAsPassword: sameAs(this.form.password) }
            }
        }
    },
    methods: {
        async resetPassword() {
            if (!await this.v$.$validate()) return

            try {
                // TODO: Send AXIOS request.
                localStorage.removeItem('emarketplace_reset_password_email')
                this.$router.replace({ name: 'Login' })
            } catch(error) {
                console.log(error)
            }
        },

        async resendVerificationCode() {
            try {
                // TODO: Send AXIOS request.
                // TODO: Display to user, that verification code was sent to it's email.
            } catch(error) {
                console.log(error)
            }
        }
    }
}
</script>