<template>
    <div :id="'reply-'+id" class="card mb-3">
        <div class="card-header" :class="isBest ? 'bg-info' : ''">
            <div class="level">
                <h6 class="flex" :class="isBest ? 'text-white' : ''">
                    <a :href="'/profiles/' + reply.owner.name"
                        v-text="reply.owner.name" :class="isBest ? 'text-white' : ''">
                    </a> said <span v-text="ago"></span>
                </h6 >

                <div v-if="signedIn">
                    <favorite :reply="reply"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <wysiwyg v-model="body"></wysiwyg>
                    </div>

                    <button class="btn btn-xs btn-primary">Update</button>
                    <button class="btn btn-xs btn-dark" @click="editing = false" type="button">Cancel</button>
                </form>
            </div>

            <div v-else v-html="body"></div>
        </div>

        <div class="card-footer level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
            <div v-if="authorize('owns', reply)">
                <button class="btn btn-xs btn-secondary mr-1" @click="editing = true" v-if="! editing">Edit</button>
                <button class="btn btn-xs btn-danger mr-1" @click="destroy">Delete</button>
            </div>

            <button class="btn btn-xs btn-success ml-auto" @click="markBestReply" v-show="! isBest" v-if="authorize('owns', reply.thread)">Best Reply?</button>
        </div>
    </div>
</template>


<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['reply'],

        components: { Favorite},

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            };
        },

        computed: {
            ago(){
                return moment(this.reply.created_at).fromNow() + '...';
            },

        },

        created () {
            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.id);
            });
        },

        methods: {
            update() {
                axios.patch(
                    '/replies/' + this.id, {
                        body: this.body
                    })
                    .catch(error => {
                        flash(error.response.reply, 'danger');
                    });
                this.editing = false;
                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.id);

                this.$emit('deleted', this.id);
            },

            markBestReply() {
                axios.post('/replies/' + this.id + '/best');
                window.events.$emit('best-reply-selected', this.id);
            }
        }
    }
</script>
