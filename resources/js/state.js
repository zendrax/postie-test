import notifications from './modules/notifications'
import user from './modules/user'

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        notifications,
        user,
    }
})
