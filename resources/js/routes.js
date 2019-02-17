import Authorize from './views/Authorize'
import Login from './views/Login'
import User from './views/User'
import Welcome from './views/Welcome'

import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './state'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',

    scrollBehavior(to, from, savedPosition) {
        return {x: 0, y: 0}
    },

    routes: [
        {path: '/', component: Welcome},
        {path: '/authorize', component: Authorize, meta: {requiresGuest: true}},
        {path: '/login', component: Login, meta: {requiresGuest: true}},
        {path: '/user', component: User, meta: {requiresAuth: true}},
        {path: '*', redirect: '/'},
    ]
});

router.beforeEach((to, from, next) => {
    if (to.path !== '/authorize' && document.location.hash.includes('access_token')) {
        next({path: `/authorize${document.location.hash}`})
    }

    const authenticated = store.getters['user/authenticated'];
    if (to.meta.requiresAuth) {
        if (!authenticated) {
            next({path: '/login', query: {redirect: to.fullPath}})
        } else {
            next()
        }
    } else if (to.meta.requiresGuest) {
        if (authenticated) {
            next({path: '/user'})
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router
