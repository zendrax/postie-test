import router from '../routes'

const nullUser = {
    name: 'Guest',
    username: 'guest',
}

export default {
    namespaced: true,

    state: {
        username: nullUser.username,
        name: nullUser.name,
    },

    getters: {
        authenticated: state => state.name !== nullUser.name && state.username !== nullUser.username && !!window.localStorage.getItem('token'),
        details: state => {
            return {
                name: state.name,
                username: state.username,
            }
        },
        username: state => state.username,
        name: state => state.name,
    },

    actions: {
        fetch({commit}) {
            let token = window.localStorage.getItem('token')
            if (token) {
                window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            }
            window.axios.get('/api/user')
                .then(response => {
                    commit('changeName', response.data.data.name)
                    commit('changeUsername', response.data.data.username)
                    if (router.currentRoute.meta.requiresGuest) {
                        router.push('/user')
                    }
                })
        },

        submitLogin({commit, dispatch}, {token}) {
            window.axios.post('/api/auth/authorize', {token})
                .then(response => {
                    dispatch('fetch')
                })
                .catch(error => {
                    commit('notifications/add', {
                        message: error.response.data.message,
                        type: 'error',
                    }, {root: true})
                })
        },

        submitLogout({commit, dispatch}) {
            window.axios.post('/api/auth/logout')
                .then(response => {
                    window.localStorage.removeItem('token')
                    commit('changeName', nullUser.name)
                    commit('changeUsername', nullUser.username)
                    router.push('/login')
                })
                .catch(error => {
                    commit('notifications/add', {
                        message: error.response.data.message,
                        type: 'error',
                    }, {root: true})
                })
        },
    },

    mutations: {
        changeName(state, name) {
            state.name = name
        },

        changeUsername(state, username) {
            state.username = username
        },
    }
}
