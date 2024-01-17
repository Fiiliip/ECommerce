<template>
    <div class="py-12 sm:px-6 lg:px-8 flex flex-1 flex-col justify-center">
        <div class="mt-10 sm:w-full sm:mx-auto">
            <div class="px-6 sm:px-12 py-12 bg-white shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold leading-9 tracking-tight">Vytvoriť inzerát</h2>

                <form @submit.prevent="createListing()" class="mt-4 space-y-9">
                    <z-form-input v-model="v$.form.category" label="Kategória" type="dropdown" :dropdownOptions="categories"/>
                    <z-form-input v-model="v$.form.title" label="Nadpis" type="text"/>
                    <z-form-input v-model="v$.form.description" label="Popis" type="textarea"/>
                    <z-form-input v-model="v$.form.location" label="Lokácia" type="text"/>
                    <z-form-input v-model="v$.form.price" label="Cena" type="price"/>

                    <div>
                        <div>
                            <div class="flex items-center">
                                <input v-model="v$.userAgreement.$model" type="checkbox" :class="{'border-red-500 accent-red-500': (v$.userAgreement.$dirty && v$.userAgreement.$error && !v$.userAgreement.$model)}" class="h-4 w-4 rounded border-gray-300 accent-zinc-500 focus:ring-zinc-600" />
                                <label :class="{'text-red-500': (v$.userAgreement.$dirty && v$.userAgreement.$error && !v$.userAgreement.$model)}" class="ml-3 block text-sm leading-6">Súhlasim s <a href="#" class="font-medium hover:text-zinc-400">podmienkami</a> inzercie.</label>
                            </div>
                            <div v-if="v$.userAgreement.$dirty && v$.userAgreement.$error && !v$.userAgreement.$model" class="mt-1 text-sm text-red-500">* This field is required.</div>
                        </div>

                        <div class="sm:max-w-[480px] mt-5 mx-auto">
                            <button :disabled="this.$loader.isLoading()" type="submit" @click.prevent="createListing()" :class="{'!bg-zinc-300': this.$loader.isLoading()}" class="flex w-full justify-center rounded-md bg-zinc-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600">
                                Vytvoriť inzerát
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import useVuealidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import zFormInput from '../../app/_layout/_components/z-form-input.vue'

export default {
  components: { zFormInput },
    data() {
        return {
            v$: useVuealidate(),
            form: {
                category: null,
                category_id: null,
                title: '',
                description: '',
                user_id: null, // Author ID.
                location: null,
                price: 0,
                images: null
            },
            categories: this.$store.getters['emarketplace/categories'],
            userAgreement: false,
            showDropdown: false,
        }
    },

    validations() {
        return {
            form: {
                category: { required },
                title: { required },
                description: { required },
                location: { required },
                price: { required }
            },
            userAgreement: { agreed: (value) => value === true }
        }
    },

    methods: {
        async createListing() {
            if (!await this.v$.$validate()) return
            
            this.$loader.startLoading()

            this.form.category_id = this.form.category.id
            this.form.user_id = this.$store.getters['auth/user'].id

            try {
                await this.$axios.post(`/api/v1/mall/listing`, this.form)
                this.$toast.success('Listing was created.', 'top')
                this.$router.replace({ name: 'Home' })
            } catch(error) {
                this.$toast.error(error.response, 'top')
            } finally {
                this.$loader.stopLoading()
            }
        }
    }
}
</script>