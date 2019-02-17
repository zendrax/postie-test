<template>
    <nav class="text-sm sm:border-r p-6">
        <router-link to="/user" class="block">Settings</router-link>
        <button class="block text-red-dark px-4 py-2 leading-none border border-red-dark rounded hover:bg-red-dark hover:text-white mt-4"
                @click.prevent="logout"
        >Logout</button>
    </nav>
</template>

<script>
    export default {
        methods: {
            logout() {
                this.$store.dispatch('user/submitLogout')
            },
        },
    }
</script>

<style scoped>

</style>
