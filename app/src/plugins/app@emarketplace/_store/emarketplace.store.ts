import axios from "@/plugins/w/axios/models/axios"

export default {
    namespaced: true,

    state: {
        categories: JSON.parse(localStorage.getItem('emarketplace_categories')) || null,
    },

    mutations: {
        set_categories(state: any, categories: any) {
            state.categories = categories
            localStorage.setItem('emarketplace_categories', JSON.stringify(categories))
        },
    },

    actions: {
        initialize({ dispatch }: { dispatch: any }) {
            Promise.all([dispatch('categories_load')])
        },

        categories_load({ commit }: { commit: any }) {
            return new Promise((resolve, reject) => {
                axios.get('/api/v1/mall/categories').then((categories: any) => {
                    commit('set_categories', categories)
                    resolve(categories)
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