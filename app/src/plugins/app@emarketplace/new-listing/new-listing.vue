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
                                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 accent-zinc-500 focus:ring-zinc-600" />
                                <label class="ml-3 block text-sm leading-6">Súhlasim s <a href="#" class="font-medium">podmienkami</a> inzercie</label>
                            </div>
                        </div>

                        <div class="sm:max-w-[480px] mt-5 mx-auto">
                            <button type="submit" @click.prevent="createListing()" class="flex w-full justify-center rounded-md bg-zinc-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600">
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
                title: '',
                description: '',
                author_id: null,
                location: null,
                price: 0,
                images: null
            },
            categories: this.$store.getters['emarketplace/categories'],
            showDropdown: false
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
            }
        }
    },

    methods: {
        async createListing() {
            if (!await this.v$.$validate()) return

            try {
                console.log('form', this.form)
                // TODO: Send AXIOS request.
                // this.$router.replace({ name: 'Home' })
            } catch(error) {
                console.log(error)
            }
        }
    }
}
</script>