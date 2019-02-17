export default {
    namespaced: true,

    state: {
        list: [],
    },

    getters: {
        list: state => state.list,
    },

    actions: {},

    mutations: {
        add(state, {message, type}) {
            state.list.push({
                created: (new Date).getTime(),
                message,
                type,
            })
        },

        remove(state, index) {
            state.list.splice(index, 1)
        },
    },
}
