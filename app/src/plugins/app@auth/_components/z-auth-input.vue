<template>
    <div>
        <label class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
        <div class="mt-2">
            <input v-model="value" type="email" autocomplete="email" :class="{'ring-red-500': (modelValue.$dirty && modelValue.$error)}" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
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
    },
    data() {
        return {
            validationErrors: {
                required: 'This field is required',
                email: 'Please enter a valid email address',
                minLength: `This field must contain at least ${this.modelValue.minLength ? this.modelValue.minLength.$params.min : ''} characters`,
                sameAsPassword: 'Passwords do not match',
            }
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
    // watch: {
    //     modelValue: {
    //         handler(value) {
    //             if (value.$errors && !value.$model) {
    //                 this.isInputTouched = true
    //             }
    //         },
    //         deep: true,
    //     }
    // }
}
</script>