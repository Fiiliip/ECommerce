import axios from "@/plugins/w/axios/models/axios"

export default {
    namespaced: true,

    state: {
        categories: localStorage.getItem('emarketplace_categories') ? JSON.parse(localStorage.getItem('emarketplace_categories')) : null,
    },

    mutations: {
        set_categories(state: any, categories: any) {
            state.categories = categories
            if (categories) {
                localStorage.setItem('emarketplace_categories', JSON.stringify(categories))
            }
        },
    },

    actions: {
        initialize({ dispatch }: { dispatch: any }) {
            Promise.all([dispatch('categories_load')])
        },

        categories_load({ commit }: { commit: any }) {
            return new Promise((resolve, reject) => {
                axios.get('http://127.0.0.1:8000/api/v1/mall/categories').then((response: any) => {
                    const categories = response
                    commit('set_categories', categories)
                    resolve(response)
                }).catch((error: any) => {
                    reject(error)
                })
            })
        }
    },

    getters: {
        categories(state: any) {
            return state.categories
        },
    }
}