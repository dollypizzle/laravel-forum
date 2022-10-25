<script>
    import Replies from '../components/Replies.vue';
    import SubscribeButton from '../components/SubscribeButton.vue';

    export default {
        props: ['thread'],
        components: {Replies},
        data() {
            return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked,
                title: this.thread.title,
                body: this.thread.body,
                form: {},
                editing: false
            };
        },

        computed: {
            classes() {
                return [
                    'btn',
                    this.locked ? 'btn-info' : 'btn-danger'
                ];
            }
        },

        methods: {
            toggleLock () {
                axios[
                    this.locked ? 'delete' : 'post'
                ]('/locked-threads/' + this.thread.slug);
                this.locked = ! this.locked;
            }
        }
    }
</script>
