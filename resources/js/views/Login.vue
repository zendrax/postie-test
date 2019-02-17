<template>
    <div class="p-6 flex justify-center">
        <div class="bg-grey-lightest shadow-md p-8 w-64 flex flex-col items-center">
            <p class="text-lg">Login with Instagram</p>
            <a class="text-white text-sm bg-blue px-4 py-2 rounded uppercase mt-8" :href="instagramAuthorizationUrl">Login</a>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            instagramAuthorizationUrl() {
                return `${instagram.authorization.url}/?client_id=${instagram.client.id}&redirect_uri=${instagram.redirect.url}&response_type=${instagram.response.type}`
            },
        },
    }
</script>
