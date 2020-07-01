<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],
        data: function () {
            return {
                button: {
                    active: this.active
                }
            }
        },
        computed: {
            classes() {
                return ['btn', this.button.active ? 'btn-primary' : 'btn-secondary'];
            }
        },
        methods: {
            subscribe() {
                axios[
                    (this.button.active ? 'delete' : 'post')
                ](location.pathname + '/subscriptions');
                this.button.active = ! this.button.active;
            }
        }
    }
</script>
