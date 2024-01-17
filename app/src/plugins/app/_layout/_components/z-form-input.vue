<template>
    <div>
        <label class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
        <div class="mt-2 h-full">
            <!-- Dropdown -->
            <div v-if="type=='dropdown'" class="relative">
                <button @click="showDropdown = !showDropdown" :disabled="!dropdownOptions" :class="{'!ring-red-500': (modelValue.$dirty && modelValue.$error), 'ring-2 ring-inset !ring-zinc-600' : showDropdown, 'bg-zinc-100 opacity-60 cursor-not-allowed': !dropdownOptions }" class="w-full h-9 px-2 py-1 flex items-center justify-between ring-1 ring-inset ring-zinc-300 rounded-md hover:bg-zinc-100">
                    <p v-if="value?.title">{{ value.title }}</p>
                    <p v-else>Vyberte zo zoznamu</p>
                    <div>
                        <img class="w-3 h-3 mt-[1px] mx-auto" src="@/plugins/app/_assets/_icons/arrow-down.svg">
                    </div>
                </button>

                <!-- Options -->
                <div v-if="showDropdown" :class="{ 'max-h-64 overflow-y-scroll' : dropdownOptions }" class="absolute w-full mt-2 bg-white divide-y divide-zinc-300 rounded-lg shadow z-10">
                    <ul class="py-2 text-sm">
                        <li @click="value = option, showDropdown = false" class="cursor-pointer" v-for="option in dropdownOptions" :key="option.id">
                            <p class="px-4 py-2 hover:bg-zinc-100">{{ option.title }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Textarea -->
            <textarea v-else-if="type=='textarea'" v-model="value" :class="{'!ring-red-500': (modelValue.$dirty && modelValue.$error)}" class="block w-full h-full rounded-md border-0 px-2 py-1.5 shadow-sm ring-1 ring-inset ring-zinc-300 focus:ring-2 focus:ring-inset focus:!ring-zinc-600 sm:text-sm sm:leading-6"></textarea>
            <!-- Price -->
            <div v-else-if="type=='price'" class="grid grid-cols-3 items-center">
                <input type="number" v-model="value" :class="{'ring-red-500': (modelValue.$dirty && modelValue.$error)}" class="block w-full rounded-md border-0 px-2 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-zinc-600 sm:text-sm sm:leading-6">
                <p class="ml-1">€</p>
            </div>
            <!-- Images -->
            <div v-else-if="type=='images'" class="flex gap-2">
                <div v-for="(image, imageIdx) in value" :key="`image-${imageIdx}`" class="listing-image relative">
                    <img :src="image.url" :alt="image.name" class="h-20 w-20 rounded-md">
                    <button @click="value.splice(imageIdx, 1)" class="absolute hidden -top-1 -right-1 w-5 h-5 items-center justify-center bg-red-400 rounded-full">
                        <img class="w-3 h-3" src="@/plugins/app/_assets/_icons/eye.svg">
                    </button>
                </div>
                <div v-if="value == null || value?.length < 5" class="relative">
                    <div class="h-20 w-20 text-center border-2 border-dashed rounded-md">
                        <label for="image" class="flex w-full h-full justify-center items-center text-sm cursor-pointer hover:opacity-70">
                            <img class="w-8 h-8" src="@/plugins/app/_assets/_icons/eye.svg">
                        </label>
                    </div>
                    <input @change="uploadImage($event)" id="image" type="file" accept="image/*" class="hidden" multiple>
                </div>
            </div>
            
            <!-- Input -->
            <input v-else v-model="value" :type="type" :autocomplete="autocomplete" :class="{'ring-red-500': (modelValue.$dirty && modelValue.$error)}" class="block w-full rounded-md border-0 px-2 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-zinc-600 sm:text-sm sm:leading-6" />
            
            <div v-if="modelValue.$dirty && modelValue.$error" class="mt-1 text-sm text-red-500">* {{ validationErrors[modelValue.$errors[0].$validator] }}.</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {
            required: true,
        },
        type: {
            type: String,
            default: 'text',
        },
        label: {
            type: String,
            default: '',
        },
        autocomplete: {
            type: String,
            default: '',
        },
        dropdownOptions: {
            type: Array,
        },
    },
    data() {
        return {
            validationErrors: {
                required: 'This field is required',
                email: 'Please enter a valid email address',
                minLength: `This field must contain at least ${this.modelValue.minLength ? this.modelValue.minLength.$params.min : ''} characters`,
                sameAsPassword: 'Passwords do not match',
            },

            showDropdown: false
        }
    },

    computed: {
        value: {
            get() {
                return this.modelValue.$model
            },

            set(value) {
                const modelValue = this.modelValue
                modelValue.$model = value

                this.$emit('update:modelValue', modelValue)
            }
        }
    },

    methods: {
        uploadImage(event) {
            if (this.value == null) {
                this.value = []
            }

            const files = event.target.files

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader() 

                reader.readAsDataURL(file)

                reader.onload = (e) => {
                    this.value.push({
                        name: file.name,
                        url: e.target.result,
                    })
                }
            }
        }
    }
}
</script>

<style lang="sass" scoped>
.listing-image:hover button
    display: flex

</style>