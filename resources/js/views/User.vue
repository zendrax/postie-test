<template>
    <div class="flex flex-col-reverse sm:flex-row">
        <acme-user-sidebar></acme-user-sidebar>
        <section class="p-6 flex-1">
            <p class="pb-6 border-b">Account Settings</p>
            <div class="mt-4 md:flex">
                <div class="md:w-1/3 md:pr-6">
                    <p>Basics</p>
                    <p class="text-grey-dark text-justify text-sm">This information will not be shown publicly so you do
                        not have to be careful what information you provide.</p>
                </div>
                <div class="md:w-2/3">
                    <input
                            class="bg-grey-lighter cursor-not-allowed leading-none mt-6 p-4 rounded sm:mt-8 text-grey-dark w-full"
                            disabled
                            placeholder="Full name"
                            type="text"
                            :value="user.name"
                    >
                    <input
                            class="bg-grey-lighter cursor-not-allowed leading-none mt-6 p-4 rounded text-grey-dark w-full"
                            disabled
                            placeholder="Username"
                            type="text"
                            :value="user.username"
                    >
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters('user', {
                user: 'details'
            }),
        },
    }
</script>
