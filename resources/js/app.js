import './bootstrap'
import Vue from 'vue'
import router from './routes'
import store from './state'

window.Vue = Vue

Vue.component('acme-menu', require('./components/AcmeMenu.vue').default)
Vue.component('acme-notifications', require('./components/AcmeNotifications.vue').default)
Vue.component('acme-user-sidebar', require('./components/AcmeUserSidebar.vue').default)

const app = new Vue({
    el: '#app',
    router,
    store,

    mounted() {
        this.$store.dispatch('user/fetch')
    },
});
