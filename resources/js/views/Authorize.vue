<template>
    <div class="p-6">
        <h1>Authorize</h1>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                hash: {
                    access_token: '',
                }
            }
        },

        computed: {
            hashHasAccessToken() {
                return this.hash.hasOwnProperty('access_token')
            },

            accessToken() {
                return this.hash.access_token
            },
        },

        mounted() {
            this.parseHash()
            if (this.hashHasAccessToken) {
                window.localStorage.setItem('token', this.accessToken)
                this.$store.dispatch('user/submitLogin', {token: this.accessToken})
            }
        },

        methods: {
            parseHash() {
                this.hash = document.location.hash
                    .substr(1)
                    .split('&')
                    .map(i => i.split('='))
                    .reduce((pre, [key, value]) => ({...pre, [key]: value}), {})
            },
        },
    }
</script>
