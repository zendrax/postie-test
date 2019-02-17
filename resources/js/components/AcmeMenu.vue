<template>
    <div class="border-b">
        <nav class="container mx-auto flex items-center justify-between flex-wrap p-6">
            <router-link to="/" exact class="flex items-center flex-no-shrink mr-6">
                <span class="font-semibold text-xl tracking-tight uppercase">Postie</span>
            </router-link>
            <div class="block sm:hidden">
                <button @click="toggle"
                        class="flex items-center px-3 py-2 border rounded text-grey-dark border-grey-dark">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>
                        Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
            <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
                <div class="text-sm sm:flex-grow">
                    <!--add menu items here-->
                </div>
                <div>
                    <router-link to="/login" v-if="!authenticated"
                                 class="inline-block text-sm px-4 py-2 leading-none border border-grey-dark rounded hover:bg-grey-dark hover:text-white mt-4 sm:mt-0"
                    >Login
                    </router-link>
                    <router-link to="/user" v-if="authenticated"
                                 class="inline-block text-sm px-4 py-2 leading-none border border-grey-dark rounded hover:bg-grey-dark hover:text-white mt-4 sm:mt-0"
                    >Settings
                    </router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                open: false,
            }
        },

        computed: {
            ...mapGetters('user', {
                authenticated: 'authenticated',
                user: 'details',
            }),
        },

        methods: {
            toggle() {
                this.open = !this.open
            },
        },

        watch: {
            '$route.path'() {
                this.open = false
            }
        },
    }
</script>
