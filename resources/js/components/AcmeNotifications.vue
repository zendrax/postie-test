<template>
    <ul class="list-reset absolute pin-b pin-r p-6">
        <li v-for="(item, index) in list" :key="index" class="flex justify-end">
            <div :class="bgToType(item.type)" class="px-4 py-2 mb-2 rounded max-w-xs">
                <header class="flex justify-between">
                    <span :class="colorToType(item.type)" class="uppercase font-bold">{{ item.type }}</span>
                    <span :class="colorToType(item.type)" class="font-bold ml-10 py-1 pl-2 cursor-pointer text-xs" @click="dismiss(index)">&#10005;</span>
                </header>
                <div :class="colorToType(item.type)">{{ item.message }}</div>
            </div>
        </li>
    </ul>
</template>

<script>
    import {mapGetters, mapMutations} from 'vuex'

    export default {
        computed: {
            ...mapGetters('notifications', {
                list: 'list',
            }),
        },

        mounted() {
            this.autoDismiss()
        },

        methods: {
            ...mapMutations('notifications', {
                add: 'add',
                remove: 'remove',
            }),

            autoDismiss() {
                setTimeout(() => {
                    this.list.forEach((item, index) => {
                        const timeDiff = (new Date).getTime() - item.created
                        if (timeDiff > 10000) {
                            this.dismiss(index)
                        }
                    })
                    this.autoDismiss()
                }, 1000)
            },

            bgToType(type) {
                if (type === 'error') {
                    return 'bg-red-light'
                }
                return 'bg-grey-light'
            },

            colorToType(type) {
                if (type === 'error') {
                    return 'text-white'
                }
                return ''
            },

            dismiss(index) {
                this.remove(index)
            },
        },
    }
</script>

<style scoped>
</style>
